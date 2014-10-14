<?php

namespace Chayka\Helpers;

class HtmlHelper {
    
    protected static $meta = array();

    /**
     * A setter for meta container
     * @param string $key
     * @param mixed $value
     */
    public static function setMeta($key, $value){
        self::$meta[$key]=$value; 
    }

    /**
     * A getter for meta container
     * @param $key
     * @param string $default
     * @return mixed|string
     */
    public static function getMeta($key, $default = ''){
        $value = Util::getItem(self::$meta, $key, $default); 
        return $value?$value:$default;
    }

    /**
     * Store html > head > title value
     *
     * @param string $title
     */
    public static function setHeadTitle($title){
        self::setMeta('head.title', $title);
    }

    /**
     * Retrieve html > head > title value
     *
     * @param string $default
     * @return string
     */
    public static function getHeadTitle($default = ''){
        self::getMeta('head.title', $default);
    }

    /**
     * Store html > head > meta > keywords value
     *
     * @param string $value
     */
    public static function setMetaKeywords($value){
        self::setMeta('meta.keywords', $value);
    }

    /**
     * Retrieve html > head > meta > keywords value
     *
     * @param string $default
     * @return string
     */
    public static function getMetaKeywords($default = ''){
        return self::getMeta('meta.keywords', $default);
    }

    /**
     * Store html > head > meta > description value
     *
     * @param string $value
     */
    public static function setMetaDescription($value){
        self::setMeta('meta.description', $value);
    }

    /**
     * Store html > head > meta > description value
     *
     * @param string $default
     * @return string
     */
    public static function getMetaDescription($default = ''){
        return self::getMeta('meta.description', $default);
    }

    /**
     * Output 'style="display: none;"' if $condition truthy
     *
     * @param bool $condition
     */
    public static function hidden($condition = true){
        if($condition){
            echo 'style="display: none;"';
        }
    }

    /**
     * Output 'style="display: none;"' if $condition truthy
     *
     * @param bool $condition
     */
    public static function visible($condition = true){
        if(!$condition){
            echo 'style="display: none;"';
        }
    }

    /**
     * Output 'checked="checked"' if $condition truthy
     *
     * @param bool $condition
     */
    public static function checked($condition = true){
        if($condition){
            echo 'checked="checked"';
        }
    }

    /**
     * Output 'disabled="disabled"' if $condition truthy
     *
     * @param bool $condition
     */
    public static function disabled($condition = true){
        if($condition){
            echo 'disabled="disabled"';
        }
    }

}


