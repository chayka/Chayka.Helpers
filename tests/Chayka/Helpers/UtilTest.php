<?php
/**
 * Created by PhpStorm.
 * User: borismossounov
 * Date: 15.10.14
 * Time: 21:46
 */

use Chayka\Helpers\Util;

class UtilTest extends PHPUnit_Framework_TestCase {

    public function testCmpVer(){
        $this->assertEquals(0, Util::cmpVersion('1.1.1', '1.1.1'));
        $this->assertGreaterThan(0, Util::cmpVersion('1.1.10-', '1.1.1'));
        $this->assertGreaterThan(0, Util::cmpVersion('1.10.1', '1.1.1'));
        $this->assertGreaterThan(0, Util::cmpVersion('10.1.1', '1.1.1'));
        $this->assertLessThan(0, Util::cmpVersion('5.5.5-', '10.1.1'));
        $this->assertLessThan(0, Util::cmpVersion('1.1.1', '1.10.1'));
        $this->assertLessThan(0, Util::cmpVersion('1.0.1', '1.1.1'));
    }

}
 