<?php

namespace Doc88\Flux;

use Doc88\Flux\Services\Api;

class Authorization
{

    private $api;

    public function __construct()
    {
        $this->api = new Api();
    }

    public function login( $account, $product, $email, $password )
    {
        return response()->json( $this->api->login( $account, $product, $email, $password ) );
    }

}