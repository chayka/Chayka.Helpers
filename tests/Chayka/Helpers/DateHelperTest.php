<?php

use Chayka\Helpers\DateHelper;

class DateHelperTest extends PHPUnit_Framework_TestCase {

    public function testDateTimeAndDb(){
        $dt = new DateTime();
        $str = DateHelper::datetimeToDbStr($dt);
        $this->assertEquals(DateHelper::dbStrToDatetime($str), $dt);
    }

    public function testDateTimeAndJson(){
        $dt = new DateTime();
        $str = DateHelper::datetimeToJsonStr($dt);
        $this->assertEquals($dt, DateHelper::jsonStrToDatetime($str));
    }

    public function testDbAndJson(){
        $dbStr = "2014-01-01 01:01:01";
        $jsonStr = DateHelper::dbDatetimeToJsonStr($dbStr);
        $this->assertEquals($jsonStr, "2014-01-01T01:01:01.000Z");
        $this->assertEquals($dbStr, DateHelper::jsonDatetimeToDbStr($jsonStr));
    }
}
 