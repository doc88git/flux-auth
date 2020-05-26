<?php

namespace Doc88\Flux\Services;

class Module extends Api
{

    protected $account;
    protected $module;
    protected $product;

    public function __construct($account, $module, $product)
    {
        parent::__construct();

        $this->account = $account;
        $this->module = $module;
        $this->product = $product;
    }

    public function module( $token )
    {
        if( !$this->checkAccountProduct() ) return $this->messages['accountProduct'];

        $headers = (array) $this->getModuleHeaders();
        $headers['Authorization'] = 'Bearer ' . $token;
        
        return $this->call(
            "applications/module", 
            $headers, 
            [],
            'get'
        );
    }

    protected function getModuleHeaders()
    {        
        return $this->call(
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
    }

}