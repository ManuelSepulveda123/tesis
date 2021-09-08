<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//INICIO
Route::get('/','App\Http\Controllers\DashboardController@inicio')->name('inicio')->middleware('auth');


//LOGIN
Route::get('login','App\Http\Controllers\LoginController@login_view')->name('login')->middleware('guest');
Route::post('login/validar','App\Http\Controllers\LoginController@login')->name('login_validar');
Route::post('logout','App\Http\Controllers\LoginController@logout')->name('logout');


//CREAR USUARIO
Route::get('users/create','App\Http\Controllers\UserController@create')->name('users.create')->middleware('admin');
Route::post('users','App\Http\Controllers\UserController@store')->name('users.store')->middleware('admin');

//PROFESORES-CRUD
Route::get('list/profesores','App\Http\Controllers\ProfesoresController@lista_profesores')->name('profesores')->middleware('admin');
Route::get('profesores/crear','App\Http\Controllers\ProfesoresController@profesor_crear')->name('profesores_crear')->middleware('admin');
Route::post('profesores/store','App\Http\Controllers\ProfesoresController@profesor_store')->name('profesores_store')->middleware('admin');
Route::get('profesor/{id}/editar', 'App\Http\Controllers\ProfesoresController@profesor_edit')->name('editar_profesor')->middleware('admin');
Route::post('profesor/update/{id}', 'App\Http\Controllers\ProfesoresController@profesor_update')->name('profesor_update')->middleware('admin');
Route::post('profesor/{id}/delet', 'App\Http\Controllers\ProfesoresController@profesor_delet')->name('profesor_delet')->middleware('admin');

//ESTUDIANTES-CRUD
Route::get('list/estudiantes','App\Http\Controllers\EstudianteController@list_estudiantes')->name('estudiantes')->middleware('admin');
Route::get('lista/estudiantes/{id}','App\Http\Controllers\EstudianteController@lista_estudiantes')->name('lista_estudiantes')->middleware('auth');
Route::get('estudiantes/crear','App\Http\Controllers\EstudianteController@estudiante_crear')->name('estudiantes_crear')->middleware('admin');
Route::post('estudiantes/store','App\Http\Controllers\EstudianteController@estudiante_store')->name('estudiantes_store')->middleware('admin');
Route::get('estudiante/{id}/editar','App\Http\Controllers\EstudianteController@estudiante_editar')->name('estudiantes_editar')->middleware('admin');
Route::post('estudiantes/{id}/update','App\Http\Controllers\EstudianteController@estudiante_update')->name('estudiantes_update')->middleware('admin');

//Cambiar-contra-admin
Route::post('password/{id}/editar','App\Http\Controllers\UserController@admin_contras')->name('password_update')->middleware('admin');

//CURSOS-CRUD
Route::get('list/cursos','App\Http\Controllers\CursosController@lista_cursos')->name('cursos')->middleware('admin');
Route::get('cursos/crear','App\Http\Controllers\CursosController@curso_crear')->name('cursos_crear')->middleware('admin');
Route::post('cursos/store','App\Http\Controllers\CursosController@curso_store')->name('cursos_store')->middleware('admin');
Route::get('cursos/{id}/editar', 'App\Http\Controllers\CursosController@curso_edit')->name('cursos_editar')->middleware('admin');
Route::post('curso/{id}/update', 'App\Http\Controllers\CursosController@curso_update')->name('cursos_update')->middleware('admin');
Route::post('delet/{id}/cursos','App\Http\Controllers\CursosController@curso_delet')->name('delet_cursos')->middleware('admin');

//MATERIAS-CRUD
Route::get('list/materias','App\Http\Controllers\MateriasController@lista_materias')->name('materias')->middleware('admin');
Route::get('materias/crear','App\Http\Controllers\MateriasController@materia_crear')->name('materias_crear')->middleware('admin');
Route::post('materias/store','App\Http\Controllers\MateriasController@materia_store')->name('materias_store')->middleware('admin');
Route::get('materias/{id}/editar','App\Http\Controllers\MateriasController@materias_edit')->name('materias_edit')->middleware('admin');
Route::post('materias/{id}/update','App\Http\Controllers\MateriasController@materias_update')->name('materias_update')->middleware('admin');
Route::post('materias/{id}/delet','App\Http\Controllers\MateriasController@materias_delet')->name('materias_delet')->middleware('admin');

//CURSO_MATERIAS-CRUD
Route::get('list/materias_faltantes/curso/{id}','App\Http\Controllers\MateriasController@lista_agregar_materias')->name('materias_faltantes')->middleware('admin');
Route::post('agregar/materias/{id}','App\Http\Controllers\MateriasController@agregar_materias_curso')->name('agregar_materias_curso')->middleware('admin');
Route::post('curso/{id}/update/materias', 'App\Http\Controllers\MateriasController@update_profesor_materias')->name('update_profesor_materias')->middleware('admin');
Route::post('eliminar/materia/{id}/curso','App\Http\Controllers\MateriasController@delet_materia_curso')->name('delet_materia_curso')->middleware('admin');


