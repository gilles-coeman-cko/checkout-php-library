<?php

/**
 * CheckoutapiClientAdapterAbstract.
 *
 * PHP Version 5.6
 *
 * @category Api
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

/**
 * CheckoutapiClientAdapterAbstract.
 *
 * CheckoutapiClientAdapterAbstract An abstract class for CheckoutapiClient adapters.
 * An adapter can be define a method of transmitting message over http protocol.
 * It encapsulate all basic and core method required by an adpater.
 *
 * @category Client
 * @version Release: @package_version@
 */
abstract class CheckoutapiClientAdapterAbstract extends CheckoutapiLibObject {
  /**
   * FFFKO.
   *
   * @var string$uri Checkoutapi server identifier
   */
  protected $uri = NULL;
  /**
   * FFFKO.
   *
   * @var resource|null $resource  Checkoutapi The server session handler
   */
  protected $resource = NULL;
  /**
   * FFFKO.
   *
   * @var mixed $respond  Checkoutapi Respond return by the server
   */
  protected $respond = NULL;

  /**
   * Onstructor for Adapters.
   *
   * @param array $arguments
   *   Array of configuration for constructor.
   * @throws Exception
   */
  public function __construct(array $arguments = array()) {
    if (isset($arguments['uri']) && $uri = $arguments['uri']) {
      $this->setUri($uri);
    }

    if (isset($arguments['config']) && $config = $arguments['config']) {

      $this->setConfig($config);
    }

  }

  /**
   * Et/Get attribute wrapper.
   *
   * @param string $method
   *   Method being call.
   * @param array $args
   *   Argument being pass.
   * @return mixed
   */
  public function __call($method, array $args) {
    switch (substr($method, 0, 3)) {
      case 'get':

        $key = substr($method, 3);
        $key = lcfirst($key);
        $data = $this->getConfig($key, isset($args[0]) ? $args[0] : NULL);

        return $data;

      case 'set':

        $key = substr($method, 3);
        $key = lcfirst($key);
        $result = $this->setConfig($key, isset($args[0]) ? $args[0] : NULL);

        return $result;

    }

    //throw new Exception("Invalid method ".get_class($this)."::".$method."(".print_r($args,1).")");
    $this->exception(
      "Invalid method " . get_class($this) . "::" . $method . "(" . print_r($args, 1) . ")",
      debug_backtrace()
    );

    return NULL;
  }

  /**
   * Etter for $uri.
   *
   * @param string $uri
   *   setting the url value.
   **/
  public function setUri($uri) {

    $this->_uri = $uri;
  }

  /**
   * Etter for $uri.
   *
   * @return string
   **/
  public function getUri() {
    return $this->_uri;
  }

  /**
   * Etter for $resource.
   *
   * @var resource $resource
   **/
  public function setResource($resource) {
    $this->_resource = $resource;
  }

  /**
   * Etter for $resource.
   *
   * @return resource
   **/
  public function getResource() {
    return $this->_resource;
  }

  /**
   * Checkoutapi_ Setter for respond.
   *
   * @param mixed $respond
   *   responnd obtain by gateway.
   **/
  public function setRespond($respond) {
    $this->_respond = $respond;
  }

  /**
   * Checkoutapi_ Getter for respond.
   *
   * @return mixed
   **/
  public function getRespond() {
    return $this->_respond;
  }

  /**
   * Reate a connection using the adapter.
   *
   * @return $this CheckoutapiClientAdapterAbstract
   */
  public function connect() {
    return $this;
  }

  /**
   * Lose all resource.
   */
  public function close() {
    $this->setResource(NULL);
    $this->setRespond(NULL);
  }

  public function getResourceInfo() {

    return array('httpStatus' => '');
  }

  /**
   * Eturn request made by the adapter.
   *
   * @return CheckoutapiLibRespondobj
   */
  abstract public function request();

}
