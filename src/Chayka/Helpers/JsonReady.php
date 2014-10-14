<?php

namespace Chayka\Helpers {

    interface JsonReady {

        /**
         * Returns assoc array to be packed into json payload
         *
         * @return array($key=>$value);
         */
        public function packJsonItem();

    }
}
