<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinciaController extends Controller
{
    //
    public function region_provincias(Request $request){
        
        $provincias = DB::table('provincias')->select('id','provincia')->where('region_id', '=', $request->id_region)->get();
        $html="<option value='0' selected disabled>Seleccione provincia</option>";
        
        foreach ($provincias as $provincia){
           
            
            $html=$html."<option value=".$provincia->id.">".$provincia->provincia."</option>";
        }
    
        echo $html;
        
    }
}
