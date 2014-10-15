<?php

namespace Chayka\Helpers;

class Util {

    /**
     * Returns object's property or array's element by key
     * in case of absense returns default value
     * @var array|object data to extract element from
     * @var string key
     * @var mixed default value
     * @return mixed value
     */
    public static function getItem($data, $key, $defaultValue = "") {
        $value = $defaultValue;
        if (is_object($data)) {
            $data = get_object_vars($data);
        }
        if (is_array($data)) {
            if (isset($data[$key])) {
                $value = $data[$key];
            }
        }

        return $value;
    }

    /**
     * Alias of print_r(), but encloses output into <pre>...</pre>
     *
     * @param mixed $var
     * @return int
     */
    public static function print_r($var){
        echo "<pre>\n";
        print_r($var);
        echo "</pre>";
        
        return 0;
    }

    /**
     * Get server name from $_SERVER['SERVER_NAME'] without 'www.'
     *
     * @return mixed
     */
    public static function serverName(){
        return str_replace('www.', '', $_SERVER['SERVER_NAME']);
    }

    /**
     * Start session.
     */
    public static function sessionStart(){
        if(!session_id()){
            session_start();
        }
    }

    /**
     * Compares to version strings
     *
     * @param $a
     * @param $b
     * @return int
     */
    public static function cmpVersion($a, $b){
        $verPattern = '%^(\d+)\.(\d+)?\.(\d+)?%';
        preg_match($verPattern, $a, $am);
        preg_match($verPattern, $b, $bm);
        $a1 = (int)Util::getItem($am, 1, 0);
        $a2 = (int)Util::getItem($am, 2, 0);
        $a3 = (int)Util::getItem($am, 3, 0);
        $b1 = (int)Util::getItem($bm, 1, 0);
        $b2 = (int)Util::getItem($bm, 2, 0);
        $b3 = (int)Util::getItem($bm, 3, 0);

        $d1 = $a1 - $b1;
        if($d1){
            return $d1;
        }

        $d2 = $a2 - $b2;
        if($d2){
            return $d2;
        }

        $d3 = $a3 - $b3;
        if($d3){
            return $d3;
        }

        return 0;
    }
}