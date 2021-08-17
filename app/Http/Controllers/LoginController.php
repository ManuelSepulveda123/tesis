<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;



class LoginController extends Controller
{
    //
    public function login_view(){
       
        $profesores = DB::table('users')->where('id_tipo_usuario',2)->get();
        $ayudantes = DB::table('users')->where('id_tipo_usuario',3)->get();
        return view ('login.login',compact('profesores','ayudantes'));
    }

    public function login(Request $request){
       
        $credenciales = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);
        
        if(Auth::attempt($credenciales)){
                
            $request->session()->regenerate();
            return redirect()->route('inicio');
            
            
        } 
        
        throw ValidationException::withMessages([
            'email' => "Estas credenciales no coinciden con nuestros registros",
            "password" => "Estas credenciales no coinciden con nuestros registros"
        ]);
    }

    public function logout(){

        Auth::logout();

        return redirect('login');
    }
}
