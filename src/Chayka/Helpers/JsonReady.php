<?php

namespace Chayka\Helpers {

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
