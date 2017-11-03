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
 * Parser to handle JSON.
 *
 * @category Parser
 * @version Release: @package_version@
 */
class CheckoutapiParserJSON extends CheckoutapiParserParser {
  /**
   * FFFKO.
   *
   * @var array $headers  Content negotiation relies on the use of specific headers
   */
  protected $headers = array('Content-Type: application/json;charset=UTF-8', 'Accept: application/json');

  /**
   * Onvert a json to a CheckoutapiLibRespondObj object.
   *
   * @param JSON $parser
   *   A parser.
   *
   * @return CheckoutapiLibRespondObj|null
   *   A return.
   *
   * @throws Exception
   */
  public function parseToObj(JSON $parser) {

    // @var CheckoutapiLibRespondObj $respondObj
    $respondObj = CheckoutapiLibFactory::getInstance('CheckoutapiLibRespondObj');

    if ($parser && is_string($parser)) {
      $encoding = mb_detect_encoding($parser);

      if ($encoding == "ASCII") {
        $parser = iconv('ASCII', 'UTF-8', $parser);
      }
      else {
        $parser = mb_convert_encoding($parser, "UTF-8", $encoding);
      }

      $jsonObj = json_decode($parser, TRUE);
      $jsonObj['rawOutput'] = $parser;

      $respondObj->setConfig($jsonObj);

    }
    $respondObj->setConfig($this->getResourceInfo());
    return $respondObj;
  }

  /**
   * His method prepare a posted value, so it match the header of the parser.
   *
   * @param mixed $postedparam
   *   A var for postedparam.
   *
   * @return JSON
   */
  public function preparePosted($postedParam) {
    return json_encode($postedParam);
  }

  /**
   * FFFetResourceInfo.
   *
   * @param mixed $info
   *   Var for info.
   */
  public function setResourceInfo($info) {
    $this->_info = $info;
  }
}
