<?php

namespace Chayka\Helpers;

class JsonHelper {

    /**
     * Encode recursively provided $value.
     * If $value or it's properties are JsonReady, packToJson() will be used.
     *
     * @param $value
     * @return string
     */
    public static function encode($value) {
        return json_encode(self::packObject($value));
    }

    /**
     * Create assoc array from provided object.
     * If $obj or it's properties are JsonReady, packToJson() will be used.
     *
     * @param mixed $obj
     * @return array|string
     */
    public static function packObject($obj) {
        if (is_array($obj)) {
            foreach ($obj as $key => $val) {
                $obj[$key] = self::packObject($val);
            }
        }elseif ($obj instanceof JsonReady) {
            return $obj->packJsonItem();
        } elseif ($obj instanceof \DateTime) {
            return DateHelper::datetimeToJsonStr($obj);
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
     * Wrap json response into {'payload': ..., 'code': ..., 'message': ...} envelope.
     * And then die() it.
     *
     * @param string $payload
     * @param int $code
     * @param string $message
     */
    public static function respond($payload = '', $code = 0, $message = '') {
        return die(self::packResponse($payload, $code, $message));
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
        HttpHeaderHelper::setResponseCode(500);
        self::respond(array(
            'file'=>$e->getFile(),
            'line'=>$e->getLine(),
            'trace'=>$e->getTrace(),
            'code' => $e->getCode(),
        ), $code ? $code :$e->getCode(), $e->getMessage());
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
        HttpHeaderHelper::setResponseCode($httpResponseCode);
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
        HttpHeaderHelper::setResponseCode($httpResponseCode);
        $count = count($errors);
        if($count){
            self::respond($payload, 'mass_errors', $errors);
        }
        self::respond($payload, 1, '');
    }


}