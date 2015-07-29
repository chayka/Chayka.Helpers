Chayka\Helpers\HtmlHelper
===============

Class HtmlHelper is a static container for HTML &gt; HEAD &gt; META values.

Also contains a set of handy methods for outputting html attrs
to hide|show|disable|enable|check|uncheck elements based on provided condition.


* Class name: HtmlHelper
* Namespace: Chayka\Helpers





Properties
----------


### $meta

    protected array $meta = array()

Container for meta values



* Visibility: **protected**
* This property is **static**.


Methods
-------


### setMeta

    mixed Chayka\Helpers\HtmlHelper::setMeta(string $key, mixed $value)

A setter for meta container



* Visibility: **public**
* This method is **static**.


#### Arguments
* $key **string**
* $value **mixed**



### getMeta

    mixed|string Chayka\Helpers\HtmlHelper::getMeta($key, string $default)

A getter for meta container



* Visibility: **public**
* This method is **static**.


#### Arguments
* $key **mixed**
* $default **string**



### setHeadTitle

    mixed Chayka\Helpers\HtmlHelper::setHeadTitle(string $title)

Store html > head > title value



* Visibility: **public**
* This method is **static**.


#### Arguments
* $title **string**



### getHeadTitle

    string Chayka\Helpers\HtmlHelper::getHeadTitle(string $default)

Retrieve html > head > title value



* Visibility: **public**
* This method is **static**.


#### Arguments
* $default **string**



### setMetaKeywords

    mixed Chayka\Helpers\HtmlHelper::setMetaKeywords(string $value)

Store html > head > meta > keywords value



* Visibility: **public**
* This method is **static**.


#### Arguments
* $value **string**



### getMetaKeywords

    string Chayka\Helpers\HtmlHelper::getMetaKeywords(string $default)

Retrieve html > head > meta > keywords value



* Visibility: **public**
* This method is **static**.


#### Arguments
* $default **string**



### setMetaDescription

    mixed Chayka\Helpers\HtmlHelper::setMetaDescription(string $value)

Store html > head > meta > description value



* Visibility: **public**
* This method is **static**.


#### Arguments
* $value **string**



### getMetaDescription

    string Chayka\Helpers\HtmlHelper::getMetaDescription(string $default)

Store html > head > meta > description value



* Visibility: **public**
* This method is **static**.


#### Arguments
* $default **string**



### hidden

    mixed Chayka\Helpers\HtmlHelper::hidden(boolean $condition)

Output 'style="display: none;"' if $condition truthy



* Visibility: **public**
* This method is **static**.


#### Arguments
* $condition **boolean**



### visible

    mixed Chayka\Helpers\HtmlHelper::visible(boolean $condition)

Output 'style="display: none;"' if $condition truthy



* Visibility: **public**
* This method is **static**.


#### Arguments
* $condition **boolean**



### checked

    mixed Chayka\Helpers\HtmlHelper::checked(boolean $condition)

Output 'checked="checked"' if $condition truthy



* Visibility: **public**
* This method is **static**.


#### Arguments
* $condition **boolean**



### disabled

    mixed Chayka\Helpers\HtmlHelper::disabled(boolean $condition)

Output 'disabled="disabled"' if $condition truthy



* Visibility: **public**
* This method is **static**.


#### Arguments
* $condition **boolean**


