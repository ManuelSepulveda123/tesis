<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function inicio()
    {

        $tipo_user =  Auth::user()->id_tipo_usuario;

        if ($tipo_user == 1) {
            $dato = "SOY ADMIN";

            $profesores = count(DB::table('users')->where('id_tipo_usuario',2)->get());
            $ayudantes = count(DB::table('users')->where('id_tipo_usuario',3)->get());
            $estudiantes = count(DB::table('users')->where('id_tipo_usuario',4)->get());
            
            return view('inicio.inicio_admin', compact('dato','profesores','ayudantes','estudiantes'));
        } elseif ($tipo_user == 2 || $tipo_user == 3) {

            $dato = "SOY UN PROFE";
            $id = Auth::user()->id;

            $query = DB::table('profesores-materias')->where('id_profesor', $id)->first();
            if ($query->id_materia > 1) {
                $query = DB::table('cursos-materias')->where('id_materia', $query->id_materia)->get();
                if ($query != null) {
                    $dato = "tiene cursos";
                    return view('inicio.inicio_profe', compact('dato'));
                } else {
                    $dato = "Este profesor no tiene ningun curso";
                    return view('inicio.inicio_profe', compact('dato'));
                }
            }

            $query = DB::table('profesores-cursos')->where('id_profesor', $id)->first();
            if ($query != null) {
                $cursos_jefe = DB::table('cursos')->where('id_curso', $query->id_curso)->get();
                return view('inicio.inicio_profe', compact('cursos_jefe'));
            }
            $dato = "Este profesor no tiene ningun curso";
            return view('inicio.inicio_profe', compact('dato'));
        } elseif ($tipo_user == 4) {
            date_default_timezone_set('America/Santiago');

            $id = Auth::user()->id;
            $curso = DB::table('estudiantes-cursos')->where('estudiantes-cursos.id_estudiante', $id)->join('cursos', 'cursos.id_curso', '=', 'estudiantes-cursos.id_curso')->first();

            $fecha = date_format(date_create(), 'Y-m-d');
            $hora = date_format(date_create(), 'G:i:s');

            $materias_estudiante = DB::table('cursos-materias')->join('materias', 'materias.id_materia', '=', 'cursos-materias.id_materia')
                ->where('id_curso', $curso->id_curso)->get();


            $clases = DB::table('clases')->where('id_curso', $curso->id_curso)->where('fecha_clase', '>=', $fecha)->where('hora_fin', '>=', $hora)->get();
            $materias = DB::table('materias')->get();
            return view('inicio.inicio_estudiante', compact('curso', 'clases', 'materias', 'materias_estudiante'));
        }
    }


    public function curso_profesor(Request $request, $id)
    {
        date_default_timezone_set('America/Santiago');
        $fecha = date_format(date_create(), 'Y-m-d');
        $hora = date_format(date_create(), 'G:i:s');
        $curso = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();

        $materias = DB::table('materias')->get();
        $clases = DB::table('clases')->where('id_curso', $curso->id_curso)->where('fecha_clase', '>=', $fecha)->where('hora_fin', '>=', $hora)->get();

        return view('profesores.cursos.clases_curso', compact('curso', 'clases','materias'));
    }

    public function materia_curso(Request $request, $id_curso, $id_materia)
    {

        $id = Auth::user()->id;

        $materia = DB::table('materias')->where('id_materia', $id_materia)->first();
        $curso = DB::table('cursos')->where('id_curso', $id_curso)->first();
        $clases = DB::table('clases')->where('id_curso', $id_curso)->where('id_materia', $id_materia)->get();
        $tareas = DB::table('archivos')->where('id_user', $id)->where('id_curso', $id_curso)->where('id_materia', $id_materia)->get();


        return view('profesores.cursos.materias.materia_curso', compact('materia', 'curso', 'clases', 'tareas'));
    }

    public function equipo_docente()
    {
        return view('profesores.equipo_docente');
    }

    public function tareas_curso($id){

        $curso = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
        return view('profesores.cursos.tareas_curso', compact('curso'));
    }

    public function tarea_curso($id_tarea){

        $tarea = DB::table('archivos')->join('tareas','tareas.id_archivo','=','archivos.id_archivo')->where('archivos.id_archivo',$id_tarea)->first();
        $curso = DB::table('cursos')->where('id_curso',$tarea->id_curso)->first();
        return view('profesores.cursos.tarea_curso', compact('tarea','curso'));
        
    }
}
