<?php

/**
 * CheckoutapiApi.
 *
 * PHP Version 5.6
 *
 * @category Api
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

/**
 * His class is used as signature  for all current and future adapters.
 *
 * @category Client
 * @version Release: @package_version@
 */
interface CheckoutapiClientAdapterInterface {
  /**
   * Checkoutapi Read respond on the server.
   *
   * @return object
   **/
  public function request();

  /**
   * Checkoutapi Close all open connections and release all set variables.
   **/
  public function close();

  /**
   * Checkoutapi Open a connection to server/URI.
   *
   * @return resource
   **/
  public function connect();

  /**
   * Et parameter $config value.
   *
   * @param array $array
   *   config array.
   *
   * @return mixed
   **/
  public function setConfig(array $array = array());

  /**
   * Eturn parameter value in $config variable.
   *
   * @param string $key
   *   config name to retrive.
   * @return mixed
   **/
  public function getConfig($key = NULL);
}
