<?php

namespace Doc88\Flux;

use Doc88\Flux\Services\Login;
use Doc88\Flux\Services\Module;
use Doc88\Flux\Services\Permission;

class Authorization
{

    public static function login( $email, $password, $account, $product )
    {
        $response = new Login($account, $product);
        return response()->json( $response->check(['email' => $email, 'password' => $password]) );
    }

    public static function module( $token, $account, $product, $module )
    {
        $response = new Module($account, $product);
        return response()->json( $response->check(['token' => $token, 'module' => $module]) );
    }

    public static function permission( $token, $account, $product, $action )
    {
        $response = new Permission($account, $product);
        return response()->json( $response->check(['token' => $token, 'action' => $action]) );
    }

}