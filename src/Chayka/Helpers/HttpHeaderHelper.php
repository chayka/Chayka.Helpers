<?php
/**
 * Chayka.Framework is a framework that enables WordPress development in a MVC/OOP way.
 *
 * More info: https://github.com/chayka/Chayka.Framework
 */

namespace Chayka\Helpers;

/**
 * Class HttpHeaderHelper contains a set of handy methods for outputting HTTP Response Headers (status codes mainly).
 *
 * @package Chayka\Helpers
 */
class HttpHeaderHelper
{
    /**
     * Sets http response code with corresonding message
     * @param int $code
     */
    public static function setResponseCode($code = 200){
        $message = '';
        $intCode = intval($code);
        switch($intCode){
            case 100:
                $message = '100 Continue'; break;
            case 101:
                $message = '101 Switching Protocols'; break;
            case 200:
                $message = '200 OK'; break;
            case 201:
                $message = '201 Created'; break;
            case 202:
                $message = '202 Accepted'; break;
            case 203:
                $message = '203 Non-Authoritative Information'; break;
            case 204:
                $message = '204 No Content'; break;
            case 205:
                $message = '205 Reset Content'; break;
            case 206:
                $message = '206 Partial Content'; break;
            case 300:
                $message = '300 Multiple Choices'; break;
            case 301:
                $message = '301 Moved Permanently'; break;
            case 302:
                $message = '302 Found'; break;
            case 303:
                $message = '303 See Other'; break;
            case 304:
                $message = '304 Not Modified'; break;
            case 305:
                $message = '305 Use Proxy'; break;
            case 306:
                $message = '306 (Unused)'; break;
            case 307:
                $message = '307 Temporary Redirect'; break;
            case 400:
                $message = '400 Bad Request'; break;
            case 401:
                $message = '401 Unauthorized'; break;
            case 402:
                $message = '402 Payment Required'; break;
            case 403:
                $message = '403 Forbidden'; break;
            case 404:
                $message = '404 Not Found'; break;
            case 405:
                $message = '405 Method Not Allowed'; break;
            case 406:
                $message = '406 Not Acceptable'; break;
            case 407:
                $message = '407 Proxy Authentication Required'; break;
            case 408:
                $message = '408 Request Timeout'; break;
            case 409:
                $message = '409 Conflict'; break;
            case 410:
                $message = '410 Gone'; break;
            case 411:
                $message = '411 Length Required'; break;
            case 412:
                $message = '412 Precondition Failed'; break;
            case 413:
                $message = '413 Request Entity Too Large'; break;
            case 414:
                $message = '414 Request-URI Too Long'; break;
            case 415:
                $message = '415 Unsupported Media Type'; break;
            case 416:
                $message = '416 Requested Range Not Satisfiable'; break;
            case 417:
                $message = '417 Expectation Failed'; break;
            case 500:
                $message = '500 Internal Server Error'; break;
            case 501:
                $message = '501 Not Implemented'; break;
            case 502:
                $message = '502 Bad Gateway'; break;
            case 503:
                $message = '503 Service Unavailable'; break;
            case 504:
                $message = '504 Gateway Timeout'; break;
            case 505:
                $message = '505 HTTP Version Not Supported'; break;
        }

        $sapi_type = php_sapi_name();
        if (substr($sapi_type, 0, 3) == 'cgi'){
            $message = 'Status: '.$message;
        }else{
            $message = 'HTTP/1.1 '.$message;
        }

        header($message, true, $intCode);

    }

    /**
     * Sets header Location
     * Redirects client to $url
     *
     * @param string $url
     * @param int $httpResponseCode
     */
    public static function redirect($url, $httpResponseCode = 301){
        header('Location: '.$url, true, $httpResponseCode);
        die();
    }

}