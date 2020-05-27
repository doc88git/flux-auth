<?php

namespace Doc88\Flux\Services;

use Unirest\Request as Http;

class Api
{

    protected $account;
    protected $product;
    protected $url;

    protected $function;

    protected $messages = [
        'accountProduct' => 'O Produto e a Conta não puderam ser identificados',
        'params' => 'Parâmetros incorretos ou em falta',
        'error' => 'Ocorreu um erro',
    ];

    public function __construct($account, $product)
    {
        $this->account = $account;
        $this->product = $product;
        $this->url = config( 'flux.url' );
    }

    public function check( $params )
    {
        if( !$this->checkAccountProduct() ) return $this->messages['accountProduct'];

        if( !empty( $this->function ) ){
            return $this->{$this->function}( $params );
        }

        return $this->messages['error'];
    }

    protected function call( $api, $headers, $body, $type = 'post' )
    {
        return Http::{$type}( 
            $this->url . $api, 
            $headers, 
            $body
        )->body;
    }

    protected function checkAccountProduct()
    {
        if( empty($this->account) || empty($this->product) ){
            $accountProduct = $this->detectAccountProduct();
            
            if( !is_array( $accountProduct ) ) return false;

            $this->account = $accountProduct[0];
            $this->product = $accountProduct[1];
        }

        return true;
    }

    protected function detectAccountProduct()
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