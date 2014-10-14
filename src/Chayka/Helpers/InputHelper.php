<?php

namespace Chayka\Helpers;

class InputHelper {

    protected static $input;
    protected static $htmlAllowed = array();

    /**
     * Set input buffer.
     * If buffer not set $_REQUEST is used by default
     *
     * @param $input
     */
    public static function setInput($input){
        self::$input = $input;
    }

    /**
     * Define input params that are allowed to contain HTML
     *
     * @param string/array $htmlAllowed 'post_content, comment_content' or ['post_content', 'comment_content']
     */
    public static function permitHtml($htmlAllowed){
        if(is_string($htmlAllowed)){
            $htmlAllowed = preg_split('%\s*,\s*%', $htmlAllowed);
        }
        self::$htmlAllowed = array_merge(self::$htmlAllowed, $htmlAllowed);
    }

    /**
     * Inject input param value to current input buffer
     *
     * @param $param
     * @param $value
     */
    public static function setParam($param, $value){
        if(self::$input){
            self::$input[$param] = $value;
        }else{
            $_REQUEST[$param] = $value;
        }
    }

    /**
     * Get filtered param value from current input buffer
     *
     * @param $param
     * @param string $default
     * @return string
     */
    public static function getParam($param, $default = '') {
        $value = Util::getItem(self::$input?self::$input:$_REQUEST, $param, $default);
        return self::filter($value, $param);
    }

    /**
     * Get assoc array of filtered values from current input buffer.
     * If $omitStandard then 'controller', 'action', 'module' will be omited
     *
     * @param bool $omitStandard
     * @return array
     */
    public static function getParams($omitStandard = false) {
        $params = self::$input?self::$input:$_REQUEST;
        $result = array();
        $standard = array('action', 'controller', 'module');
        foreach ($params as $key => $value) {
            if(!$omitStandard || !in_array($key, $standard)){
                $result[$key] = self::getParam($key);
            }
        }

        return $result;
    }

    /**
     * Filter $value (trim, strip_slashes, strip_tags).
     * If $key is in array of html allowed params, then tags won't be stripped
     *
     * @param string $value
     * @param string $key
     * @return string
     */
    public static function filter($value, $key = ''){
        if(is_array($value)){
            return self::filterArray($value);
        }
        if(!in_array($key, self::$htmlAllowed)){
            $filter = FILTER_SANITIZE_STRING;
            $options = FILTER_FLAG_NO_ENCODE_QUOTES;
            $value = filter_var($value, $filter, $options);
        }
        return rtrim(stripslashes($value));
    }
    /**
     * Filter $values (trim, strip_slashes, strip_tags).
     *
     * @param array(string) $values
     * @return string
     */
    public static function filterArray($values){
        foreach($values as $k=>$v){
            $values[$k] = self::filter($v, $k);
        }
        return $values;
    }
}
