<?php

namespace Chayka\Helpers {

    interface InputReady{
        public function unpackInput($input = array());
        public function validateInput($input = array(), $action = 'create');
        public function getValidationErrors();
    }
}
