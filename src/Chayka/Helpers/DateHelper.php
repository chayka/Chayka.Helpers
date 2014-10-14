<?php

namespace Chayka\Helpers;

use \DateTime;
use \DateTimeZone;

class DateHelper {
    const DB_DATETIME = 'Y-m-d H:i:s';//'yyyy-MM-dd HH:mm:ss';
    const DB_DATE = 'Y-m-d';//'yyyy-MM-dd';
    const DB_TIME = 'H:i:s';//'HH:mm:ss';

    const JSON_DATETIME = 'Y-m-d\TH:i:s.000\Z';
    const JSON_DATE = 'Y-m-d';//'dd.MM.yyyy';
    const JSON_TIME = 'H:i:s';

    static protected $storedTimezone = null;

    /**
     * Convert DateTime to db date string.
     *
     * @param DateTime $dt
     * @return string
     */
    public static function dateToDbStr($dt) {
        return $dt->setTimezone(new DateTimeZone('UTC'))->format(self::DB_DATE);
    }

    /**
     * Convert DateTime to db time string.
     *
     * @param DateTime $dt
     * @return string
     */
    public static function timeToDbStr($dt) {
        return $dt->setTimezone(new DateTimeZone('UTC'))->format(self::DB_TIME);
    }

    /**
     * Convert DateTime to db datetime string.
     *
     * @param DateTime $dt
     * @return string
     */
    public static function datetimeToDbStr($dt) {
        return $dt->setTimezone(new DateTimeZone('UTC'))->format(self::DB_DATETIME);
    }

    /**
     * Convert db date string to DateTime.
     *
     * @param string $strDate
     * @return DateTime
     */
    public static function dbStrToDate($strDate) {
        $dt = DateTime::createFromFormat(self::DB_DATETIME, $strDate.' 00:00:00', new DateTimeZone('UTC'));
        return $dt;
    }

    /**
     * Convert db time string to DateTime.
     *
     * @param string $strTime
     * @return DateTime
     */
    public static function dbStrToTime($strTime) {
        $dt = DateTime::createFromFormat(self::DB_TIME, $strTime, new DateTimeZone('UTC'));
        return $dt;
    }

    /**
     * Convert db datetime string to DateTime.
     *
     * @param string $strDatetime
     * @return DateTime
     */
    public static function dbStrToDatetime($strDatetime) {
        $dt = DateTime::createFromFormat(self::DB_DATETIME, $strDatetime, new DateTimeZone('UTC'));
        return $dt;
    }

    /**
     * Convert DateTime to json date string.
     *
     * @param DateTime $dt
     * @return string
     */
    public static function dateToJsonStr($dt) {
        return $dt->setTimezone(new DateTimeZone('UTC'))->format(self::JSON_DATE);
    }

    /**
     * Convert DateTime to json time string.
     *
     * @param DateTime $dt
     * @return string
     */
    public static function timeToJsonStr($dt) {
        return $dt->setTimezone(new DateTimeZone('UTC'))->format(self::JSON_TIME);
    }

    /**
     * Convert DateTime to json datetime string.
     *
     * @param DateTime $dt
     * @return string
     */
    public static function datetimeToJsonStr($dt) {
        return $dt->setTimezone(new DateTimeZone('UTC'))->format(self::JSON_DATETIME);
    }

    /**
     * Convert json date string to DateTime.
     *
     * @param string $strDate
     * @return DateTime
     */
    public static function jsonStrToDate($strDate) {
        $dt = DateTime::createFromFormat(self::JSON_DATETIME, $strDate.'T00:00:00.000Z', new DateTimeZone('UTC'));
        return $dt;
    }

    /**
     * Convert json time string to DateTime.
     *
     * @param string $strTime
     * @return DateTime
     */
    public static function jsonStrToTime($strTime) {
        $dt = DateTime::createFromFormat(self::JSON_TIME, $strTime, new DateTimeZone('UTC'));
        return $dt;
    }

    /**
     * Convert json datetime string to DateTime.
     *
     * @param string $strDatetime
     * @return DateTime
     */
    public static function jsonStrToDatetime($strDatetime) {
        $dt = DateTime::createFromFormat(self::JSON_DATETIME, $strDatetime, new DateTimeZone('UTC'));
        return $dt;
    }

    /**
     * Convert json date string to db string.
     *
     * @param string $strDate
     * @return string
     */
    public static function jsonDateToDbStr($strDate){
        $dt = self::jsonStrToDate($strDate);
        return self::dateToDbStr($dt);
    }

    /**
     * Convert json time string to db string.
     *
     * @param string $strTime
     * @return string
     */
    public static function jsonTimeToDbStr($strTime){
        $dt = self::jsonStrToTime($strTime);
        return self::timeToDbStr($dt);
    }

    /**
     * Convert json datetime string to db string.
     *
     * @param string $strDatetime
     * @return string
     */
    public static function jsonDatetimeToDbStr($strDatetime){
        $dt = self::jsonStrToDatetime($strDatetime);
        return self::datetimeToDbStr($dt);
    }

    /**
     * Convert db date string to json string.
     *
     * @param string $strDate
     * @return string
     */
    public static function dbDateToJsonStr($strDate){
        $dt = self::dbStrToDate($strDate);
        return self::dateToJsonStr($dt);
    }

    /**
     * Convert db time string to json string.
     *
     * @param string $strTime
     * @return string
     */
    public static function dbTimeToJsonStr($strTime){
        $dt = self::dbStrToTime($strTime);
        return self::timeToJsonStr($dt);
    }

    /**
     * Convert db datetime string to json string.
     *
     * @param string $strDatetime
     * @return string
     */
    public static function dbDatetimeToJsonStr($strDatetime){
        $dt = self::dbStrToDatetime($strDatetime);
        return self::datetimeToJsonStr($dt);
    }

    /**
     * Fix DateTime timezone using the one stored at $_SESSION['timezone'].
     * You can get timezone only from JS on client-side,
     * and you need to store it in $_SESSION yourself.
     *
     * @param DateTime $date
     * @return DateTime
     */
    public static function fixTimezone($date){
        if(isset($_SESSION['timezone'])){
            if(!self::$storedTimezone){
                self::$storedTimezone = new DateTimeZone(isset($_SESSION['timezone'])?$_SESSION['timezone']:'UTC');
            }
            $date->setTimezone(self::$storedTimezone);
        }
        return $date;
    }

}
