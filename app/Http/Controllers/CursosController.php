<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

use ZipArchive;

use Illuminate\Support\Facades\File;

class CursosController extends Controller
{


    public function lista_cursos()
    {
        return view('cursos.listar_cursos');
    }

    public function curso_crear()
    {
        $profesores = DB::table('users')
            ->select('id', 'nombre', 'apellido_p', 'apellido_m')->where('id_tipo_usuario', 2)->get();

        $profesores_curso = DB::table('profesores-cursos')->get();



        $profes_sin_curso = [];
        foreach ($profesores as $item) {
            $flag = true;
            foreach ($profesores_curso as $indexData) {
                if ($indexData->id_profesor == $item->id)
                    $flag = false;
            }
            if ($flag)
                array_push($profes_sin_curso, $item);
        }


        $ayudantes = DB::table('users')
            ->select('id', 'nombre', 'apellido_p', 'apellido_m')->where('id_tipo_usuario', 3)->get();

        $materias = DB::table('materias')->get();

        return view('cursos.crear_curso', compact('profesores', 'ayudantes', 'materias', 'profes_sin_curso'));
    }

    public function curso_store(Request $request)
    {

        $materias = [];
        $cont = 0;
        foreach ($request->request as $item) {


            if ($cont > 5) {
                array_push($materias, $item);
            }

            $cont++;
        }

        if ($request->ano_curso == null) {
            throw ValidationException::withMessages([
                'ano_curso' => "Seleccione año*",
            ]);
        }

        if ($request->jefe == null || $request->ayudante == null) {
            throw ValidationException::withMessages([
                'profesor' => "Seleccione profesores*",
            ]);
        }

        $query = DB::table('cursos')
            ->where('ano_curso', $request->ano_curso)->where('curso', $request->curso)
            ->first();

        if ($query != null) {
            flash('Ya existe un curso con ese nombre en ese año')->error();
            return redirect()->route('cursos_crear');
        }

        request()->validate([
            'curso' => 'required|string',
        ]);

        DB::table('cursos')->insert([
            'curso' => $request->curso,
            'ano_curso' => $request->ano_curso,
        ]);
        $id_curso = DB::table('cursos')->select('id_curso')->get();
        $id_curso = MAX(end($id_curso));

        if ($request->jefe == -1) {
            DB::table('profesores-cursos')->insert([
                'id_profesor' => 1,
                'id_curso' => $id_curso->id_curso,
            ]);
        }
        //PROFE JEFE
        if ($request->jefe != -1) {
            DB::table('profesores-cursos')->insert([
                'id_profesor' => $request->jefe,
                'id_curso' => $id_curso->id_curso,
            ]);
        }

        //PROFE AYUDANTE
        if ($request->ayudante != -1) {
            DB::table('profesores-cursos')->insert([
                'id_profesor' => $request->ayudante,
                'id_curso' => $id_curso->id_curso,
            ]);
        }

        //CURSOS MATERIAS

        foreach ($materias as $materia) {
            DB::table('cursos-materias')->insert([
                'id_curso' => $id_curso->id_curso,
                'id_materia' => $materia
            ]);
        }
        
       /*  $url = public_path() . '/cursos' . '/' . $request->ano_curso . '/' . $request->curso;
        File::makeDirectory($url, 077, true, true);
        
        $url = public_path() . '/cursos' . '/' . $request->ano_curso . '/' . $request->curso . '/profesor/tareas';
        File::makeDirectory($url, 077, true, true);
        $url = public_path() . '/cursos' . '/' . $request->ano_curso . '/' . $request->curso . '/profesor/planificaciones';
        File::makeDirectory($url, 077, true, true);
        $url = public_path() . '/cursos' . '/' . $request->ano_curso . '/' . $request->curso . '/profesor/evaluaciones';
        File::makeDirectory($url, 077, true, true);
        $url = public_path() . '/cursos' . '/' . $request->ano_curso . '/' . $request->curso . '/estudiantes/tareas';
        File::makeDirectory($url, 077, true, true);
        $url = public_path() . '/cursos' . '/' . $request->ano_curso . '/' . $request->curso . '/estudiantes/evaluaciones';
        File::makeDirectory($url, 077, true, true); */
        flash('Curso creado exitosamente: '.$request->curso)->success();
        return redirect()->route('cursos');
    }

