<?php
/**
 * Chayka.Framework is a framework that enables WordPress development in a MVC/OOP way.
 *
 * More info: https://github.com/chayka/Chayka.Framework
 */

namespace Chayka\Helpers;

/**
 * Class FsHelper contains a set of handy methods for file system operations.
 *
 * @package Chayka\Helpers
 */
class FsHelper {

    /**
     * Alias of file_get_contents()
     *
     * @param string $filename
     * @return string
     */
    public static function readFile($filename) {
        return file_exists($filename) && is_readable($filename) ?
                file_get_contents($filename) : '';
    }

    /**
     * Alias of file_put_contents()
     *
     * @param $filename
     * @param $data
     * @param int $flags
     * @param null $context
     * @return int
     */
    public static function saveFile($filename, $data, $flags=0, $context=null) {
        return file_exists($filename) && !is_writable($filename) ? 0 :
                file_put_contents($filename, $data, $flags, $context);
    }

    /**
     * Append data to a file
     *
     * @param $filename
     * @param $data
     * @return int
     */
    public static function append($filename, $data) {
        if (file_exists($filename) && !is_writable($filename)){
            return 0;
        }
        
        $fp = fopen($filename, 'ab');
        $n = fwrite($fp, $data);
        fclose($fp);

        return $n;
    }

    /**
     * Checks if two files have identical content
     * @param string $filename1
     * @param string $filename2
     * @return bool
     */
    public static function areIdentical($filename1, $filename2) {
        return filesize($filename1) == filesize($filename2) && !strcmp(self::readFile($filename1), self::readFile($filename2));
    }

    /**
     * Get file extension (E.g. 'txt')
     * @param $filename
     * @return string
     */
    public static function getExtension($filename) {
        return preg_match('%\.([\w\d]+)$%', $filename, $m)?$m[1]:pathinfo($filename, PATHINFO_EXTENSION);
    }

    /**
     * Replace current filename extension or append if none exists.
     * Returns resulting filename.
     *
     * @param string $filename
     * @param string $ext
     * @return mixed|string
     */
    public static function setExtension($filename, $ext) {
        if (strlen($ext) && $ext[0] != '.') {
            $ext = '.' . $ext;
        }

        return self::getExtension($filename)?preg_replace('%\.[\w\d]+$%', $ext, $filename):$filename.$ext;
    }

    /**
     * Get filename without extension
     * e.g. 'readme.txt' -> 'readme'
     *
     * @param $filename
     * @return string
     */
    public static function hideExtension($filename) {
        return preg_replace('%\.([\w\d]+)$%', '', $filename);
    }

    /**
     * Prepend extension prefix.
     * Returns resulting filename.
     *
     * @param string $filename
     * @param string $prefix
     * @return string
     */
    public static function setExtensionPrefix($filename, $prefix){
        $ext = self::getExtension($filename);
        return self::setExtension($filename, $prefix.'.'.$ext);
    }

    /**
     * Read dir contents
     *
     * @param string $dir
     * @param bool|false $absPaths
     *
     * @return array
     */
    public static function readDir($dir, $absPaths = false){
        $entries = array();
        if (is_dir($dir)) {
            $dir = preg_replace("%/$%", '', $dir);
            $d = dir($dir);
            while ($file = $d->read()) {
                if ($file == "." || $file == "..") {
                    continue;
                }
                $entries[]=$absPaths?$dir.'/'.$file:$file;
            }
            $d->close();
        }

        return $entries;
    }

    /**
     * Copy $src (file or dir) to $dst
     *
     * @param string $src
     * @param string $dst
     * @param int $dstAttribs
     * @return bool
     */
    public static function copy($src, $dst, $dstAttribs=0755) {
        if (is_file($src)) {
            return copy($src, $dst);
        } elseif (is_dir($src)) {
            if (!is_dir($dst) && !mkdir($dst, $dstAttribs)){
                return 0;
            }
            $src = preg_replace("%/$%", '', $src);
            $dst = preg_replace("%/$%", '', $dst);
            $d = dir($src);
            while ($file = $d->read()) {
                if ($file == "." || $file == "..") {
                    continue;
                }
                if (!self::copy("$src/$file", "$dst/$file", $dstAttribs)) {
                    $d->close();
                    return 0;
                };
            }
            $d->close();
        } else {
            return 0;
        }
        return 1;
    }

    /**
     * Delete $path.
     *
     * @param $path
     * @return bool
     */
    public static function delete($path) {
        if (is_dir($path)) {
            $path = preg_replace("%/$%", '', $path);
            $d = dir($path);
            while ($file = $d->read()) {
                if ($file == "." || $file == "..") {
                    continue;
                }
                self::delete("$path/$file");
            }
            $d->close();
            return rmdir($path);
        } else {
            return unlink($path);
        }
    }

    /**
     * Check if dir is empty
     * @param $path
     * @return int
     */
    public static function isDirEmpty($path)/* fvo */ {
        if (!is_dir($path)) {
            return 0;
        }
        $d = dir($path); //$img_set_folder
        $emptyDir = 1;
        while ($file = $d->read()) {
            if ($file != "." && $file != "..") {
                $emptyDir = 0;
                break;
            }
        }
        $d->close();
        return $emptyDir;
    }

}
