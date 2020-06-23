<?php

namespace Doc88\Flux\Services;

class Module extends Api
{

    protected $module;

    public function __construct($account, $product)
    {
        parent::__construct($account, $product);

        $this->function = 'module';
    }

    public function module( $params )
    {
        if( !$this->checkParams( $params ) ) return $this->messages['params'];

        $headers = $this->getHeaders( $params['token'] );

        if(isset( $headers['error'] )) return $headers;
        
        return $this->call(
            "applications/module", 
            $headers, 
            [],
            'get'
        );
    }

    protected function checkParams( $params )
    {
        if( empty( $params['token'] ) || empty( $params['module'] ) ) return false;

        $this->module = $params['module'];

        return true;
    }

    protected function getHeaders( $token )
    {        
        $headers = $this->call(
            "applications/headers/module", 
            [
                'Accept' => 'application/json'
            ], 
            [
                'account' => $this->account, 
                'module' => $this->module,
                'product' => $this->product,
            ]
        );
        $headers['Authorization'] = 'Bearer ' . $token;

        return $headers;
    }

}