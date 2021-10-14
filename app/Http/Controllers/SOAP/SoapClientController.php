<?php

namespace App\Http\Controllers\SOAP;

use App\Http\Controllers\Controller;
use SoapClient;

class SoapClientController extends Controller
{
    public function client($id)
    {
        ini_set('soap.wsdl_cache_enabled', '0');

        $client = new SoapClient('http://nginx/wsdl', [
            'soap_version' => SOAP_1_2,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => 1,
        ]);

        return array($client->getUser($id));
    }
}
