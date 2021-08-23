<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Regione;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DatatableController extends Controller
{
    public function prueba()
    {
        $regiones = Regione::select('id', 'region')->get();

        return datatables()->of($regiones)->toJson();
    }

    public function tabla_estudiantes()
    {

        $tipo_user = Auth::user()->id_tipo_usuario;

        if ($tipo_user == 2 || $tipo_user == 3) {
            $id = Auth::user()->id;
            $curso = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();

            $estudiantes = DB::table('estudiantes-cursos')->join('users', 'users.id', '=', 'estudiantes-cursos.id_estudiante')->where('id_curso', $curso->id_curso)->get();

            return datatables()->of($estudiantes)->addColumn('action', function ($estudiante) {

                $apoderado = DB::table('estudiantes')->where('id', $estudiante->id)->first();
                if ($apoderado != null) {
                    $apoderado = DB::table('users')->where('id', $apoderado->id_apoderado)->first();
                }
                $region = DB::table('regiones')->where('id', $estudiante->id_region)->first();
                $comuna = DB::table('comunas')->where('id', $estudiante->id_comuna)->first();
                $provincia = DB::table('provincias')->where('id', $estudiante->id_provincia)->first();
                $diagnostico = DB::table('estudiantes')->join('diagnosticos', 'diagnosticos.id', '=', 'estudiantes.id_diagnostico')->where('estudiantes.id', $estudiante->id)->first();

                return '<a href=""  data-toggle="modal" data-target="#estudiante_' . $estudiante->id . '" class="btn btn-dark"><i class="fa flaticon-eye"></i></a></button>
                <div class="modal " id="estudiante_' . $estudiante->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Estudiante</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">

                                                <div class="form-group">
                                                    <label class="col-xl-12 col-lg-12 col-form-label" style="text-align: left;"> <b>Nombre: </b> ' . $estudiante->nombre . ' ' . $estudiante->apellido_p . ' ' . $estudiante->apellido_m . '</label>
                                                </div>
                                                <div class="form-group" style="margin-bottom:10%">

                                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: left;"> <b>Correo:</b> ' . $estudiante->email . '</label>
                                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: left;"> <b>Telefono:</b> ' . $estudiante->telefono . '</label>

                                                </div>

                                                <div class="form-group" style="margin-bottom:10%">

                                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: left;"> <b>Diagnostico:</b> ' . $diagnostico->diagnostico . '</label>
                                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: left;"> <b>Otro:</b> ' . $diagnostico->otro . '</label>

                                                </div>

                                                <div class="row ">

                                                    <div class="col-lg-9 col-xl-6" style="margin-top:5px">
                                                        <h5 class="kt-section__title kt-section__title-sm"><b>Apoderado:</b></h5>
                                                    </div>
                                                </div>

                                                <div class="form-group">

                                                    <label class="col-xl-12 col-lg-12 col-form-label" style="text-align: left;"> <b>Nombre: </b>' . $apoderado->nombre . ' ' . $apoderado->apellido_p . ' ' . $apoderado->apellido_m . '</label>

                                                </div>

                                                <div class="form-group" >

                                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: left;"> <b>Correo:</b>' . $apoderado->email . '</label>
                                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: left;"> <b>Telefono:</b>' . $apoderado->telefono . '</label>

                                                </div>

                                                <div class="row">

                                                    <div class="col-lg-9 col-xl-6" style="margin-top:5px">
                                                        <h5 class="kt-section__title kt-section__title-sm"><b>Dirección:</b></h5>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: left;"> <b>Dirección:</b>' . $estudiante->direccion . '</label>
                                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: left;"> <b>Comuna:</b>' . $comuna->comuna . '</label>



                                                </div>

                                                <div class="form-group">
                                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: left;"> <b>Region:</b>' . $region->region . '</label>
                                                    <label class="col-xl-6 col-lg-6 col-form-label" style="text-align: left;"> <b>Provincia:</b>' . $provincia->provincia . '</label>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                                        </div>
                                    </div>
                                </div>';
            })
                ->addColumn('action2', function ($estudiante) {

                    $curso = DB::table('estudiantes-cursos')->join('cursos', 'cursos.id_curso', '=', 'estudiantes-cursos.id_curso')->where('id_estudiante', $estudiante->id)->first();
                    $planificacion = DB::table('archivos')->join('planificaciones', 'planificaciones.id_archivo', 'archivos.id_archivo')
                        ->where('id_curso', $curso->id_curso)->where('id_estudiante', $estudiante->id)
                        ->where('id_tipo_archivo', 1)->first();
                    $ruta2 = route('planificacion_up', $estudiante->id);

                    if ($planificacion != null) {
                        $ruta = route('planificacion_descargar', $planificacion->id_archivo);
                        $token =  csrf_field();
                        return '
                                    <a href="' . $ruta . '" type="submit" class="btn btn-warning"style="align: center;">Descargar</a>
                                    <a href="" data-toggle="modal" data-target="#planificacion_' . $estudiante->id . '"type="submit" class="btn btn-dark" >+</a>
                                    <div class="modal " id="planificacion_' . $estudiante->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modificar Planificación</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group ">

                                                    <label class="" >Nueva planificacion</label>


                                                    <form action="' . $ruta2 . '" method="post" enctype="multipart/form-data">
                                                        ' . $token . '
                                                        <input type="file" name="planificacion" accept="application/pdf, .doc, .docx, .odf" />
                                                        <div class="d-flex pt-10 mt-15" style="margin:20px">
                                                            <div class="mr-2"></div>
                                                            <div>
                                                                <button type="submit" class="btn btn-warning">Guardar</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                                            </div>
                                        </div>
                                    </div>
                                
                                </div> ';
                    } else {
                        $token =  csrf_field();
                        return '
                                   
                                    <a href="" data-toggle="modal" data-target="#planificacion_' . $estudiante->id . '"type="submit" class="btn btn-dark" >+</a>
                                    <div class="modal " id="planificacion_' . $estudiante->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modificar Planificación</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group ">

                                                    <label class="" >Nueva planificacion</label>


                                                    <form action="' . $ruta2 . '" method="post" enctype="multipart/form-data">
                                                        ' . $token . '
                                                        <input type="file" name="planificacion" accept="application/pdf, .doc, .docx, .odf" />
                                                        <div class="d-flex pt-10 mt-15" style="margin:20px">
                                                            <div class="mr-2"></div>
                                                            <div>
                                                                <button type="submit" class="btn btn-warning">Guardar</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                                            </div>
                                        </div>
                                    </div>
                                
                                </div> ';
                    }
                })->rawColumns(['action2' => 'action2', 'action' => 'action'])
                ->make(true);
        }

        $estudiantes = DB::table('users')->join('estudiantes-cursos', 'estudiantes-cursos.id_estudiante', '=', 'users.id')->join('cursos', 'cursos.id_curso', '=', 'estudiantes-cursos.id_curso')->where('id_tipo_usuario', 4)->get();

        return datatables()->of($estudiantes)->addColumn('action', function ($estudiante) {
            $url = route('estudiantes_editar', $estudiante->id);
            return '<a href="' . $url . '" class="btn btn-dark"><i class="fa fa-edit"></i></a></button>';
        })
            ->addColumn('action2', function ($estudiante) {
                $token =  csrf_field();
                $url = "#";
                return ' <form action="' . $url . '" method="post"  class="delete">  ' . $token . ' <input type="hidden" name="id_curso"  value=' .  $estudiante->id . '>
                        <td><button type="submit" value="Eliminar"  class="btn btn-danger" onclick="return confirm(`¿Está seguro que desea eliminar ' .  $estudiante->nombre  . '?`);" /><i class="fa fa-trash"></i></td>
                        </form>';
            })->rawColumns(['action2' => 'action2', 'action' => 'action'])
            ->make(true);
    }

    public function tabla_cursos()
    {
        $cursos = DB::table('cursos')
            ->join('profesores-cursos', "profesores-cursos.id_curso", "=", "cursos.id_curso")
            ->join('users', 'users.id', '=', 'profesores-cursos.id_profesor')
            ->select('cursos.id_curso', 'cursos.curso', 'cursos.ano_curso', 'users.id', 'users.nombre', 'users.apellido_p', 'users.apellido_m', 'users.email')
            ->where("users.id_tipo_usuario", 2)->orWhere("users.id_tipo_usuario", 1)
            ->get();
        $cursos_sin_profes = DB::table('cursos')
            ->join('profesores-cursos', "profesores-cursos.id_curso", "=", "cursos.id_curso")
            ->join('users', 'users.id', '=', 'profesores-cursos.id_profesor')
            ->select('cursos.id_curso', 'cursos.curso', 'cursos.ano_curso', 'users.id', 'users.nombre', 'users.apellido_p', 'users.apellido_m', 'users.email')
            ->where("users.id_tipo_usuario", 1)
            ->get();


        foreach ($cursos as $curso) {
            $curso->ano_curso = \Carbon\Carbon::parse($curso->ano_curso)->format('Y');
        }
        return datatables()->of($cursos)
            ->addColumn('action', function ($curso) {
                $url = route('cursos_editar', $curso->id_curso);
                return '<a href="' . $url . '" class="btn btn-dark"><i class="fa fa-edit"></i></a></button>';
            })
            ->addColumn('action2', function ($curso) {
                $token =  csrf_field();
                $url = route('delet_cursos', $curso->id_curso);
                return ' <form action="' . $url . '" method="post"  class="delete">  ' . $token . ' <input type="hidden" name="id_curso"  value=' .  $curso->id_curso . '>
            <td><button type="submit" value="Eliminar"  class="btn btn-danger" onclick="return confirm(`¿Está seguro que desea eliminar ' .  $curso->curso  . '?`);" /><i class="fa fa-trash"></i></td>
            </form>
            ';
            })->rawColumns(['action2' => 'action2', 'action' => 'action'])
            ->make(true);
    }

    public function tabla_materias()
    {
        $materias = DB::table('materias')->select("*")->get();

        return datatables()->of($materias)
            ->addColumn('action', function ($materias) {
                $url = route('materias_edit', $materias->id_materia);
                return '<a href="' . $url . '" class="btn btn-dark"><i class="fa fa-edit"></i></a></button>';
            })
            ->addColumn('action2', function ($materias) {
                $token =  csrf_field();
                $url = route('materias_delet', $materias->id_materia);
                return ' <form action="' . $url . '" method="post"  class="delete">  ' . $token . ' <input type="hidden" name="id_materia"  value=' .  $materias->id_materia . '>
            <td><button type="submit" value="Eliminar"  class="btn btn-danger" onclick="return confirm(`¿Está seguro que desea eliminar ' .  $materias->materia  . '?, se eliminaran todos los archivos asignados`);" /><i class="fa fa-trash"></i></td>
            </form>
            ';
            })->addColumn('action3', function ($materias) {
                if ($materias->laboral == 0) {
                    return 'Basico';
                } else {
                    return 'Laboral';
                }
            })->rawColumns(['action2' => 'action2', 'action' => 'action', 'action3' => 'action3'])
            ->make(true);
    }

    public function tabla_materias_curso($id)
    {
        $materias = DB::table('materias')->get();

        unset($materias[0]);

        $x = [];

        foreach ($materias as $materia) {


            array_push($x, [$materia, $id]);
        }


        return datatables()->of($x)->addColumn('action', function ($materia) {


            $materias_curso = DB::table('cursos-materias')->join("materias", "materias.id_materia", "=", "cursos-materias.id_materia")
                ->select('cursos-materias.id_curso', 'cursos-materias.id_materia', 'materias.materia')
                ->where("cursos-materias.id_curso", $materia[1])
                ->get();

            foreach ($materias_curso as $item) {

                if ($item->id_materia == $materia[0]->id_materia) {
                    return '<label class="kt-checkbox kt-checkbox--single kt-checkbox--success" style="align-items: center;">
            <input type="checkbox" id="' . $materia[0]->id_materia . '" name="' . $materia[0]->materia . '" value="' . $materia[0]->id_materia . '"style="align-items: center;"checked>
            <span></span></label>';
                }
            }

            return '<label class="kt-checkbox kt-checkbox--single kt-checkbox--success" style="align-items: center;">
            <input type="checkbox" id="' . $materia[0]->id_materia . '" name="' . $materia[0]->materia . '" value="' . $materia[0]->id_materia . '"style="align-items: center;">
            <span></span></label>';
        })->addColumn('action2', function ($materia) {
            return $materia[0]->materia;
        })->toJson();
    }

    public function tabla_NO_materias_curso($id)
    {

        $notMaterias = DB::table('cursos-materias')
            ->select('id_materia')
            ->where('id_curso', $id)
            ->get();
        $allMaterias = DB::table('materias')
            ->select('id_materia', 'materia')
            ->get();

        $materias = [];
        foreach ($allMaterias as $item) {
            $flag = true;
            foreach ($notMaterias as $indexData) {
                if ($indexData->id_materia == $item->id_materia)
                    $flag = false;
            }
            if ($flag)
                array_push($materias, $item);
        }


        return datatables()->of($materias)
            ->addColumn('action', function ($materia) {
                return '<input type="checkbox" name="materia_' . $materia->id_materia . '" value="' . $materia->id_materia . '"> ';
            })
            ->addColumn('action2', function ($materia) {
                $profesores = DB::table('users')->select('id', 'nombre', 'apellido_p', 'apellido_m')->where('id_tipo_usuario', 2)->get();

                $html = '
                                        <select class="form-control form-control-lg form-control-solid" name="profesor_' . $materia->id_materia . '">';
                $html = $html . "<option value='0' selected disabled>Seleccione Profesor</option>";

                foreach ($profesores as $profesor) {
                    $html = $html . '<option value="' . $profesor->id . '" >' . $profesor->nombre . ' ' . $profesor->apellido_p . ' ' . $profesor->apellido_m . '</option>';
                }
                $html = $html . '</select><input type="hidden" name="materia_' . $materia->id_materia . '"  value=' .  $materia->id_materia  . '> ';
                return $html;
            })->rawColumns(['action2' => 'action2', 'action' => 'action'])
            ->toJson();
    }

    public function tabla_profesores()
    {
        $profesores = DB::table('users')->join('tipo_users', 'tipo_users.id_tipo_user', 'users.id_tipo_usuario')
            ->select('users.id', 'users.nombre', 'users.apellido_p', 'users.apellido_m', 'users.rut', 'users.email', 'tipo_users.tipo_user')
            ->where('users.id_tipo_usuario', 2)->orWhere('users.id_tipo_usuario', 3)->get();

        return datatables()->of($profesores)
            ->addColumn('action', function ($id) {
                $name_url = route('editar_profesor', $id->id);

                return '<a href="' . $name_url . '" class="btn btn-dark"><i class="fa fa-edit"></i></a></button>';
            })
            ->addColumn('action2', function ($id) {
                $token =  csrf_field();

                return ' <form action="deletprofesor" method="post"  class="delete">  ' . $token . ' <input type="hidden" name="id=' . $id->id . '"  value=' .  $id->id  . '>
                                        <td><button type="submit" value="Eliminar"  class="btn btn-danger" onclick="return confirm(`¿Está seguro que desea eliminar ' .  $id->nombre  . '?`);" /><i class="fa fa-trash"></i></td>
                                        </form>
                                        ';
            })->rawColumns(['action2' => 'action2', 'action' => 'action'])
            ->toJson();
    }

    public function tabla_profesor_cursos()
    {
        $id = Auth::user()->id;

        $cursos = DB::table('cursos')->join('profesores-cursos', 'profesores-cursos.id_curso', '=', 'cursos.id_curso')->where('id_profesor', $id)->get();
        foreach ($cursos as $curso) {
            $curso->ano_curso = \Carbon\Carbon::parse($curso->ano_curso)->format('Y');
        }
        return datatables()->of($cursos)
            ->addColumn('action', function ($curso) {
                $name_url = route('curso_profesor', $curso->id_curso);
                return '<a href="' . $name_url . '" class="btn btn-dark"><i class="fa fa-edit"></i></a></button>';
            })->rawColumns(['action' => 'action'])
            ->toJson();
        dd($cursos);
    }

    public function tabla_estudiantes_curso($id)
    {

        $estudiantes = DB::table('users')->join('estudiantes-cursos', 'estudiantes-cursos.id_estudiante', '=', 'users.id')
            ->where('id_curso', $id);

        return datatables()->of($estudiantes)
            ->addColumn('action', function ($estudiante) {
                $name_url = route('planificacion_estudiante', $estudiante->id);
                $id = Auth::user()->id;
                if($id == 2 || $id ==3)
                    return '<a href="' . $name_url  . '" class="btn btn-dark"><i class="fa fa-edit"></i></a></button>';
                else{
                    $plani = DB::table('planificaciones')->where('id_estudiante',$estudiante->id)->first();
                    $name_url = route('planificacion_descargar',$plani->id_archivo);
                   
                
                    if($plani != null)
                        return '<a href="' . $name_url  . '" class="btn btn-warning"><i class="fa flaticon-download"></i></a></button>';
                    else    
                        return 'No tiene';
                }

            })->rawColumns(['action' => 'action'])
            ->toJson();
    }

    public function tabla_estudiantes_tareas_p()
    {
        $id = Auth::user()->id;
        $curso = DB::table('estudiantes-cursos')->where('id_estudiante', $id)->first();
        $tareas_pendientes = DB::table('tareas')
            ->join('archivos', 'archivos.id_archivo', '=', 'tareas.id_archivo')
            ->join('materias', 'materias.id_materia', 'archivos.id_materia')
            ->where('tareas.id_estudiante', $id)->where('archivos.id_curso', $curso->id_curso)->where('estado', 0)->get();


        return datatables()->of($tareas_pendientes)
            ->addColumn('action', function ($tarea) {

                $ruta = route('tarea_descargar', $tarea->id_archivo);
                return '<a href="' . $ruta . '" class="btn btn-success"><i class="flaticon-download"></i></a></button>';
            })
            ->addColumn('action2', function ($tarea) {

                $ruta = route('tarea_estudiante_up', ['id' => $tarea->id_estudiante, 'id_tarea' => $tarea->id_archivo]);
                return '<a href="' . $ruta . '" class="btn btn-primary"><i class="flaticon-upload"></i></a></button>';
            })->rawColumns(['action2' => 'action2', 'action' => 'action'])->toJson();
    }

    public function tabla_estudiantes_tareas()
    {
        $id = Auth::user()->id;
        $curso = DB::table('estudiantes-cursos')->where('id_estudiante', $id)->first();
        $tareas_entregadas = DB::table('tareas')
            ->join('archivos', 'archivos.id_archivo', '=', 'tareas.id_archivo')
            ->join('materias', 'materias.id_materia', 'archivos.id_materia')
            ->where('tareas.id_estudiante', $id)->where('archivos.id_curso', $curso->id_curso)->where('estado', 1)->get();

        $tareas_estudiante = DB::table('archivos')
            ->join('materias', 'materias.id_materia', '=', 'archivos.id_materia')->where('id_user', $id)->where('id_curso', $curso->id_curso)->get();

        return datatables()->of($tareas_estudiante)->addColumn('action', function ($tarea) {

            $ruta = route('tarea_descargar', $tarea->id_archivo);

            return '<a href="' . $ruta . '" class="btn btn-success"><i class="flaticon-download"></i></a></button>';
        })
            ->addColumn('action2', function ($tarea) {

                $ruta = route('tarea_estudiante_up', ['id' => $tarea->id_user, 'id_tarea' => $tarea->id_archivo]);
                return '<a href="' . $ruta . '" class="btn btn-primary"><i class="flaticon-upload"></i></a></button>';
            })->rawColumns(['action2' => 'action2', 'action' => 'action'])->toJson();
    }

    public function tabla_materias_tareas($id)
    {
        $materias = DB::table('cursos-materias')->join("materias", "materias.id_materia", "=", "cursos-materias.id_materia")
            ->select('cursos-materias.id_curso', 'cursos-materias.id_materia', 'materias.materia')
            ->where("cursos-materias.id_curso", $id)
            ->get();

        return datatables()->of($materias)->addColumn('action', function ($materias) {
            /* route('materia_curso', ['id_curso' => $materias->id_curso, 'id_materia' => $materias->id_materia]); */
            $token =  csrf_field();
            $url = route('tarea_up', ['id_curso' => $materias->id_curso, 'id_materia' => $materias->id_materia]);
            return '<a href="#" data-toggle="modal" data-target="#tarea_' . $materias->id_materia . '" class="btn btn-dark"><i class="fa fa-edit"></i></a></button>
                    <div class="modal " id="tarea_' . $materias->id_materia . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">' . $materias->materia . ' | Agregar Tarea</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group ">

                                        <h4 ><b>Nueva Tarea<b></h4>


                                        <form action="' . $url . '" method="post" enctype="multipart/form-data">
                                            ' . $token . '
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Titulo</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" name="nombre">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Plazo</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="date" name="fecha_fin">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Archivo</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="file" name="tarea" accept="application/pdf, .doc, .docx, .odf" />
                                                </div>
                                            </div>
                                            
                                            <div class="d-flex justify-content-between pt-10 mt-15" style="margin:20px">
                                            <div class="mr-2"></div>
                                            <div>
                                                <button type="submit" class="btn btn-warning font-weight-bolder px-9 " style="margin:20px">Guardar</button>
                                            </div>
                                        </div>
                                        </form>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                                </div>
                            </div>
                        </div>
                    </div>';
        })->toJson();
    }

    public function tabla_tareas_curso($id)
    {
        $tareas = DB::table('archivos')->join('materias', 'materias.id_materia', '=', 'archivos.id_materia')->where('id_curso', $id)->where('id_tipo_archivo', 2)->get();

        return datatables()->of($tareas)->addColumn('action', function ($tarea) {
            $nombre = DB::table('tareas')->select('nombre_tarea')->where('id_archivo', $tarea->id_archivo)->first();

            $nombre = $nombre->nombre_tarea;
            return $nombre;
        })->addColumn('action2', function ($tarea) {
            $fecha = DB::table('tareas')->select('fecha_fin')->where('id_archivo', $tarea->id_archivo)->first();

            return $fecha->fecha_fin;
        })
            ->addColumn('action3', function ($tarea) {

                $ruta = route('tarea_curso', $tarea->id_archivo);
                return '<a href="' . $ruta . '" class="btn btn-dark"><i class="flaticon-eye" style="aling-icon:center"></i></a>';
            })->rawColumns(['action2' => 'action2', 'action' => 'action', 'action3' => 'action3'])->toJson();
    }

    public function tabla_tareas_estudiantes($id_tarea)
    {

        $tareas = DB::table('tareas')->join('users', 'users.id', '=', 'tareas.id_estudiante')->where('id_archivo', $id_tarea)->get();

        return datatables()->of($tareas)->addColumn('action', function ($tarea) {
            $tarea_estudiante = DB::table('archivos')->where('id_tarea', $tarea->id_archivo)->where('id_user', $tarea->id)->first();

            if ($tarea_estudiante != null)
                $ruta = route('tarea_descargar', $tarea_estudiante->id_archivo);
            if ($tarea->estado == 1)
                return '<a href="' . $ruta . '" class="btn btn-warning"><i class="flaticon-download" style="aling-icon:center"></i></a>';

            return 'Nulo';
        })->toJson();
    }

    public function tabla_materias_agregar()
    {
        $materias = DB::table('materias')->get();
        unset($materias[0]);

        return datatables()->of($materias)->addColumn('action', function ($materia) {

            return '<label class="kt-checkbox kt-checkbox--single kt-checkbox--success" style="align-items: center;">
            <input type="checkbox" id="' . $materia->id_materia . '" name="' . $materia->materia . '" value="' . $materia->id_materia . '"style="align-items: center;">
            <span></span></label>';
        })->toJson();
    }

    public function tabla_tareas_curso_especifico($id_curso, $id_materia)
    {
      
        $tareas = DB::table('archivos')->where('id_curso', $id_curso)->where('id_materia', $id_materia)->where('id_tipo_archivo', 2)->get();
        return datatables()->of($tareas)->addColumn('action', function ($tarea) {
            $nombre = DB::table('tareas')->select('nombre_tarea')->where('id_archivo', $tarea->id_archivo)->first();

            $nombre = $nombre->nombre_tarea;
            return $nombre;
        })->addColumn('action2', function ($tarea) {
            $fecha = DB::table('tareas')->select('fecha_fin')->where('id_archivo', $tarea->id_archivo)->first();

            return $fecha->fecha_fin;
        })
            ->addColumn('action3', function ($tarea) {

                $ruta = route('tarea_curso', $tarea->id_archivo);
                return '<a href="' . $ruta . '" class="btn btn-dark"><i class="flaticon-eye" style="aling-icon:center"></i></a>';
            })->rawColumns(['action2' => 'action2', 'action' => 'action', 'action3' => 'action3'])->toJson();
    }

    public function tabla_cursos_clases($id){

        $materias = DB::table('cursos-materias')->join('materias','materias.id_materia','=','cursos-materias.id_materia')->where('id_curso',$id)->get();
        return datatables()->of($materias)->addColumn('action', function ($materia) {
            $token =  csrf_field();
            $ruta = route('clase_store',['id_materia' => $materia->id_materia, 'id_curso' => $materia->id_curso]);
           
            return '<a href="#" data-toggle="modal" data-target="#materia_' . $materia->id_materia . '" class="btn btn-dark">+</a>
            <div class="modal " id="materia_'.$materia->id_materia.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nueva Clase | '.$materia->materia.'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action="'.$ruta.'" method="post" enctype="multipart/form-data">
                                '.$token.'
                                <div class="tab-content">
                                    <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                                        <div class="kt-form kt-form--label-right">
                                            <div class="kt-form__body">
                                            <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">Agendar Clase:</h3>
                                                    </div>
                                                </div>
    
                                                <input type="hidden" name ="redirect" value="1">
                                                <div class="form-group form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">fecha</label>
                                                    <div class="col-lg-9 col-xl-3">
                                                        
                                                        <input class="form-control" type="date" value="" name="fecha">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">Horario:</h3>
                                                    </div>
                                                </div>
    
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Inicio</label>
                                                    <div class="col-lg-2 col-xl-2">
                                                        
                                                        <input class="form-control" type="time" value="" name="hora_inicio">
                                                    </div>
                                                </div>
    
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Fin</label>
                                                    <div class="col-lg-2 col-xl-2">
                                                        
                                                        <input class="form-control" type="time" value="" name="hora_fin">
                                                    </div>
                                                </div>
    
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">Información:</h3>
                                                    </div>
                                                </div>
    
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Link</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                       
                                                        <input class="form-control" type="text" value="" name="link">
                                                    </div>
                                                </div>
    
                                                <!-- <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">contraseña</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        
                                                        <input class="form-control" type="text" value="" name="password">
                                                    </div>
                                                </div> -->
    
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Detalle</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                       
                                                        <textarea class="form-control" name="detalle" rows="6" cols="50" style="resize: none"></textarea>
                                                    </div>
                                                </div>
    
    
                                                <div class="d-flex justify-content-between  pt-10 mt-15" style="margin:20px">
                                                    <div class="mr-2"></div>
                                                    <div>
                                                        <button type="submit" class="btn btn-success font-weight-bolder px-9 py-4" style="margin:20px">Crear clase</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                        </div>
                    </div>
                </div>

            </div>';})->toJson();
    }

    public function cursos_escuela(){

        $cursos = DB::table('cursos')->join('profesores-cursos','profesores-cursos.id_curso','=','cursos.id_curso')
        ->join('users','users.id','=','profesores-cursos.id_profesor')->where('id_tipo_usuario',2)->get();
        
        foreach ($cursos as $curso) {
            $curso->ano_curso = \Carbon\Carbon::parse($curso->ano_curso)->format('Y');
        }
        return datatables()->of($cursos)->addColumn('action1', function ($curso) {
            $nombre = $curso->nombre.' '.$curso->apellido_p.' '.$curso->apellido_m;
            
            return $nombre;
        })->addColumn('action2', function ($curso){
            $ruta = Route('ver_cursos',$curso->id_curso);
            return '<a href="'.$ruta.'" class="btn btn-dark">ver</a>';
        })->rawColumns(['action2' => 'action2', 'action1' => 'action1', ])->toJson();
        
    }

    public function tabla_clases($id){
        $clases = DB::table('clases')->where('id_clase',$id);

        return datatables()->of($clases)->addColumn('action1', function ($clase) {
            date_default_timezone_set('America/Santiago');
            $clase->hora_inicio = \Carbon\Carbon::parse($clase->hora_inicio)->format('h:i');
            $clase->hora_inicio = \Carbon\Carbon::parse($clase->hora_fin)->format('h:i');
            $horario = $clase->hora_inicio.'-'.$clase->hora_fin;
            return $horario;
        })->addColumn('action2', function ($clase){
            date_default_timezone_set('America/Santiago');
            $fecha = date_format(date_create(), 'Y-m-d');
            if($clase->fechaclase>=$fecha)
                return '<a href="'.$clase->link.'"  target="_blank" class="btn btn-dark">Entrar</a>';
            else
                'No se puede entrar';
        })->rawColumns(['action2' => 'action2', 'action1' => 'action1', ])->toJson();

    }
}
