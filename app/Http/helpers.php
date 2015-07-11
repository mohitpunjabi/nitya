<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Irazasyed\LaravelGAMP\Facades\GAMP;

function ga($title = null) {
    if(Auth::guest()) {
        $gamp = GAMP::setClientId(Session::getId());
        $gamp->setDocumentPath(Request::getPathInfo());
        if($title) $gamp->setDocumentTitle($title);
        $gamp->setIpOverride(Request::ip());
        $gamp->sendPageview();
    }
}

if(!function_exists("curl_reset")) {
    function curl_reset($resource)
    {
        curl_setopt($resource, CURLOPT_HTTPGET, 1);
        curl_setopt($resource, CURLOPT_POST, false);
    }
}