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
 * The basic functionally all parsers need to inherit.
 *
 * @category Parser
 * @version Release: @package_version@
 */
abstract class CheckoutapiParserParser extends CheckoutapiLibObject {
  /**
   * Headers.
   *
   * @var $headers
   *   Array Checkoutapi hold value for headers to be send by the transport message layer.
   */
  protected $headers = array();

  /**
   * Response object.
   *
   * @var $respondObj
   *   null|CheckoutapiLibRespondobj  * Checkoutapi hold an  value for.
   */
  protected $respondObj = NULL;
  protected $info = array('httpStatus' => 0);

  /**
   * It takes a string, parse it and then map it to an object.
   *
   * This method need to be implemented by all children.
   *
   * @param mixed $parser
   *   A var.
   *
   * @return CheckoutapiLibRespondobj
   */
  abstract public function parseToObj($parser);

  /**
   * Etter $respondObj.
   *
   * @param object $obj
   *   CheckoutapiLibRespondobj.
   */
  public function setRespondobj($obj) {
    $this->_respondObj = $obj;
  }

  /**
   * Etter $respondObj.
   *
   * @return CheckoutapiLibRespondobj|null
   */
  public function getRespondobj() {
    return $this->_respondObj;
  }

  /**
   * Etter $headers.
   *
   * @return array
   */
  public function getHeaders() {
    return $this->_headers;
  }

  /**
   * Ormat the value base on the parser type.
   *
   * @param mixed $postedParam
   *   The var.
   *
   * @return mixed
   */
  abstract public function preparePosted($postedParam);

  /**
   * Et Resource Info.
   *
   * @param mixed $info
   *   The info.
   *
   * @return mixed
   */
  abstract public function setResourceInfo($info);

  /**
   * Et Resource Info.
   *
   * @return mixed
   */
  public function getResourceInfo() {
    return $this->_info;
  }

}
