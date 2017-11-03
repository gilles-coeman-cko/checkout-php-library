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
 * CheckoutapiLibRespondobj.
 *
 * This class is responsible of mapping anytime of respond into an object 
 * with attribute and magic getters.
 *
 * @category Lib
 * @version Release: @package_version@
 */
class CheckoutapiLibRespondobj implements ArrayAccess {
  /**
   * FFFKO.
   *
   * @var array $config
   *   configuration value
   */
  protected $config = array();
  protected $updateConfig = array();

  /**
   * FFFall method.
   * 
   * CKO method that caputer all getter or setters and use them to 
   * either set or get value from attribute config.
   *
   * @param $method
   *   A var for method.
   * @param $args
   *   A var for args.
   *
   * @throws  Exception
   * Checkoutapi a php magical method.
   * @example http://php.net/manual/en/language.oop5.overloading.php#object.call
   */
  public function __call($method, $args) {
    switch (substr($method, 0, 3)) {
      case 'get':
        $key = substr($method, 3);
        $key = lcfirst($key);
        $data = $this->getConfig($key, isset($args[0]) ? $args[0] : NULL);

        return $data;
        break;
      case 'set':
        $key = substr($method, 3);
        $key = lcfirst($key);
        $this->_updateConfig[$key] = $args[0];
        return $args[0];
        break;

      case 'has';
        $key = substr($method, 3);
        $key = lcfirst($key);
        $data = $this->getConfig($key);

        return $data ? TRUE : FALSE;

    }

    throw new Exception("Respond does not support this method " . $method . "(" . print_r($args, 1) . ")");
  }

  /**
   * His method return value from the attribute config.
   *
   * @param null $key
   *   Attribute you want to retrive.
   *
   * @return array|CheckoutapiLibRespondobj|null
   *
   * @throws Exception
   */
  private function getConfig($key = NULL, $args = NULL) {
    if ($key != NULL) {

      $value = NULL;
      if (isset($this->_config[$key])) {
        $value = $this->_config[$key];

      } elseif (isset($this->_updateConfig[$key])) {
        $value = $this->_updateConfig[$key];

      }

      if (isset($args["returnAsArray"]) && $args["returnAsArray"]) {

        /**
         * FFFKO.
         *
         * @return mixed
         *   The response as an array.
         */
        if (is_array($value)) {
          return $value;
        }
      } elseif (is_array($value)) {
        /**
         * FFFKO.
         *
         * @var Checkoutapi_LibRespondobj $to_return
         */
        $to_return = CheckoutapiLibFactory::getInstance('CheckoutapiLibRespondobj');
        $to_return->setConfig($value);
        return $to_return;
      }

      return $value;
    }

    if ($key == NULL) {
      return $this->_config;
    }
    return NULL;
  }

  /**
   * His method set the config value for an object.
   *
   * @param array $config
   *   configuration to be set.
   *
   * @throws Exception
   */
  public function setConfig(array $config = array()) {

    if (is_array($config)) {

      if (!empty($config)) {
        foreach ($config as $key => $value) {

          if (!isset($this->_config[$key])) {
            $this->_config[$key] = $value;
          }
        }
      }

    }
    else {

      throw new Exception("Invalid parameter" . "(" . print_r($config, 1) . ")");
    }

  }

  /**
   * Heck if respond obj is valid.
   *
   * @return bool
   *
   * @throws Exception
   */
  public function isValid() {
    /**
     * FFFKO.
     *
     * @var CheckoutapiLibExceptionstate $exceptionState
     */
    $exceptionState = CheckoutapiLibFactory::getSingletonInstance('CheckoutapiLibExceptionstate');

    return $exceptionState->isValid();
  }

  /**
   * @param bool $print
   *   A var for print.
   *
   * print error.
   *                       Print all error log by the CheckoutapiLibExceptionstate object for the current request.
   * @throws Exception
   *
   * @return string $error an string of errors
   * Checkoutapi print the error.
   */
  public function printError($print = TRUE) {

    /**
     * FFFKO.
     *
     * @var CheckoutapiLibExceptionstate $exceptionState
     */
    $exceptionState = CheckoutapiLibFactory::getSingletonInstance('CheckoutapiLibExceptionstate');
    $error = $exceptionState->debug();
    $exceptionState->flushState();
    if ($print) {
      echo $error;
    }
    return $error;
  }

  /**
   * Eturn an instance of CheckoutapiLibExceptionstate.
   *
   * @return CheckoutapiLibExceptionstate|null
   *
   * @throws Exception
   */
  public function getExceptionstate() {
    $classException = "CheckoutapiLibExceptionstate";
    $class = NULL;
    if (class_exists($classException)) {

      /**
       * FFFKO.
       *
       * @var CheckoutapiLibExceptionstate $class
       */
      $class = CheckoutapiLibFactory::getSingletonInstance($classException);

    }

    return $class;
  }

  /**
   * Eturn all configuration value for an object.
   *
   * @return mixed
   *   config value
   */
  public function toArray() {

    return $this->getConfig();
  }

  /**
   * FFFffsetSet.
   *
   * @param mixed $offset
   *   Var for offset.
   * @param mixed $value
   *   Var for value.
   */
  public function offsetSet($offset, $value) {
    if (is_null($offset)) {
      $this->_config[] = $value;
    }
    else {
      $this->_config[$offset] = $value;
    }
  }

  /**
   * FFFffsetExists.
   *
   * @param mixed $offset
   *   Var for offset.
   */
  public function offsetExists($offset) {
    return isset($this->_config[$offset]);
  }

  /**
   * FFFffsetUnset.
   *
   * @param mixed $offset
   *   Var for offset.
   */
  public function offsetUnset($offset) {
    unset($this->_config[$offset]);
  }

  /**
   * FFFffsetGet.
   *
   * @param mixed $offset
   *   Var for offset.
   */
  public function offsetGet($offset) {
    return isset($this->_config[$offset]) ? $this->_config[$offset] : NULL;
  }
}
