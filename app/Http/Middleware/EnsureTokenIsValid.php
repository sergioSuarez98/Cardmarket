<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use \Firebase\JWT\JWT;

use App\Http\Helpers\MyJWT;
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

        
        
            $key = MyJWT::getKey();

            $headers = getallheaders();

            $decoded = JWT::decode($headers['api_token'], $key, array('HS256'));
            echo $decoded->role;
            if($decoded){
                
                //si el usuario es admin entra a la ruta de la api
                if($decoded->role == "Admin"){
                    return $next($request);

            }   else{
               abort(403,"User isn't admin");
            }
        

        }else{
            abort(403,"User isn't admin");
        }
     }   
}