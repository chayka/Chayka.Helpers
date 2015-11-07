<?php
/**
 * Chayka.Framework is a framework that enables WordPress development in a MVC/OOP way.
 *
 * More info: https://github.com/chayka/Chayka.Framework
 */

namespace Chayka\Helpers;

/**
 * Class LogHelper contains a set of handy methods for logging
 *
 * @package Chayka\Helpers
 */
class LogHelper {

    /**
     * Output functions
     */
    const NEED_FUNC = 1;

    /**
     * Output errors
     */
    const NEED_ERROR = 2;

    /**
     * Output warnings
     */
    const NEED_WARNING = 4;

    /**
     * Output info
     */
    const NEED_INFO = 8;

    /**
     * Indent size
     */
    const INDENT_LENGTH = 4;

    /**
     * Log content
     *
     * @var string|null
     */
    protected static $log = null;

    /**
     * Current indent
     *
     * @var integer
     */
    protected static $indent = 0;

    /**
     * Log filename
     *
     * @var string
     */
    protected static $logFn;

    /**
     * Log dir
     *
     * @var string
     */
    protected static $logDir;

    /**
     * Log level (flags)
     *
     * @var integer
     */
    protected static $logLevel = 255;

    /**
     * Called script signature
     *
     * @var string
     */
    protected static $signature;

    /**
     * Script start time;
     *
     * @var float
     */
    protected static $startTime;

    /**
     * Last time check datetime
     *
     * @var float
     */
    protected static $lastTimeCheck;

    /**
     * Init log
     *
     * @param null|string $logDir
     * @param int $logLevel
     */
    public static function init($logDir = null, $logLevel = 255){
        if($logDir){
            self::setDir($logDir);
        }
        self::$logLevel = $logLevel;
        if(!self::$startTime){
            self::$startTime = microtime(true);
            register_shutdown_function(array('\\Chayka\\Helpers\\LogHelper', 'shutDownHandler'));
        }

    }

    /**
     * Get start time
     *
     * @return float
     */
    public static function getStartTime(){
        if(empty(self::$startTime)){
            self::$startTime = microtime(true);
        }
        return self::$startTime;
    }

    /**
     * Get datetime of previous time check
     *
     * @return \DateTime
     */
    public static function getLastTimeCheck(){
        if(empty(self::$lastTimeCheck)){
            self::$lastTimeCheck = self::getStartTime();
        }
        return self::$lastTimeCheck;
    }

    /**
     * Get amount of time passed since script start
     *
     * @return float
     */
    public static function getElapsedTime(){
        $now = microtime(true);
        $elapsed = $now - self::getStartTime();
        return $elapsed;
    }

    /**
     * Get amount of time passed since last time check
     *
     * @return float
     */
    public static function getDeltaTime(){
        $now = microtime(true);
        $delta = $now - self::getLastTimeCheck();
        self::$lastTimeCheck = microtime(true);

        return $delta;
    }

    /**
     * Get fancy header strings, like this:
     *    ___________________
     * __/ session at 345345 \_________________________________________________________
     *
     * @param string $str
     * @param int $width
     *
     * @return string
     */
    public static function fancyHeader($str, $width = 74){
        $strLength = strlen($str);
        if($strLength > $width){
            $str = substr($str, 0, $width - 3).'...';
            $strLength = $width;
        }
        $res = '   ' . str_repeat('_', $strLength + 2) . "\r\n";
        $res.= '__/ ' . $str . ' \\' . str_repeat('_', $width - $strLength) . "\r\n\r\n";
        return $res;
    }

    /**
     * Get fancy footer strings, like this:
     * _________________________________________________________                     __
     *                                                          \ session at 345345 /
     *                                                           -------------------
     * @param string $str
     * @param int $width
     *
     * @return string
     */
    public static function fancyFooter($str, $width = 74){
        $strLength = strlen($str);
        if($strLength > $width){
            $str = substr($str, 0, $width - 3).'...';
            $strLength = $width;
        }
        $res = str_repeat('_', $width - $strLength) . str_repeat(' ', $strLength + 4) . '__' . "\r\n";
        $res.= str_repeat(' ', $width - $strLength) . '\\ ' . $str . ' /' . "\r\n";
        $res.= str_repeat(' ', $width + 1 - $strLength) . str_repeat('-', $strLength + 2) . "\r\n\r\n";
        return $res;
    }

