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
 * CheckoutapiClientAdapterAbstract.
 * An abstract class for CheckoutapiClient adapters.
 * An adapter can be define a method of transmitting message over http protocol.
 * It encapsulate all basic and core method required by an adpater.
 *
 * @category Client
 * @version Release: @package_version@
 */
abstract class CheckoutapiClientAdapterAbstract extends CheckoutapiLibObject {
  /**
   * @var string
   */
  protected $uri = NULL;

  /**
   * @var resource|null
   */
  protected $resource = NULL;

  /**
   * @var mixed
   */
  protected $respond = NULL;

  /**
   * Constructor for Adapters.
   *
   * @param array $arguments
   *   Array of configuration for constructor.
   *
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
   * Set/Get attribute wrapper.
   *
   * @param string $method
   *   Method being call.
   * @param array $args
   *   Argument being pass.
   *
   * @return mixed
   *   A mixed .
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

    $this->exception(
      "Invalid method " . get_class(
        $this
      ) . "::" . $method . "(" . print_r(
        $args,
        1
      ) . ")",
      debug_backtrace()
    );

    return NULL;

  }

  /**
   * Setter for $uri.
   *
   * @param string $uri
   *   Setting the url value.
   */
  public function setUri($uri) {

    $this->uri = $uri;
  }

  /**
   * Getter for $uri.
   *
   * @return string
   */
  public function getUri() {
    return $this->uri;

  }

  /**
   * Setter for $resource.
   *
   * @var resource
   */
  public function setResource($resource) {
    $this->_resource = $resource;
  }

  /**
   * Getter for $resource.
   *
   * @return resource
   */
  public function getResource() {
    return $this->_resource;

  }

  /**
   * Setter for respond.
   *
   * @param mixed $respond
   *   Responnd obtain by gateway.
   */
  public function setRespond($respond) {
    $this->_respond = $respond;
  }

  /**
   * Getter for respond.
   *
   * @return mixed
   */
  public function getRespond() {
    return $this->_respond;

  }

  /**
   * Create a connection using the adapter.
   *
   * @return $this CheckoutapiClientAdapterAbstract
   */
  public function connect() {
    return $this;

  }

  /**
   * close all resource.
   */
  public function close() {
    $this->setResource(NULL);
    $this->setRespond(NULL);
  }
  public function getResourceInfo() {

    return array('httpStatus' => '');

  }

  /**
   * Return request made by the adapter.
   *
   * @return CheckoutapiLibRespondobj
   *   A CheckoutapiLibRespondobj.
   */
  abstract public function request();

  }