    public function curso_edit(Request $request, $id)
    {
        $curso = DB::table('cursos')->select('*')
            ->where('id_curso', $id)->first();
        $jefe = DB::table('profesores-cursos')->select('users.id', 'users.nombre', 'users.apellido_p', 'users.apellido_m')
            ->join('users', 'users.id', '=', 'profesores-cursos.id_profesor')->where("profesores-cursos.id_curso", $id)->where("users.id_tipo_usuario", 2)->first();
        $ayudante = DB::table('profesores-cursos')->select('users.id', 'users.nombre', 'users.apellido_p', 'users.apellido_m')
            ->join('users', 'users.id', '=', 'profesores-cursos.id_profesor')->where("profesores-cursos.id_curso", $id)->where("users.id_tipo_usuario", 3)->first();
        $aux1 = 0;
        $aux2 = 0;
        if ($jefe == null) {
            $jefe = 1;
            $aux1 = 1;
        }
        if ($ayudante == null) {
            $ayudante = 1;
            $aux2 = 1;
        }

        $profesores = DB::table('users')
            ->select('id', 'nombre', 'apellido_p', 'apellido_m')->where('id_tipo_usuario', 2)->get();

        $profesores_curso = DB::table('profesores-cursos')->get();

        if($aux1 == 1){
            $profes_sin_curso = [];
            foreach ($profesores as $item) {
                $flag = true;
                foreach ($profesores_curso as $indexData) {
                    if ($indexData->id_profesor == $item->id)
                        $flag = false;
                }
                if ($flag)
                    array_push($profes_sin_curso, $item);
            }

            $profesores = $profes_sin_curso;
        }


        if ($aux1 != 1) {
            $profes_sin_curso = [];
            foreach ($profesores as $item) {
                $flag = true;
                foreach ($profesores_curso as $indexData) {
                    if ($indexData->id_profesor == $item->id)
                        $flag = false;
                }
                if ($flag)
                    array_push($profes_sin_curso, $item);
            }

            array_push($profes_sin_curso, $jefe);
            $profesores = $profes_sin_curso;
        }
        $ayudantes = DB::table('users')
            ->select('id', 'nombre', 'apellido_p', 'apellido_m')->where('id_tipo_usuario', 3)->get();


        return view('cursos.editar_curso', compact('curso', 'jefe', 'ayudante', 'profesores', 'ayudantes', 'aux1', 'aux2'));
    }

    public function curso_update(Request $request, $id)
    {


        $materias = [];
        $cont = 0;
        foreach ($request->request as $item) {
            if ($cont > 5) {
                array_push($materias, $item);
            }
            $cont++;
        }

        if ($request->ano_curso == null) {
            throw ValidationException::withMessages([
                'ano_curso' => "Seleccione año*",
            ]);
        }

        if ($request->jefe == null || $request->ayudante == null) {
            throw ValidationException::withMessages([
                'profesor' => "Seleccione profesores*",
            ]);
        }
        request()->validate([
            'curso' => 'required|string',
        ]);

        $query = DB::table('cursos')->where('ano_curso', $request->ano_curso)->where('curso', 'curso')->first();

        if ($query != null) {
            flash('Ya existe un curso con ese nombre en ese año')->error();
            return redirect()->route('cursos_crear');
        }

        DB::table('cursos')->where("id_curso", "=", $id)->update([
            'ano_curso' => $request->ano_curso,
            'curso' => $request->curso,

        ]);
        DB::table('profesores-cursos')->where('id_curso', $id)->delete();
        if ($request->jefe == -1) {
            DB::table('profesores-cursos')->insert([
                'id_profesor' => 1,
                'id_curso' => $id,
            ]);
        }
        if ($request->jefe != -1) {
            DB::table('profesores-cursos')->insert([
                'id_profesor' => $request->jefe,
                'id_curso' => $id,
            ]);
        }
        //PROFE AYUDANTE
        if ($request->ayudante != -1) {
            DB::table('profesores-cursos')->insert([
                'id_profesor' => $request->ayudante,
                'id_curso' => $id,
            ]);
        }
        DB::table('cursos-materias')->where('id_curso', $id)->delete();

        foreach ($materias as $materia) {
            DB::table('cursos-materias')->insert([
                'id_curso' => $id,
                'id_materia' => $materia
            ]);
        }
        flash('Curso editado exitosamente')->success();
        return redirect()->route('cursos_editar', $id);
        dd($request->request, $id);
    }

