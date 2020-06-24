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
        'error' => 'Ocorreu um erro na sua chamada',
    ];

    public function __construct($account, $product)
    {
        $this->account = $account;
        $this->product = $product;
        $this->url = config( 'flux.url' );
    }

    public function getResponse( $params )
    {
        try{
            if( !$this->checkAccountProduct() ) return $this->messages['accountProduct'];
            return $this->check( $params );
        }catch( \Exception $e ){
            return [ 'error' => true, 'msg' => $e->getMessage() ];
        }
    }

    protected function checkAccountProduct()
    {
        if( empty($this->account) || empty($this->product) ) return $this->detectAccountProduct();
        return true;
    }

    protected function detectAccountProduct()
    {
        if(isset($_SERVER['HTTP_HOST'])){
            $host = explode('.', $_SERVER['HTTP_HOST']);
            return $this->updateAccountProduct($host[0], $host[1]);
        }

        return false;
    }

    protected function updateAccountProduct( $account, $product )
    {
        if( !empty($account) && !empty($product) ){
            $this->account = $account;
            $this->product = $product;
            return true;
        }

        return false;
    }

    protected function call( $api, $headers, $body, $type = 'post' )
    {
        $response = Http::{$type}( $this->url . $api, $headers, $body);    
        if( $response->code != 200 ) throw new \Exception( $this->messages['error'] );
        return (array) $response->body;
    }

}