<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   public function handle($request, Closure $next)
    {

        /*$data = $request->getContent();

        // Decodificar el json
        $data = json_decode($data);
        echo $data->token;*/
        //echo $request->token;
        if($request->token){

            $user = User::Where('api_token',$request->token)->get()->first();
            
            if($user){
                //si el usuario es admin entra a la ruta de la api
                if($user->role == "Admin"){
                    return $next($request);

            }else{
               abort(403,"User isn't admin");
            }
        }else{
            abort(403,"Token Erroneo");
        }

        

       
    }
}
}
