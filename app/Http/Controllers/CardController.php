<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Collection;
use App\Models\cardCollection;
use App\Models\Sale;
use App\Models\User;
class CardController extends Controller
{
    /**
     * Funcion que crea una carta, si no existe la coleccion la crea, solo con su nombre, y si existe añade la carta a ella. Tambien autocompleta 
     la tabla intermedia
     */
     public function createCard(Request $request,$token)
     {

       $response="";

       $card_id=0;
       $collection_id=0;


       $data = $request->getContent();


       $data = json_decode($data);


       if($data) {
          $card = new Card();
    		//Validar que el rol del usuario no sea admin de primeras
          $collection = Collection::where('name', $data->collection)->get()->first();
          $user = User::where('api_token',$token)->get()->first();

          if($collection){

             $card->name = $data->name;
             $card->description = $data->description;
             $card->collection=$data->collection;
             $card->user_id=$user->id;

             try{
                $card->save();
                $card_id=$card->id;
                $response="OK";
            } catch(\Exception $e){
                $response=$e->getMessage();
            }

            $cardCollection = new cardCollection();
            $cardCollection->card_id =$card_id;
            $cardCollection->collection_id =  $collection->id;
            $cardCollection->save();
        }else{

           $collection= new Collection();
           $collection->name = $data->collection;
           $card->name = $data->name;
           $card->description = $data->description;
           $card->collection=$data->collection;
           $card->user_id=$user->id;
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
 * Muestra la lista de cartas a la venta con un nombre en concreto.
 */
public function buyCard(Request $request)
{

    $response="";
    $response= [];

        // Leer el contenido de la petición
    $data = $request->getContent();

        // Decodificar el json
    $data = json_decode($data);
    $cards = Card::Where('name', $data->name)->get();
    
        // Si hay un json, crear el soldado
    if($cards) {

        for ($i=0; $i <count($cards) ; $i++){
            
            if($cards[$i]->sale){
             for ($j=0; $j <count($cards[$i]->sale) ; $j++) {  
                $idCreador= $cards[$i]->sale[$j]->user_id;
                //echo $idCreador;
                $userCreador = User::where('id',$idCreador)->get()->first();
                $response[] = [
                    "name" => $cards[$i]->name,
                    "copies" => $cards[$i]->sale[$j]->copies,
                    "total_price" => $cards[$i]->sale[$j]->price,
                    "nombre" => $userCreador->username

                     ];

            }
        }   
    }

}else{
    $response="No hay carta con ese nombre";
}

            //Validar que el rol del usuario no sea admin de primeras

return response($response);

}
/**
 * Update de las cartas que se crean desde la coleccion
 */
public function updateCard(Request $request, $id) 
{
    $response="";

        //Buscar el libro por id
    $card=Card::find($id);


        // Si hay un libro, actualizar el libro
    if($card) {

            // Leer el contenido de la petición
        $data = $request->getContent();

            // Decodificar el json
        $data = json_decode($data);


        if($data){



            $card->description = (isset($data->description ) ? $data->description  : $collection->description );


            try{
                $card->save();
                $response="OK";
            } catch(\Exception $e){
                $response=$e->getMessage();
            }
        } else {
            $response = "No card";
        }



    }

    return response()->json($response);
}
}
