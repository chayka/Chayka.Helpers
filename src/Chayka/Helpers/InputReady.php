<?php
/**
 * Chayka.Framework is a framework that enables WordPress development in a MVC/OOP way.
 *
 * More info: https://github.com/chayka/Chayka.Framework
 */

namespace Chayka\Helpers {

    /**
     * Interface InputReady declares methods needed for the object to be validated when captured from HTTP request.
     * @package Chayka\Helpers
     */
    interface InputReady{
        /**
         * Validate input data when object is captured from HTTP request.
         * @param array $input
         * @param array|object $oldState
         *
         * @return bool
         */
        public static function validateInput($input = array(), $oldState = null);

        /**
         * Get hash map with validation errors organized by object property names.
         *
         * @return array
         */
	    public static function getValidationErrors();

        /**
         * Add validation errors.
         * @param array $errors An array of errors organized by property names.
         *
         * @return mixed
         */
	    public static function addValidationErrors($errors);
    }
}
