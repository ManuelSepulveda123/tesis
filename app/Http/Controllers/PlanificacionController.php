<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

use App\Mail\PlanificacionMailable;
use Illuminate\Support\Facades\Mail;

class PlanificacionController extends Controller
{
    //
    public function planificacion_estudiante($id)
    {

        $user = DB::table('users')->where('id', $id)->first();

        $planificacion = DB::table('planificaciones')->join('archivos', 'archivos.id_archivo', '=', 'planificaciones.id_archivo')->where('id_estudiante', $id)->first();

        if (isset($planificacion)) {

            return view('profesores.cursos.planificaciones.planificacion_estudiante', compact('user', 'planificacion'));
        }

        return view('profesores.cursos.planificaciones.planificacion_estudiante', compact('user'));
    }


    public function planificacion_up(Request $request, $id)
    {
        $planificacion = DB::table('planificaciones')->where('id_estudiante', $id)->first();
        
        $curso = DB::table('estudiantes-cursos')->join('cursos', 'cursos.id_curso', '=', 'estudiantes-cursos.id_curso')->where('id_estudiante', $id)->first();
        $user = DB::table('users')->where('id', $id)->first();
        $extension = $request->file('planificacion')->getClientOriginalExtension();
        $file_name = $user->nombre . '_' . $user->apellido_p . '_' . $user->apellido_m . '.' . $extension;
        $ruta = "public/cursos/$curso->id_curso/planificaciones";
        

        $id_profesor = Auth::user()->id;
        if ($planificacion == null) {
            $request->file('planificacion')->storeAs($ruta, $file_name);
            $ruta = $ruta . '/' . $user->nombre . '_' . $user->apellido_p . '_' . $user->apellido_m . '.' . $extension;

            DB::table('archivos')->insert([
                'id_user' => $id_profesor,
                'id_curso' => $curso->id_curso,
                'id_materia' => 1,
                'id_tipo_archivo' => 1,
                'ruta_archivo' => $ruta
            ]);
            $archivo = DB::table('archivos')->select('id_archivo')->get();
            $archivo = MAX(end($archivo));
            DB::table('planificaciones')->insert([
                'id_estudiante' => $id,
                'id_archivo' => $archivo->id_archivo
            ]);

            $descarga = route('planificacion_descargar',$id);
            $correo = new PlanificacionMailable($descarga);
            Mail::to($user->email)->send($correo); 
            flash('Planificación agregada exitosamente')->success();
            return redirect()->route('lista_estudiantes');
        }

        $planificacion = DB::table('archivos')->where('id_archivo',$planificacion->id_archivo)->first();
        Storage::delete($planificacion->ruta_archivo);

        $file_name = $user->nombre . '_' . $user->apellido_p . '_' . $user->apellido_m . '.' . $extension;
        $ruta = "public/cursos/$curso->id_curso/planificaciones";
        
        $request->file('planificacion')->storeAs($ruta, $file_name);
        
        $ruta = $ruta . '/' . $user->nombre . '_' . $user->apellido_p . '_' . $user->apellido_m . '.' . $extension;
        

        DB::table('archivos')->where('id_archivo', $id)->delete();

        DB::table('archivos')->where("id_archivo", "=", $planificacion->id_archivo)->update([
            'id_curso' => $curso->id_curso,
            'ruta_archivo' => $ruta
        ]);
        $descarga = route('planificacion_descargar',$planificacion->id_archivo);
        $correo = new PlanificacionMailable($descarga);
        Mail::to($user->email)->send($correo);
        flash('Planificación modificada exitosamente')->success();
        return redirect()->route('lista_estudiantes');
    }

    
    public function descargar_planificacion($id)
    {
        
        $file = DB::table('archivos')->where('id_archivo', $id)->first();
     
        $file->ruta_archivo = str_replace('public', 'storage', $file->ruta_archivo);
        $pathtoFile = public_path() . '/' . $file->ruta_archivo;

        return response()->download($pathtoFile);
    }
}
