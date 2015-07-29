Chayka\Helpers\InputHelper
===============

Class InputHelper contains a set of methods to filter and validate user input from HTTP request.




* Class name: InputHelper
* Namespace: Chayka\Helpers





Properties
----------


### $input

    protected array $input

Unfiltered input hash map



* Visibility: **protected**
* This property is **static**.


### $htmlAllowed

    protected array $htmlAllowed = array()

Array of param names that are allowed to contain HTML code



* Visibility: **protected**
* This property is **static**.


### $slashesPreserved

    protected array $slashesPreserved = array()

Array of param names that should preserve slashes.

No stripslashes performed on those params.

* Visibility: **protected**
* This property is **static**.


### $validation

    protected array $validation = array()

Hash map of param validation objects.



* Visibility: **protected**
* This property is **static**.


### $errors

    protected array $errors = array()

Hash map of param validation errors.



* Visibility: **protected**
* This property is **static**.


Methods
-------


### setInput

    mixed Chayka\Helpers\InputHelper::setInput($input)

Set input buffer.

If buffer not set $_REQUEST is used by default

* Visibility: **public**
* This method is **static**.


#### Arguments
* $input **mixed**



### permitHtml

    mixed Chayka\Helpers\InputHelper::permitHtml(\Chayka\Helpers\string/array $htmlAllowed)

Define input params that are allowed to contain HTML



* Visibility: **public**
* This method is **static**.


#### Arguments
* $htmlAllowed **Chayka\Helpers\string/array** - &lt;p&gt;&#039;post_content, comment_content&#039; or [&#039;post_content&#039;, &#039;comment_content&#039;]&lt;/p&gt;



### preserveSlashes

    mixed Chayka\Helpers\InputHelper::preserveSlashes($slashesPreserved)

Define input params that should preserve slashes



* Visibility: **public**
* This method is **static**.


#### Arguments
* $slashesPreserved **mixed**



### setParam

    mixed Chayka\Helpers\InputHelper::setParam($param, $value)

Inject input param value to current input buffer



* Visibility: **public**
* This method is **static**.


#### Arguments
* $param **mixed**
* $value **mixed**



### setParams

    mixed Chayka\Helpers\InputHelper::setParams(array $params)

Inject input params to current input buffer



* Visibility: **public**
* This method is **static**.


#### Arguments
* $params **array**



### getParam

    mixed Chayka\Helpers\InputHelper::getParam($param, string $default)

Get filtered param value from current input buffer



* Visibility: **public**
* This method is **static**.


#### Arguments
* $param **mixed**
* $default **string**



### getParams

    array Chayka\Helpers\InputHelper::getParams(boolean $omitStandard)

Get assoc array of filtered values from current input buffer.

If $omitStandard then 'controller', 'action', 'module' will be omitted

* Visibility: **public**
* This method is **static**.


#### Arguments
* $omitStandard **boolean**



### filter

    string|array Chayka\Helpers\InputHelper::filter(string|array|object $value, string $key)

Filter $value (trim, strip_slashes, strip_tags).

If $key is in array of html allowed params, then tags won't be stripped

* Visibility: **public**
* This method is **static**.


#### Arguments
* $value **string|array|object**
* $key **string**



### filterArray

    \Chayka\Helpers\array(string) Chayka\Helpers\InputHelper::filterArray(\Chayka\Helpers\array(string) $values)

Filter $values (trim, strip_slashes, strip_tags).



* Visibility: **public**
* This method is **static**.


#### Arguments
* $values **Chayka\Helpers\array(string)**



### captureInput

    array Chayka\Helpers\InputHelper::captureInput()

Capture request from "php://input" and return as an assoc array



* Visibility: **public**
* This method is **static**.




### checkParam

    \Chayka\Helpers\InputValidation; Chayka\Helpers\InputHelper::checkParam(string $key, boolean $needValidate)

Setup input param validation using InputValidation
If validation should be performed only if some condition met,
setup 2nd param.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $key **string** - &lt;p&gt;param name&lt;/p&gt;
* $needValidate **boolean**



### validateParam

    boolean Chayka\Helpers\InputHelper::validateParam($param)

Check if param is valid.

If param is not valid, validation error will be put in to array

* Visibility: **public**
* This method is **static**.


#### Arguments
* $param **mixed**



### validateInput

    boolean Chayka\Helpers\InputHelper::validateInput(boolean|false $respondErrors)

Perform bulk validation. If $respondErrors then output errors in json



* Visibility: **public**
* This method is **static**.


#### Arguments
* $respondErrors **boolean|false**



### getValidationErrors

    array Chayka\Helpers\InputHelper::getValidationErrors()

Get validation errors organized py param name.

Validation should be performed beforehand.

* Visibility: **public**
* This method is **static**.



