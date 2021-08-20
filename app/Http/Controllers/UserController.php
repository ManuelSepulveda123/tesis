<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function create()
    {
        $tipo_usuarios = DB::select('select * from tipo_users');
        $regiones = DB::table('regiones')->select('id', 'region')->get();
        /* dd(auth()->user()->foto); */
        return view('users.create', compact('tipo_usuarios', 'regiones'));
    }


    public function store(Request $request)
    {

        //Validar Datos
        if ($request->tipo_user == null) {
            throw ValidationException::withMessages([
                'estado' => "Seleccione un tipo de usuario",
            ]);
        }
        //validacion de datos
        request()->validate([
            'name' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'rut' => 'required|min:11|max:12|',
            'phone' => 'required',
            'email' => 'required|email',
            'fecha_nacimiento' => 'required',
            'direccion' => 'required'
        ]);
        //Crear Contraseña
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
        //Correo en la base de datos
        $query = DB::table('users')
            ->where('email', $request->email)
            ->first();

        if ($query != null) {
            throw ValidationException::withMessages([
                'estado' => "La dirección de correo electrónico ingresado ya tiene una cuenta creada",
            ]);
        }
        //Rut ya ingresado
        $query = DB::table('users')
            ->where('rut', $request->rut)
            ->first();

        if ($query != null) {
            throw ValidationException::withMessages([
                'estado' => "El Rut ingresado ya tiene una cuenta creada",
            ]);
        }

        if ($request->region == null || $request->comuna == null || $request->provincia == null) {
            throw ValidationException::withMessages([
                'estado' => "Ingrese una direccion valida",
            ]);
        }

        if ($request->tipo_user == "2") {
            request()->validate([]);

            $imagenes = $request->file('foto')->store('public/fotos_profesores');
            $url = Storage::url($imagenes);

            DB::table('users')->insert([
                'nombre' => $request->name,
                'apellido_p' => $request->apellido_paterno,
                'apellido_m' => $request->apellido_materno,
                'rut' => $request->rut,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'direccion' => $request->direccion,
                'email' => $request->email,
                'password' => Hash::make($contra),
                'fecha_update' => date_format(date_create(), 'Y-m-d'),
                'foto' => $url,
                'id_tipo_usuario' => $request->tipo_user,
                'id_comuna' => $request->comuna,
                'id_provincia' => $request->provincia,
                'id_region' => $request->region,
                'fono' => $request->phone
            ]);
        }

        if ($request->tipo_user == "3") {
            request()->validate([
                'name_apoderado' => 'required',
                'apellido_p_a' => 'required',
                'apellido_m_a' => 'required',
                'rut_apoderado' => 'required',
                'phone_apoderado' => 'required',
                'email_apoderado' => 'required|email',
            ]);

            $contraAux2 = $request->rut_apoderado;
            $contraAux2 = str_split($contraAux2);
            $contra2 = "";
            foreach ($contraAux2 as $x) {
                if (strlen($contra2) == 5) {
                    break;
                }
                if ($x != ".") {
                    $contra2 = $contra2 . $x;
                }
            }

            //INSERTAR APODERADO
            DB::table('users')->insert([
                'nombre' => $request->name_apoderado,
                'apellido_p' => $request->apellido_p_a,
                'apellido_m' => $request->apellido_m_a,
                'rut' => $request->rut_apoderado,
                'direccion' => $request->direccion,
                'email' => $request->email_apoderado,
                'password' => Hash::make($contra2),
                'fecha_update' => date_format(date_create(), 'Y-m-d'),
                'id_tipo_usuario' => 4,
                'id_comuna' => $request->comuna,
                'id_provincia' => $request->provincia,
                'id_region' => $request->region,
                'fono' => $request->phone_apoderado,
            ]);
            $id_apoderado = DB::table('users')->select('@@id')->get();
            $id_apoderado = MAX(end($id_apoderado));
            //INSERTAR ALUMNO
            DB::table('users')->insert([
                'nombre' => $request->name,
                'apellido_p' => $request->apellido_paterno,
                'apellido_m' => $request->apellido_materno,
                'rut' => $request->rut,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'direccion' => $request->direccion,
                'email' => $request->email,
                'password' => Hash::make($contra),
                'fecha_update' => date_format(date_create(), 'Y-m-d'),
                'id_tipo_usuario' => $request->tipo_user,
                'id_comuna' => $request->comuna,
                'id_provincia' => $request->provincia,
                'id_region' => $request->region,
                'id_apoderado' => $id_apoderado->id,
                'fono' => $request->phone
            ]);
        }


        return redirect()->back();
    }

    public function perfil_usuario($id)
    {
        $usuario = DB::table('users')->where('id', $id)->first();
        $region = DB::table('regiones')->where('id', $usuario->id_region)->first();
        $comuna = DB::table('comunas')->where('id', $usuario->id_comuna)->first();
        $provincia = DB::table('provincias')->where('id', $usuario->id_provincia)->first();


        $apoderado = DB::table('estudiantes')->where('id', $id)->first();
        if ($apoderado != null) {
            $apoderado = DB::table('users')->where('id', $apoderado->id_apoderado)->first();
        }
        $curso = DB::table('estudiantes-cursos')->where('id_estudiante', $id)->join('cursos', 'cursos.id_curso', '=', 'estudiantes-cursos.id_curso')->first();
        $materias_estudiante = "";
        if ($curso != null) {
            $materias_estudiante = DB::table('cursos-materias')->join('materias', 'materias.id_materia', '=', 'cursos-materias.id_materia')
                ->where('id_curso', $curso->id_curso)->get();
        }


        return view('users.perfil_usuario', compact('usuario', 'region', 'comuna', 'provincia', 'curso', 'apoderado', 'materias_estudiante'));
    }

    public function admin_contras(Request $request, $id)
    {
        request()->validate([
            'nueva_password' => 'required',
        ]);
        
        DB::table('users')->where('id',$id)->update([
            'password' => Hash::make($request->nueva_password)
        ]);

        flash('Contraseña actualizada con exito')->success();
        return redirect()->route('estudiantes_editar', $id);
        
    }
}
