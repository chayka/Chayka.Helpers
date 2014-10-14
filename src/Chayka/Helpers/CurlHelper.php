<?php

namespace Chayka\Helpers;

class CurlHelper {

    /**
     * Prepares curl handle on given url
     * @param string $url given URL
     * @param mixed $params data to send
     * @param integer $timeout in seconds
     * @return resource curl handle
     */
    public static function prepareRequest($url, $params=array(), $timeout=60) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if(!empty ($params)){
            curl_setopt($ch, CURLOPT_POST, 1);
            $request = http_build_query($params, '', '&');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

        return $ch;
    }

    /**
     * Perform request using prepared handle.
     * If request returns json function returns decoded response (assoc array)
     * @param $ch
     * @return string/array
     */
    public static function performRequest($ch){
        $res = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($res, true);
        return null == $json ? $res : $json;
    }

    /**
     * Sends post request on given url and returns response
     * @param string $url given URL
     * @param array $params to send
     * @param integer $timeout in seconds
     * @return string response
     */
    public static function post($url, $params=array(), $timeout=60) {
        $ch = self::prepareRequest($url, $params, $timeout);
        return self::performRequest($ch);
    }

    /**
     * Sends get request on given url and returns response
     * @param string $url given URL
     * @param array $params to send
     * @param integer $timeout in seconds
     * @return string response
     */
    public static function get($url, $params=array(), $timeout=60) {
        $url.='?'.http_build_query($params, '', '&');
        $ch = self::prepareRequest($url, null, $timeout);
        return self::performRequest($ch);
    }

    /**
     * Download file from $url and store it to $filename.
     * If params are used they are POSTed.
     * Returns size of downloaded file.
     *
     * @param string $filename
     * @param string $url
     * @param array $params
     * @param int $timeout
     * @return int file size
     */
    public static function download($filename, $url, $params=array(), $timeout=0){
        $ch = self::prepareRequest($url, $params, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
        $fp = fopen ($filename, 'w+');

        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch); // get curl response
        curl_close($ch);
        fclose($fp);

        return file_exists($filename)?filesize($filename):0;
    }

    /**
     * Ping $url several times with specified timeout till $url responses.
     *
     * @param string $url
     * @param int $retry
     * @param int $timeout
     * @return bool
     */
    public static function ping($url, $retry = 3, $timeout = 2) {
        $try = 0;
        do {
            $try++;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_FAILONERROR, 1);
            $data = curl_exec($ch);
            curl_close($ch);
        } while (empty($data) && $try <= $retry);

        return!empty($data);
    }

    /**
     * Given a http response with http header
     * this function returns assoc array containing http headers.
     *
     * @param string $str
     * @return array
     */
    public static function extractHttpHeader($str) {
        $response = array();

        $pattern = '%\A(.*\x0D\x0A)\x0D\x0A%imUsA';
        $answer = preg_match($pattern, $str, $m) ? $m[1] : '';

        $pattern = '%\A(.*)\x0D\x0A%imUs';
        if(preg_match($pattern, $answer, $m)){
            $response['SA'] = $m[1];

            $pattern = '%\s(\d{3})\s%';
            $response['Code'] = preg_match($pattern, $response['SA'], $m) ? $m[1] : '';
        }
        $pattern = "%^([^\x0D\x0A]*):(.*)$%imUs";
        preg_match_all($pattern, $answer, $m, PREG_SET_ORDER);
        $c = count($m);
        for ($i = 0; $i < $c; $i++) {
            $key = strtolower($m[$i][1]);
            $val = $m[$i][2];
            $response[$key] = $val;
        }
        $pattern = "%charset=(.*)$%iU";
        $charset = isset($response['content-type']) && preg_match($pattern, $response['content-type'], $m) ? $m[1] : '';
        if($charset){
            $response['charset'] = $charset;
        }

        return $response;
    }

}
