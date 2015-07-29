Chayka\Helpers\HttpHeaderHelper
===============

Class HttpHeaderHelper contains a set of handy methods for outputting HTTP Response Headers (status codes mainly).




* Class name: HttpHeaderHelper
* Namespace: Chayka\Helpers







Methods
-------


### setResponseCode

    mixed Chayka\Helpers\HttpHeaderHelper::setResponseCode(integer $code)

Sets http response code with corresonding message



* Visibility: **public**
* This method is **static**.


#### Arguments
* $code **integer**



### redirect

    mixed Chayka\Helpers\HttpHeaderHelper::redirect(string $url, integer $httpResponseCode)

Sets header Location
Redirects client to $url



* Visibility: **public**
* This method is **static**.


#### Arguments
* $url **string**
* $httpResponseCode **integer**


