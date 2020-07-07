<?php

namespace Doc88\Flux;

use Doc88\Flux\Services\Login;
use Doc88\Flux\Services\Module;
use Doc88\Flux\Services\Permission;

use Doc88\FluxEntityPermission\EntityPermission;

class Authorization
{

    public static function login( $email, $password, $account = null, $product = null )
    {
        $response = new Login($account, $product);
        return response()->json( $response->getResponse(['email' => $email, 'password' => $password]) );
    }

    public static function module( $token, $module, $account = null, $product = null )
    {
        $response = new Module($account, $product);
        return response()->json( $response->getResponse(['token' => $token, 'module' => $module]) );
    }

    public static function permission( $token, $action, $account = null, $product = null )
    {
        $response = new Permission($account, $product);
        return response()->json( $response->getResponse(['token' => $token, 'action' => $action]) );
    }

    public static function entity( $method, $params )
    {
        return EntityPermission::{$method}(...$params);
    }

}