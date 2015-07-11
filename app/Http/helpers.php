<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

function ga($title = null) {
    if(Auth::guest()) {
        $gamp = GAMP::setClientId(Session::getId());
        $gamp->setDocumentPath(Request::getPathInfo());
        if($title) $gamp->setDocumentTitle($title);
        $gamp->setIpOverride(Request::ip());
        $gamp->sendPageview();
    }
}