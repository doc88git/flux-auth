<?php

namespace Doc88\Flux\Services;

class Login extends Api
{

    public function __construct($account, $product)
    {
        parent::__construct($account, $product);
    }

    public function check( $params )
    {
        if( !$this->checkParams( $params ) ) throw new \Exception( $this->messages['params'] );

        $headers = $this->getHeaders();
        
        return $this->call(
            "auth/login", 
            $headers, 
            [
                'email' => $params['email'],
                'password' => $params['password']
            ]
        );
    }

    protected function checkParams( $params )
    {
        if( empty( $params['email'] ) || empty( $params['password'] ) ) return false;
        return true;
    }

    protected function getHeaders()
    {        
        return $this->call(
            "applications/headers/login", 
            [
                'Accept' => 'application/json'
            ], 
            [
                'account' => $this->account, 
                'product' => $this->product
            ]
        );
    }

}