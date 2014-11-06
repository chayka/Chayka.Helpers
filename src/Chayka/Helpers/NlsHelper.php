<?php
/**
 * Created by PhpStorm.
 * User: borismossounov
 * Date: 30.10.14
 * Time: 18:28
 */

namespace Chayka\Helpers;

use \Locale;

class NlsHelper {

    protected static $dictionary = array();
    protected static $locale;
    protected static $lang;
    protected static $baseDir;
    protected static $nlsDir = 'app/nls/';
//    protected static $resDir = 'res/';

    /**
     * Set current locale.
     * Locale::setDefault() is used.
     *
     * @param $locale
     */
    public static function setLocale($locale = 'auto'){
        if('auto' == $locale){
            $locale = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
        }
        Locale::setDefault($locale);
        self::$locale = Locale::getDefault();
    }

    /**
     * Function returns current locale
     *
     * @return string
     */
    public static function getLocale() {
        if (!self::$locale) {
            self::setLocale('auto');
        }
        return self::$locale;
    }

    /**
     * Set current language
     *
     * @param string $lang
     */
    public static function setLang($lang) {
        self::$lang = $lang;
    }

    /**
     * Get current language
     *
     * @return string
     */
    public static function getLang() {
        if (!self::$lang) {
            self::$lang = Locale::getPrimaryLanguage(self::getLocale());
        }
        return self::$lang;
    }

    /**
     * Set base project dir
     *
     * @param string $dir
     */
    public static function setBaseDir($dir){
        self::$baseDir = $dir;
    }

    /**
     * Get base project dir
     *
     * @return string
     */
    public static function getBaseDir(){
        return self::$baseDir;
    }

    /**
     * Set nls dir (relative to base dir)
     *
     * @param string $dir
     */
    public static function setNlsDir($dir){
        self::$nlsDir = $dir;
    }

    /**
     * Get base dir (relative to base dir)
     *
     * @return string
     */
    public static function getNlsDir(){
        return self::$nlsDir;
    }

    /**
     * Load translation (e.g. 'auth').
     * Translations can be stored in two alternative paradigms:
     * 1. Split by lang-dirs
     * nls/
     *   _/
     *     auth.php
     *   en/
     *     auth.php
     * 2. Split by extentsion prefix
     * nls/
     *   auth.php
     *   auth._.php
     *   auth.en.php
     *
     * '_' - stands for default
     *
     * @param $module
     */
    public static function load($module) {
        if(empty(self::$dictionary[$module])){
            $nlsDir = static::getBaseDir().static::getNlsDir();
            $langDir = $nlsDir.self::getLang().'/';
            $defLangDir = $nlsDir.'_/';
            if(is_dir($defLangDir)){
                if(!is_dir($langDir)){
                    $langDir = $defLangDir;
                }
                $fn = $langDir.str_replace('/', DIRECTORY_SEPARATOR, $module).'.php';
                if(file_exists($fn)){
                    self::$dictionary[$module] = require($fn);
                }
            }else{
                $fnBase = $nlsDir.str_replace('/', DIRECTORY_SEPARATOR, $module).'.';
                $fn = '';
                if(file_exists($fnBase.self::getLang().'.php')){
                    $fn = $fnBase.self::getLang().'.php';
                }else if(file_exists($fnBase.'_.php')){
                    $fn = $fnBase.'_.php';
                }else if(file_exists($fnBase.'php')) {
                    $fn = $fnBase . 'php';
                }
                if($fn){
                    self::$dictionary[$module] = require($fn);
                }
            }

        }
    }

    /**
     * Search for the translation in all the dictionaries.
     * Begins with module dictionary if the one specified.
     *
     * @param string $string
     * @param string $module
     * @return string
     */
    public static function translate($string, $module = ''){
        $tran = '';

        if($module && isset(self::$dictionary[$module])){
            $dictionary = self::$dictionary[$module];
            if(isset($dictionary[$string]) && $dictionary[$string]){
                $tran = $dictionary[$string];
            }
        }

        if(!$tran){
            foreach(self::$dictionary as $dictionary){
                if(isset($dictionary[$string]) && $dictionary[$string]){
                    $tran = $dictionary[$string];
                    break;
                }
            }
        }

        return $tran? $tran : $string;
    }

    /**
     * Get localized value, or value itself if localization is not found
     * This function can get multiple args and work like sprintf($template, $arg1, ... $argN)
     * Hint: Use $format = 'На %2$s сидят %1$d обезьян';
     *
     * @param string $value String to translate
     * @return string
     */
    public static function _($value) {
        if(func_num_args()>1){
            $args = func_get_args();
            $args[0] = self::translate($value);
            return call_user_func_array('sprintf', $args);
        }
        return self::translate($value);
    }

    /**
     * Echo localized value, or value itself if localization is not found
     * This function can get multiple args and work like sprintf($template, $arg1, ... $argN)
     * Hint: Use $format = 'На %2$s сидят %1$d обезьян';
     *
     * @param string $value String to translate
     * @return string
     */
    public static function __($value){
        if(func_num_args()>1){
            $args = func_get_args();
            $args[0] = self::translate($value);
            echo $res = call_user_func_array('sprintf', $args);
            return $res;
        }
        echo $res = self::translate($value);
        return $res;
    }

}