<?php

namespace Doc88\Flux\Services;

class Permission extends Api
{

    protected $action;

    public function __construct($account, $product)
    {
        parent::__construct($account, $product);

        $this->function = 'permission';
    }

    public function permission( $params )
    {
        if( !$this->checkParams( $params ) ) return $this->messages['params'];

        $headers = $this->getHeaders( $params['token'] );

        if(isset( $headers['error'] )) return $headers;
        
        return $this->call(
            "applications/permission", 
            $headers, 
            [],
            'get'
        );
    }

    protected function checkParams( $params )
    {
        if( empty( $params['token'] ) || empty( $params['action'] ) ) return false;

        $this->action = $params['action'];

        return true;
    }

    protected function getHeaders( $token )
    {        
        $headers = $this->call(
            "applications/headers/permission", 
            [
                'Accept' => 'application/json'
            ], 
            [
                'account' => $this->account, 
                'action' => $this->action,
                'product' => $this->product,
            ]
        );
        $headers['Authorization'] = 'Bearer ' . $token;

        return $headers;
    }

}