//DATATABLES
Route::get('datatable/list/profesores','App\Http\Controllers\DatatableController@tabla_profesores')->name('tabla.profesores')->middleware('admin');
Route::get('datatable/list/cursos','App\Http\Controllers\DatatableController@tabla_cursos')->name('tabla.cursos')->middleware('admin');
Route::get('datatable/list/materias','App\Http\Controllers\DatatableController@tabla_materias')->name('tabla.materias')->middleware('admin');
Route::get('datatable/materias_agregar','App\Http\Controllers\DatatableController@tabla_materias_agregar')->name('tabla.materias.agregar')->middleware('admin');
Route::get('datatable/materias/curso/{id}/','App\Http\Controllers\DatatableController@tabla_materias_curso')->name('tabla.materias.curso')->middleware('adminprofe');
Route::get('datatable/no_materias/curso/{id}/','App\Http\Controllers\DatatableController@tabla_NO_materias_curso')->name('tabla.materias.faltantes.curso')->middleware('admin');

Route::get('datatable/profesores/tareas/{id}','App\Http\Controllers\DatatableController@tabla_materias_tareas')->name('tabla.materias.tareas')->middleware('profeestudiante');
Route::get('datatable/tareas/curso/{id}','App\Http\Controllers\DatatableController@tabla_tareas_curso')->name('tabla.tareas.curso')->middleware('auth');
Route::get('datatable/tareas_estudiantes/{id_tarea}','App\Http\Controllers\DatatableController@tabla_tareas_estudiantes')->name('tabla.tareas.estudiantes')->middleware('adminprofe');

Route::get('datatable/list/estudiantes/{id}','App\Http\Controllers\DatatableController@tabla_estudiantes')->name('tabla.estudiantes')->middleware('adminprofe');
Route::get('datatable/estudiantes/curso/{id}/','App\Http\Controllers\DatatableController@tabla_estudiantes_curso')->name('tabla.estudiantes.curso')->middleware('adminprofe');
Route::get('datatable/profesor/cursos/','App\Http\Controllers\DatatableController@tabla_profesor_cursos')->name('tabla.cursos_profesor')->middleware('adminprofe');

Route::get('datatable/estudiante/tareas_pendientes/','App\Http\Controllers\DatatableController@tabla_estudiantes_tareas_p')->name('tabla.estudiantes_tareas_p')->middleware('estudiante');
Route::get('datatable/estudiante/tareas_entregadas/','App\Http\Controllers\DatatableController@tabla_estudiantes_tareas')->name('tabla.estudiantes_tareas')->middleware('estudiante');


Route::get('datatable/curso_clases/{id}','App\Http\Controllers\DatatableController@tabla_cursos_clases')->name('tabla.materias.curso.clases')->middleware('adminprofe');
Route::get('datatable/{id_curso}/materia_especifica/{id_materia}','App\Http\Controllers\DatatableController@tabla_tareas_curso_especifico')->name('tabla.materia.tareas')->middleware('adminprofe');

//Region-Provincia-Comuna
Route::post('provincia','App\Http\Controllers\ProvinciaController@region_provincias')->name('region.provincia');
Route::post('Comuna','App\Http\Controllers\ComunaController@provincia_comunas')->name('provincia.comuna');

//AJAX
Route::post('tipo','App\Http\Controllers\AjaxController@tipo_usuario')->name('tipo_usuario');
Route::post('profesor.ayudante','App\Http\Controllers\AjaxController@select_ayudante')->name('profesor.ayudante');
Route::get('equipo.docente','App\Http\Controllers\AjaxController@equipo_docente')->name('equipo_docente');

//Profesores
Route::get('clases/{id}','App\Http\Controllers\DashboardController@curso_profesor')->name('curso_profesor')->middleware('adminprofe');
Route::get('curso/{id_curso}/materia/{id_materia}','App\Http\Controllers\DashboardController@materia_curso')->name('materia_curso')->middleware('adminprofe');

Route::get('tareas/{id}','App\Http\Controllers\DashboardController@tareas_curso')->name('tareas_curso')->middleware('profesor');
Route::get('tarea/{id_tarea}','App\Http\Controllers\DashboardController@tarea_curso')->name('tarea_curso')->middleware('adminprofe');

//Planificaciones
Route::get('estudiante/{id}/planificacion','App\Http\Controllers\PlanificacionController@planificacion_estudiante')->name('planificacion_estudiante')->middleware('profesor');
Route::post('estudiante/{id}/planificacion/up','App\Http\Controllers\PlanificacionController@planificacion_up')->name('planificacion_up')->middleware('profesor');
Route::get('planificacion/descargar/{id}/','App\Http\Controllers\PlanificacionController@descargar_planificacion')->name('planificacion_descargar')->middleware('auth');

