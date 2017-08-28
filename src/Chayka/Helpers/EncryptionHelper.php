<?php
/**
 * Chayka.Framework is a framework that enables WordPress development in a MVC/OOP way.
 *
 * More info: https://github.com/chayka/Chayka.Framework
 */

namespace Chayka\Helpers;

/**
 * Class EncryptionHelper provides methods to encrypt and decrypt data.
 * If mcrypt php extension is not enabled, does no actual encryption/decryption.
 *
 * @package Chayka\Helpers
 */
class EncryptionHelper{

    /**
     * Encrypt provided data.
     *
     * @param string $value
     * @param string $key
     *
     * @param string $cipher
     * @param string $mode
     *
     * @return string
     */
    public static function encrypt($value, $key = '', $cipher = '', $mode = ''){
        if(!$key){
            $key = 'Chayka.Framework';
        }
        if(function_exists('openssl_encrypt')){
            if(!$cipher){
                $cipher = 'aes-256-cbc';
            }
            $ivSize = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivSize);
            $encrypted = openssl_encrypt($value, $cipher, $key, OPENSSL_RAW_DATA, $iv);
//            echo "($encrypted)";
            $value = base64_encode('openssl_'.$iv.$encrypted);
//            echo "[$value]";
        } else if(function_exists('mcrypt_encrypt')){
            if(!$cipher){
                $cipher = MCRYPT_RIJNDAEL_256;
            }
            if(!$mode){
                $mode = MCRYPT_MODE_CBC;
            }
            $keySize = @mcrypt_get_key_size($cipher, $mode);
            $key = substr(str_pad($key, $keySize, $key), 0, $keySize);
            $ivSize = @mcrypt_get_iv_size($cipher, $mode);
            $iv = @mcrypt_create_iv($ivSize, MCRYPT_RAND);
            $encrypted = @mcrypt_encrypt($cipher, $key, $value, $mode, $iv);
            $value = base64_encode($iv.$encrypted);
        }
        return $value;
    }

    /**
     * Decrypt provided data.
     * If decryption failed, returns initial data.
     *
     * @param string $value
     * @param string $key
     *
     * @param string $cipher
     * @param string $mode
     *
     * @return string
     */
    public static function decrypt($value, $key = '', $cipher = '', $mode = ''){
        if(!$key){
            $key = 'Chayka.Framework';
        }
        $decoded = base64_decode($value, true);
        if($decoded){
            $libHeaderSize = strlen('openssl_');
            $libName = trim(substr($decoded, 0, $libHeaderSize), "_\t\n\r\0\x0B");

            if(function_exists('openssl_decrypt') && $value && $libName === 'openssl'){
                if(!$cipher){
                    $cipher = 'aes-256-cbc';
                }
                $ivSize = openssl_cipher_iv_length($cipher);
                $iv = substr($decoded, $libHeaderSize, $ivSize);
                $data = substr($decoded, $libHeaderSize + $ivSize);
                if(strlen($iv) === $ivSize){
                    $decrypted = openssl_decrypt($data, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                    if($decrypted!==false){
                        $value = preg_replace('/\x00*$/', '', $decrypted);
                    }
                }
            } else  if(function_exists('mcrypt_decrypt') && $value){
                if(!$cipher){
                    $cipher = MCRYPT_RIJNDAEL_256;
                }
                if(!$mode){
                    $mode = MCRYPT_MODE_CBC;
                }
                $keySize = @mcrypt_get_key_size($cipher, $mode);
                $key = substr(str_pad($key, $keySize, $key), 0, $keySize);
                $ivSize = @mcrypt_get_iv_size($cipher, $mode);
                $iv = substr($decoded, 0, $ivSize);
                if(strlen($iv) === $ivSize){
                    $decrypted = @mcrypt_decrypt($cipher, $key, substr($decoded, $ivSize), $mode, $iv);
                    if($decrypted!==false){
                        $value = preg_replace('/\x00*$/', '', $decrypted);
                    }
                }
            }

        }

        return $value;
    }

}