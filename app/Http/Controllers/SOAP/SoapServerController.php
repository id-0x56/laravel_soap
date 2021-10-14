<?php

namespace App\Http\Controllers\SOAP;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use SoapServer;

class SoapServerController extends Controller
{
    public function server()
    {
        header('Content-Type: text/xml; charset=utf-8');
        header('Cache-Control: no-store, no-cache');
        header('Expires: ' . date('r'));

        ini_set('soap.wsdl_cache_enabled', '0');

        $server = new SoapServer('http://nginx/wsdl');
        $server->setClass(UserController::class);

        $server->handle();
    }
}
