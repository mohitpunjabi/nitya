<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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