<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;


class CheckToken
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
        //echo $request->token;
        if($request->token){

            $user = User::Where('api_token',$request->token)->get()->first();
            
            if($user){
                //si el usuario es individual o profesional entra a la ruta de la api
                if($user->role == "Individual" || $user->role == "Profesional"){
                    return $next($request);

            }else{
               abort(403,"User isn't valid");
            }
        }else{
            abort(403,"Token Erroneo");
        }
    }
    }
}