<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfesoresController extends Controller
{
    //
    public function lista_profesores()
    {
        return view('profesores.listar_profesores');
    }

    public function profesor_crear()
    {
        $regiones = DB::table('regiones')->select('id', 'region')->get();
        $tipo_profesores = DB::table('materias')->select('*')->where('especifica', 1)->get();
        return view('profesores.crear_profesor', compact('regiones', 'tipo_profesores'));
    }

    public function profesor_store(Request $request)
    {

        request()->validate([
            'foto' => 'required|image',
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
            if ($request->tipo_profesor == null) {
                throw ValidationException::withMessages([
                    'tipo_profesor' => "Seleccione un tipo de usuario*",
                    'region_provincia_comuna' => "Seleccione una dirección valida*"
                ]);
            }
            throw ValidationException::withMessages([
                'region_provincia_comuna' => "Seleccione una dirección valida*",
            ]);
        }

        if ($request->tipo_profesor == null) {
            throw ValidationException::withMessages([
                'tipo_profesor' => "Seleccione un tipo de usuario*",
            ]);
        }

        if ($request->tipo_usuario == 3 && $request->tipo_profesor != 0) {
            throw ValidationException::withMessages([
                'tipo_profesor' => "No es posible asignar una materia especifica a un ayudante*",
            ]);
        }
        //CONTRASEÑA
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
            ->where('email', $request->email)->where('foto', '!=', null)
            ->first();

        if ($query != null) {
            throw ValidationException::withMessages([
                'email' => "La dirección de correo electrónico ingresado ya tiene una cuenta como profesor*",
            ]);
        }
        //Rut ya ingresado
        $query = DB::table('users')
            ->where('rut', $request->rut)->where('foto', "!=", null)
            ->first();

        if ($query != null) {
            throw ValidationException::withMessages([
                'rut' => "El rut del profesor ya existe*",
            ]);
        }


        $imagenes = $request->file('foto')->store('public/fotos_profesores');
        $url = Storage::url($imagenes);

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
            'foto' => $url,
            'id_tipo_usuario' => $request->tipo_usuario,
            'id_comuna' => $request->comuna,
            'id_provincia' => $request->provincia,
            'id_region' => $request->region,
            'telefono' => $request->telefono
        ]);



        $id = DB::table('users')->select('id')->get();
        $id = MAX(end($id));
        if ($request->tipo_profesor == 0) {
            DB::table('profesores-materias')->insert([
                'id_profesor' => $id->id,
                'id_materia' => 1
            ]);
            flash('Profesor registrado correctamente')->success();
            return redirect()->route('editar_profesor', $id->id);
        }
        DB::table('profesores-materias')->insert([
            'id_profesor' => $id->id,
            'id_materia' => $request->tipo_profesor
        ]);
        flash('Profesor registrado correctamente')->success();
        return redirect()->route('editar_profesor', $id->id);
    }

    public function profesor_edit(Request $request, $id)
    {

        $profesor = DB::table('users')
            ->join('profesores-materias', 'profesores-materias.id_profesor', '=', 'users.id')
            ->select('users.id', 'users.nombre', 'users.apellido_p', 'users.apellido_m', 'users.rut', 'users.email', 'users.fecha_nacimiento', 'users.direccion', 'users.foto', 'users.telefono', 'users.id_comuna', 'users.id_provincia', 'users.id_region', 'users.id_tipo_usuario', 'profesores-materias.id_materia')
            ->where('users.id', $id)->first();
        $tipo_profesores = DB::table('materias')->where('especifica', 1)->get();
        $regiones = DB::table('regiones')->select('id', 'region')->get();
        $comunas = DB::table('comunas')->select('id', 'comuna')->where('provincia_id', $profesor->id_provincia)->get();
        $provincias = DB::table('provincias')->select('id', 'provincia')->where('region_id', $profesor->id_region)->get();

        return view('profesores.editar_profesor', compact('profesor', 'tipo_profesores', 'regiones', 'comunas', 'provincias'));
    }

    public function profesor_update(Request $request, $id)
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
            if ($request->tipo_profesor == null) {
                throw ValidationException::withMessages([
                    'tipo_profesor' => "Seleccione un tipo de usuario*",
                    'region_provincia_comuna' => "Seleccione una dirección valida*"
                ]);
            }
            throw ValidationException::withMessages([
                'region_provincia_comuna' => "Seleccione una dirección valida*",
            ]);
        }

        if ($request->tipo_usuario == 3 && $request->tipo_profesor != 0) {
            throw ValidationException::withMessages([
                'tipo_profesor' => "No es posible asignar una materia especifica a un ayudante*",
            ]);
        }

        $foto = $request->file('foto');

        if (isset($foto)) {
            $foto = DB::table('users')->select('foto')->where('id', $id)->first()->foto;

            $url = str_replace('storage', 'public', $foto);
            Storage::delete($url);
            $imagenes = $request->file('foto')->store('public/fotos_profesores');
            $url = Storage::url($imagenes);
            DB::table('users')->where("id", $id)->update([
                'foto' => $url
            ]);
        }

        $query = DB::table('users')->join('profesores-cursos', 'profesores-cursos.id_profesor', '=', 'users.id')
            ->where('users.id_tipo_usuario', 2)->where('users.id', $id)
            ->first();

        if ($query != null) {
            flash('No se logro cambiar el tipo de profesor, asegurese de que no sea profesor jefe de ningun curso')->error();
            return redirect()->route('editar_profesor', $id);
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
            'id_tipo_usuario' => $request->tipo_usuario

        ]);



        if ($request->tipo_profesor == 0) {
            DB::table('profesores-materias')->where('id_profesor', $id)->update([
                'id_materia' => 1
            ]);
            flash('Datos guardados correctamente')->success();
            return redirect()->route('editar_profesor', $id);
        }

        DB::table('profesores-materias')->where('id_profesor', $id)->update([
            'id_materia' => $request->tipo_profesor
        ]);

        flash('Datos guardados correctamente')->success();
        return redirect()->route('editar_profesor', $id);
    }
}
