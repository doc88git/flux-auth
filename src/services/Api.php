<?php

namespace Doc88\Flux\Services;

use Unirest\Request as Http;

class Api
{

    private $url;

    public function __construct()
    {
        $this->url = config( 'flux.url' );
    }

    public function login( $account, $product, $email, $password )
    {
        $headers = (array) $this->getLoginHeaders( $account, $product );
        
        return Http::post( 
            $this->url . "auth/login",
            $headers,
            [
                'email' => $email,
                'password' => $password
            ]
        )->body;
    }

    private function getLoginHeaders( $account, $product )
    {
        return Http::post( 
            $this->url . "applications/headers/login", 
            [
                'Accept' => 'application/json'
            ], 
            [
                'account' => $account, 
                'product' => $product
            ]
        )->body;
    }

}