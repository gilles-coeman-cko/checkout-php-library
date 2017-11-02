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
 * This class is used as signature  for all current and future adapters
 *
 * @category Client
 * @version  Release: @package_version@
 **/
interface CheckoutapiClientAdapterInterface
{
    /**
     * Checkoutapi Read respond on the server
     * 
     * @return object
     **/

    public function request();
    
    /**
     * Checkoutapi Close all open connections and release all set variables
     **/

    public function close();

    /**
     * Checkoutapi Open a connection to server/URI
     *
     * @return resource
     **/

    public function connect();

    /**
     *  Set parameter $_config value
     *
     * @param array $array config array
     *
     * @return mixed
     **/

    public function setConfig($array = array());

    /**
     *  Return parameter value in $_config variable
     *
     * @param  string $key config name to retrive
     * @return mixed
     **/

    public function getConfig($key = null);
}
