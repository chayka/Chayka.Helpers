<?php
/**
 * Chayka.Framework is a framework that enables WordPress development in a MVC/OOP way.
 *
 * More info: https://github.com/chayka/Chayka.Framework
 */

namespace Chayka\Helpers;

/**
 * Class JsonHelper wraps all the api output into an envelope
 *
 * {
 *  payload: mixed,
 *  message: string,
 *  code: string|int
 * }
 *
 * Payload is scanned recursively for JsonReady interface instances,
 * so that json representation of the object can be customized
 *
 * @package Chayka\Helpers
 */
class JsonHelper {

    /**
     * If true outputs Json response and dies (default behavior)
     * @var bool
     */
    protected static $dieOnRespond = true;

    /**
     * Enable or disable 'die on respond' mode.
     * Mainly needed to disable for testing purposes.
     *
     * @param bool $die
     */
    public static function dieOnRespond($die = true){
        self::$dieOnRespond = $die;
    }

    /**
     * Encode recursively provided $value.
     * If $value or it's properties are JsonReady, packToJson() will be used.
     *
     * @param $value
     * @param bool $singleQuotes
     *
     * @return string
     */
    public static function encode($value, $singleQuotes = false) {
        $json = json_encode(self::packObject($value));
        return $singleQuotes?self::singleQuotes($json):$json;
    }

    /**
     * Convert json encoded string to single quotes
     *
     * @param string $encodedJson
     *
     * @return string
     */
    public static function singleQuotes($encodedJson){
        $encodedJson = str_replace("'", "\\'", $encodedJson);
        $encodedJson = str_replace('"', "'", $encodedJson);
        return $encodedJson;
    }

    /**
     * Create assoc array from provided object.
     * If $obj or it's properties are JsonReady, packToJson() will be used.
     *
     * @param mixed $obj
     * @return array|string
     */
    public static function packObject($obj) {
        if ($obj instanceof JsonReady) {
            return $obj->packJsonItem();
        } elseif ($obj instanceof \DateTime) {
            return DateHelper::datetimeToJsonStr($obj);
        } elseif ($obj instanceof \Exception) {
            return array(
                'file'=>$obj->getFile(),
                'line'=>$obj->getLine(),
                'trace'=>$obj->getTrace(),
                'code' => $obj->getCode(),
            );
        }
	    if (is_object($obj)){
		    $obj = get_object_vars($obj);
	    }
	    if (is_array($obj)) {
		    foreach ( $obj as $key => $val ) {
			    $obj[ $key ] = self::packObject( $val );
		    }
	    }
        return $obj;
    }

    /**
     * Wrap json response into {'payload': ..., 'code': ..., 'message': ...} envelope
     *
     * @param string $payload
     * @param int $code
     * @param string $message
     * @return string
     */
    public static function packResponse($payload = '', $code = 0, $message = '') {
        $response = array(
            'payload' => $payload,
            'code' => $code,
            'message' => $message
        );
        return self::encode($response);
    }

    /**
     * Set http response code
     *
     * @param $code
     */
    public static function setResponseCode($code){
        if(self::$dieOnRespond && !headers_sent()){
            /**
             * dieOnRespond = false usually on debug mode for unit testing
             * in this mode we need to suppress 'headers sent' errors
             */
            HttpHeaderHelper::setResponseCode($code);
        }
    }

    /**
     * Wrap json response into {'payload': ..., 'code': ..., 'message': ...} envelope.
     * And then die() it.
     *
     * @param string $payload
     * @param int $code
     * @param string $message
     */
    public static function respond($payload = '', $code = 0, $message = '') {
        $response = self::packResponse($payload, $code, $message);
        if(self::$dieOnRespond){
            die($response);
        }else{
            echo $response;
        }
    }

    /**
     * Wrap Exception into {'payload': ..., 'code': ..., 'message': ...} envelope.
     * Set http response code to 500.
     * And then die() it.
     *
     * @param \Exception $e
     * @param string $code
     */
    public static function respondException($e, $code = ''){
        self::setResponseCode(500);
        self::respond($e, $code ? $code :$e->getCode(), $e->getMessage());
    }

    /**
     * Wrap success message into {'payload': ..., 'code': ..., 'message': ...} envelope.
     * Set http response code to $httpResponseCode = 200.
     * And then die() it.
     *
     * @param string $message
     * @param null $payload
     * @param int $code
     * @param int $httpResponseCode
     */
    public static function respondSuccess($message = '', $payload = null, $code = 0, $httpResponseCode = 200){
        self::setResponseCode($httpResponseCode);
        self::respond($payload, $code, $message);
    }

    /**
     * Wrap error into {'payload': ..., 'code': ..., 'message': ...} envelope.
     * Set http response code to $httpResponseCode = 400.
     * And then die() it.
     *
     * @param string $message
     * @param int $code
     * @param null $payload
     * @param int $httpResponseCode
     */
    public static function respondError($message = '', $code = 1, $payload = null, $httpResponseCode = 400){
        self::setResponseCode($httpResponseCode);
        self::respond($payload, $code, $message);
    }

    /**
     * Wrap multiple errors into {'payload': ..., 'code': ..., 'message': ...} envelope.
     * Set http response code to $httpResponseCode = 400.
     * And then die() it.
     *
     * @param $errors
     * @param null $payload
     * @param int $httpResponseCode
     */
    public static function respondErrors($errors, $payload = null, $httpResponseCode = 400){
        self::setResponseCode($httpResponseCode);
        $count = count($errors);
        if($count){
            self::respond($payload, 'mass_errors', $errors);
        }
        self::respond($payload, 1, '');
    }


}