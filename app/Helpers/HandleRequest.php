<?php


namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class HandleRequest
{


    public static function getRequest($url)
    {
        try{
            $request = new Client();
            $res = $request->get($url,
                [
                    'headers' => [
                        'x-access-token' => getenv('TOKEN')
                    ],
                ]
            );
            if($res->getStatusCode() == 200)
            {
                return $res->getBody();
            }
            return "Houve um problema com o acesso a API COD ".$res->getStatusCode();

        }catch (\Throwable $e)
        {
            Log::error("Existe um problema com a chamada da API GET ".$e->getMessage());
            return $e->getMessage();
        }
    }
}
