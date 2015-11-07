Chayka\Helpers\LogHelper
===============

Class LogHelper contains a set of handy methods for logging




* Class name: LogHelper
* Namespace: Chayka\Helpers



Constants
----------


### NEED_FUNC

    const NEED_FUNC = 1





### NEED_ERROR

    const NEED_ERROR = 2





### NEED_WARNING

    const NEED_WARNING = 4





### NEED_INFO

    const NEED_INFO = 8





### INDENT_LENGTH

    const INDENT_LENGTH = 4





Properties
----------


### $log

    protected string $log = null

Log content



* Visibility: **protected**
* This property is **static**.


### $indent

    protected integer $indent

Current indent



* Visibility: **protected**
* This property is **static**.


### $logFn

    protected string $logFn

Log filename



* Visibility: **protected**
* This property is **static**.


### $logDir

    protected string $logDir

Log dir



* Visibility: **protected**
* This property is **static**.


### $logLevel

    protected integer $logLevel = 255

Log level (flags)



* Visibility: **protected**
* This property is **static**.


### $signature

    protected string $signature

Called script signature



* Visibility: **protected**
* This property is **static**.


### $startTime

    protected float $startTime

Script start time;



* Visibility: **protected**
* This property is **static**.


### $lastTimeCheck

    protected float $lastTimeCheck

Last time check datetime



* Visibility: **protected**
* This property is **static**.


Methods
-------


### init

    mixed Chayka\Helpers\LogHelper::init(null|string $logDir, integer $logLevel)

Init log



* Visibility: **public**
* This method is **static**.


#### Arguments
* $logDir **null|string**
* $logLevel **integer**



### getStartTime

    float Chayka\Helpers\LogHelper::getStartTime()

Get start time



* Visibility: **public**
* This method is **static**.




### getLastTimeCheck

    \DateTime Chayka\Helpers\LogHelper::getLastTimeCheck()

Get datetime of previous time check



* Visibility: **public**
* This method is **static**.




### getElapsedTime

    float Chayka\Helpers\LogHelper::getElapsedTime()

Get amount of time passed since script start



* Visibility: **public**
* This method is **static**.




### getDeltaTime

    float Chayka\Helpers\LogHelper::getDeltaTime()

Get amount of time passed since last time check



* Visibility: **public**
* This method is **static**.




### fancyHeader

    string Chayka\Helpers\LogHelper::fancyHeader(string $str, integer $width)

Get fancy header strings, like this:
   ___________________
__/ session at 345345 \_________________________________________________________



* Visibility: **public**
* This method is **static**.


#### Arguments
* $str **string**
* $width **integer**



### fancyFooter

    string Chayka\Helpers\LogHelper::fancyFooter(string $str, integer $width)

Get fancy footer strings, like this:
_________________________________________________________                     __
                                                         \ session at 345345 /
                                                          -------------------



* Visibility: **public**
* This method is **static**.


#### Arguments
* $str **string**
* $width **integer**



### getSignature

    string Chayka\Helpers\LogHelper::getSignature()

Get script signature



* Visibility: **public**
* This method is **static**.




### setDir

    mixed Chayka\Helpers\LogHelper::setDir($dir)

Set log directory



* Visibility: **public**
* This method is **static**.


#### Arguments
* $dir **mixed**



### getDir

    string Chayka\Helpers\LogHelper::getDir()

Get log directory



* Visibility: **public**
* This method is **static**.




### setFn

    mixed Chayka\Helpers\LogHelper::setFn($fn)

Sets log filename



* Visibility: **public**
* This method is **static**.


#### Arguments
* $fn **mixed**



### getFn

    string Chayka\Helpers\LogHelper::getFn()

Get log filename



* Visibility: **public**
* This method is **static**.




### shutDownHandler

    mixed Chayka\Helpers\LogHelper::shutDownHandler()

Callback that is triggered on shutdown to close log output



* Visibility: **public**
* This method is **static**.




### argsToString

    string Chayka\Helpers\LogHelper::argsToString($args, boolean $richObjects)

Output function arguments



* Visibility: **public**
* This method is **static**.


#### Arguments
* $args **mixed**
* $richObjects **boolean**



### setLogLevel

    mixed Chayka\Helpers\LogHelper::setLogLevel(integer $level)

Set log level



* Visibility: **public**
* This method is **static**.


#### Arguments
* $level **integer**



### append

    mixed Chayka\Helpers\LogHelper::append($str)

Output string to log



* Visibility: **protected**
* This method is **static**.


#### Arguments
* $str **mixed**



### flush

    mixed Chayka\Helpers\LogHelper::flush()

Flush cached log to file



* Visibility: **public**
* This method is **static**.




### funcStart

    mixed Chayka\Helpers\LogHelper::funcStart(boolean $richObjects)

Log function start



* Visibility: **public**
* This method is **static**.


#### Arguments
* $richObjects **boolean**



### funcStop

    mixed Chayka\Helpers\LogHelper::funcStop()

Log function stop



* Visibility: **public**
* This method is **static**.




### func

    mixed Chayka\Helpers\LogHelper::func(boolean $richObjects)

Log function call



* Visibility: **public**
* This method is **static**.


#### Arguments
* $richObjects **boolean**



### milestone

    mixed Chayka\Helpers\LogHelper::milestone(integer $milestone)

Log milestone



* Visibility: **public**
* This method is **static**.


#### Arguments
* $milestone **integer**



### backtrace

    mixed Chayka\Helpers\LogHelper::backtrace(boolean $richObjects)

Log backtrace



* Visibility: **public**
* This method is **static**.


#### Arguments
* $richObjects **boolean**



### info

    mixed Chayka\Helpers\LogHelper::info($str)

Log info



* Visibility: **public**
* This method is **static**.


#### Arguments
* $str **mixed**



### warning

    mixed Chayka\Helpers\LogHelper::warning($str)

Log warning



* Visibility: **public**
* This method is **static**.


#### Arguments
* $str **mixed**



### error

    mixed Chayka\Helpers\LogHelper::error($str)

Log error



* Visibility: **public**
* This method is **static**.


#### Arguments
* $str **mixed**



### dir

    mixed Chayka\Helpers\LogHelper::dir($obj, string $title)

Log object



* Visibility: **public**
* This method is **static**.


#### Arguments
* $obj **mixed**
* $title **string**



### exception

    mixed Chayka\Helpers\LogHelper::exception(\Exception $e)

Log exception



* Visibility: **public**
* This method is **static**.


#### Arguments
* $e **Exception**



### errorHandler

    boolean Chayka\Helpers\LogHelper::errorHandler(integer $errNo, string $errStr, string $errFile, integer $errLine)

Callback for error handling



* Visibility: **public**
* This method is **static**.


#### Arguments
* $errNo **integer**
* $errStr **string**
* $errFile **string**
* $errLine **integer**



### handleErrors

    mixed Chayka\Helpers\LogHelper::handleErrors()

Enable error handling



* Visibility: **public**
* This method is **static**.




### flushLogsFolder

    mixed Chayka\Helpers\LogHelper::flushLogsFolder(integer $logsLifeSpan)

Flush logs older than $logsLifeSpan days



* Visibility: **public**
* This method is **static**.


#### Arguments
* $logsLifeSpan **integer**


