<?php

namespace Doc88\Flux;

use Doc88\Flux\Services\Api;

class Authorization
{

    public function login( $email, $password, $account = null, $product =null )
    {
        $response = new Api($account, $product);
        return response()->json( $response->login($email, $password) );
    }

}