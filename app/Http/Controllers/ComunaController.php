<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComunaController extends Controller
{
    //
    public function provincia_comunas(Request $request){

        $comunas = DB::table('comunas')->select('id','comuna')->where('provincia_id', '=', $request->id_provincia)->get();
        $html="<option value='0' selected disabled>Seleccione comuna</option>";
        
        foreach ($comunas as $comuna){
           
            
            $html=$html."<option value=".$comuna->id.">".$comuna->comuna."</option>";
        }
    
        echo $html;

    }
}
