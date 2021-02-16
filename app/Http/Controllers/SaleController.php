<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Card;
use App\Models\User;
use \Firebase\JWT\JWT;

use App\Http\Helpers\MyJWT;

class SaleController extends Controller
{
    /**
     * Busca una carta por su nombre
     */
    public function findCard(Request $request)
    {

    	$response="";
    	$response= [];

    	// Leer el contenido de la petición
    	$data = $request->getContent();

    	// Decodificar el json
    	$data = json_decode($data);
    	
		$key = MyJWT::getKey();
		$headers = getallheaders();
		
		$decoded = JWT::decode($headers['api_token'], $key, array('HS256'));
    	//echo $cards;
    	// Si hay un json, crear el soldado
		if($data){
			$cards = Card::Where('name', $data->name)->get();
			for ($i=0; $i <count($cards) ; $i++){
			echo $cards[$i];
	
			}
    	if(!$cards->empty()) {
			echo "entra al if";
    	for ($i=0; $i <count($cards) ; $i++){
    		$response[$i] = [
            "id" => $cards[$i]->id,
            "name" =>  $cards[$i]->name,
            "description" =>$cards[$i]->description,
            "collection" => $cards[$i]->collection,
            "nombre admin"=>$cards[$i]->user->username
        	];

    	}
    	}else{
    		$response="No hay carta con ese nombre";
    	}

	}else{
		$response="No data";
	}
    		//Validar que el rol del usuario no sea admin de primeras
    		
    	return response($response);

    }

 
    /**
     * Crea una venta en funcion del id de la carta que se desea.
     */
    public function createSale(Request $request, $card_id)
    {

    	$response="";
 

    	// Leer el contenido de la petición
    	$data = $request->getContent();

    	// Decodificar el json
    	$data = json_decode($data);
    	$card = Card::Find($card_id);
        $key = MyJWT::getKey();
       $headers = getallheaders();
       $decoded = JWT::decode($headers['api_token'], $key, array('HS256'));
    	// Si hay un json, crear el soldado
    	if($card && $data) {

    	

    		if($decoded->id){
    			$sale = new Sale();

    			$sale->price = $data->price;
    			$sale->copies = $data->copies;
    			$sale->user_id = $decoded->id;
    			$sale->card_id = $card_id;


    		try{
            $sale->save();
           
            } catch(\Exception $e){
                $response=$e->getMessage();
                }
    		}else{
    			$response = "No user";
    		}

    	

    	}else{
    		$response="No hay carta con ese nombre";
    	}
    	return response($response);

    }

    	
    		
    	
    

}
