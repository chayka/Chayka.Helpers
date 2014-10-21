<?php

namespace Chayka\Helpers;

class InputHelper {

    protected static $input;
    protected static $htmlAllowed = array();
    protected static $validation = array();
    protected static $errors = array();

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
     * @param string|array|object $value
     * @param string $key
     * @return string|array
     */
    public static function filter($value, $key = ''){
        if(is_array($value)){
            return self::filterArray($value);
        }
        if(is_object($value)){
            return self::filterArray(get_object_vars($value));
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
     * @return array(string)
     */
    public static function filterArray($values){
        foreach($values as $k=>$v){
            $values[$k] = self::filter($v, $k);
        }
        return $values;
    }

    /**
     * Capture request from "php://input" and return as an assoc array
     *
     * @return array
     */
    public static function captureInput(){
        $fp = fopen("php://input", "r");
        $req = '';
        while($data = fread($fp, 1024)){
            $req.=$data;
        }
        fclose($fp);
        $params = array();
        if($req){
            $params = json_decode($req, true);
            if(!$params){
                parse_str($req, $params);
            }
            if($params){
                foreach($params as $key=>$value){
                    self::setParam($key, $value);
                }
            }
        }

        return self::filter($params);

    }

    /**
     * Setup input param validation using InputValidation
     *
     * @param string $key param name
     * @return InputValidation;
     */
    public static function checkParam($key){
        if(!isset(self::$validation[$key])){
            self::$validation[$key] = new InputValidation();
        }
        return self::$validation[$key];
    }

    /**
     * Check if param is valid.
     * If param is not valid, validation error will be put in to array
     *
     * @param $param
     * @return bool
     */
    public static function validateParam($param){
        $paramValidation = Util::getItem(self::$validation, $param);
        if($paramValidation){
            $error = $paramValidation->invalid(self::getParam($param));
            if($error){
                self::$errors[$param] = $error;
                return false;
            }
        }

        return true;
    }

    public static function validateInput($respondErrors = false){
        $valid = true;
        foreach(self::$validation as $param=>$validation){
            $valid = self::validateParam($param) && $valid;
        }

        if(!$valid && $respondErrors){
            JsonHelper::respondErrors(self::$errors);
        }

        return $valid;
    }

    public static function getValidationErrors(){
        return self::$errors;
    }
}

class InputValidation{

    protected $checks = array();

    /**
     * Setup param check
     * @param string $check
     * @param string $message
     * @param array $params
     * @return InputValidation
     */
    protected function add($check, $message, $params = array()){
        $params['message'] = $message;
        $this->checks[$check] = $params;
        return $this;
    }

    /**
     * Get stored check param
     *
     * @param $check
     * @param $param
     * @param string $default
     * @return mixed
     */
    protected function getCheckParam($check, $param, $default = ''){
        $check = Util::getItem($this->checks, $check);
        if($check){
            return Util::getItem($check, $param, $default);
        }

        return $default;
    }

    /**
     * Setup required param validation
     *
     * @param $message
     * @return InputValidation
     */
    public function required($message = 'Required'){
        return $this->add('required', $message);
    }

    /**
     * Check required value
     *
     * @param $val
     * @param string $message
     * @return string|false
     */
    public static function invalidRequired($val, $message = 'Required'){
//        $message = $message?$message:$this->getCheckParam('required', 'message', 'Required');
        return !$val?$message:false;
    }

    /**
     * Setup input param length validation
     *
     * @param $message
     * @param int $min
     * @param int $max
     * @return InputValidation
     */
    public function length($min = 0, $max = 0, $message = ''){
        return $this->add('length', $message, array(
            'min' => $min,
            'max' => $max
        ));
    }

    /**
     * Check value length
     *
     * @param string $val
     * @param int $min
     * @param int $max
     * @param string $message
     * @return bool|string
     */
    public static function invalidLength($val, $min = 0, $max = 0, $message = ''){
        if(!$min && $max){
            $defMsg = 'The value length should be shorter than %2$d';
        }else if($min && !$max){
            $defMsg = 'The value length should be longer than %1$d';
        }else{
            $defMsg = 'The length of value should be between %1$d and %2$d';
        }
        $message = $message?$message: $defMsg;
        $len = strlen($val);

        return ($min && $len < $min || $max && $len > $max) ? $message:false;
    }

    /**
     * Setup input param format validation
     *
     * @param $message
     * @param $format
     * @return InputValidation
     */
    public function format($format, $message = 'Invalid format'){
        return $this->add('format', $message, array('format'=>$format));
    }

    /**
     * Check value format
     *
     * @param string $val
     * @param string $format
     * @param string $message
     * @return bool|string
     */
    public static function invalidFormat($val, $format, $message = 'Invalid format'){
        return preg_match($format, $val)?false:$message;
    }

    /**
     * Setup input param email format validation
     *
     * @param $message
     * @return InputValidation
     */
    public function email($message = 'Invalid email'){
        return $this->add('email', $message);
    }

    /**
     * Check value email format
     *
     * @param string $val
     * @param string $message
     * @return bool|string
     */
    public function invalidEmail($val, $message = 'Invalid email'){
        return filter_var($val, FILTER_VALIDATE_EMAIL)?false:$message;
    }

    /**
     * Setup input param url format validation
     *
     * @param $message
     * @return InputValidation
     */
    public function url($message = 'Invalid URL'){
        return $this->add('url', $message);
    }

    /**
     * Check if value URL format
     *
     * @param $val
     * @param string $message
     * @return bool|string
     */
    public function invalidUrl($val, $message = 'Invalid URL'){
        return filter_var($val, FILTER_VALIDATE_URL)?false:$message;
    }

    /**
     * Setup input param int format validation
     *
     * @param $message
     * @return InputValidation
     */
    public function int($message = 'This value should be an integer'){
        return $this->add('int', $message);
    }

    /**
     * Check if value is integer
     *
     * @param $val
     * @param string $message
     * @return bool|string
     */
    public function invalidInt($val, $message = 'This value should be an integer'){
        return filter_var($val, FILTER_VALIDATE_URL)?false:$message;
    }

    /**
     * Setup input param number format validation
     *
     * @param $message
     * @return InputValidation
     */
    public function float($message = 'This value should be a number'){
        return $this->add('float', $message);
    }

    /**
     * Check if value is integer
     *
     * @param $val
     * @param string $message
     * @return bool|string
     */
    public function invalidFloat($val, $message = 'This value should be a number'){
        return filter_var($val, FILTER_VALIDATE_FLOAT)?false:$message;
    }

    /**
     * Setup param gt check
     *
     * @param $min
     * @param $message
     * @return InputValidation
     */
    public function gt($min, $message = "Value should be greater than %d"){
        return $this->add('gt', $message, array('min'=>$min));
    }

    /**
     * Validate gt check
     *
     * @param $val
     * @param $min
     * @param string $message
     * @return bool|string
     */
    public static function invalidGt($val, $min, $message = "Value should be greater than %d"){
        return $val > $min ? false : sprintf($message, $min);
    }

    /**
     * Setup param ge check
     *
     * @param $min
     * @param $message
     * @return InputValidation
     */
    public function ge($min, $message = "Value should be greater than %d or equal"){
        return $this->add('ge', $message, array('min'=>$min));
    }

    /**
     * Validate ge check
     *
     * @param $val
     * @param $min
     * @param string $message
     * @return bool|string
     */
    public static function invalidGe($val, $min, $message = "Value should be greater than %d or equal"){
        return $val >= $min ? false : sprintf($message, $min);
    }

    /**
     * Setup param lt check
     *
     * @param $max
     * @param $message
     * @return InputValidation
     */
    public function lt($max, $message = "Value should be less than %d"){
        return $this->add('lt', $message, array('max'=>$max));
    }

    /**
     * Validate lt check
     *
     * @param $val
     * @param $max
     * @param string $message
     * @return bool|string
     */
    public static function invalidLt($val, $max, $message = "Value should be less than %d"){
        return $val < $max ? false : sprintf($message, $max);
    }

    /**
     * Setup param le check
     *
     * @param $max
     * @param $message
     * @return InputValidation
     */
    public function le($max, $message = "Value should be less than %d or equal"){
        return $this->add('le', $message, array('max'=>$max));
    }

    /**
     * Validate le check
     *
     * @param $val
     * @param $max
     * @param string $message
     * @return bool|string
     */
    public static function invalidLe($val, $max, $message = "Value should be less than %d or equal"){
        return $val <= $max ? false : sprintf($message, $max);
    }

    /**
     * Validate $value across registered checks
     *
     * @param $value
     * @return string|false
     */
    public function invalid($value){
        if(isset($this->checks['required'])){
            $message = $this->getCheckParam('required', 'message');
            $error = self::invalidRequired($value, $message);
            if($error){
                return $error;
            }
        }elseif(!$value){
            return false;
        }

        foreach( $this->checks as $check => $params){
            $message = $this->getCheckParam($check, 'message');
            $error = false;
            switch($check){
                case 'length':
                    $min = $this->getCheckParam($check, 'min', 0);
                    $max = $this->getCheckParam($check, 'max', 0);
                    $error = self::invalidLength($value, $min, $max, $message);
                    break;
                case 'format':
                    $format = $this->getCheckParam($check, 'format');
                    $error = self::invalidFormat($value, $format, $message);
                    break;
                case 'email':
                    $error = self::invalidEmail($value, $message);
                    break;
                case 'url':
                    $error = self::invalidUrl($value, $message);
                    break;
                case 'int':
                    $error = self::invalidInt($value, $message);
                    break;
                case 'float':
                    $error = self::invalidFloat($value, $message);
                    break;
                case 'gt':
                    $min = $this->getCheckParam($check, 'min', 0);
                    $error = self::invalidGt($value, $min, $message);
                    break;
                case 'ge':
                    $min = $this->getCheckParam($check, 'min', 0);
                    $error = self::invalidGe($value, $min, $message);
                    break;
                case 'lt':
                    $max = $this->getCheckParam($check, 'max', 0);
                    $error = self::invalidLt($value, $max, $message);
                    break;
                case 'le':
                    $max = $this->getCheckParam($check, 'max', 0);
                    $error = self::invalidLe($value, $max, $message);
                    break;
            }
            if($error){
                return $error;
            }
        }

        return false;
    }

}

