<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//Enviar correo 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;





class ClasesController extends Controller
{
    //
    public function clase_crear($id_curso, $id_materia)
    {
        $id = Auth::user()->id;

        $materia = DB::table('materias')->where('id_materia', $id_materia)->first();
        $curso = DB::table('cursos')->where('id_curso', $id_curso)->first();
        $profesor = DB::table('users')->where('id', $id)->first();
        //VER SI ES PROFE ESPECIFICO
        $aux = DB::table('profesores-materias')->where('id_profesor', $id)->first();
        $aux = $aux->id_materia;
        $flag = 0;
        $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->get();
        if ($aux != 1) {

            $cursos_materia = DB::table('cursos-materias')->join('cursos', 'cursos.id_curso', '=', 'cursos-materias.id_curso')->where('id_materia', $aux)->get();

            if (count($cursos) == 0) {
                $flag = 1;
                return view('clases.crear_clase', compact('cursos', 'cursos_materia', 'aux', 'flag', 'materia', 'curso'));
            }

            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();
            return view('clases.crear_clase', compact('cursos', 'cursos_materia', 'aux', 'flag', 'materia', 'curso'));
        }
        //PROFE JEFE

        if ($profesor->id_tipo_usuario == 2) {

            if (count($cursos) == 0) {
                $flag = 1;

                return view('clases.crear_clase', compact('cursos', 'cursos_materia', 'aux', 'flag', 'materia', 'curso'));
            }
            $cursos = DB::table('profesores-cursos')->join('cursos', 'cursos.id_curso', '=', 'profesores-cursos.id_curso')->where('id_profesor', $id)->first();

            return view('clases.crear_clase', compact('cursos', 'cursos_materia', 'aux', 'flag', 'materia', 'curso'));
        }

        return view('clases.crear_clase', compact('materia', 'curso'));
    }

    public function clase_store(Request $request, $id_curso, $id_materia)
    {

        
        request()->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        $validacion = date_format(date_create(), 'Y-m-d');

        if ($validacion > $request->fecha) {
            flash('Ingrese una fecha posible')->error();
            return redirect()->back();
        }
        /* dd($request->hora_inicio,$request->hora_fin); */
        if ($request->hora_fin < $request->hora_inicio) {
            flash('La hora de inicio tiene que ser menor a la hora de fin')->error();
            return redirect()->back();
        }

        $clases = DB::table('clases')->where('id_curso', $id_curso)->where('fecha_clase', $validacion)->get();

        foreach ($clases as $clase) {

            if ($request->hora_inicio == $clase->hora_inicio) {
                flash('Ya hay una clase agendada para esa hora')->error();
                return redirect()->back();
            } elseif ($request->hora_fin <= $clase->hora_fin && $request->hora_inicio >= $clase->hora_inicio) {
                /* validaciones de clases */
            }
        }

        require './PHPMailer/src/Exception.php';
        require './PHPMailer/src/PHPMailer.php';
        require './PHPMailer/src/SMTP.php';
        $mail = new PHPMailer(true);

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
            $mail->setFrom('manux.rayxxd@gmail.com', 'Manuel');
            $mail->addAddress('manux.rayxxd@gmail.com', 'estudiante');     //Add a recipient

            //Attachments
            /* $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');  */   //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Clase';
            $mail->Body    = 'Hola este es un correo <b>kasjdhsajk!</b>';


            $mail->send();
            echo 'El mensaje se enviot';
        } catch (Exception $e) {
            echo "ocurrio un error en el mensaje: {$mail->ErrorInfo}";
        }

        DB::table('clases')->insert([
            'link' => $request->link,
            'password' => null,
            'fecha_clase' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'detalle' => $request->detalle,
            'id_profesor' => Auth::user()->id,
            'id_curso' => $id_curso,
            'id_materia' => $id_materia,

        ]);

        flash('Clase agregada con exito')->success();
        return redirect()->back();
    }
}
