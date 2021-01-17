<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Registro/creacion de usuario, encripta contraseña
     */
    public function singUp(Request $request)
    {

    	$response="";


    	// Leer el contenido de la petición
    	$data = $request->getContent();

    	// Decodificar el json
    	$data = json_decode($data);

    	// Si hay un json, crear el soldado
    	if($data) {
    		$user = new User();

    		//Validar que el rol del usuario no sea admin de primeras
    		if($data->role!="Admin"){

    		$user->username = $data->username;
    		$user->password = Hash::make($data->password);
    		$user->email = $data->email;
    		$user->role = $data->role;
    		
			try{
				$user->save();
				$response="OK";
			} catch(\Exception $e){
			    $response=$e->getMessage();
				}

    		}else{
    			$response="Rol no valido, tiene que ser profesional o inidividual";
    		}
    		

    		
    		
    	}else{
    		$response="No data";
    	}

    	return response($response);

    }

    /**
     * COmprueba usuario y contraseña y genera el token del user
     */
     public function logIn(Request $request)
    {

        $response="";


        // Leer el contenido de la petición
        $data = $request->getContent();

        // Decodificar el json
        $data = json_decode($data);
        $user = User::Where('username', $data->username)->get()->first();
       
        if($user){
        // Si hay un json, crear el soldado
        if(Hash::check($data->password,$user->password)) {
                $response = "Usuario y contraseña correctos";
                
                $user->api_token = Str::random(60);
            try{
            $user->save();
                
            } catch(\Exception $e){
                $response=$e->getMessage();
                }

            }else{
                $response="Contraseña Incorrecta";
          }
            
        }else{
            $response="Username no valido";
        }
            
            
      
        return response($response);

    }

    /**
     * Para hacer a un user administrador
     */
     public function makeAdmin(Request $request, $user_id)
    {

        $response="";

        $user = User::Find($user_id);

        if($user) {
            

            
            $user->role = "Admin";
            
            try{
                $user->save();
                $response="Administrador creado";
            } catch(\Exception $e){
                $response=$e->getMessage();
                }

            }else{
                $response="No se encuentra user";
            }
            

            
            
        

        return response($response);

    }
    /**
     * Reseteo de contraseña
     */
    public function forgotPassword(Request $request)
    {

        $response="";

        $data = $request->getContent();

        // Decodificar el json
        $data = json_decode($data);
        $user = User::where('email',$data->email)->get()->first();

        if($user) {
            
            $password= "";

            $password= Str::random(15);
            
            $user->password = Hash::make($password);
            
            try{
                $user->save();
                $response="Nueva contraseña: ".$password;
            } catch(\Exception $e){
                $response=$e->getMessage();
                }

            }else{
                $response="No se encuentra user";
            }
            

        return response($response);

    }


}