<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Irazasyed\LaravelGAMP\Facades\GAMP;

function url_product($product) {
    return url('products/' . $product->id . '/' . $product->slug);
}

function getCurrentPath() {
    return (Request::getPathInfo() . (Request::getQueryString() ? ('?' . Request::getQueryString()) : ''));
    // return str_replace(url(), '', Request::fullUrl());
}

function ga($title = null, $responseTime = null) {
    if(config('app.debug')) {
        Log::info(getCurrentPath() . ': ' . $responseTime . 'ms');
    }
    else {
        $gamp = GAMP::setClientId(Session::getId());
        
        $gamp->setDocumentPath(getCurrentPath());

        $gamp->setDocumentLocationUrl(Request::fullUrl());

        if($responseTime)
            $gamp->setServerResponseTime($responseTime);
        if(Request::ip())
            $gamp->setIpOverride(Request::ip());
        if(Request::server('HTTP_USER_AGENT'))
            $gamp->setUserAgentOverride(Request::server('HTTP_USER_AGENT'));
        
        if(Auth::user()) $title = 'Admin ' . $title;
        if($title) 
            $gamp->setDocumentTitle($title);

        if(Request::server('HTTP_REFERER'))
            $gamp->setDocumentReferrer(Request::server('HTTP_REFERER'));

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

function submit_sitemap()
{
    $sitemapUrl = url('sitemap');
    $crawlers = [
        'Google'    => 'http://www.google.com/webmasters/sitemaps/ping?sitemap='.$sitemapUrl,
        'Bing'      => 'http://www.bing.com/webmaster/ping.aspx?siteMap='.$sitemapUrl,
        'Ask'       => 'http://submissions.ask.com/ping?sitemap='.$sitemapUrl
    ];

    foreach($crawlers as $crawler => $url)
    {
        $returnCode = myCurl($url);
        Log::info($crawler.' Sitemaps has been pinged (return code: '.$returnCode.')');
    }
}

function myCurl($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpCode;
}

function submit_to_facebook($url)
{
    return myCurl('https://graph.facebook.com/?id='.$url.'&scrape=1&method=POST');
}