Chayka\Helpers\NlsHelper
===============

Class NlsHelper provides mechanism for National Language Support.




* Class name: NlsHelper
* Namespace: Chayka\Helpers





Properties
----------


### $dictionary

    protected array $dictionary = array()

Hash map for translations



* Visibility: **protected**
* This property is **static**.


### $locale

    protected string $locale

Locale identifier string



* Visibility: **protected**
* This property is **static**.


### $lang

    protected string $lang

Language code



* Visibility: **protected**
* This property is **static**.


### $baseDir

    protected string $baseDir

Project base directory



* Visibility: **protected**
* This property is **static**.


### $nlsDir

    protected string $nlsDir = 'app/nls/'

Project subdirectory containing dictionaries



* Visibility: **protected**
* This property is **static**.


Methods
-------


### setLocale

    mixed Chayka\Helpers\NlsHelper::setLocale($locale)

Set current locale.

Locale::setDefault() is used.

* Visibility: **public**
* This method is **static**.


#### Arguments
* $locale **mixed**



### getLocale

    string Chayka\Helpers\NlsHelper::getLocale()

Function returns current locale



* Visibility: **public**
* This method is **static**.




### setLang

    mixed Chayka\Helpers\NlsHelper::setLang(string $lang)

Set current language



* Visibility: **public**
* This method is **static**.


#### Arguments
* $lang **string**



### getLang

    string Chayka\Helpers\NlsHelper::getLang()

Get current language



* Visibility: **public**
* This method is **static**.




### setBaseDir

    mixed Chayka\Helpers\NlsHelper::setBaseDir(string $dir)

Set base project dir



* Visibility: **public**
* This method is **static**.


#### Arguments
* $dir **string**



### getBaseDir

    string Chayka\Helpers\NlsHelper::getBaseDir()

Get base project dir



* Visibility: **public**
* This method is **static**.




### setNlsDir

    mixed Chayka\Helpers\NlsHelper::setNlsDir(string $dir)

Set nls dir (relative to base dir)



* Visibility: **public**
* This method is **static**.


#### Arguments
* $dir **string**



### getNlsDir

    string Chayka\Helpers\NlsHelper::getNlsDir()

Get base dir (relative to base dir)



* Visibility: **public**
* This method is **static**.




### load

    mixed Chayka\Helpers\NlsHelper::load($module)

Load translation (e.g. 'auth').

Translations can be stored in two alternative paradigms:
1. Split by lang-dirs
nls/
  _/
    auth.php
  en/
    auth.php
2. Split by extension prefix
nls/
  auth.php
  auth._.php
  auth.en.php

'_' - stands for default

* Visibility: **public**
* This method is **static**.


#### Arguments
* $module **mixed**



### translate

    string Chayka\Helpers\NlsHelper::translate(string $string, string $module)

Search for the translation in all the dictionaries.

Begins with module dictionary if the one specified.

* Visibility: **public**
* This method is **static**.


#### Arguments
* $string **string**
* $module **string**



### _

    string Chayka\Helpers\NlsHelper::_(string $value)

Get localized value, or value itself if localization is not found
This function can get multiple args and work like sprintf($template, $arg1, .

.. $argN)
Hint: Use $format = 'На %2$s сидят %1$d обезьян';

* Visibility: **public**
* This method is **static**.


#### Arguments
* $value **string** - &lt;p&gt;String to translate&lt;/p&gt;



### __

    string Chayka\Helpers\NlsHelper::__(string $value)

Echo localized value, or value itself if localization is not found
This function can get multiple args and work like sprintf($template, $arg1, .

.. $argN)
Hint: Use $format = 'На %2$s сидят %1$d обезьян';

* Visibility: **public**
* This method is **static**.


#### Arguments
* $value **string** - &lt;p&gt;String to translate&lt;/p&gt;


