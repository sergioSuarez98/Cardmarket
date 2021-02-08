<?php

namespace App\Http\Helpers;
use \Firebase\JWT\JWT;

class MyJWT{

    private const KEY = 'ksahdisbfoudsbvfkjuHSAm$$jlpgjfkjggfjrbhiuvnsdvkndv55695';
    
    public static function generatePayload($user){
        $payload = array(
            'role' => $user->role,
            'id' => $user->id
        );

        return $payload;
    }

    public static function getKey(){
        return self::KEY;
    }

    /*public static function generateToken($username){
        return JWT::encode(generatePayload($username), self::KEY);
    }*/
}
