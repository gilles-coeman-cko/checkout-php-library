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
   * FFFKO.
   *
   * @var null $uri Uri to where request should be made
   */
  protected $uri = NULL;

  /**
   * FFFKO.
   *
   * @var array $headers Hold headers that should be pass to api
   */
  protected $headers = array();

  /**
   * FFFKO.
   *
   * @var string $processType  Type of adapter to be called
   */
  protected $processType = "curl";

  /**
   * FFFKO.
   *
   * @var string $respondType   Type of respond expecting from the server
   */
  protected $respondType = CheckoutapiParserConstant::API_RESPOND_TYPE_JSON;

  /**
   * FFFKO.
   *
   * @var null|CheckoutapiParserParser  $parserObj Checkoutapi use for keeping an instance of the paser
   */
  protected $parserObj = NULL;

  /**
   * Onstructor.
   *
   * @param array $config
   *   configutation for class.
   * @throws Exception
   */
  public function __construct(array $config = array()) {

    parent::setConfig($config);
    $this->initParser($this->getRespondType());
  }

  /**
   * Et/Get attribute wrapper.
   *
   * @param string $method
   *   method being call.
   * @param array $args
   *   argument for method being called.
   * @return mixed
   */
  public function __call($method, array $args) {
    switch (substr($method, 0, 3)) {
      case 'get':

        $key = substr($method, 3);
        $key = lcfirst($key);
        $data = $this->getConfig($key, isset($args[0]) ? $args[0] : NULL);

        return $data;

    }

    $this->exception("Api does not support this method " . $method . "(" . print_r($args, 1) . ")", debug_backtrace());
    return NULL;
  }

  /**
   * Checkoutapi initialise return an adapter.
   *
   * @param $adapterName
   *   Adapter Name.
   * @param array $arguments
   *   argument for creating the adapter.
   * @return CheckoutapiClientAdapterAbstract|null
   *
   * @throws Exception
   */
  public function getAdapter($adapterName, array $arguments = array()) {
    $stdName = ucfirst($adapterName);

    $classAdapterName = CheckoutapiClientConstant::ADAPTER_CLASS_GROUP . $stdName;

    $class = NULL;

    if (class_exists($classAdapterName)) {
      /**
       * FFFKO.
       *
       * @var CheckoutapiClientAdapterAbstract  $class
       */
      $class = CheckoutapiLibFactory::getSingletonInstance($classAdapterName, $arguments);
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
   * Etter for $parserObje.
   *
   * @return Checkoutapi_Parser_Parser|null
   */
  public function getParser() {
    return $this->_parserObj;
  }

  /**
   * Etter for $parserObj.
   *
   * @param string $parser
   *   parser name.
   */
  public function setParser($parser) {
    $this->_parserObj = $parser;

  }

  /**
   * Et the headers array base on which paser we are using.
   *
   * @param array $headers
   *   extra headers.
   */
  public function setHeaders(array $headers) {

    if (!$this->_parserObj) {
      $this->initParser($this->getRespondType());

    }

    /**
     * FFFKO.
     *
     * @var array  _headers
     */
    $this->_headers = $this->getParser()->getHeaders();
    $this->_headers = array_merge($this->_headers, $headers);
  }

  /**
   * Etters for $headers.
   *
   * @return array $headers headers
   */
  public function getHeaders() {
    return $this->_headers;
  }

  /**
   * Et which adapter communicator to use.
   *
   * @param string $processType
   *   process type or adapter name.
   */
  public function setProcessType($processType) {
    $this->_processType = $processType;
  }

  /**
   * Eturn name of adpater.
   *
   * @return string $processType  name of adapter
   */
  public function getProcessType() {
    return $this->_processType;
  }

  /**
   * Eturn the respond type default json.
   *
   * @return string
   */
  public function getRespondType() {
    $respondType = $this->_respondType;
    if ($respondType = $this->getConfig('respondType')) {
      $respondType = $respondType;
    }

    return $respondType;
  }

  /**
   * Reate and set a parser.
   *
   * @throws Exception
   */
  public function initParser() {
    $parserType = CheckoutapiClientConstant::PARSER_CLASS_GROUP . $this->getRespondType();

    $parserObj = CheckoutapiLibFactory::getSingletonInstance($parserType);
    $this->setParser($parserObj);
  }

  /**
   * Etter for $uri.
   *
   * @param string $uri
   *   endpoint name.
   */
  public function setUri($uri) {
    $this->_uri = $uri;
  }

  /**
   * Etter for $uri.
   *
   * @return string $uri
   */
  public function getUri() {
    return $this->_uri;
  }

}
