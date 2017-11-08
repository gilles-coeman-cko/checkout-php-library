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
 * CheckoutapiClientClient.
 *
 * An abstract class for CheckoutapiClient gateway api.
 * This class encapsulate the main functionality of all gateway implimentation.
 *
 * @category Client
 * @version Release: @package_version@
 */
abstract class CheckoutapiClientClient extends CheckoutapiLibObject {

  /**
   * Uri.
   *
   * @var null
   *   Uri to where request should be made.
   */
  protected $uri = NULL;

  /**
   * Headers.
   *
   * @var array
   *   Hold headers that should be pass to api.
   */
  protected $headers = array();

  /**
   * Process type.
   *
   * @var string
   *   Type of adapter to be called.
   */
  protected $processType = "curl";

  /**
   * Respond type.
   *
   * @var string
   *   Type of respond expecting from the server.
   */
  protected $respondType = CheckoutapiParserConstant::API_RESPOND_TYPE_JSON;

  /**
   * Parser object.
   *
   * @var null|object
   *   CheckoutapiParserParser $parserObj Checkoutapi
   *   Use for keeping an instance of the paser.
   */
  protected $parserObj = NULL;

  /**
   * Constructor.
   *
   * @param array $config
   *   Configutation for class.
   *
   * @throws Exception
   */
  public function __construct(array $config = array()) {

    parent::setConfig($config);
    $this->initParser($this->getRespondType());
  }

  /**
   * Set/Get attribute wrapper.
   *
   * @param string $method
   *   Method being call.
   * @param array $args
   *   Argument for method being called.
   *
   * @return mixed
   *   A mixed for data.
   */
  public function __call($method, array $args) {
    switch (substr($method, 0, 3)) {
      case 'get':

        $key = substr($method, 3);
        $key = lcfirst($key);
        $data = $this->getConfig($key, isset($args[0]) ? $args[0] : NULL);

        return $data;

    }

    $this->exception(
      "Api does not support this method " .
        $method . "(" . print_r($args, 1) . ")",
      debug_backtrace());
    return NULL;

  }

  /**
   * Checkoutapi initialise return an adapter.
   *
   * @param mixed $adapterName
   *   Adapter Name.
   * @param array $arguments
   *   Argument for creating the adapter.
   *
   * @return CheckoutapiClientAdapterAbstract|null
   *   Something.
   *
   * @throws Exception
   */
  public function getAdapter($adapterName, array $arguments = array()) {
    $stdName = ucfirst($adapterName);

    $classAdapterName =
      CheckoutapiClientConstant::ADAPTER_CLASS_GROUP . $stdName;

    $class = NULL;

    if (class_exists($classAdapterName)) {
      // @var CheckoutapiClientAdapterAbstract $class.
      $class = CheckoutapiLibFactory::getSingletonInstance(
        $classAdapterName,
        $arguments
      );
      if (isset($arguments['uri'])) {
        $class->setUri($arguments['uri']);
      }

      if (isset($arguments['config'])) {
        $class->setConfig($arguments['config']);
      }

    }
    else {

      $this->exception("Not a valid Adapter", debug_backtrace());
    }

    return $class;

  }

  /**
   * Getter for $parserObje.
   *
   * @return Checkoutapi_Parser_Parser|null
   *   A Checkoutapi_Parser_Parser.
   */
  public function getParser() {
    return $this->_parserObj;

  }

  /**
   * Getter for $parserObj.
   *
   * @param string $parser
   *   Parser name.
   */
  public function setParser($parser) {
    $this->_parserObj = $parser;

  }

  /**
   * Set the headers array base on which paser we are using.
   *
   * @param array $headers
   *   Extra headers.
   */
  public function setHeaders(array $headers) {

    if (!$this->_parserObj) {
      $this->initParser($this->getRespondType());
    }

    // @var array  _headers.
    $this->_headers = $this->getParser()->getHeaders();
    $this->_headers = array_merge($this->_headers, $headers);
  }

  /**
   * Getters for $headers.
   *
   * @return array
   *   A array for $headers headers.
   */
  public function getHeaders() {
    return $this->_headers;

  }

  /**
   * Set which adapter communicator to use.
   *
   * @param string $processType
   *   Process type or adapter name.
   */
  public function setProcessType($processType) {
    $this->_processType = $processType;
  }

  /**
   * Return name of adpater.
   *
   * @return string
   *   A string for  $processType  name of adapter.
   */
  public function getProcessType() {
    return $this->_processType;

  }

  /**
   * Return the respond type default json.
   *
   * @return string
   *   A string.
   */
  public function getRespondType() {
    $respondType = $this->_respondType;
    if ($respondType = $this->getConfig('respondType')) {
      $respondType = $respondType;
    }

    return $respondType;

  }

  /**
   * Create and set a parser.
   *
   * @throws Exception
   */
  public function initParser() {
    $parserType =
      CheckoutapiClientConstant::PARSER_CLASS_GROUP . $this->getRespondType();

    $parserObj = CheckoutapiLibFactory::getSingletonInstance($parserType);
    $this->setParser($parserObj);
  }

  /**
   * Getter for $uri.
   *
   * @param string $uri
   *   Endpoint name.
   */
  public function setUri($uri) {
    $this->_uri = $uri;
  }

  /**
   * Getter for $uri.
   *
   * @return string
   *   The uri.
   */
  public function getUri() {
    return $this->_uri;

  }

}
