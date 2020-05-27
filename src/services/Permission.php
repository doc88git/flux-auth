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

        $headers = (array) $this->getPermissionHeaders();
        $headers['Authorization'] = 'Bearer ' . $params['token'];
        
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

    protected function getPermissionHeaders()
    {        
        return $this->call(
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
    }

}