    /**
     * Get script signature
     *
     * @return string
     */
    public static function getSignature(){
        if(empty(self::$signature)){
            $action = $_SERVER['REQUEST_URI'];
            $server = $_SERVER['SERVER_NAME'];
            self::$signature = $server.$action.' at '.date('H:i:s');
        }
        return self::$signature;
    }

    /**
     * Set log directory
     *
     * @param string
     */
    public static function setDir($dir){
        if($dir && !is_dir($dir)){
            mkdir($dir);
        }
        static::$logDir = $dir;
    }

    /**
     * Get log directory
     *
     * @return string
     */
    public static function getDir(){
        if(!static::$logDir){
            static::$logDir = self::$logDir;
        }
        return static::$logDir;
    }

    /**
     * Sets log filename
     *
     * @param string
     */
    public static function setFn($fn){
        static::$logFn = $fn;
    }

    /**
     * Get log filename
     *
     * @return string
     */
    public static function getFn(){
        if(empty(self::$logFn)){
            self::$logFn = self::getDir() . '/' . Util::serverName() . date('.Y-m-d') . '.log';
        }
        return self::$logFn;
    }

    /**
     * Callback that is triggered on shutdown to close log output
     */
    public static function shutDownHandler(){
        if(self::$log !== null){
            $str = self::fancyFooter(self::getSignature() . DateHelper::microTimeToStr(self::getElapsedTime(), ' i:s.z'));
            self::append($str);
        }
        self::flush();
    }

    /**
     * Output function arguments
     *
     * @param $args
     *
     * @param bool $richObjects
     *
     * @return string
     */
    public static function argsToString($args, $richObjects = true){
        $objects = array();
        foreach($args as $i => $arg){
            $str = '$'.$i.' = ';
            $str.= print_r($arg, true);
            $str = str_replace("\n", "\r\n", $str);
            if(is_object($arg)){
                $objects[]=$str;
                $args[$i] = '{Object}';
            }elseif(is_array($arg)){
                $objects[]=$str;
                $args[$i] = '{Array}';
            }else{
                $args[$i] = "'".$args[$i]."'";
            }
        }

        $result = '('.implode(', ', $args).')';
        if(count($objects) && $richObjects){
            $result .= "\n" . implode("\n", $objects);
        }

        return $result;
    }

    /**
     * Set log level
     *
     * @param integer $level
     */
    public static function setLogLevel($level){
        self::$logLevel = $level;
    }

    /**
     * Output string to log
     *
     * @param $str
     */
    protected static function append($str){
        if(!self::$startTime){
            self::init();
        }
        if($str){
            if(self::$log === null){
                self::$log = self::fancyHeader(self::getSignature());
            }
            $indent = str_repeat(' ', self::$indent * self::INDENT_LENGTH);
            $str = $indent . rtrim(str_replace("\n", "\n".$indent, $str)) . "\n";
            self::$log.= $str;
        }
    }

    /**
     * Flush cached log to file
     */
    public static function flush(){
        if(self::$log && self::$logDir){
            FsHelper::append(self::getFn(), self::$log);
            self::$log = '';
        }
    }

    /**
     * Log function start
     *
     * @param bool $richObjects
     */
    public static function funcStart($richObjects = false){
        if(self::$logLevel & self::NEED_FUNC){
            $trace = debug_backtrace();
            $str = Util::getItem($trace[1], 'class');
            $str.= Util::getItem($trace[1], 'type');
            $str.= Util::getItem($trace[1], 'function');
            $str.= self::argsToString(Util::getItem($trace[1], 'args'), $richObjects);
            $str.= '[start]';
            self::append($str);
            self::$indent++;
        }
    }

    /**
     * Log function stop
     */
    public static function funcStop(){
        if(self::$logLevel & self::NEED_FUNC){
            $trace = debug_backtrace();
            $str = Util::getItem($trace[1], 'class');
            $str.= Util::getItem($trace[1], 'type');
            $str.= Util::getItem($trace[1], 'function');
            $str.= '('.str_repeat('.', count(Util::getItem($trace[1], 'args'))).')';
            $str.= '[stop]';
            self::$indent--;
            self::append($str);
        }
    }

    /**
     * Log function call
     *
     * @param bool $richObjects
     **/
    public static function func($richObjects = true){
        if(self::$logLevel & self::NEED_FUNC){
            $trace = debug_backtrace();
            $str = Util::getItem($trace[1], 'class');
            $str.= Util::getItem($trace[1], 'type');
            $str.= Util::getItem($trace[1], 'function');
            $str.= self::argsToString(Util::getItem($trace[1], 'args'), $richObjects);
            self::append($str);
        }
    }

