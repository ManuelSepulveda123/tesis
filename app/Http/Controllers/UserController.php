<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

//Enviar correo 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


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

        $id = Auth::user()->id;


        $profesor = DB::table('users')->where('id', $id)->where('foto', '<>', null)->first();
        if ($profesor != null && $profesor->id_tipo_usuario != 1) {
            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->get();

            $aux = DB::table('profesores-materias')->where('id_profesor', $id)->first();
            $aux = $aux->id_materia;
            $flag = 0;
            //PROFE ESPECIFICO DE UNA MATERIA
            if ($aux != 1) {

                $cursos_materia = DB::table('cursos-materias')->join('cursos', 'cursos.id_curso', '=', 'cursos-materias.id_curso')->where('id_materia', $aux)->get();

                if (count($cursos) == 0) {
                    $flag = 1;
                    return view('users.perfil_usuario', compact('cursos', 'cursos_materia', 'aux', 'flag', 'usuario', 'region', 'comuna', 'provincia', 'curso', 'apoderado', 'materias_estudiante'));
                }

                $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
                return view('users.perfil_usuario', compact('cursos', 'cursos_materia', 'aux', 'flag', 'usuario', 'region', 'comuna', 'provincia', 'curso', 'apoderado', 'materias_estudiante'));
            }
            //PROFE JEFE
            if ($profesor->id_tipo_usuario == 2) {

                if (count($cursos) == 0) {
                    $flag = 1;
                    return view('users.perfil_usuario', compact('cursos', 'aux', 'flag', 'usuario', 'region', 'comuna', 'provincia', 'curso', 'apoderado', 'materias_estudiante'));
                }
                $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
                return view('users.perfil_usuario', compact('cursos', 'aux', 'flag', 'usuario', 'region', 'comuna', 'provincia', 'curso', 'apoderado', 'materias_estudiante'));
            }
            //PROFE AYUDANTE

            if ($profesor->id_tipo_usuario == 3) {
                if (count($cursos) == 0) {
                    $flag = 1;
                    return view('users.perfil_usuario', compact('cursos', 'aux', 'flag', 'usuario', 'region', 'comuna', 'provincia', 'curso', 'apoderado', 'materias_estudiante'));
                }


                return view('users.perfil_usuario', compact('cursos', 'aux', 'flag', 'usuario', 'region', 'comuna', 'provincia', 'curso', 'apoderado', 'materias_estudiante'));
            }
        }


        return view('users.perfil_usuario', compact('usuario', 'region', 'comuna', 'provincia', 'curso', 'apoderado', 'materias_estudiante'));
    }

    public function admin_contras(Request $request, $id)
    {
        request()->validate([
            'nueva_password' => 'required',
        ]);

        DB::table('users')->where('id', $id)->update([
            'password' => Hash::make($request->nueva_password)
        ]);

        flash('Contraseña actualizada con exito')->success();
        return redirect()->route('estudiantes_editar', $id);
    }

    public function perfil_admin($id)
    {


        if (auth()->user()->id != $id) {
            return redirect()->route('inicio');
        }

        $usuario = DB::table('users')->where('users.id', $id)->first();

        return view('users.perfil_admin', compact('usuario'));
    }

    public function correo_datos(Request $request,$id)
    {
        
        if (auth()->user()->id != $id) {
            return redirect()->route('inicio');
        }
        date_default_timezone_set('America/Santiago');
        $hora = date_format(date_create(), 'Y-m-d G:i:s');
        DB::table('users')->where('id', $id)->update([
            'confi' => $hora
        ]);
        $usuario = DB::table('users')->where('users.id', $id)->first();

        require './PHPMailer/src/Exception.php';
        require './PHPMailer/src/PHPMailer.php';
        require './PHPMailer/src/SMTP.php';
        $mail = new PHPMailer(true);
        $ruta = route('cambio_datos_confi',$id);
        
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'manux.rayxxd@gmail.com';                     //SMTP username
            $mail->Password   = 'mamertox890';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('manux.rayxxd@gmail.com', 'Escuela Chile Espana');
            $mail->addAddress('manux.rayxxd@gmail.com', 'Administrador');     //Add a recipient

            //Attachments
            /* $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');  */   //Optional name
            $foto = asset('assets/media/escuela/escuela-espana-228x300.png');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Nuevo usuario';
            $mail->Body    = '<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td style="padding: 10px 0 30px 0;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="border: 1px solid #cccccc; border-collapse: collapse;">
                        <tr>
                            <td bgcolor="#ffffff" style="padding: 30px 30px 0px 30px;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="color: #153643; font-family: Georgia, sans-serif; font-size: 20px;">
                                            <center>
                                                <b>Solicitud de cambio de datos</b>
                                            </center>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td style="padding: 20px 0px 60px 0px; color: #153643; font-family: Georgia, cursive; font-size: 14px;">
                                        <center><a href="'.$ruta.'" class="btn">Confirmar</a></center>
                                            <center><i>Este link solo sera valido durante 1 hora</i></center>
                                            
                                        </td>
                                        
                                    </tr>
                                </table>
                            </td>
                        </tr>        
                    </table>
                </td>
            </tr>
        </table>';

       
            $mail->send();
            dd($mail->send());
            echo 'El mensaje se envio';
        } catch (Exception $e) {
            echo "ocurrio un error en el mensaje: {$mail->ErrorInfo}";
        }
    }

    public function cambio_datos($id){
        if (auth()->user()->id != $id) {
            return redirect()->route('inicio');
        }
        
        date_default_timezone_set('America/Santiago');
        $hora = date_format(date_create(), ' G:i:s');
        $fecha = date_format(date_create(), 'Y-m-d');
        $dia = date_format(date_create(), 'd');

        $usuario = DB::table('users')->where('users.id', $id)->first();
        $hora_fin = \Carbon\Carbon::parse($usuario->confi)->addHours(1)->format('G:i:s');
        $fecha_cam = \Carbon\Carbon::parse($usuario->confi)->format('Y-m-d');
        $dia_item = \Carbon\Carbon::parse($usuario->confi)->format('d');
        
       
        $hora = strtotime($hora);
        $hora_fin = strtotime($hora_fin);
        
        if($fecha != $fecha_cam){
     
            return redirect()->route('inicio');
        }
        if($hora > $hora_fin){
            return redirect()->route('inicio');
        }
        return view('users.cambio_perfil',compact('usuario'));
    }

    public function admin_update(Request $request,$id){
        

        //cambio contraseña
        if($request->contra2 != null && $request->contra == null){
            flash('Porfavor rellene todos los campos de contraseña')->error();
            return redirect()->route('cambio_datos_confi', $id);
        }
        if($request->contra2 == null && $request->contra != null){
            flash('Porfavor rellene todos los campos de contraseña')->error();
            return redirect()->route('cambio_datos_confi', $id);
        }
        if($request->contra2 != $request->contra ){
            flash('Las contraseñas no coinciden')->error();
            return redirect()->route('cambio_datos_confi', $id);
        }
        if($request->contra == $request->contra2){
            if($request->contra != null){
                DB::table('users')->where("id", "=", $id)->update([
                    'password' => Hash::make($request->contra),
                ]);
            }
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
        request()->validate([
            'nombre' => 'required|string',
            'apellido_p' => 'required|string',
            'apellido_m' => 'required|string',
            'rut' => 'required|min:11|max:12|',
            'telefono' => 'required',
            'email' => 'required|email',
            'fecha_nacimiento' => 'required|date',
        ]);
        DB::table('users')->where("id", "=", $id)->update([
            'nombre' => $request->nombre,
            'apellido_p' => $request->apellido_p,
            'apellido_m' => $request->apellido_m,
            'rut' => $request->rut,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'fecha_update' => date_format(date_create(), 'Y-m-d'),
        ]);
        flash('Datos actualizados')->success();
        return redirect()->route('cambio_datos_confi', $id);
    }
}
