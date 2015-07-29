Chayka\Helpers\DateHelper
===============

Class DateHelper contains a set of handy methods for date formatting.




* Class name: DateHelper
* Namespace: Chayka\Helpers



Constants
----------


### DB_DATETIME

    const DB_DATETIME = 'Y-m-d H:i:s'





### DB_DATE

    const DB_DATE = 'Y-m-d'





### DB_TIME

    const DB_TIME = 'H:i:s'





### JSON_DATETIME

    const JSON_DATETIME = 'Y-m-d\TH:i:s.000\Z'





### JSON_DATE

    const JSON_DATE = 'Y-m-d'





### JSON_TIME

    const JSON_TIME = 'H:i:s'





Properties
----------


### $frontEndTimezone

    protected null $frontEndTimezone = null

Timezone acquired form browser and used to adjust time stored in UTC
when outputting to the timezone different from server timezone.



* Visibility: **protected**
* This property is **static**.


Methods
-------


### dateToDbStr

    string Chayka\Helpers\DateHelper::dateToDbStr(\DateTime $dt)

Convert DateTime to db date string.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $dt **DateTime**



### timeToDbStr

    string Chayka\Helpers\DateHelper::timeToDbStr(\DateTime $dt)

Convert DateTime to db time string.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $dt **DateTime**



### datetimeToDbStr

    string Chayka\Helpers\DateHelper::datetimeToDbStr(\DateTime $dt)

Convert DateTime to db datetime string.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $dt **DateTime**



### dbStrToDate

    \DateTime Chayka\Helpers\DateHelper::dbStrToDate(string $strDate)

Convert db date string to DateTime.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $strDate **string**



### dbStrToTime

    \DateTime Chayka\Helpers\DateHelper::dbStrToTime(string $strTime)

Convert db time string to DateTime.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $strTime **string**



### dbStrToDatetime

    \DateTime Chayka\Helpers\DateHelper::dbStrToDatetime(string $strDatetime)

Convert db datetime string to DateTime.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $strDatetime **string**



### dateToJsonStr

    string Chayka\Helpers\DateHelper::dateToJsonStr(\DateTime $dt)

Convert DateTime to json date string.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $dt **DateTime**



### timeToJsonStr

    string Chayka\Helpers\DateHelper::timeToJsonStr(\DateTime $dt)

Convert DateTime to json time string.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $dt **DateTime**



### datetimeToJsonStr

    string Chayka\Helpers\DateHelper::datetimeToJsonStr(\DateTime $dt)

Convert DateTime to json datetime string.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $dt **DateTime**



### jsonStrToDate

    \DateTime Chayka\Helpers\DateHelper::jsonStrToDate(string $strDate)

Convert json date string to DateTime.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $strDate **string**



### jsonStrToTime

    \DateTime Chayka\Helpers\DateHelper::jsonStrToTime(string $strTime)

Convert json time string to DateTime.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $strTime **string**



### jsonStrToDatetime

    \DateTime Chayka\Helpers\DateHelper::jsonStrToDatetime(string $strDatetime)

Convert json datetime string to DateTime.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $strDatetime **string**



### jsonDateToDbStr

    string Chayka\Helpers\DateHelper::jsonDateToDbStr(string $strDate)

Convert json date string to db string.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $strDate **string**



### jsonTimeToDbStr

    string Chayka\Helpers\DateHelper::jsonTimeToDbStr(string $strTime)

Convert json time string to db string.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $strTime **string**



### jsonDatetimeToDbStr

    string Chayka\Helpers\DateHelper::jsonDatetimeToDbStr(string $strDatetime)

Convert json datetime string to db string.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $strDatetime **string**



### dbDateToJsonStr

    string Chayka\Helpers\DateHelper::dbDateToJsonStr(string $strDate)

Convert db date string to json string.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $strDate **string**



### dbTimeToJsonStr

    string Chayka\Helpers\DateHelper::dbTimeToJsonStr(string $strTime)

Convert db time string to json string.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $strTime **string**



### dbDatetimeToJsonStr

    string Chayka\Helpers\DateHelper::dbDatetimeToJsonStr(string $strDatetime)

Convert db datetime string to json string.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $strDatetime **string**



### fixTimezone

    \DateTime Chayka\Helpers\DateHelper::fixTimezone(\DateTime $date)

Fix DateTime timezone using the one stored at $_SESSION['timezone'].

You can get timezone only from JS on client-side,
and you need to store it in $_SESSION yourself.

* Visibility: **public**
* This method is **static**.


#### Arguments
* $date **DateTime**


