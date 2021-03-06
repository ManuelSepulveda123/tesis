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
                foreach ($archivosaux as $item) {;
                    if ($curso->id_curso == $item->id_curso) {
                        $cont = $cont + 1;
                    }
                }
                array_push($archivos, $cont);
            }


            return view('inicio.inicio_admin', compact('profesores', 'ayudantes', 'estudiantes', 'cursos', 'nombres', 'archivos'));
        } elseif ($tipo_user == 2 || $tipo_user == 3) {

            $id = Auth::user()->id;

            $profesor = DB::table('users')->where('id', $id)->first();
            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->get();

            $aux = DB::table('profesores-materias')->where('id_profesor', $id)->first();
            $aux = $aux->id_materia;
            $flag = 0;
            //PROFE ESPECIFICO DE UNA MATERIA

            if ($aux != 1) {
                date_default_timezone_set('America/Santiago');
                $fecha = date_format(date_create(), 'Y-m-d');
                $hora = date_format(date_create(), 'G:i:s');
                $cursos_materia = DB::table('cursos-materias')->join('cursos', 'cursos.id_curso', '=', 'cursos-materias.id_curso')->where('id_materia', $aux)->get();

                if (count($cursos) == 0) {
                    $flag = 1;
                    return view('inicio.inicio_profe', compact('cursos', 'cursos_materia', 'aux', 'flag'));
                }
                $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
                $clases = DB::table('clases')->join('materias', 'materias.id_materia', '=', 'clases.id_materia')->join('users', 'users.id', '=', 'clases.id_profesor')->where('id_curso', $cursos->id_curso)->where('fecha_clase', '>=', $fecha)->get();
                $materias = DB::table('materias')->get();

                return view('inicio.inicio_profe', compact('cursos', 'cursos_materia', 'aux', 'flag', 'clases', 'materias'));
            }
            //PROFE JEFE
            if ($profesor->id_tipo_usuario == 2) {
                date_default_timezone_set('America/Santiago');
                $fecha = date_format(date_create(), 'Y-m-d');
                $hora = date_format(date_create(), 'G:i:s');



                if (count($cursos) == 0) {
                    $flag = 1;
                    return view('inicio.inicio_profe', compact('cursos', 'aux', 'flag'));
                }

                $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
                $clases = DB::table('clases')->join('materias', 'materias.id_materia', '=', 'clases.id_materia')->join('users', 'users.id', '=', 'clases.id_profesor')->where('id_curso', $cursos->id_curso)->where('fecha_clase', '>=', $fecha)->get();
                $materias = DB::table('materias')->get();
               
                $estudiantes = DB::table('estudiantes-cursos')->where('id_curso', $cursos->id_curso)->get();
                $tareas = DB::table('archivos')->where('id_user', $id)->where('id_tipo_archivo', 2)->get();


                return view('inicio.inicio_profe', compact('cursos', 'aux', 'flag', 'estudiantes', 'tareas', 'clases', 'materias'));
            }
            //PROFE AYUDANTE

            if ($profesor->id_tipo_usuario == 3) {
                date_default_timezone_set('America/Santiago');
                $fecha = date_format(date_create(), 'Y-m-d');
                $hora = date_format(date_create(), 'G:i:s');
                $clases = array();
                foreach ($cursos as $item) {
                    $x  = DB::table('clases')->where('id_curso', $item->id_curso)->join('materias', 'materias.id_materia', '=', 'clases.id_materia')->join('users', 'users.id', '=', 'clases.id_profesor')->where('fecha_clase', '>=', $fecha)->orderBy('fecha_clase')->orderBy('hora_inicio')->get();
                    array_push($clases, $x);
                }
                $materias = DB::table('materias')->get();

                if (count($cursos) == 0) {
                    $flag = 1;
                    return view('inicio.inicio_coeducador', compact('cursos', 'aux', 'flag', 'clases', 'materias'));
                }

                return view('inicio.inicio_coeducador', compact('cursos', 'aux', 'flag', 'clases', 'materias'));
            }


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
            $profesores = DB::table('users')->where('id_tipo_usuario', 2)->get();
            return view('inicio.inicio_estudiante', compact('curso', 'clases', 'materias', 'materias_estudiante', 'profesores'));
        }
    }


    public function curso_profesor(Request $request, $id_curso)
    {
        $id = Auth::user()->id;


        date_default_timezone_set('America/Santiago');
        $fecha = date_format(date_create(), 'Y-m-d');
        $hora = date_format(date_create(), 'G:i:s');

        $profesor = DB::table('users')->where('id', $id)->first();
        $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->get();

        $aux = DB::table('profesores-materias')->where('id_profesor', $id)->first();
        $aux = $aux->id_materia;
        $flag = 0;
        //PROFE ESPECIFICO DE UNA MATERIA
        if ($aux != 1) {

            $curso = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('profesores-cursos.id_curso', $id_curso)->first();
            if ($curso == null) {
                return redirect()->route('inicio');
            }
            $materias = DB::table('materias')->get();
            $clases = DB::table('clases')->where('id_curso', $curso->id_curso)->where('fecha_clase', '>=', $fecha)->get();
            $cursos_materia = DB::table('cursos-materias')->join('cursos', 'cursos.id_curso', '=', 'cursos-materias.id_curso')->where('id_materia', $aux)->get();

            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.clases_curso', compact('cursos', 'cursos_materia', 'aux', 'flag', 'clases', 'materias', 'curso'));
            }

            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
            return view('profesores.cursos.clases_curso', compact('cursos', 'cursos_materia', 'aux', 'flag', 'clases', 'materias', 'curso'));
        }
        if ($profesor->id_tipo_usuario == 2) {


            $curso = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('profesores-cursos.id_profesor', $id)->first();
            $materias = DB::table('materias')->get();
            $clases = DB::table('clases')->where('id_curso', $curso->id_curso)->where('fecha_clase', '>=', $fecha)->orderBy('fecha_clase')->orderBy('hora_inicio')->get();


            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.clases_curso', compact('cursos',  'aux', 'flag', 'clases', 'materias', 'curso'));
            }
            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();

            return view('profesores.cursos.clases_curso', compact('cursos', 'aux', 'flag', 'clases', 'materias', 'curso'));
        }
        if ($profesor->id_tipo_usuario == 3) {
            $query = DB::table('profesores-cursos')->where('id_profesor', $id)->where('id_curso', $id_curso)->first();
            if ($query == null) {
                return redirect()->route('inicio');
            }
            $curso = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('profesores-cursos.id_curso', $id_curso)->first();
            $materias = DB::table('materias')->get();
            $clases = DB::table('clases')->where('id_curso', $curso->id_curso)->where('fecha_clase', '>=', $fecha)->orderBy('fecha_clase')->orderBy('hora_inicio')->get();
            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.clases_curso', compact('cursos', 'aux', 'flag', 'clases', 'materias', 'curso'));
            }


            return view('profesores.cursos.clases_curso', compact('cursos', 'aux', 'flag', 'clases', 'materias', 'curso'));
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

    public function tareas_curso($id_curso)
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
                return view('profesores.cursos.tareas_curso', compact('cursos', 'cursos_materia', 'aux', 'flag', 'curso'));
            }

            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
            return view('profesores.cursos.tareas_curso', compact('cursos', 'cursos_materia', 'aux', 'flag', 'curso'));
        }

        if ($profesor->id_tipo_usuario == 2) {
            if ($id != $id_curso) {
                return redirect()->route('inicio');
            }
            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.tareas_curso', compact('cursos',  'aux', 'flag', 'curso'));
            }
            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
            return view('profesores.cursos.tareas_curso', compact('cursos', 'aux', 'flag', 'curso'));
        }
        if ($profesor->id_tipo_usuario == 3) {
            $curso = DB::table('cursos')->where('id_curso', $id_curso)->first();
            $query = DB::table('profesores-cursos')->where('id_curso', $id_curso)->where('id_profesor', $id)->first();

            if ($query == null) {
                return redirect()->route('inicio');
            }

            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.tareas_curso', compact('cursos', 'aux', 'flag', 'curso'));
            }


            return view('profesores.cursos.tareas_curso', compact('cursos', 'aux', 'flag', 'curso'));
        }
        return view('profesores.cursos.tareas_curso', compact('curso'));
    }

    public function tarea_curso($id_tarea)
    {
        $id = Auth::user()->id;
        $tarea = DB::table('tareas')->where('id_tarea', $id_tarea)->join('cursos', 'cursos.id_curso', '=', 'tareas.id_curso')->first();
        /* $tateas_estudaintes = DB::table('estudiantes-tareas')->where('id_tarea',$id_tarea)->get(); */
        $tarea->fecha_plazo = \Carbon\Carbon::parse($tarea->fecha_plazo)->format('d-m-Y');

        if ($id == 1) {
            return view('profesores.cursos.tarea_curso', compact('tarea'));
        }


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
                return view('profesores.cursos.tarea_curso', compact('cursos', 'cursos_materia', 'aux', 'flag', 'tarea'));
            }

            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
            return view('profesores.cursos.tarea_curso', compact('cursos', 'cursos_materia', 'aux', 'flag', 'tarea'));
        }
        if ($profesor->id_tipo_usuario == 2) {

            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.tarea_curso', compact('cursos',  'aux', 'flag', 'tarea'));
            }
            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
            return view('profesores.cursos.tarea_curso', compact('cursos', 'aux', 'flag', 'tarea'));
        }
        if ($profesor->id_tipo_usuario == 3) {
            if (count($cursos) == 0) {
                $flag = 1;
                return view('profesores.cursos.tarea_curso', compact('cursos', 'aux', 'flag', 'tarea'));
            }


            return view('profesores.cursos.tarea_curso', compact('cursos', 'aux', 'flag', 'tarea'));
        }


        return view('profesores.cursos.tarea_curso', compact('tarea', 'curso'));
    }

    public function clases_materia_especifica($id_curso, $id_materia)
    {
        $id = Auth::user()->id;

        $user = DB::table('users')->join('profesores-materias', 'profesores-materias.id_profesor', '=', 'users.id')->join('profesores-cursos', 'profesores-cursos.id_profesor', '=', 'users.id')->where('id_materia', $id_materia)->where('id', $id)->first();
        if ($user == null) {
            return redirect()->route('inicio');
        }
        $query = DB::table('cursos-materias')->where('id_curso', $id_curso)->where('id_materia', $id_materia)->first();
        if ($query == null) {
            return redirect()->route('inicio');
        }

        $materia_1 = DB::table('materias')->where('id_materia', $id_materia)->first();
        $curso_1 = DB::table('cursos')->where('id_curso', $id_curso)->first();



        $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->get();
        $cursos_materia = DB::table('cursos-materias')->join('cursos', 'cursos.id_curso', '=', 'cursos-materias.id_curso')->where('id_materia', $id_materia)->get();
        date_default_timezone_set('America/Santiago');
        $fecha = date_format(date_create(), 'Y-m-d');
        $clases = DB::table('clases')->where('id_curso', $id_curso)->where('id_materia', $id_materia)->where('fecha_clase', '>=', $fecha)->orderBy('fecha_clase')->orderBy('hora_inicio')->get();
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

        $user = DB::table('users')->join('profesores-materias', 'profesores-materias.id_profesor', '=', 'users.id')->join('profesores-cursos', 'profesores-cursos.id_profesor', '=', 'users.id')->where('id_materia', $id_materia)->where('id', $id)->first();
        if ($user == null) {
            return redirect()->route('inicio');
        }
        $query = DB::table('cursos-materias')->where('id_curso', $id_curso)->where('id_materia', $id_materia)->first();
        if ($query == null) {
            return redirect()->route('inicio');
        }
        
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

    public function cursos_escuela()
    {

        $tipo_user =  Auth::user()->id_tipo_usuario;

        if ($tipo_user == 1) {

            return view('escuela.cursos');
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
                    return view('escuela.cursos', compact('cursos', 'cursos_materia', 'aux', 'flag'));
                }

                $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
                return view('escuela.cursos', compact('cursos', 'cursos_materia', 'aux', 'flag'));
            }
            //PROFE JEFE
            if ($profesor->id_tipo_usuario == 2) {

                if (count($cursos) == 0) {
                    $flag = 1;
                    return view('escuela.cursos', compact('cursos', 'aux', 'flag'));
                }
                $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
                $estudiantes = DB::table('estudiantes-cursos')->where('id_curso', $cursos->id_curso)->get();
                $tareas = DB::table('archivos')->where('id_user', $id)->where('id_tipo_archivo', 2)->get();
                return view('escuela.cursos', compact('cursos', 'aux', 'flag', 'estudiantes', 'tareas'));
            }
            //PROFE AYUDANTE

            if ($profesor->id_tipo_usuario == 3) {
                if (count($cursos) == 0) {
                    $flag = 1;
                    return view('escuela.cursos', compact('cursos', 'aux', 'flag'));
                }

                return view('escuela.cursos', compact('cursos', 'aux', 'flag'));
            }
        }
    }

    public function ver_curso($id)
    {

        $curso = DB::table('cursos')->join('profesores-cursos', 'profesores-cursos.id_curso', '=', 'cursos.id_curso')
            ->join('users', 'users.id', '=', 'profesores-cursos.id_profesor')->where('id_tipo_usuario', 2)->where('cursos.id_curso', $id)->first();
        $curso->ano_curso = \Carbon\Carbon::parse($curso->ano_curso)->format('Y');

        $ayudante = DB::table('cursos')->join('profesores-cursos', 'profesores-cursos.id_curso', '=', 'cursos.id_curso')
            ->join('users', 'users.id', '=', 'profesores-cursos.id_profesor')->where('id_tipo_usuario', 3)->where('cursos.id_curso', $id)->first();

        $tipo_user =  Auth::user()->id_tipo_usuario;

        if ($tipo_user == 1) {

            return view('escuela.perfil_curso', compact('curso', 'ayudante'));
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
                    return view('escuela.perfil_curso', compact('cursos', 'cursos_materia', 'aux', 'flag', 'curso', 'ayudante'));
                }

                $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
                return view('escuela.perfil_curso', compact('cursos', 'cursos_materia', 'aux', 'flag', 'curso', 'ayudante'));
            }
            //PROFE JEFE
            if ($profesor->id_tipo_usuario == 2) {

                if (count($cursos) == 0) {
                    $flag = 1;
                    return view('escuela.perfil_curso', compact('cursos', 'aux', 'flag', 'curso', 'ayudante'));
                }
                $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
                $estudiantes = DB::table('estudiantes-cursos')->where('id_curso', $cursos->id_curso)->get();
                $tareas = DB::table('archivos')->where('id_user', $id)->where('id_tipo_archivo', 2)->get();
                return view('escuela.perfil_curso', compact('cursos', 'aux', 'flag', 'estudiantes', 'tareas', 'curso', 'ayudante'));
            }
            //PROFE AYUDANTE

            if ($profesor->id_tipo_usuario == 3) {
                if (count($cursos) == 0) {
                    $flag = 1;
                    return view('escuela.perfil_curso', compact('cursos', 'aux', 'flag', 'curso', 'ayudante'));
                }

                return view('escuela.perfil_curso', compact('cursos', 'aux', 'flag', 'curso', 'ayudante'));
            }
        }
    }

    public function clases_escuela()
    {
        return view('escuela.clases');
    }

    public function tareas_escuela()
    {

        return view('escuela.tareas');
    }

    public function estudiante_tarea($id_tarea)
    {

        $tarea = DB::table('tareas')->where('id_tarea', $id_tarea)
            ->join('materias', 'materias.id_materia', '=', 'tareas.id_materia')
            ->join('cursos', 'cursos.id_curso', '=', 'tareas.id_curso')
            ->join('users', 'users.id', '=', 'tareas.id_profesor')->first();

        $tarea->fecha_plazo = \Carbon\Carbon::parse($tarea->fecha_plazo)->format('d-m-Y');
        $estudiante = DB::table('users')->where('id', Auth::user()->id)->first();
        $materias_estudiante = DB::table('cursos-materias')->join('materias', 'materias.id_materia', '=', 'cursos-materias.id_materia')
            ->where('id_curso', $tarea->id_curso)->get();

        if ($tarea->id_archivo != null) {
            $archivo = DB::table('archivos')->where('id_archivo', $tarea->id_archivo)->first();
            return view('users.estudiantes.tarea_estudiante', compact('tarea', 'estudiante', 'materias_estudiante', 'archivo'));
        }

        return view('users.estudiantes.tarea_estudiante', compact('tarea', 'estudiante', 'materias_estudiante'));
    }

    public function estudiante_tarea_entregada($id_tarea)
    {

        $id = Auth::user()->id;
        $tarea = DB::table('tareas')->where('id_tarea', $id_tarea)
            ->join('materias', 'materias.id_materia', '=', 'tareas.id_materia')
            ->join('cursos', 'cursos.id_curso', '=', 'tareas.id_curso')
            ->join('users', 'users.id', '=', 'tareas.id_profesor')->first();

        $tarea->fecha_plazo = \Carbon\Carbon::parse($tarea->fecha_plazo)->format('d-m-Y');
        $estudiante = DB::table('users')->where('id', Auth::user()->id)->first();
        $materias_estudiante = DB::table('cursos-materias')->join('materias', 'materias.id_materia', '=', 'cursos-materias.id_materia')
            ->where('id_curso', $tarea->id_curso)->get();
        $tarea_estudiante = DB::table('estudiantes-tareas')->join('archivos', 'archivos.id_archivo', '=', 'estudiantes-tareas.id_archivo')->where('estudiantes-tareas.id_tarea', $id_tarea)->where('id_estudiante', $id)->first();

        $tarea_estudiante->fecha_subida = \Carbon\Carbon::parse($tarea_estudiante->fecha_subida)->format('d-m-Y H:i:s');
        if ($tarea->id_archivo != null) {
            $archivo = DB::table('archivos')->where('id_archivo', $tarea->id_archivo)->first();

            return view('users.estudiantes.tarea_entregada_estudiante', compact('tarea', 'estudiante', 'materias_estudiante', 'archivo', 'tarea_estudiante'));
        }



        return view('users.estudiantes.tarea_entregada_estudiante', compact('tarea', 'estudiante', 'materias_estudiante', 'tarea_estudiante'));
    }
}
