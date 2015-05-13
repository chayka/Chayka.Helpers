<?php

namespace Chayka\Helpers {

    interface InputReady{
//        public function unpackInput($input = array());
        public static function validateInput($input = array(), $oldState = null);
	    public static function getValidationErrors();
	    public static function addValidationErrors($errors);
    }
}
