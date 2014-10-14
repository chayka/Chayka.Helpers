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
}