<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TareasController extends Controller
{
    //
    public function tarea_crear($id_curso, $id_materia)
    {
        $materia = DB::table('materias')->where('id_materia', $id_materia)->first();
        $curso = DB::table('cursos')->where('id_curso', $id_curso)->first();


        return view('tareas.crear_tarea', compact('materia', 'curso'));
    }

    public function tarea_up(Request $request, $id_curso, $id_materia)
    {
        date_default_timezone_set('America/Santiago');
        $id_profesor = Auth::user()->id;
        if ($request->nombre == null || $request->fecha_fin == null) {
            flash('Todos los campos son requeridos')->error();
            return redirect()->back();
        }

        $fecha = date_format(date_create(), 'Y-m-d');
        if ($fecha > $request->fecha_fin) {
            flash('La fecha de plazo es invalida')->error();
            return redirect()->back();
        }
        $id_profesor = Auth::user()->id;
        $fecha = date_format(date_create(), 'Y-m-d H:i:s');
        if ($request->tarea != null) {
            $extension = $request->file('tarea')->getClientOriginalExtension();

            $cont = DB::table('archivos')->where('id_user', $id_profesor)->where('id_curso', $id_curso)->where('id_materia', $id_materia)->get();
            $cont = count($cont) + 1;

            $nombre = str_replace(' ', '_', $request->nombre);
            $fecha = str_replace(' ', '_', $fecha);
            $fecha = str_replace(':', '-', $fecha);
            $file_name = $nombre . '_' . $fecha . '.' . $extension;

            $ruta = "public/cursos/$id_curso/materias/$id_materia/tareas";

            $request->file('tarea')->storeAs($ruta, $file_name);

            $ruta = $ruta . '/' . $file_name;

            DB::table('archivos')->insert([
                'id_user' => $id_profesor,
                'id_curso' => $id_curso,
                'id_materia' => $id_materia,
                'id_tipo_archivo' => 2,
                'ruta_archivo' => $ruta,
                'fecha_archivo' => $fecha
            ]);
            $archivo = DB::table('archivos')->select('id_archivo')->get();
            $archivo = MAX(end($archivo));
            DB::table('tareas')->insert([
                'titulo' => $request->nombre,
                'actividad' => $request->actividad,
                'fecha_plazo' => $request->fecha_fin,
                'fecha_subida' => $fecha,
                'id_archivo' => $archivo->id_archivo,
                'id_curso' => $id_curso,
                'id_profesor' => $id_profesor,
                'id_materia' => $id_materia

            ]);
        } else {
            DB::table('tareas')->insert([
                'titulo' => $request->nombre,
                'actividad' => $request->actividad,
                'fecha_plazo' => $request->fecha_fin,
                'fecha_subida' => $fecha,
                'id_archivo' => null,
                'id_curso' => $id_curso,
                'id_profesor' => $id_profesor,
                'id_materia' => $id_materia
            ]);
        }

        flash('Tarea agregada exitosamente')->success();
        return redirect()->back();
    }

    public function descargar_tarea($id)
    {

        $file = DB::table('archivos')->where('id_archivo', $id)->first();
        $file->ruta_archivo = str_replace('public', 'storage', $file->ruta_archivo);
        $pathtoFile = public_path() . '/' . $file->ruta_archivo;

        return response()->download($pathtoFile);
    }

    public function eliminar_tarea($id)
    {


        $tarea = DB::table('archivos')->where('id_archivo', $id)->first();
        Storage::delete($tarea->ruta_archivo);

        DB::table('archivos')->where('id_archivo', $id)->delete();
        flash('Tarea eliminada')->success();


        return redirect()->back();
    }

    public function tareas_estudiante($id)
    {
        $id_original = Auth::user()->id;
        if ($id_original != $id) {
            return redirect()->route('inicio');
        }

        $curso = DB::table('estudiantes-cursos')->join('cursos', 'cursos.id_curso', '=', 'estudiantes-cursos.id_curso')->where('id_estudiante', $id)->first();
        $materias_estudiante = DB::table('cursos-materias')->join('materias', 'materias.id_materia', '=', 'cursos-materias.id_materia')
            ->where('id_curso', $curso->id_curso)->get();

        return view('users.estudiantes.tareas_estudiantes', compact('id', 'curso', 'materias_estudiante'));
        dd($id);
    }

    public function tarea_estudiante_up($id, $id_tarea)
    {

        $materia = DB::table('materias')->join('archivos', 'archivos.id_materia', '=', 'materias.id_materia')->where('id_archivo', $id_tarea)->first();
        $curso = DB::table('cursos')->join('estudiantes-cursos', 'estudiantes-cursos.id_curso', '=', 'cursos.id_curso')->where('id_estudiante', $id)->first();
        $materias_estudiante = DB::table('cursos-materias')->join('materias', 'materias.id_materia', '=', 'cursos-materias.id_materia')
            ->where('id_curso', $curso->id_curso)->get();
        return view('users.estudiantes.subir_tarea_estudiantes', compact('materia', 'curso', 'id', 'id_tarea', 'materias_estudiante'));
        dd($id, $id_tarea);
    }

    public function subir_tarea_estudiante_up(Request $request, $id_tarea)
    {
        $id = Auth::user()->id;
        if ($request->archivo == null) {
            flash('Tiene que subir un archivo')->error();
            return redirect()->back();
        }
        $user = DB::table('users')->where('id',$id)->first();
        date_default_timezone_set('America/Santiago');
        $fecha = date_format(date_create(), 'Y-m-d H:i:s');
        $nombre = $request->file('archivo')->getClientOriginalName();
        $tarea = DB::table('tareas')->where('id_tarea',$id_tarea)->first();

        $nombre_estudiante =  $user->nombre . ' ' . $user->apellido_p . ' ' . $user->apellido_m;
        $file_name = $nombre_estudiante . '_' . $id_tarea.'_' . $nombre;

        $curso = DB::table('estudiantes-cursos')->where('id_estudiante', $id)->first();

        $ruta = "public/cursos/$curso->id_curso/materias/$tarea->id_materia/tareas/$tarea->id_tarea/respuestas";
        $request->file('archivo')->storeAs($ruta, $file_name);

        $ruta = $ruta . '/' . $file_name;

        DB::table('archivos')->insert([
            'id_user' => $id,
            'id_curso' => $tarea->id_curso,
            'id_materia' => $tarea->id_materia,
            'id_tipo_archivo' => 3,
            'ruta_archivo' => $ruta,
            'fecha_archivo' => $fecha,
            'id_tarea' => $tarea->id_tarea
        ]);
        
        $archivo = DB::table('archivos')->select('id_archivo')->get();
        $archivo= MAX(end($archivo));
        
        DB::table('estudiantes-tareas')->insert([
            'id_estudiante' => $id,
            'id_tarea'=>$id_tarea,
            'id_archivo'=>$archivo->id_archivo,
            'comentario'=>$request->comentario,
            'fecha_subida'=>$fecha
        ]);

        flash('Tarea entregada con exito')->success();
        return redirect()->route('tareas_estudiante',$id);
    }

    public function tarea_update(Request $request, $id)
    {
        date_default_timezone_set('America/Santiago');

        if ($request->nombre == null || $request->fecha_plazo == null) {
            flash('Todos los campos son requeridos')->error();
            return redirect()->back();
        }
        $fecha = date_format(date_create(), 'Y-m-d');
        if ($fecha > $request->fecha_plazo) {
            flash('La fecha de plazo es invalida')->error();
            return redirect()->back();
        }
        DB::table('tareas')->where('id_tarea', $id)->update([
            'titulo' => $request->nombre,
            'actividad' => $request->actividad,
            'fecha_plazo' => $request->fecha_plazo,
        ]);
        flash('Tarea entregada con exito')->success();
        return redirect()->back();
    }
}
