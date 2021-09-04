<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

use App\Mail\PlanificacionMailable;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Arr;

use PDF;

class PlanificacionController extends Controller
{
    //
    public function planificacion_estudiante($id_estudiante)
    {
        $user = DB::table('users')->where('id', $id_estudiante)->first();
        $curso_estudiante = DB::table('estudiantes-cursos')->where('id_estudiante', $id_estudiante)->first();

        $id = Auth::user()->id;
        $profesor = DB::table('users')->where('id', $id)->first();
        $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->get();
        $materias = DB::table('cursos-materias')->join('materias', 'materias.id_materia', '=', 'cursos-materias.id_materia')->where('id_curso', $curso_estudiante->id_curso)->get();

        $aux = DB::table('profesores-materias')->where('id_profesor', $id)->first();
        $aux = $aux->id_materia;
        $flag = 0;


        $plani = DB::table('plani')->where('id_estudiante', $id_estudiante)->where('id_curso', $curso_estudiante->id_curso)->get();


        //PROFE ESPECIFICO DE UNA MATERIA
        if ($aux != 1) {

            $cursos_materia = DB::table('cursos-materias')->join('cursos', 'cursos.id_curso', '=', 'cursos-materias.id_curso')->where('id_materia', $aux)->get();

            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.planificaciones.planificacion_estudiante', compact('cursos', 'cursos_materia', 'aux', 'flag', 'user', 'materias', 'plani'));
            }

            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
            return view('profesores.cursos.planificaciones.planificacion_estudiante', compact('cursos', 'cursos_materia', 'aux', 'flag', 'user', 'materias', 'plani'));
        }
        //PROFE JEFE
        if ($profesor->id_tipo_usuario == 2) {

            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.planificaciones.planificacion_estudiante', compact('cursos', 'aux', 'flag', 'user', 'materias', 'plani'));
            }
            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
            $estudiantes = DB::table('estudiantes-cursos')->where('id_curso', $cursos->id_curso)->get();
            $tareas = DB::table('archivos')->where('id_user', $id)->where('id_tipo_archivo', 2)->get();
            return view('profesores.cursos.planificaciones.planificacion_estudiante', compact('cursos', 'aux', 'flag', 'estudiantes', 'tareas', 'user', 'materias', 'plani'));
        }
        //PROFE AYUDANTE

        if ($profesor->id_tipo_usuario == 3) {
            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.planificaciones.planificacion_estudiante', compact('cursos', 'aux', 'flag', 'user', 'materias', 'plani'));
            }


            return view('profesores.cursos.planificaciones.planificacion_estudiante', compact('cursos', 'aux', 'flag', 'user', 'materias', 'plani'));
        }
    }


    public function planificacion_up(Request $request, $id)
    {

        $curso = DB::table('estudiantes-cursos')->where('id_estudiante', $id)->first();
        DB::table('plani')->where('id_estudiante', $id)->where('id_curso', $curso->id_curso)->delete();



        $i = 1;
        $lista = array();
        foreach ($request->all() as $item) {
            if ($i != 1)
                array_push($lista, $item);

            $i++;
        }

        $aux = array();
        $i = 1;

        foreach ($lista as $item) {

            array_push($aux, $item);

            if ($i == 8) {

                DB::table('plani')->insert([
                    'id_materia' => $aux[0],
                    'id_estudiante' => $id,
                    'id_curso' => $curso->id_curso,
                    'objetivo' => $aux[1],
                    'adecuacion' => $aux[2],
                    'habilidades' => $aux[3],
                    'indicador' => $aux[4],
                    'metodologia' => $aux[5],
                    'personal' => $aux[6],
                    'social' => $aux[7],
                    'fecha_cambio' => date_format(date_create(), 'Y-m-d')
                ]);
                $aux = array();
                $i = 0;
            }
            $i++;
        }

        $datos = DB::table('plani')->join('materias', 'materias.id_materia', '=', 'plani.id_materia')->where('id_estudiante', $id)->get();
        $usuario =  DB::table('users')->where('users.id', $id)->first();
        $curso = DB::table('estudiantes-cursos')->join('cursos', 'cursos.id_curso', '=', 'estudiantes-cursos.id_curso')->where('id_estudiante', $id)->first();

        $jefe = DB::table('profesores-cursos')->join('users', 'users.id', '=', 'profesores-cursos.id_profesor')->where('id_curso', $curso->id_curso)->where('id_tipo_usuario', 2)->first();
        $ayudante = DB::table('profesores-cursos')->join('users', 'users.id', '=', 'profesores-cursos.id_profesor')->where('id_curso', $curso->id_curso)->where('id_tipo_usuario', 3)->first();
        $pdf = PDF::loadView('PDF.planificacion', compact('datos', 'usuario', 'curso', 'jefe', 'ayudante'));


        $ruta = "cursos/$curso->id_curso/planificaciones";
        $file_name = $id . '-planificacion.pdf';
        $ruta = $ruta . '/' . $file_name;
        Storage::disk('public')->put($ruta, $pdf);

        $ruta = 'public/' . $ruta;
        $x = DB::table('planificaciones')->where('id_estudiante', $id)->first();
        if ($x == null) {

            DB::table('archivos')->insert([
                'id_user' => $jefe->id,
                'id_curso' => $curso->id_curso,
                'id_materia' => 1,
                'id_tipo_archivo' => 1,
                'ruta_archivo' => $ruta,
                'fecha_archivo' => date_format(date_create(), 'Y-m-d')
            ]);
            $id_archivo = DB::table('archivos')->select('id_archivo')->get();
            $id_archivo = MAX(end($id_archivo));

            DB::table('planificaciones')->insert([
                'id_archivo' => $id_archivo->id_archivo,
                'id_estudiante' => $id
            ]);
        } else {
            $query = DB::table('archivos')->where('id_archivo', $x->id_archivo)->where('id_curso', $curso->id_curso)->first();
            if ($query == null) {
                DB::table('archivos')->insert([
                    'id_user' => $jefe->id,
                    'id_curso' => $curso->id_curso,
                    'id_materia' => 1,
                    'id_tipo_archivo' => 1,
                    'ruta_archivo' => $ruta,
                    'fecha_archivo' => date_format(date_create(), 'Y-m-d')
                ]);
                $id_archivo = DB::table('archivos')->select('id_archivo')->get();
                $id_archivo = MAX(end($id_archo));

                DB::table('planificaciones')->where('id_estudiante', $id)->update([
                    'id_archivo' => $id_archivo->id_archivo,
                    'id_estudiante' => $id
                ]);
            }
        }


        flash('Planificacion guardada')->success();
        return redirect()->back();
    }


    public function descargar_planificacion($id)
    {

        $datos = DB::table('plani')->join('materias', 'materias.id_materia', '=', 'plani.id_materia')->where('id_estudiante', $id)->get();
        $usuario =  DB::table('users')->where('users.id', $id)->first();
        $curso = DB::table('estudiantes-cursos')->join('cursos', 'cursos.id_curso', '=', 'estudiantes-cursos.id_curso')->where('id_estudiante', $id)->first();

        $jefe = DB::table('profesores-cursos')->join('users', 'users.id', '=', 'profesores-cursos.id_profesor')->where('id_curso', $curso->id_curso)->where('id_tipo_usuario', 2)->first();
        $ayudante = DB::table('profesores-cursos')->join('users', 'users.id', '=', 'profesores-cursos.id_profesor')->where('id_curso', $curso->id_curso)->where('id_tipo_usuario', 3)->first();
        $pdf = PDF::loadView('PDF.planificacion', compact('datos', 'usuario', 'curso', 'jefe', 'ayudante'));
        //download
        //stream
        $nombre_archivo = $usuario->nombre . ' ' . $usuario->apellido_p . ' ' . $usuario->apellido_m . '- Planificacion.pdf';
        return $pdf->stream($nombre_archivo);
    }
}
