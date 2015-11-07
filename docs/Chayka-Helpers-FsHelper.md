Chayka\Helpers\FsHelper
===============

Class FsHelper contains a set of handy methods for file system operations.




* Class name: FsHelper
* Namespace: Chayka\Helpers







Methods
-------


### readFile

    string Chayka\Helpers\FsHelper::readFile(string $filename)

Alias of file_get_contents()



* Visibility: **public**
* This method is **static**.


#### Arguments
* $filename **string**



### saveFile

    integer Chayka\Helpers\FsHelper::saveFile($filename, $data, integer $flags, null $context)

Alias of file_put_contents()



* Visibility: **public**
* This method is **static**.


#### Arguments
* $filename **mixed**
* $data **mixed**
* $flags **integer**
* $context **null**



### append

    integer Chayka\Helpers\FsHelper::append($filename, $data)

Append data to a file



* Visibility: **public**
* This method is **static**.


#### Arguments
* $filename **mixed**
* $data **mixed**



### areIdentical

    boolean Chayka\Helpers\FsHelper::areIdentical(string $filename1, string $filename2)

Checks if two files have identical content



* Visibility: **public**
* This method is **static**.


#### Arguments
* $filename1 **string**
* $filename2 **string**



### getExtension

    string Chayka\Helpers\FsHelper::getExtension($filename)

Get file extension (E.g. 'txt')



* Visibility: **public**
* This method is **static**.


#### Arguments
* $filename **mixed**



### setExtension

    mixed|string Chayka\Helpers\FsHelper::setExtension(string $filename, string $ext)

Replace current filename extension or append if none exists.

Returns resulting filename.

* Visibility: **public**
* This method is **static**.


#### Arguments
* $filename **string**
* $ext **string**



### setExtensionPrefix

    string Chayka\Helpers\FsHelper::setExtensionPrefix(string $filename, string $prefix)

Prepend extension prefix.

Returns resulting filename.

* Visibility: **public**
* This method is **static**.


#### Arguments
* $filename **string**
* $prefix **string**



### readDir

    array Chayka\Helpers\FsHelper::readDir(string $dir, boolean|false $absPaths)

Read dir contents



* Visibility: **public**
* This method is **static**.


#### Arguments
* $dir **string**
* $absPaths **boolean|false**



### copy

    boolean Chayka\Helpers\FsHelper::copy(string $src, string $dst, integer $dstAttribs)

Copy $src (file or dir) to $dst



* Visibility: **public**
* This method is **static**.


#### Arguments
* $src **string**
* $dst **string**
* $dstAttribs **integer**



### delete

    integer Chayka\Helpers\FsHelper::delete($path)

Delete $path.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $path **mixed**



### isDirEmpty

    integer Chayka\Helpers\FsHelper::isDirEmpty($path)

Check if dir is empty



* Visibility: **public**
* This method is **static**.


#### Arguments
* $path **mixed**