//Clases
Route::get('{id_curso}/{id_materia}/crear/clase','App\Http\Controllers\ClasesController@clase_crear')->name('clase_crear')->middleware('profesor');
Route::post('{id_curso}/{id_materia}/store/clase','App\Http\Controllers\ClasesController@clase_store')->name('clase_store')->middleware('profesor');

//Tareas
Route::get('{id_curso}/{id_materia}/crear/tarea','App\Http\Controllers\TareasController@tarea_crear')->name('tarea_crear')->middleware('profesor');
Route::post('{id_curso}/{id_materia}/tarea/up','App\Http\Controllers\TareasController@tarea_up')->name('tarea_up')->middleware('profesor');
Route::post('tarea/update/{id}/','App\Http\Controllers\TareasController@tarea_update')->name('tarea_update')->middleware('profesor');
Route::get('tarea/descargar/{id}/','App\Http\Controllers\TareasController@descargar_tarea')->name('tarea_descargar')->middleware('auth');
Route::get('tarea/eliminar/{id}/','App\Http\Controllers\TareasController@eliminar_tarea')->name('tarea_eliminar')->middleware('profesor');

//Estudiantes-Tareas
Route::get('estudiante/{id}/tarea','App\Http\Controllers\TareasController@tareas_estudiante')->name('tareas_estudiante')->middleware('estudiante');
Route::get('estudiante/{id}/tarea/{id_tarea}','App\Http\Controllers\TareasController@tarea_estudiante_up')->name('tarea_estudiante_up')->middleware('estudiante');
Route::post('estudiante_up/subir_tarea/{id_tarea}','App\Http\Controllers\TareasController@subir_tarea_estudiante_up')->name('subir_tarea_estudiante_up')->middleware('estudiante');

//Estudiantes
Route::get('estudiante/materia/{id_materia}','App\Http\Controllers\EstudianteController@estudiante_materia')->name('estudiante_materia')->middleware('estudiante');
Route::get('estudiante/tarea/{id}','App\Http\Controllers\DashboardController@estudiante_tarea')->name('estudiante_tarea')->middleware('estudiante');
Route::get('estudiante/tarea/entregada/{id}','App\Http\Controllers\DashboardController@estudiante_tarea_entregada')->name('estudiante_tarea_entregada')->middleware('estudiante');
//Perfil usuario
Route::get('usuario/{id}','App\Http\Controllers\UserController@perfil_usuario')->name('perfil_usuario')->middleware('profeestudiante');

Route::get('admin/{id}','App\Http\Controllers\UserController@perfil_admin')->name('perfil_admin')->middleware('admin');
//Cursos materia especifica
//MIDLEWARE PROFESOR ESPECIFICO (HACER)
Route::get('clases/{id_curso}/materia/{id_materia}','App\Http\Controllers\DashboardController@clases_materia_especifica')->name('clases_materia_especifica')->middleware('profesor');
Route::get('tareas/{id_curso}/materia/{id_materia}','App\Http\Controllers\DashboardController@tareas_materia_especifica')->name('tareas_materia_especifica')->middleware('profesor');

//Escuela
//cursos
Route::get('lista/cursos','App\Http\Controllers\DashboardController@cursos_escuela')->name('cursos_escuela')->middleware('adminprofe');
Route::get('tabla/cursos/escuela','App\Http\Controllers\DatatableController@cursos_escuela')->name('tabla.cursos.escuela')->middleware('adminprofe');
Route::get('cursos/{id}','App\Http\Controllers\DashboardController@ver_curso')->name('ver_cursos')->middleware('adminprofe');

//clases
Route::get('labla/clases/{id}','App\Http\Controllers\DatatableController@tabla_clases')->name('tabla.clases')->middleware('adminprofe');
Route::get('lista/clases','App\Http\Controllers\DashboardController@clases_escuela')->name('clases_escuela')->middleware('admin');
Route::get('tabla/clases','App\Http\Controllers\DatatableController@tabla2_clases')->name('tabla2.clases')->middleware('admin');

//Tareas
Route::get('lista/tareas','App\Http\Controllers\DashboardController@tareas_escuela')->name('tareas_escuela')->middleware('admin');
Route::get('tabla/tareas','App\Http\Controllers\DatatableController@tabla_tareas')->name('tabla.tareas')->middleware('admin');

//cambio de datos
Route::get('usuario_cambio/{id}','App\Http\Controllers\UserController@correo_datos')->name('cambio_datos')->middleware('admin');
Route::get('cambio_datos_confi/{id}','App\Http\Controllers\UserController@cambio_datos')->name('cambio_datos_confi')->middleware('admin');
Route::post('admin/update/{id}','App\Http\Controllers\UserController@admin_update')->name('admin_update')->middleware('admin');