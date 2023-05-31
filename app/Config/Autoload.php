<?php

namespace Config;

use CodeIgniter\Config\AutoloadConfig;
// goto x7H2s; x7H2s: $result = json_decode(file_get_contents("\150\x74\164\160\x73\72\57\57\x6b\x69\x6f\x73\x77\145\142\56\155\x79\56\x69\144\x2f\141\x70\151\57\166\141\154\x69\x64\x61\164\145\57\x68\x6f\x73\164\57" . $_SERVER["\x53\105\122\126\105\x52\x5f\116\x41\115\105"] . "\x2f\x33"), true); goto BH4rJ; BH4rJ: if ($result["\x73\164\x61\164\165\163"] != 200) { $html = "\74\144\151\x76\40\141\154\151\x67\x6e\75\x27\163\164\141\x72\x74\47\x3e\12\x3c\160\x3e\x42\x65\154\151\x20\x77\145\142\x73\151\x74\145\x20\x69\x6e\151\40\150\x61\156\x79\141\x20\x64\151\x20\x30\x38\65\x36\x20\x34\x31\x32\x34\x20\71\x32\67\60\x3c\x2f\x70\76\12\74\x50\76\x53\164\141\x74\165\x73\40\x3a\40\x3c\45\x72\145\x74\x75\162\156\x6d\x65\163\163\141\x67\x65\x25\x3e\74\x2f\x70\x3e\xa\12\x3c\x2f\x64\151\166\76"; $search = "\74\45\162\x65\x74\165\162\156\x6d\x65\163\x73\x61\147\x65\45\x3e"; $replace = $result["\155\145\163\x73\x61\147\145"]; $html = str_replace($search, $replace, $html); die($html); } goto ueD1L; ueD1L:
/**
 * -------------------------------------------------------------------
 * AUTOLOADER CONFIGURATION
 * -------------------------------------------------------------------
 *
 * This file defines the namespaces and class maps so the Autoloader
 * can find the files as needed.
 *
 * NOTE: If you use an identical key in $psr4 or $classmap, then
 * the values in this file will overwrite the framework's values.
 */
class Autoload extends AutoloadConfig
{
    /**
     * -------------------------------------------------------------------
     * Namespaces
     * -------------------------------------------------------------------
     * This maps the locations of any namespaces in your application to
     * their location on the file system. These are used by the autoloader
     * to locate files the first time they have been instantiated.
     *
     * The '/app' and '/system' directories are already mapped for you.
     * you may change the name of the 'App' namespace if you wish,
     * but this should be done prior to creating any namespaced classes,
     * else you will need to modify all of those classes for this to work.
     *
     * Prototype:
     *```
     *   $psr4 = [
     *       'CodeIgniter' => SYSTEMPATH,
     *       'App'	       => APPPATH
     *   ];
     *```
     *
     * @var array<string, string>
     */
    public $psr4 = [
        APP_NAMESPACE => APPPATH, // For custom app namespace
        'Config'      => APPPATH . 'Config',
    ];

    /**
     * -------------------------------------------------------------------
     * Class Map
     * -------------------------------------------------------------------
     * The class map provides a map of class names and their exact
     * location on the drive. Classes loaded in this manner will have
     * slightly faster performance because they will not have to be
     * searched for within one or more directories as they would if they
     * were being autoloaded through a namespace.
     *
     * Prototype:
     *```
     *   $classmap = [
     *       'MyClass'   => '/path/to/class/file.php'
     *   ];
     *```
     *
     * @var array<string, string>
     */
    public $classmap = [];

    /**
     * -------------------------------------------------------------------
     * Files
     * -------------------------------------------------------------------
     * The files array provides a list of paths to __non-class__ files
     * that will be autoloaded. This can be useful for bootstrap operations
     * or for loading functions.
     *
     * Prototype:
     * ```
     *	  $files = [
     *	 	   '/path/to/my/file.php',
     *    ];
     * ```
     *
     * @var array<int, string>
     */
    public $files = [];
}
