Chayka\Helpers\CurlHelper
===============

Class CurlHelper contains a set of handy methods to perform HTTP requests.

Utilizes cURL library.


* Class name: CurlHelper
* Namespace: Chayka\Helpers







Methods
-------


### prepareRequest

    resource Chayka\Helpers\CurlHelper::prepareRequest(string $url, mixed $params, integer $timeout)

Prepares curl handle on given url



* Visibility: **public**
* This method is **static**.


#### Arguments
* $url **string** - &lt;p&gt;given URL&lt;/p&gt;
* $params **mixed** - &lt;p&gt;data to send&lt;/p&gt;
* $timeout **integer** - &lt;p&gt;in seconds&lt;/p&gt;



### performRequest

    \Chayka\Helpers\string/array Chayka\Helpers\CurlHelper::performRequest($ch)

Perform request using prepared handle.

If request returns json function returns decoded response (assoc array)

* Visibility: **public**
* This method is **static**.


#### Arguments
* $ch **mixed**



### post

    string Chayka\Helpers\CurlHelper::post(string $url, array $params, integer $timeout)

Sends post request on given url and returns response



* Visibility: **public**
* This method is **static**.


#### Arguments
* $url **string** - &lt;p&gt;given URL&lt;/p&gt;
* $params **array** - &lt;p&gt;to send&lt;/p&gt;
* $timeout **integer** - &lt;p&gt;in seconds&lt;/p&gt;



### get

    string Chayka\Helpers\CurlHelper::get(string $url, array $params, integer $timeout)

Sends get request on given url and returns response



* Visibility: **public**
* This method is **static**.


#### Arguments
* $url **string** - &lt;p&gt;given URL&lt;/p&gt;
* $params **array** - &lt;p&gt;to send&lt;/p&gt;
* $timeout **integer** - &lt;p&gt;in seconds&lt;/p&gt;



### download

    integer Chayka\Helpers\CurlHelper::download(string $filename, string $url, array $params, integer $timeout)

Download file from $url and store it to $filename.

If params are used they are POSTed.
Returns size of downloaded file.

* Visibility: **public**
* This method is **static**.


#### Arguments
* $filename **string**
* $url **string**
* $params **array**
* $timeout **integer**



### ping

    boolean Chayka\Helpers\CurlHelper::ping(string $url, integer $retry, integer $timeout)

Ping $url several times with specified timeout till $url responses.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $url **string**
* $retry **integer**
* $timeout **integer**



### extractHttpHeader

    array Chayka\Helpers\CurlHelper::extractHttpHeader(string $str)

Given a http response with http header
this function returns assoc array containing http headers.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $str **string**


