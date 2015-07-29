<?php
/**
 * Chayka.Framework is a framework that enables WordPress development in a MVC/OOP way.
 *
 * More info: https://github.com/chayka/Chayka.Framework
 */

namespace Chayka\Helpers;

/**
 * Class Util contains some helper methods that are nowhere else to put, yet.
 * @package Chayka\Helpers
 */
class Util {

    /**
     * Returns object's property or array's element by key
     * in case of absence returns default value
     *
     * @param array|object $data to extract element from
     * @param string $key
     * @param mixed $defaultValue
     * @return mixed
     */
    public static function getItem($data, $key, $defaultValue = "") {
        $value = $defaultValue;
        if (is_object($data)) {
//            $data = get_object_vars($data);
	        if(isset($data->$key)){
		        $value = $data->$key;
	        }
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
     * Perform translit convert of cyrillic string
     *
     * @param $str
     *
     * @return mixed
     */
    public static function translit($str){
        $table = array(
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I', 'Й' => 'J',
            'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P',
            'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H',
            'Ц' => 'C', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'CSH', 'Ь' => '',
            'Ы' => 'Y', 'Ъ' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',

            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'j',
            'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p',
            'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h',
            'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'csh', 'ь' => '',
            'ы' => 'y', 'ъ' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
        );

        $str = str_replace(
            array_keys($table),
            array_values($table),$str
        );

        return $str;
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