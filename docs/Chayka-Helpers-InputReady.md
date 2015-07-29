Chayka\Helpers\InputReady
===============

Interface InputReady declares methods needed for the object to be validated when captured from HTTP request.




* Interface name: InputReady
* Namespace: Chayka\Helpers
* This is an **interface**






Methods
-------


### validateInput

    boolean Chayka\Helpers\InputReady::validateInput(array $input, array|object $oldState)

Validate input data when object is captured from HTTP request.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $input **array**
* $oldState **array|object**



### getValidationErrors

    array Chayka\Helpers\InputReady::getValidationErrors()

Get hash map with validation errors organized by object property names.



* Visibility: **public**
* This method is **static**.




### addValidationErrors

    mixed Chayka\Helpers\InputReady::addValidationErrors(array $errors)

Add validation errors.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $errors **array** - &lt;p&gt;An array of errors organized by property names.&lt;/p&gt;