    public function curso_delet(Request $request, $id)
    {

        $curso = DB::table('cursos')->where('id_curso', $id)->first();
        if ($curso == null) {
            return redirect()->back();
        }
        $query = DB::table('estudiantes-cursos')->where('id_curso',$id)->first();
        if($query != null){
            flash('Existen estudiantes en el curso')->error();
            return redirect()->back();
        }
        
        $archivo = $curso->curso . $curso->ano_curso;
        $archivo = str_replace('0', '', $archivo);
        $archivo = str_replace(':', '', $archivo);
        $archivo = str_replace(' ', '_', $archivo);
        $archivo = $archivo . '.zip';
        $planificaciones = DB::table('archivos')->where('id_curso', $id)->where('id_tipo_archivo', 1)->get();
        $estudiantes = DB::table('users')->join('planificaciones', 'planificaciones.id_estudiante', '=', 'users.id')->where('id_tipo_usuario', 4)->get();

        $tareas = DB::table('archivos')->where('id_curso', $id)->where('id_tipo_archivo', 2)->get();

        $tareas_estudiantes = DB::table('archivos')->where('id_curso', $id)->where('id_tipo_archivo', 3)->get();


        $zip = new ZipArchive();



        $zip->open($archivo, ZipArchive::CREATE);

        $dir = 'planificaciones';
        $zip->addEmptyDir($dir);

        foreach ($planificaciones as $planificacion) {
            $ruta = str_replace('public', 'storage', $planificacion->ruta_archivo);
            foreach ($estudiantes as $estudiante) {

                if ($planificacion->id_archivo == $estudiante->id_archivo) {
                    $nombre = $estudiante->nombre . $estudiante->apellido_p . $estudiante->apellido_m;
                    $extencion = substr($ruta, -3);
                    $nombre = $nombre . '.' . $extencion;
                    $zip->addFile($ruta, 'planificaciones/' . $nombre);
                }
            }
        }
        $cont = 1;
        foreach ($tareas as $tarea) {
            $ruta = str_replace('public', 'storage', $tarea->ruta_archivo);
            $materias = DB::table('materias')->get();

            $nombre = DB::table('tareas')->where('id_archivo', $tarea->id_archivo)->first();
            foreach ($materias as $materia) {
                if ($tarea->id_materia == $materia->id_materia) {
                    $nombre = $nombre->nombre_tarea;
                    $extencion = substr($ruta, -3);
                    $nombre = $nombre . '.' . $extencion;

                    $zip->addFile($ruta, 'tareas/' . $materia->materia . '/tarea_' . $cont . '/' . $nombre);

                    foreach ($tareas_estudiantes as $tarea_estudiante) {

                        if ($tarea_estudiante->id_tarea == $tarea->id_archivo) {
                            $ruta = str_replace('public', 'storage', $tarea_estudiante->ruta_archivo);
                            $estudiante = DB::table('users')->where('id', $tarea_estudiante->id_user)->first();
                            $nombre = $estudiante->nombre . $estudiante->apellido_p . $estudiante->apellido_m;
                            $extencion = substr($ruta, -3);
                            $nombre = 'tarea_' . $cont . '_' . $nombre . '.' . $extencion;
                            $zip->addFile($ruta, 'tareas/' . $materia->materia . '/tarea_' . $cont . '/tareas' . '/' . $nombre);
                        }
                    }
                }
            }

            $cont++;
        }



        $zip->close();
        flash('Reloguee')->success();
        DB::table('cursos')->where('id_curso', $id)->delete();
        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment; filename=$archivo");

        readfile($archivo);
        // Por último eliminamos el archivo temporal creado

        unlink($archivo); //Destruye el archivo temporal





    }
}
