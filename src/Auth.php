<?php

namespace Doc88\Flux;

use Unirest\Request as Http;

class Auth
{

    public function login()
    {
        $response = Http::get("https://dev.flux88.io/api/users");
        return response()->json($response);
    }

}