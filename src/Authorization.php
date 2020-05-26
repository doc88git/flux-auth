<?php

namespace Doc88\Flux;

use Doc88\Flux\Services\Login;
use Doc88\Flux\Services\Module;
use Doc88\Flux\Services\Permission;

class Authorization
{

    public function login( $email, $password, $account, $product )
    {
        $response = new Login($account, $product);
        return response()->json( $response->login($email, $password) );
    }

    public function module( $token, $account, $product, $module )
    {
        $response = new Module($account, $module, $product);
        return response()->json( $response->permission($token) );
    }

    public function permission( $token, $account, $product, $action )
    {
        $response = new Permission($account, $action, $product);
        return response()->json( $response->permission($token) );
    }

}