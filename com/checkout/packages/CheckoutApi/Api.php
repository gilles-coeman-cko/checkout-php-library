<?php

/**
 * CheckoutapiApi
 *
 * PHP Version 5.6
 * 
 * @category Checkoutapi
 * @package  Checkoutapi
 * @author   Dhiraj Gangoosirdar <dhiraj.gangoosirdar@checkout.com>
 * @author   Gilles Coeman <gilles.coeman@checkout.com>
 * @license  https://checkout.com/terms/ MIT License
 * @link     https://www.checkout.com/
 */

/**
 * class final  CheckoutapiApi.
 * This class is responsible in creating instance of payment gateway interface(CheckoutapiClientClient).
 *
 * The simplest usage would be:
 *     $Api = CheckoutapiApi::getApi();
 *
 * This will create an instance a singleton instance of CheckoutapiClientClient
 * The default gateway is CheckoutapiClientClientgw3.
 *
 * If you need create instance of other gateways, you can do do those steps:
 *
 *     $Api = CheckoutapiApi::getApi(array(),'CheckoutapiClientClient[GATEWAYNAME]');
 *
 *  If you need initialise some configuration before hand:
 *
 *     $config = array('config1' => 'value1', 'config2' => 'value2');
 *     $Api = CheckoutapiApi::getApi($config);
 *
 * @category Checkoutapi
 * @version  Release: @package_version@
 */
final class CheckoutapiApi
{
    /**
     * 
     *
     * @var string $_apiclass  The name of the gateway to be used  
     */
    private static $_apiclass = 'CheckoutapiClientClientgw3';


    /**
     * Helper static function to get singleton instance of a gateway interface.
     *
     * @param  array       $arguments A set arguments for initialising class constructor.
     * @param  null|string $_apiclass Gateway class name.
     * @return CheckoutapiClientClient An singleton instance of CheckoutapiClientClient
     * @throws Exception
     */

    public static function getApi(array $arguments = array(),$_apiclass = null)
    {
        if($_apiclass) {
            self::setApiclass($_apiclass);
        }
                
        //Initialise the exception library
        $exceptionState = CheckoutapiLibFactory::getSingletonInstance('CheckoutapiLibExceptionstate');
        $exceptionState->setErrorState(false);
        
        return CheckoutapiLibFactory::getSingletonInstance(self::getApiclass(), $arguments);
    }

    /**
     * Helpper static function for setting  for $_apiclass.
     *
     * @param CheckoutapiClientClient $apiclass gateway interface name
     */

    public static function setApiclass($apiclass)
    {
        self::$_apiclass = $apiclass;
    }

    /**
     * Helper static function  for retriving value of $_apiclass.
     *
     * @return CheckoutapiClientClient  $_apiclass
     */

    public static function getApiclass()
    {
        return self::$_apiclass;
    }
}