    /**
     * Log milestone
     *
     * @param int $milestone
     */
    public static function milestone($milestone = 0){
        if(self::$logLevel & self::NEED_FUNC){
            $trace = debug_backtrace();
            $str = Util::getItem($trace[1], 'class');
            $str.= Util::getItem($trace[1], 'type');
            $str.= Util::getItem($trace[1], 'function');
            $str .= ' {milestone '.$milestone.'}';
            $str .= ' elapsed: '.DateHelper::microTimeToStr(self::getElapsedTime(), 'mm:ss.z');
            $str .= ' delta: '.DateHelper::microTimeToStr(self::getDeltaTime(), 'mm:ss.z');
            self::append($str);
        }

    }

    /**
     * Log backtrace
     *
     * @param bool $richObjects
     */
    public static function backtrace($richObjects = false){
        $trace = debug_backtrace();
        $str = "[backtrace]:\r\n";
        array_shift($trace);
        foreach($trace as $caller){
            $str.= Util::getItem($caller, 'class');
            $str.= Util::getItem($caller, 'type');
            $str.= Util::getItem($caller, 'function');
            $str.= self::argsToString(Util::getItem($caller, 'args'), $richObjects);
            $str.= "\r\n";
        }
        self::append($str);

    }

    /**
     * Log info
     *
     * @param $str
     */
    public static function info($str){
        if(self::$logLevel & self::NEED_INFO){
            self::append('[info]: '.$str);
        }
    }

    /**
     * Log warning
     *
     * @param $str
     */
    public static function warning($str){
        if(self::$logLevel & self::NEED_WARNING){
            self::append('[warning]: '.$str);
        }
    }

    /**
     * Log error
     *
     * @param $str
     */
    public static function error($str){
        if(self::$logLevel & self::NEED_ERROR){
            self::append('[error]: '.$str);
        }
    }

    /**
     * Log object
     *
     * @param $obj
     * @param string $title
     */
    public static function dir($obj, $title = ""){
        $str = '[dir]: ';
        $trace = debug_backtrace();
        $str.= Util::getItem($trace[1], 'class');
        $str.= Util::getItem($trace[1], 'type');
        $str.= Util::getItem($trace[1], 'function');
        $str.= $title? ' '.$title . ' = ': ' ';
        $str.= print_r($obj, true);
        $str = str_replace("\n", "\r\n", $str);
        self::append($str);
    }

    /**
     * Log exception
     *
     * @param \Exception $e
     */
    public static function exception(\Exception $e){
        self::errorHandler($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        self::info($e->getTraceAsString());
    }

    /**
     * Callback for error handling
     *
     * @param int $errNo
     * @param string $errStr
     * @param string $errFile
     * @param int $errLine
     *
     * @return bool
     */
    public static function errorHandler($errNo, $errStr, $errFile, $errLine){
        $str = "($errFile:$errLine)$errStr";
        switch ($errNo) {

            case E_ERROR:
            case E_CORE_ERROR  :
            case E_USER_ERROR:
            case E_COMPILE_ERROR:
            case E_RECOVERABLE_ERROR:
            case E_PARSE:
                self::error($str);
                break;

            case E_WARNING:
            case E_CORE_WARNING:
            case E_COMPILE_WARNING:
            case E_USER_WARNING:
                self::warning($str);
                break;

            case E_NOTICE:
            case E_USER_NOTICE:
            case E_STRICT:
            default:
                self::info($str);
                break;
        }
        return false;
    }

    /**
     * Enable error handling
     */
    public static function handleErrors(){
        set_error_handler(array("\\Chayka\\Helpers\\LogHelper", "errorHandler"));
    }

    /**
     * Flush logs older than $logsLifeSpan days
     *
     * @param int $logsLifeSpan
     */
    public static function flushLogsFolder($logsLifeSpan){
        if(self::$logDir){
            $files = FsHelper::readDir(self::getDir(), true);
            $border = new \DateTime();
            $threshold = new \DateInterval('P' . (int)$logsLifeSpan . 'D');
            $borderStr = $border->sub($threshold)->format('Y-m-d');

            foreach($files as $file){
                $m = array();
                if(preg_match('/.*(\d{4}-\d{2}-\d{2})\.log$/', $file, $m) && $m[1] < $borderStr){
                    FsHelper::delete($file);
                }
            }
        }
    }

}