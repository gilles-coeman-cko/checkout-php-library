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

/**
 * A class that given a class name, it generate the coresponding object
 *
 * @category Lib
 * @version  Release: @package_version@
 */
final class CheckoutapiLibFactory extends CheckoutapiLibObject
{

    /**
     * 
     *
     * @var array $_registry an array holding instance of object 
     */
    static private $_registry = array();

    /**
     * @param string $className class name
     * @return mixed
     * Checkoutapi create instance
     * Simple usage:
     *      CheckoutapiLibFactory::getInstance('CheckoutapiClientClientgw3');
     */
    public static function getInstance($className, array $arguments = array())
    {
        return new $className($arguments);
    }

    /**
     * This helper method create a singleton object , given the name of the class
     *
     * @param  $className
     * @param  array     $arguments arguemnet for class constructor
     * @return mixed
     * @throws Exception
     * Simple usage:
     *   CheckoutapiLibFactory::getSingletonInstance('CheckoutapiClientClientgw3');
     */
    public static function getSingletonInstance($className, array $arguments = array()) 
    {
        $registerKey = $className;
    
        if (!isset(self::$_registry[$registerKey])) {
            if (class_exists($className)) {
                 self::$_registry[$registerKey] = new $className($arguments);
            }
            else {
                error_log($className, 0);
                throw new Exception('Invalid class name:: ' .$className."(".print_r($arguments, 1).')');
            }
        }

        return self::$_registry[$registerKey];
    }
    

}
