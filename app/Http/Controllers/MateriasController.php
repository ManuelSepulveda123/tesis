<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Illuminate\Validation\ValidationException;


class MateriasController extends Controller
{
    //

    public function lista_materias(Request $request)
    {
        return view('materias.listar_materias');
    }

    public function materia_crear(Request $request)
    {

        return view('materias.crear_materia');
    }

    public function materia_store(Request $request)
    {
        request()->validate([
            'name_materia' => 'required|string',
        ]);

        if ($request->especifico == 1) {
            if ($request->laboral == 1) {
                DB::table('materias')->insert([
                    'materia' => $request->name_materia,
                    'especifica' => 1,
                    'laboral' => 1
                ]);
                $id = DB::table('materias')->select('id_materia')->get();
                $id = MAX(end($id));
                flash('Materia creada exitosamente')->success();
                return redirect()->route('materias_edit', $id->id_materia);
            }
            DB::table('materias')->insert([
                'materia' => $request->name_materia,
                'especifica' => 1,
                'laboral' => 0
            ]);
            $id = DB::table('materias')->select('id_materia')->get();
            $id = MAX(end($id));
            flash('Materia creada exitosamente')->success();
            return redirect()->route('materias_edit', $id->id_materia);
        }

        DB::table('materias')->insert([
            'materia' => $request->name_materia,
            'especifica' => 0,
            'laboral' => 0
        ]);
        $id = DB::table('materias')->select('id_materia')->get();
        $id = MAX(end($id));
        flash('Materia creada exitosamente')->success();
        return redirect()->route('materias_edit', $id->id_materia);
    }

    public function materias_edit(Request $request, $id)
    {
        $materia = DB::table('materias')->select("*")->where("id_materia", $id)->first();
        $allcursos = DB::table('cursos')->select("*")->get();
        $notCursos = DB::table('cursos-materias')
            ->select('id_curso')
            ->where('id_materia', $id)
            ->get();
        $cursos = [];
        foreach ($allcursos as $item) {
            $flag = true;
            foreach ($notCursos as $indexData) {
                if ($indexData->id_curso == $item->id_curso)
                    $flag = false;
            }
            if ($flag)
                array_push($cursos, $item);
        }
        /* dd($cursos); */
        $cursos_materia = DB::table('cursos-materias')->join('cursos','cursos.id_curso','=','cursos-materias.id_curso')->where('id_materia', $id)->get();
        return view('materias.editar_materia', compact('materia', 'cursos', 'cursos_materia'));
    }

    public function materias_update(Request $request, $id)
    {

        request()->validate([
            'name_materia' => 'required|string',
        ]);

        DB::table('materias')->where("id_materia", $id)->update([
            'materia' => $request->name_materia,
        ]);

        if (isset($request->cursos)) {
            DB::table('cursos-materias')->where('id_materia', $id)->delete();
            foreach ($request->cursos as $curso) {
                
                DB::table('cursos-materias')->insert([
                    'id_curso' => $curso,
                    'id_materia' => $id
                ]);
            }
            flash('Cursos actualizados exitosamente')->success();
            return redirect()->route('materias_edit', $id);
        }
        DB::table('cursos-materias')->where('id_materia', $id)->delete();
        flash('Nombre cambiado exitosamente')->success();
        return redirect()->route('materias_edit', $id);
    }

    public function materias_delet(Request $request, $id)
    {

        DB::table('materias')->where('id_materia', $request->id_materia)->delete();

        return redirect()->back();
    }

    /*  MATERIAS DEL CURSO */

    public function lista_agregar_materias(Request $request, $id)
    {
        $curso = DB::table('cursos')->select('id_curso', 'curso', 'ano_curso')
            ->where('id_curso', $id)->first();
        return view('cursos.curso_materias.agregar_materias_curso', compact('curso'));
    }

    public function agregar_materias_curso(Request $request, $id)
    {
        $aux = 0;

        $profesores = array();
        $materias = array();


        foreach ($request->request as $dato) {

            if ($aux % 2 == 0 && $aux >= 2) {
                array_push($profesores, $dato);
            } elseif ($aux % 2 != 0 && $aux >= 2) {
                array_push($materias, $dato);
            }
            $aux++;
        }

        if (count($profesores) == count($materias)) {
            $count = 0;
            foreach ($materias as $materia) {

                DB::table('materias-cursos')->where("id_curso", $id)->insert([
                    'id_curso' => $id,
                    'id_materia' => $materia,
                ]);

                DB::table('profesores_materias_cursos')->where("id_curso", $id)->insert([
                    'id_profesor' => $profesores[$count],
                    'id_curso' => $id,
                    'id_materia' => $materia,
                ]);
                $count++;
            }
            return redirect()->route('cursos_editar', $id);
        }

        throw ValidationException::withMessages([
            'estado2' => "Porfavor selecciones un Profesor y marque la casilla corresponiente",
        ]);
    }

    public function update_profesor_materias(Request $request, $id)
    {
        $aux = 0;

        $profesores = array();
        $materias = array();

        foreach ($request->request as $dato) {

            if ($aux % 2 == 0 && $aux >= 2) {
                array_push($profesores, $dato);
            } elseif ($aux % 2 != 0 && $aux >= 2) {
                array_push($materias, $dato);
            }
            $aux++;
        }

        $x = count($profesores);

        if (count($profesores) == count($materias)) {
            $count = 0;
            foreach ($materias as $materia) {

                DB::table('profesores_materias_cursos')->where("id_curso", $id)->update([
                    'id_profesor' => $profesores[$count],
                    'id_curso' => $id,
                    'id_materia' => $materia,
                ]);
                $count++;
            }
            return redirect()->back();
        }
    }

    public function delet_materia_curso(Request $request, $id)
    {
        DB::table('materias_cursos')->where('id_materia', $request->id_materia)->where('id_curso', $id)->delete();
        return redirect()->back();
    }
}
