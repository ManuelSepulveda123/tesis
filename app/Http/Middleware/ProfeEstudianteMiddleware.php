<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class ProfeEstudianteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            switch (Auth::user()->id_tipo_usuario) {
                case ('1'):
                    return redirect(RouteServiceProvider::HOME);
                    break;
                case ('2'):
                    return $next($request);
                    break;
                case ('3'):
                    return $next($request);
                    break;
                case ('4'):
                    return $next($request);
                    break;
                case ('5'):
                    return redirect(RouteServiceProvider::HOME);
                    break;
            }
        }

        return redirect('login');
    }
}
