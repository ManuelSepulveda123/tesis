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

            $profesores = count(DB::table('users')->where('id_tipo_usuario', 2)->get());
            $ayudantes = count(DB::table('users')->where('id_tipo_usuario', 3)->get());
            $estudiantes = count(DB::table('users')->where('id_tipo_usuario', 4)->get());

            $cursos = DB::table('cursos')->get();

            $nombres = [];

            foreach ($cursos as $curso) {

                array_push($nombres, $curso->curso);
            }

            $archivosaux = DB::table('archivos')->get();
           
            $archivos = [];

            foreach ($cursos as $curso) {
                $cont = 0;
                foreach ($archivosaux as $item) {
                    ;
                    if ($curso->id_curso == $item->id_curso) {
                        $cont = $cont + 1;
                    }
                }
                array_push($archivos, $cont);
            }
            

            return view('inicio.inicio_admin', compact('dato', 'profesores', 'ayudantes', 'estudiantes', 'cursos', 'nombres', 'archivos'));
        } elseif ($tipo_user == 2 || $tipo_user == 3) {

            $id = Auth::user()->id;

            $profesor = DB::table('users')->where('id', $id)->first();
            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->get();

            $aux = DB::table('profesores-materias')->where('id_profesor', $id)->first();
            $aux = $aux->id_materia;
            $flag = 0;
            //PROFE ESPECIFICO DE UNA MATERIA
            if ($aux != 1) {

                $cursos_materia = DB::table('cursos-materias')->join('cursos', 'cursos.id_curso', '=', 'cursos-materias.id_curso')->where('id_materia', $aux)->get();

                if (count($cursos) == 0) {
                    $flag = 1;
                    return view('inicio.inicio_profe', compact('cursos', 'cursos_materia', 'aux', 'flag'));
                }

                $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
                return view('inicio.inicio_profe', compact('cursos', 'cursos_materia', 'aux', 'flag'));
            }
            //PROFE JEFE
            if ($profesor->id_tipo_usuario == 2) {

                if (count($cursos) == 0) {
                    $flag = 1;
                    return view('inicio.inicio_profe', compact('cursos', 'aux', 'flag'));
                }
                $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
                $estudiantes= DB::table('estudiantes-cursos')->where('id_curso',$cursos->id_curso)->get();
                $tareas= DB::table('archivos')->where('id_user',$id)->where('id_tipo_archivo',2)->get();
                return view('inicio.inicio_profe', compact('cursos','aux','flag','estudiantes','tareas'));
            }
            //PROFE AYUDANTE
            
            if ($profesor->id_tipo_usuario == 3) {
                if (count($cursos) == 0) {
                    $flag = 1;
                    return view('inicio.inicio_profe', compact('cursos', 'aux', 'flag'));
                }
             
              
                return view('inicio.inicio_profe', compact('cursos','aux','flag'));
                
            }
            dd($cursos);

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
            $profesores = DB::table('users')->where('id_tipo_usuario',2)->get();
            return view('inicio.inicio_estudiante', compact('curso', 'clases', 'materias', 'materias_estudiante','profesores'));
        }
    }


    public function curso_profesor(Request $request, $id)
    {
        $id = Auth::user()->id;
        date_default_timezone_set('America/Santiago');
        $fecha = date_format(date_create(), 'Y-m-d');
        $hora = date_format(date_create(), 'G:i:s');
        $curso = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
        $materias = DB::table('materias')->get();
        $clases = DB::table('clases')->where('id_curso', $curso->id_curso)->where('fecha_clase', '>=', $fecha)->get();

        $profesor = DB::table('users')->where('id', $id)->first();
        $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->get();

        $aux = DB::table('profesores-materias')->where('id_profesor', $id)->first();
        $aux = $aux->id_materia;
        $flag = 0;
        //PROFE ESPECIFICO DE UNA MATERIA
        if ($aux != 1) {

            $cursos_materia = DB::table('cursos-materias')->join('cursos', 'cursos.id_curso', '=', 'cursos-materias.id_curso')->where('id_materia', $aux)->get();

            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.clases_curso', compact('cursos', 'cursos_materia', 'aux', 'flag','clases','materias','curso'));
            }

            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
            return view('profesores.cursos.clases_curso', compact('cursos', 'cursos_materia', 'aux', 'flag','clases','materias','curso'));
        }
        if ($profesor->id_tipo_usuario == 2) {

            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.clases_curso', compact('cursos',  'aux', 'flag','clases','materias','curso'));
            }
            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
         
            return view('profesores.cursos.clases_curso', compact('cursos', 'aux', 'flag','clases','materias','curso'));
        }
        if ($profesor->id_tipo_usuario == 3) {
            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.clases_curso', compact('cursos', 'aux', 'flag','clases','materias','curso'));
            }
         
          
            return view('profesores.cursos.clases_curso', compact('cursos', 'aux', 'flag','clases','materias','curso'));
            
        }



        return view('profesores.cursos.clases_curso', compact('curso', 'clases', 'materias'));
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

    public function tareas_curso($id)
    {
        $id = Auth::user()->id;
        $curso = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
        
        $profesor = DB::table('users')->where('id', $id)->first();
        $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->get();

        $aux = DB::table('profesores-materias')->where('id_profesor', $id)->first();
        $aux = $aux->id_materia;
        $flag = 0;
        //PROFE ESPECIFICO DE UNA MATERIA
        if ($aux != 1) {

            $cursos_materia = DB::table('cursos-materias')->join('cursos', 'cursos.id_curso', '=', 'cursos-materias.id_curso')->where('id_materia', $aux)->get();

            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.tareas_curso', compact('cursos', 'cursos_materia', 'aux', 'flag','curso'));
            }

            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
            return view('profesores.cursos.tareas_curso', compact('cursos', 'cursos_materia', 'aux', 'flag','curso'));
        }

        if ($profesor->id_tipo_usuario == 2) {

            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.tareas_curso', compact('cursos',  'aux', 'flag','curso'));
            }
            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
            return view('profesores.cursos.tareas_curso', compact('cursos', 'aux', 'flag','curso'));
        }
        if ($profesor->id_tipo_usuario == 3) {
            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.tareas_curso', compact('cursos', 'aux', 'flag','curso'));
            }
         
          
            return view('profesores.cursos.tareas_curso', compact('cursos', 'aux', 'flag','curso'));
            
        }
        return view('profesores.cursos.tareas_curso', compact('curso'));
    }

    public function tarea_curso($id_tarea)
    {
        $id = Auth::user()->id;

        if(Auth::user()->id_tipo_usuario == 1){
            $tarea = DB::table('archivos')->join('tareas', 'tareas.id_archivo', '=', 'archivos.id_archivo')->where('archivos.id_archivo', $id_tarea)->first();
            $curso = DB::table('cursos')->where('id_curso', $tarea->id_curso)->first();
        }
        $tarea = DB::table('archivos')->join('tareas', 'tareas.id_archivo', '=', 'archivos.id_archivo')->where('archivos.id_archivo', $id_tarea)->first();
        $curso = DB::table('cursos')->where('id_curso', $tarea->id_curso)->first();

        
        $profesor = DB::table('users')->where('id', $id)->first();
        $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->get();

        $aux = DB::table('profesores-materias')->where('id_profesor', $id)->first();
        $aux = $aux->id_materia;
        $flag = 0;
        //PROFE ESPECIFICO DE UNA MATERIA
        if ($aux != 1) {

            $cursos_materia = DB::table('cursos-materias')->join('cursos', 'cursos.id_curso', '=', 'cursos-materias.id_curso')->where('id_materia', $aux)->get();

            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.tarea_curso', compact('cursos', 'cursos_materia', 'aux', 'flag','curso','tarea'));
            }

            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
            return view('profesores.cursos.tarea_curso', compact('cursos', 'cursos_materia', 'aux', 'flag','curso','tarea'));
        }
        if ($profesor->id_tipo_usuario == 2) {

            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.tarea_curso', compact('cursos',  'aux', 'flag','curso','tarea'));
            }
            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
            return view('profesores.cursos.tarea_curso', compact('cursos', 'aux', 'flag','curso','tarea'));
        }
        if ($profesor->id_tipo_usuario == 3) {
            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.tarea_curso', compact('cursos', 'aux', 'flag','curso','tarea'));
            }
         
          
            return view('profesores.cursos.tarea_curso', compact('cursos', 'aux', 'flag','curso','tarea'));
            
        }
        

        return view('profesores.cursos.tarea_curso', compact('tarea', 'curso'));
    }

    public function clases_materia_especifica($id_curso, $id_materia)
    {
        $id = Auth::user()->id;
        $materia_1 = DB::table('materias')->where('id_materia', $id_materia)->first();
        $curso_1 = DB::table('cursos')->where('id_curso', $id_curso)->first();
        $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->get();
        $cursos_materia = DB::table('cursos-materias')->join('cursos', 'cursos.id_curso', '=', 'cursos-materias.id_curso')->where('id_materia', $id_materia)->get();

        $clases = DB::table('clases')->where('id_curso', $id_curso)->where('id_materia', $id_materia)->get();
        $aux = 0;

        $flag = 0;

        $profe = DB::table('profesores-materias')->where('id_profesor', $id)->first();
        if ($materia_1->id_materia != $profe->id_materia) {
            return redirect()->route('inicio');
        }

        if (count($cursos) == 0) {
            $flag = 1;
            return view('profesores.especificos.clases_especifica', compact('materia_1', 'curso_1', 'cursos_materia', 'aux', 'flag', 'cursos', 'clases'));
        }
        $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
        return view('profesores.especificos.clases_especifica', compact('materia_1', 'curso_1', 'cursos_materia', 'aux', 'flag', 'cursos', 'clases'));
    }

    public function tareas_materia_especifica($id_curso, $id_materia)
    {
        $id = Auth::user()->id;
        $materia_1 = DB::table('materias')->where('id_materia', $id_materia)->first();
        $curso_1 = DB::table('cursos')->where('id_curso', $id_curso)->first();
        $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->get();
        $cursos_materia = DB::table('cursos-materias')->join('cursos', 'cursos.id_curso', '=', 'cursos-materias.id_curso')->where('id_materia', $id_materia)->get();

        $aux = 0;

        $flag = 0;

        $profe = DB::table('profesores-materias')->where('id_profesor', $id)->first();
        if ($materia_1->id_materia != $profe->id_materia) {
            return redirect()->route('inicio');
        }

        if (count($cursos) == 0) {
            $flag = 1;
            return view('profesores.especificos.tarea_especifica', compact('materia_1', 'curso_1', 'cursos_materia', 'aux', 'flag', 'cursos'));
        }
        $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
        return view('profesores.especificos.tarea_especifica', compact('materia_1', 'curso_1', 'cursos_materia', 'aux', 'flag', 'cursos'));
    }

    public function cursos_escuela(){

        return view('escuela.cursos');
    }

    public function ver_curso($id){

        $curso = DB::table('cursos')->join('profesores-cursos','profesores-cursos.id_curso','=','cursos.id_curso')
        ->join('users','users.id','=','profesores-cursos.id_profesor')->where('id_tipo_usuario',2)->where('cursos.id_curso',$id)->first();
        $curso->ano_curso = \Carbon\Carbon::parse($curso->ano_curso)->format('Y');

        $ayudante = DB::table('cursos')->join('profesores-cursos','profesores-cursos.id_curso','=','cursos.id_curso')
        ->join('users','users.id','=','profesores-cursos.id_profesor')->where('id_tipo_usuario',3)->where('cursos.id_curso',$id)->first();
        
        return view('escuela.perfil_curso',compact('curso','ayudante'));
    }

    public function clases_escuela(){
        return view('escuela.clases');
    }

    public function tareas_escuela(){

        return view('escuela.tareas');
    }
}
