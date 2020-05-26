<?php

namespace Doc88\Flux\Services;

use Unirest\Request as Http;

class Api
{

    protected $url;

    protected $messages = [
        'accountProduct' => 'O Produto e a Conta não puderam ser identificados'
    ];

    public function __construct()
    {
        $this->url = config( 'flux.url' );
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
        if( is_null($this->account) || is_null($this->product) ){
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