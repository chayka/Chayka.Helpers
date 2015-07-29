Chayka\Helpers\InputValidation
===============

Class InputValidation is responsible for param validation.

Can be used in a chained manner:
$param1 = InputHelper::checkParam('param1')->required('This param is required')->email('Invalid email')->getValue();
InputHelper::validateInput();


* Class name: InputValidation
* Namespace: Chayka\Helpers





Properties
----------


### $param

    protected string $param

Param name



* Visibility: **protected**


### $needValidate

    protected boolean $needValidate = true

Set this flag to false if this field should not be validated



* Visibility: **protected**


### $checks

    protected array $checks = array()

Array of checks



* Visibility: **protected**


Methods
-------


### __construct

    mixed Chayka\Helpers\InputValidation::__construct(string $param, boolean|true $needValidate)

Constructor



* Visibility: **public**


#### Arguments
* $param **string**
* $needValidate **boolean|true**



### add

    \Chayka\Helpers\InputValidation Chayka\Helpers\InputValidation::add(string $check, string $message, array $params)

Setup param check



* Visibility: **protected**


#### Arguments
* $check **string**
* $message **string**
* $params **array**



### getCheckParam

    mixed Chayka\Helpers\InputValidation::getCheckParam($check, $param, string $default)

Get stored check param



* Visibility: **protected**


#### Arguments
* $check **mixed**
* $param **mixed**
* $default **string**



### required

    \Chayka\Helpers\InputValidation Chayka\Helpers\InputValidation::required($message)

Setup required param validation



* Visibility: **public**


#### Arguments
* $message **mixed**



### invalidRequired

    string|false Chayka\Helpers\InputValidation::invalidRequired($val, string $message)

Check required value



* Visibility: **public**
* This method is **static**.


#### Arguments
* $val **mixed**
* $message **string**



### length

    \Chayka\Helpers\InputValidation Chayka\Helpers\InputValidation::length(integer $min, integer $max, $message)

Setup input param length validation



* Visibility: **public**


#### Arguments
* $min **integer**
* $max **integer**
* $message **mixed**



### invalidLength

    boolean|string Chayka\Helpers\InputValidation::invalidLength(string $val, integer $min, integer $max, string $message)

Check value length



* Visibility: **public**
* This method is **static**.


#### Arguments
* $val **string**
* $min **integer**
* $max **integer**
* $message **string**



### format

    \Chayka\Helpers\InputValidation Chayka\Helpers\InputValidation::format($format, $message)

Setup input param format validation



* Visibility: **public**


#### Arguments
* $format **mixed**
* $message **mixed**



### invalidFormat

    boolean|string Chayka\Helpers\InputValidation::invalidFormat(string $val, string $format, string $message)

Check value format



* Visibility: **public**
* This method is **static**.


#### Arguments
* $val **string**
* $format **string**
* $message **string**



### email

    \Chayka\Helpers\InputValidation Chayka\Helpers\InputValidation::email($message)

Setup input param email format validation



* Visibility: **public**


#### Arguments
* $message **mixed**



### invalidEmail

    boolean|string Chayka\Helpers\InputValidation::invalidEmail(string $val, string $message)

Check value email format



* Visibility: **public**


#### Arguments
* $val **string**
* $message **string**



### url

    \Chayka\Helpers\InputValidation Chayka\Helpers\InputValidation::url($message)

Setup input param url format validation



* Visibility: **public**


#### Arguments
* $message **mixed**



### invalidUrl

    boolean|string Chayka\Helpers\InputValidation::invalidUrl($val, string $message)

Check if value URL format



* Visibility: **public**


#### Arguments
* $val **mixed**
* $message **string**



### int

    \Chayka\Helpers\InputValidation Chayka\Helpers\InputValidation::int($message)

Setup input param int format validation



* Visibility: **public**


#### Arguments
* $message **mixed**



### invalidInt

    boolean|string Chayka\Helpers\InputValidation::invalidInt($val, string $message)

Check if value is integer



* Visibility: **public**


#### Arguments
* $val **mixed**
* $message **string**



### float

    \Chayka\Helpers\InputValidation Chayka\Helpers\InputValidation::float($message)

Setup input param number format validation



* Visibility: **public**


#### Arguments
* $message **mixed**



### invalidFloat

    boolean|string Chayka\Helpers\InputValidation::invalidFloat($val, string $message)

Check if value is integer



* Visibility: **public**


#### Arguments
* $val **mixed**
* $message **string**



### gt

    \Chayka\Helpers\InputValidation Chayka\Helpers\InputValidation::gt($min, $message)

Setup param gt check



* Visibility: **public**


#### Arguments
* $min **mixed**
* $message **mixed**



### invalidGt

    boolean|string Chayka\Helpers\InputValidation::invalidGt($val, $min, string $message)

Validate gt check



* Visibility: **public**
* This method is **static**.


#### Arguments
* $val **mixed**
* $min **mixed**
* $message **string**



### ge

    \Chayka\Helpers\InputValidation Chayka\Helpers\InputValidation::ge($min, $message)

Setup param ge check



* Visibility: **public**


#### Arguments
* $min **mixed**
* $message **mixed**



### invalidGe

    boolean|string Chayka\Helpers\InputValidation::invalidGe($val, $min, string $message)

Validate ge check



* Visibility: **public**
* This method is **static**.


#### Arguments
* $val **mixed**
* $min **mixed**
* $message **string**



### lt

    \Chayka\Helpers\InputValidation Chayka\Helpers\InputValidation::lt($max, $message)

Setup param lt check



* Visibility: **public**


#### Arguments
* $max **mixed**
* $message **mixed**



### invalidLt

    boolean|string Chayka\Helpers\InputValidation::invalidLt($val, $max, string $message)

Validate lt check



* Visibility: **public**
* This method is **static**.


#### Arguments
* $val **mixed**
* $max **mixed**
* $message **string**



### le

    \Chayka\Helpers\InputValidation Chayka\Helpers\InputValidation::le($max, $message)

Setup param le check



* Visibility: **public**


#### Arguments
* $max **mixed**
* $message **mixed**



### invalidLe

    boolean|string Chayka\Helpers\InputValidation::invalidLe($val, $max, string $message)

Validate le check



* Visibility: **public**
* This method is **static**.


#### Arguments
* $val **mixed**
* $max **mixed**
* $message **string**



### invalid

    string|false Chayka\Helpers\InputValidation::invalid($value)

Validate $value across registered checks



* Visibility: **public**


#### Arguments
* $value **mixed**



### getValue

    mixed|string Chayka\Helpers\InputValidation::getValue(string $default)

Get param value.

Use it like that:

$someVar = InputHelper::checkParam('some_var')->required('Please set some var')->getValue();

* Visibility: **public**


#### Arguments
* $default **string**


