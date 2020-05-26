<?php

namespace Doc88\Flux\Services;

class Permission extends Api
{

    protected $account;
    protected $action;
    protected $product;

    public function __construct($account, $action, $product)
    {
        parent::__construct();

        $this->account = $account;
        $this->action = $action;
        $this->product = $product;
    }

    public function permission( $token )
    {
        if( !$this->checkAccountProduct() ) return $this->messages['accountProduct'];

        $headers = (array) $this->getPermissionHeaders();
        $headers['Authorization'] = 'Bearer ' . $token;
        
        return $this->call(
            "applications/permission", 
            $headers, 
            [],
            'get'
        );
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