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
        if($request->nombre == null || $request->fecha_fin == null || $request->tarea == null){
            flash('Todos los campos son requeridos')->error();
            return redirect()->route('tarea_curso',$id_profesor);
        }
        $fecha = date_format(date_create(), 'Y-m-d');
        if($fecha > $request->fecha_fin){
            flash('La fecha de plazo es invalida')->error();
            return redirect()->route('tarea_curso',$id_profesor);
        }
        $id_profesor = Auth::user()->id;
        
        $fecha = date_format(date_create(), 'Y-m-d H:i:s');

        $extension = $request->file('tarea')->getClientOriginalExtension();

        $cont = DB::table('archivos')->where('id_user', $id_profesor)->where('id_curso', $id_curso)->where('id_materia', $id_materia)->get();
        $cont = count($cont) + 1;

        $nombre =str_replace(' ', '_', $request->nombre);
        $fecha = str_replace(' ', '_', $fecha);
        $fecha = str_replace(':', '-', $fecha);
        $file_name = $nombre.'_'. $fecha . '.' . $extension;
        
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

        $estudiantes = DB::table('estudiantes-cursos')->where('id_curso', $id_curso)->get();

        $archivo = DB::table('archivos')->select('id_archivo')->get();
        $archivo = MAX(end($archivo));
        foreach ($estudiantes as $estudiante) {
            DB::table('tareas')->insert([
                'id_estudiante' => $estudiante->id_estudiante,
                'id_archivo' => $archivo->id_archivo,
                'estado' => 0,
                'nombre_tarea' => $request->nombre,
                'fecha_fin' => $request->fecha_fin
            ]);
        }

        flash('Tarea agregada exitosamente')->success();
        return redirect()->route('tarea_curso',$id_profesor);
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
        return view('users.estudiantes.subir_tarea_estudiantes', compact('materia', 'curso', 'id', 'id_tarea','materias_estudiante'));
        dd($id, $id_tarea);
    }

    public function subir_tarea_estudiante_up(Request $request, $id, $id_tarea)
    {

        request()->validate([
            'tarea' => 'required',
        ]);
        date_default_timezone_set('America/Santiago');
        $fecha = date_format(date_create(), 'Y-m-d H:i:s');
        $nombre = $request->file('tarea')->getClientOriginalName();

        $tarea = DB::table('archivos')->join('materias', 'materias.id_materia', '=', 'archivos.id_materia')
            ->join('tareas', 'tareas.id_archivo', '=', 'archivos.id_archivo')
            ->join('users', 'users.id', '=', 'tareas.id_estudiante')
            ->where('archivos.id_archivo', $id_tarea)->first();


        $cont = DB::table('archivos')->where('id_user', $id)->get();
        $cont = count($cont) + 1;
        $nombre_estudiante =  $tarea->nombre . ' ' . $tarea->apellido_p . ' ' . $tarea->apellido_m;
        $file_name = $nombre_estudiante . '_' . $tarea->materia . '_' . $cont . '_' . $nombre;

        $curso = DB::table('estudiantes-cursos')->where('id_estudiante', $id)->first();
        $ruta = "public/cursos/$curso->id_curso/materias/$tarea->id_materia/estudiantes/$tarea->id";
        $request->file('tarea')->storeAs($ruta, $file_name);

        $ruta = $ruta . '/' . $file_name;

        DB::table('archivos')->insert([
            'id_user' => $id,
            'id_curso' => $tarea->id_curso,
            'id_materia' => $tarea->id_materia,
            'id_tipo_archivo' => 3,
            'ruta_archivo' => $ruta,
            'fecha_archivo' => $fecha,
            'id_tarea' => $id_tarea
        ]);

        DB::table('tareas')->where('id_estudiante', $id)->where('id_archivo', $id_tarea)->update([
            'estado' => 1
        ]);

        flash('Tarea entregada con exito')->success();
        return redirect()->route('tareas_estudiante', $tarea->id);
    }
}
