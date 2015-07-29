<?php
/**
 * Chayka.Framework is a framework that enables WordPress development in a MVC/OOP way.
 *
 * More info: https://github.com/chayka/Chayka.Framework
 */

namespace Chayka\Helpers {

    /**
     * Interface JsonReady allows to customize json output when object is included into a payload
     * when JsonHelper is used to perform API res
     *
     * @package Chayka\Helpers
     */
    interface JsonReady {

        /**
         * Returns assoc array to be packed into json payload
         *
         * @return array($key=>$value);
         */
        public function packJsonItem();

	    /**
	     * Assigns inner values from the ones provided in $data
	     *
	     * @param $data
	     *
	     * @return self
	     */
	    public static function unpackJsonItem($data);

    }
}
