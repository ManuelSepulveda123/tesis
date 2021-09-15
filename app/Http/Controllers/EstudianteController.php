<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EstudianteController extends Controller
{
    //LASTA DEL CURSO
    public function lista_estudiantes($id_curso)
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
            
            $curso = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('profesores-cursos.id_curso', $id_curso)->first();
            if (count($cursos) == 0) {
                $flag = 1;
                return view('estudiantes.listar_estudiantes_curso', compact('cursos', 'cursos_materia', 'aux', 'flag','curso'));
            }

            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
            
            return view('estudiantes.listar_estudiantes_curso', compact('cursos', 'cursos_materia', 'aux', 'flag','curso'));
        }
        if ($profesor->id_tipo_usuario == 2) {

            if (count($cursos) == 0) {
                $flag = 1;
                return view('estudiantes.listar_estudiantes_curso', compact('cursos',  'aux', 'flag','curso'));
            }
            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
            return view('estudiantes.listar_estudiantes_curso', compact('cursos', 'aux', 'flag','curso'));
        }
        if ($profesor->id_tipo_usuario == 3) {
            $query = DB::table('profesores-cursos')->where('id_profesor',$id)->where('id_curso',$id_curso)->first();
            if($query == null){
                return redirect()->route('inicio');
            }
            $curso = DB::table('cursos')->where('id_curso',$id_curso)->first();
           
            if (count($cursos) == 0) {
                $flag = 1;
                return view('estudiantes.listar_estudiantes_curso', compact('cursos',  'aux', 'flag','curso'));
            }
          
            return view('estudiantes.listar_estudiantes_curso', compact('cursos', 'aux', 'flag','curso'));
        }
        
        return view('estudiantes.listar_estudiantes_curso', compact('curso'));
    }
    //LISTA DE TODOS LOS ESTUDIANTES
    public function list_estudiantes()
    {
        $curso = (object) ['id_curso' => 1];
    
        return view('estudiantes.listar_estudiantes',compact('curso'));
    }

    public function estudiante_crear()
    {
        $regiones = DB::table('regiones')->select('id', 'region')->get();
        $cursos = DB::table('cursos')->get();
        $diagnosticos = DB::table('diagnosticos')->get();
        return view('estudiantes.crear_estudiante', compact('regiones', 'cursos', 'diagnosticos'));
    }

    public function estudiante_store(Request $request)
    {


        request()->validate([
            'nombre' => 'required|string',
            'apellido_p' => 'required|string',
            'apellido_m' => 'required|string',
            'rut' => 'required|min:11|max:12|',
            'telefono' => 'required',
            'email' => 'required|email',
            'fecha_nacimiento' => 'required|date',
            'direccion' => 'required|string',
            'nombre_apoderado' => 'required|string',
            'apellido_p_apoderado' => 'required|string',
            'apellido_m_apoderado' => 'required|string',
            'rut_apoderado' => 'required|min:11|max:12|',
            'telefono_apoderado' => 'required',
            'email_apoderado' => 'required|email'

        ]);

        if ($request->region == null || $request->comuna == null || $request->provincia == null) {
            if ($request->curso == null) {
                throw ValidationException::withMessages([
                    'curso' => "Seleccione un curso*",
                    'region_provincia_comuna' => "Seleccione una dirección valida*"
                ]);
            }
            throw ValidationException::withMessages([
                'region_provincia_comuna' => "Seleccione una dirección valida*"
            ]);
        }

        if ($request->curso == null) {
            throw ValidationException::withMessages([
                'curso' => "Seleccione un curso*"
            ]);
        }

        //CONTRASEÑA ESTUDIANTE
        $contraAux = $request->rut;
        $contraAux = str_split($contraAux);
        $contra = "";
        foreach ($contraAux as $x) {
            if (strlen($contra) == 5) {
                break;
            }
            if ($x != ".") {
                $contra = $contra . $x;
            }
        }
        //CONTRASEÑA APODERADO
        $contraAux = $request->rut_apoderado;
        $contraAux = str_split($contraAux);
        $contra_apoderado = "";
        foreach ($contraAux as $x) {
            if (strlen($contra_apoderado) == 5) {
                break;
            }
            if ($x != ".") {
                $contra_apoderado = $contra_apoderado . $x;
            }
        }

        //Rut estudante ya ingresado
        $query = DB::table('users')
            ->where('rut', $request->rut)->where('foto', "!=", null)
            ->first();

        if ($query != null) {
            throw ValidationException::withMessages([
                'rut' => "El rut del estudiante ya existe*",
            ]);
        }
        //Rut apoderado ya ingresado
        $query = DB::table('users')
            ->where('rut', $request->rut_apoderado)->where('foto', null)
            ->first();

        if ($query != null) {

            DB::table('users')->insert([
                'nombre' => $request->nombre,
                'apellido_p' => $request->apellido_p,
                'apellido_m' => $request->apellido_m,
                'rut' => $request->rut,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'direccion' => $request->direccion,
                'email' => $request->email,
                'password' => Hash::make($contra),
                'fecha_update' => date_format(date_create(), 'Y-m-d'),
                'id_tipo_usuario' => 4,
                'id_comuna' => $request->comuna,
                'id_provincia' => $request->provincia,
                'id_region' => $request->region,
                'telefono' => $request->telefono
            ]);

            $id = DB::table('users')->select('id')->get();
            $id = MAX(end($id));

            DB::table('estudiantes')->insert([
                'id' => $id->id,
                'id_apoderado' => $query->id,
                'id_diagnostico' => $request->diagnostico,
                'otro' => $request->otro
            ]);

            DB::table('estudiantes-cursos')->insert([
                'id_estudiante' => $id->id,
                'id_curso' => $request->curso
            ]);
            flash('Estudiante registrado correctamente')->success();
            return redirect()->route('estudiantes_crear');
        }


        DB::table('users')->insert([
            'nombre' => $request->nombre_apoderado,
            'apellido_p' => $request->apellido_p_apoderado,
            'apellido_m' => $request->apellido_m_apoderado,
            'rut' => $request->rut_apoderado,
            'direccion' => $request->direccion,
            'email' => $request->email_apoderado,
            'password' => Hash::make($contra_apoderado),
            'fecha_update' => date_format(date_create(), 'Y-m-d'),
            'id_tipo_usuario' => 5,
            'id_comuna' => $request->comuna,
            'id_provincia' => $request->provincia,
            'id_region' => $request->region,
            'telefono' => $request->telefono_apoderado
        ]);

        $apoderado = DB::table('users')->select('id')->get();
        $apoderado = MAX(end($apoderado));

        DB::table('users')->insert([
            'nombre' => $request->nombre,
            'apellido_p' => $request->apellido_p,
            'apellido_m' => $request->apellido_m,
            'rut' => $request->rut,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'direccion' => $request->direccion,
            'email' => $request->email,
            'password' => Hash::make($contra),
            'fecha_update' => date_format(date_create(), 'Y-m-d'),
            'id_tipo_usuario' => 4,
            'id_comuna' => $request->comuna,
            'id_provincia' => $request->provincia,
            'id_region' => $request->region,
            'telefono' => $request->telefono
        ]);

        $id = DB::table('users')->select('id')->get();
        $id = MAX(end($id));

        DB::table('estudiantes')->insert([
            'id' => $id->id,
            'id_apoderado' => $apoderado->id,
            'id_diagnostico' => $request->diagnostico,
            'otro' => $request->otro
        ]);

        DB::table('estudiantes-cursos')->insert([
            'id_estudiante' => $id->id,
            'id_curso' => $request->curso
        ]);

        flash('Estudiante registrado correctamente')->success();
        return redirect()->route('estudiantes_crear');
    }

    public function estudiante_editar($id)
    {

        $estudiante = DB::table('users')->where('id', $id)->first();

        $regiones = DB::table('regiones')->select('id', 'region')->get();
        $comunas = DB::table('comunas')->select('id', 'comuna')->where('provincia_id', $estudiante->id_provincia)->get();
        $provincias = DB::table('provincias')->select('id', 'provincia')->where('region_id', $estudiante->id_region)->get();

        $cursos = DB::table('cursos')->get();
        $curso_estudiante = DB::table('cursos')->join('estudiantes-cursos', 'estudiantes-cursos.id_curso', '=', 'cursos.id_curso')->where('id_estudiante', $id)->first();

        $diagnostico_estudiante = DB::table('estudiantes')->where('estudiantes.id', $id)->first();
        $diagnosticos = DB::table('diagnosticos')->get();

        $apoderado = DB::table('users')->where('id', $diagnostico_estudiante->id_apoderado)->first();
        return view('estudiantes.editar_estudiante', compact('estudiante', 'regiones', 'comunas', 'provincias', 'cursos', 'curso_estudiante', 'diagnosticos', 'diagnostico_estudiante', 'apoderado'));
    }

    public function estudiante_update(Request $request, $id)
    {

        request()->validate([
            'nombre' => 'required|string',
            'apellido_p' => 'required|string',
            'apellido_m' => 'required|string',
            'rut' => 'required|min:11|max:12|',
            'telefono' => 'required',
            'email' => 'required|email',
            'fecha_nacimiento' => 'required|date',
            'direccion' => 'required|string',
        ]);

        if ($request->region == null || $request->comuna == null || $request->provincia == null) {
            if ($request->curso == null) {
                throw ValidationException::withMessages([
                    'curso' => "Seleccione un curso*",
                    'region_provincia_comuna' => "Seleccione una dirección valida*"
                ]);
            }
            throw ValidationException::withMessages([
                'region_provincia_comuna' => "Seleccione una dirección valida*"
            ]);
        }

        if ($request->curso == null) {
            throw ValidationException::withMessages([
                'curso' => "Seleccione un curso*"
            ]);
        }

        $user = DB::table('users')->where('id', $id)->first();

        $query = DB::table('users')->where([['rut', $request->rut], ['id', '<>', $id]])->get();

        if ($user->rut != $request->rut) {
            if (count($query) == 1) {
                throw ValidationException::withMessages([
                    'rut' => "El rut del estudiante es identico a otro estudiante*",
                ]);
            }
        }

        DB::table('users')->where("id", "=", $id)->update([
            'nombre' => $request->nombre,
            'apellido_p' => $request->apellido_p,
            'apellido_m' => $request->apellido_m,
            'rut' => $request->rut,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'direccion' => $request->direccion,
            'id_region' => $request->region,
            'id_comuna' => $request->comuna,
            'id_provincia' => $request->provincia,
            'fecha_update' => date_format(date_create(), 'Y-m-d'),
        ]);

        DB::table('estudiantes-cursos')->where("id_estudiante", $id)->update([
            'id_curso' => $request->curso
        ]);

        if ($request->diagnostico != 0) {
            DB::table('estudiantes')->where('id', $id)->update([

                'id_diagnostico' => $request->diagnostico,
                'otro' => $request->otro
            ]);
            flash('Datos guardados correctamente')->success();
            return redirect()->route('estudiantes_editar', $id);
        }

        DB::table('estudiantes')->where('id', $id)->update([

            'id_diagnostico' => null,
            'otro' => $request->otro
        ]);

        flash('Datos guardados correctamente')->success();
        return redirect()->route('estudiantes_editar', $id);
    }

    public function estudiante_materia($id_materia)
    {

        $id = Auth::user()->id;
        $curso = DB::table('estudiantes-cursos')->where('estudiantes-cursos.id_estudiante', $id)->join('cursos', 'cursos.id_curso', '=', 'estudiantes-cursos.id_curso')->first();
        $materias_estudiante = DB::table('cursos-materias')->join('materias', 'materias.id_materia', '=', 'cursos-materias.id_materia')
            ->where('id_curso', $curso->id_curso)->get();

        $materia = DB::table('materias')->where('id_materia', $id_materia)->first();
        
        $tareas = DB::table('tareas')->join('materias', 'materias.id_materia', '=', 'tareas.id_materia')->where('id_curso', $curso->id_curso)->where('tareas.id_materia',$id_materia)->get();
        $tarea_estudiante = DB::table('estudiantes-tareas')->where('id_estudiante', $id)->get();

        $tareas_pendientes = [];
        foreach ($tareas as $item) {
            $flag = true;
            foreach ($tarea_estudiante as $indexData) {
                if ($indexData->id_tarea == $item->id_tarea)
                    $flag = false;
            }
            if ($flag)
                array_push($tareas_pendientes, $item);
        }
        foreach ($tareas_pendientes as $tarea) {
            $tarea->fecha_plazo = \Carbon\Carbon::parse($tarea->fecha_plazo)->format('d-m-Y');
        }
        
        return view('estudiantes.materias.estudiante_materia', compact('id', 'materias_estudiante', 'id_materia', 'materia', 'curso', 'tareas_pendientes'));
    }
}

