<?php

namespace Doc88\Flux\Services;

use Unirest\Request as Http;

class Api
{

    private $account;
    private $product;

    private $messages = [
        'accountProduct' => 'O Produto e a Conta não puderam ser identificados'
    ];
    private $url;

    public function __construct($account, $product)
    {
        $this->account = $account;
        $this->product = $product;
        $this->url = config( 'flux.url' );
    }

    public function login( $email, $password )
    {
        if( !$this->checkAccountProduct() ) return $this->messages['accountProduct'];

        $headers = (array) $this->getLoginHeaders();
        
        return $this->apiCall(
            "auth/login", 
            $headers, 
            [
                'email' => $email,
                'password' => $password
            ]
        );
    }

    private function getLoginHeaders()
    {        
        return $this->apiCall(
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

    private function apiCall( $api, $headers, $body, $type = 'post' )
    {
        return Http::{$type}( 
            $this->url . $api, 
            $headers, 
            $body
        )->body;
    }

    private function checkAccountProduct()
    {
        if( is_null($this->account) || is_null($this->product) ){
            $accountProduct = $this->detectAccountProduct();
            
            if( !is_array( $accountProduct ) ) return false;

            $this->account = $accountProduct[0];
            $this->product = $accountProduct[1];
        }

        return true;
    }

    private function detectAccountProduct()
    {
        if(isset($_SERVER['HTTP_HOST'])){
            $host = explode('.', $_SERVER['HTTP_HOST']);

            if( !empty($host[0]) && !empty($host[1]) ){
                return[ $host[0], $host[1] ];
            }
        }

        return null;
    }

}