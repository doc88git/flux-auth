<?php

namespace Doc88\Flux\Services;

class Login extends Api
{

    protected $account;
    protected $product;

    public function __construct($account, $product)
    {
        parent::__construct();

        $this->account = $account;
        $this->product = $product;
    }

    public function login( $email, $password )
    {
        if( !$this->checkAccountProduct() ) return $this->messages['accountProduct'];

        $headers = (array) $this->getLoginHeaders();
        
        return $this->call(
            "auth/login", 
            $headers, 
            [
                'email' => $email,
                'password' => $password
            ]
        );
    }

    protected function getLoginHeaders()
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