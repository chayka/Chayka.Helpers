Chayka\Helpers\JsonReady
===============

Interface JsonReady allows to customize json output when object is included into a payload
when JsonHelper is used to perform API res




* Interface name: JsonReady
* Namespace: Chayka\Helpers
* This is an **interface**






Methods
-------


### packJsonItem

    \Chayka\Helpers\array($key=>$value); Chayka\Helpers\JsonReady::packJsonItem()

Returns assoc array to be packed into json payload



* Visibility: **public**




### unpackJsonItem

    \Chayka\Helpers\JsonReady Chayka\Helpers\JsonReady::unpackJsonItem($data)

Assigns inner values from the ones provided in $data



* Visibility: **public**
* This method is **static**.


#### Arguments
* $data **mixed**


