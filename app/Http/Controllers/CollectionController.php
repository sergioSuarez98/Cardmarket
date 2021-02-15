<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Card;
use App\Models\cardCollection;
use App\Models\User;

use \Firebase\JWT\JWT;
use App\Http\Helpers\MyJWT;
class CollectionController extends Controller
{
    public function createCollection(Request $request)
    {
        /**
     * Funcion que crea una coleccion, si no existe la carta la crea, solo con su nombre, y si existe añade la carta a ella. Tambien autocompleta 
     la tabla intermedia
     */

    	$response="";

    	$card_id=0;
    	$collection_id=0;

    	// Leer el contenido de la petición
    	$data = $request->getContent();

    	// Decodificar el json
    	$data = json_decode($data);
        $key = MyJWT::getKey();
        $headers = getallheaders();
        $decoded = JWT::decode($headers['api_token'], $key, array('HS256'));
    	
    	if($data && $decoded->id) {
    		$collection = new Collection();
    		//Validar que el rol del usuario no sea admin de primeras
    		$card = Card::where('name', $data->card)->get()->first();
    		
    		if($card){

    			$collection->name = $data->name;
    			$collection->creation_date = $data->date;
    			$collection->icon=$data->icon;
    			

    			try{
    				$collection->save();
    				$collection_id=$collection->id;
    				$response="OK";
    			} catch(\Exception $e){
    				$response=$e->getMessage();
    			}

    			$cardCollection = new cardCollection();
    			$cardCollection->card_id =$card->id;
    			$cardCollection->collection_id =$collection_id;
				$cardCollection->save();
    		}else{

    			$card= new Card();
    			$card->name = $data->card;
    			$card->user_id=$decoded->id;
    			$card->collection = $data->name;
    			$collection->name = $data->name;
    			$collection->creation_date = $data->date;
    			$collection->icon=$data->icon;
    			
    			try{
    				$card->save();
    				$collection->save();
    				$card_id=$card->id;
    				$collection_id=$collection->id;
    				$response="OK";
    			} catch(\Exception $e){
    				$response=$e->getMessage();
    			}
    			$cardCollection = new cardCollection();
    			$cardCollection->card_id =$card_id;
    			$cardCollection->collection_id = $collection->id; 
				$cardCollection->save(); 
    		}
    	}else{
    		$response="No data";
    	}

    	return response($response);

    }
    /**
     * Update de las colecciones creadas al crear cartas.
     */
    public function updateCollection(Request $request, $id) 
     {
        $response="";

        //Buscar el libro por id
        $collection= Collection::find($id);
        

        // Si hay un libro, actualizar el libro
        if($collection) {

            // Leer el contenido de la petición
            $data = $request->getContent();

            // Decodificar el json
            $data = json_decode($data);
            

            if($data){

               
                $collection->creation_date = (isset($data->date) ? $data->date : $collection->date);
               	$collection->icon = (isset($data->icon) ? $data->icon : $collection->icon);
               
               
                try{
                    $collection->save();
                    $response="OK";
                } catch(\Exception $e){
                    $response=$e->getMessage();
                }
            } else {
                $response = "No collection";
            }

            
            
        }

        return response()->json($response);
    }
}
