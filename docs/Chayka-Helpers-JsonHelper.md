Chayka\Helpers\JsonHelper
===============

Class JsonHelper wraps all the api output into an envelope

{
 payload: mixed,
 message: string,
 code: string|int
}

Payload is scanned recursively for JsonReady interface instances,
so that json representation of the object can be customized


* Class name: JsonHelper
* Namespace: Chayka\Helpers





Properties
----------


### $dieOnRespond

    protected boolean $dieOnRespond = true

If true outputs Json response and dies (default behavior)



* Visibility: **protected**
* This property is **static**.


Methods
-------


### dieOnRespond

    mixed Chayka\Helpers\JsonHelper::dieOnRespond(boolean $die)

Enable or disable 'die on respond' mode.

Mainly needed to disable for testing purposes.

* Visibility: **public**
* This method is **static**.


#### Arguments
* $die **boolean**



### encode

    string Chayka\Helpers\JsonHelper::encode($value, boolean $singleQuotes)

Encode recursively provided $value.

If $value or it's properties are JsonReady, packToJson() will be used.

* Visibility: **public**
* This method is **static**.


#### Arguments
* $value **mixed**
* $singleQuotes **boolean**



### singleQuotes

    string Chayka\Helpers\JsonHelper::singleQuotes(string $encodedJson)

Convert json encoded string to single quotes



* Visibility: **public**
* This method is **static**.


#### Arguments
* $encodedJson **string**



### packObject

    array|string Chayka\Helpers\JsonHelper::packObject(mixed $obj)

Create assoc array from provided object.

If $obj or it's properties are JsonReady, packToJson() will be used.

* Visibility: **public**
* This method is **static**.


#### Arguments
* $obj **mixed**



### packResponse

    string Chayka\Helpers\JsonHelper::packResponse(string $payload, integer $code, string $message)

Wrap json response into {'payload': .

.., 'code': ..., 'message': ...} envelope

* Visibility: **public**
* This method is **static**.


#### Arguments
* $payload **string**
* $code **integer**
* $message **string**



### setResponseCode

    mixed Chayka\Helpers\JsonHelper::setResponseCode($code)

Set http response code



* Visibility: **public**
* This method is **static**.


#### Arguments
* $code **mixed**



### respond

    mixed Chayka\Helpers\JsonHelper::respond(string $payload, integer $code, string $message)

Wrap json response into {'payload': .

.., 'code': ..., 'message': ...} envelope.
And then die() it.

* Visibility: **public**
* This method is **static**.


#### Arguments
* $payload **string**
* $code **integer**
* $message **string**



### respondException

    mixed Chayka\Helpers\JsonHelper::respondException(\Exception $e, string $code)

Wrap Exception into {'payload': .

.., 'code': ..., 'message': ...} envelope.
Set http response code to 500.
And then die() it.

* Visibility: **public**
* This method is **static**.


#### Arguments
* $e **Exception**
* $code **string**



### respondSuccess

    mixed Chayka\Helpers\JsonHelper::respondSuccess(string $message, null $payload, integer $code, integer $httpResponseCode)

Wrap success message into {'payload': .

.., 'code': ..., 'message': ...} envelope.
Set http response code to $httpResponseCode = 200.
And then die() it.

* Visibility: **public**
* This method is **static**.


#### Arguments
* $message **string**
* $payload **null**
* $code **integer**
* $httpResponseCode **integer**



### respondError

    mixed Chayka\Helpers\JsonHelper::respondError(string $message, integer $code, null $payload, integer $httpResponseCode)

Wrap error into {'payload': .

.., 'code': ..., 'message': ...} envelope.
Set http response code to $httpResponseCode = 400.
And then die() it.

* Visibility: **public**
* This method is **static**.


#### Arguments
* $message **string**
* $code **integer**
* $payload **null**
* $httpResponseCode **integer**



### respondErrors

    mixed Chayka\Helpers\JsonHelper::respondErrors($errors, null $payload, integer $httpResponseCode)

Wrap multiple errors into {'payload': .

.., 'code': ..., 'message': ...} envelope.
Set http response code to $httpResponseCode = 400.
And then die() it.

* Visibility: **public**
* This method is **static**.


#### Arguments
* $errors **mixed**
* $payload **null**
* $httpResponseCode **integer**


