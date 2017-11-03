<?php

/**
 * CheckoutapiApi
 *
 * PHP Version 5.6
 *
 * @category Api
 * @package  Checkoutapi
 * @author   Dhiraj Gangoosirdar <dhiraj.gangoosirdar@checkout.com>
 * @author   Gilles Coeman <gilles.coeman@checkout.com>
 * @license  https://checkout.com/terms/ MIT License
 * @link     https://www.checkout.com/
 */

namespace com\checkout\packages;

/**
 * Autoloader
 *
 * @category Utility
 * @version  Release: @package_version@
 */
class Autoloader
{

  private static $_instance;

  public static function instance()
  {
    if (!self::$_instance) {
      $class = __class__;
      self::$_instance = new $class();
    }
    return self::$_instance;
  }

  public function autoload($class)
  {
    $realclassName = ltrim($class, '\\');
    $classNameArray = explode('_', $realclassName);
    $includePath = get_include_path();
    set_include_path($includePath);
    $path = '';
    $baseDir = __DIR__;
    if (!preg_match('/PHPUnit/', $realclassName) && !preg_match('/Composer/', $realclassName)) {
      if (!empty($classNameArray) && sizeof($classNameArray) > 1) {

        $path = $baseDir . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $classNameArray) . '.php';
        $path = str_replace('\PHPPlugin\\', '', $path);
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);

        if ($file = stream_resolve_include_path($path)) {
          if (file_exists($file)) {
            include $file;
          }
        }

      }
    }

  }

  public static function register()
  {
    spl_autoload_extensions('.php');
    spl_autoload_register(array(self::instance(), 'autoload'));
  }

}

$autoload = new Autoloader();
Autoloader::register();
