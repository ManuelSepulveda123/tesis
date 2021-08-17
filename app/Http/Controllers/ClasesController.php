<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClasesController extends Controller
{
    //
    public function clase_crear($id_curso, $id_materia)
    {
        
        $materia = DB::table('materias')->where('id_materia', $id_materia)->first();
        $curso = DB::table('cursos')->where('id_curso', $id_curso)->first();
       
        
        return view('clases.crear_clase', compact('materia', 'curso'));
    }

    public function clase_store(Request $request,$id_curso,$id_materia)
    {

        
        request()->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        $validacion = date_format(date_create(), 'Y-m-d');

        if ($validacion > $request->fecha) {
            flash('Ingrese una fecha posible')->error();
            return redirect()->route('clase_crear', ['id_curso' => $id_curso, 'id_materia' => $id_materia]);
        }
        /* dd($request->hora_inicio,$request->hora_fin); */
        if ($request->hora_fin < $request->hora_inicio) {
            flash('La hora de inicio tiene que ser menor a la hora de fin')->error();
            return redirect()->route('clase_crear', ['id_curso' => $id_curso, 'id_materia' => $id_materia]);
        }

        $clases = DB::table('clases')->where('id_curso', $id_curso)->where('fecha_clase', $validacion)->get();

        foreach ($clases as $clase) {

            if ($request->hora_inicio == $clase->hora_inicio) {
                flash('Ya hay una clase agendada para esa hora')->error();
                return redirect()->route('clase_crear', ['id_curso' => $id_curso, 'id_materia' => $id_materia]);
            }elseif($request->hora_fin <= $clase->hora_fin && $request->hora_inicio >= $clase->hora_inicio){
                /* validaciones de clases */
            }
        }

        DB::table('clases')->insert([
            'link' => $request->link,
            'password' => $request->password,
            'fecha_clase' =>$request->fecha,
            'hora_inicio' =>$request->hora_inicio,
            'hora_fin' =>$request->hora_fin,
            'detalle' =>$request->detalle,
            'id_profesor'=> Auth::user()->id,
            'id_curso'=>$id_curso,
            'id_materia'=>$id_materia,
        
        ]);
        flash('Clase agregada con exito')->success();
        return redirect()->route('materia_curso', ['id_curso' => $id_curso, 'id_materia' => $id_materia]);
    }
}
