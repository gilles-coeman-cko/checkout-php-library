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
 * CheckoutapiClientClientgw3.
 *
 * Gateway 3.0 class
 *
 * Class CheckoutapiClientClientgw3.
 * This class in an interface to the Checkout Gateway 3.0.
 * It provide access to all endpoint setup by the gateway.
 * The simplest usage would be example creating a card token:.
 *      $secretKey = 'sk_test_CC937715-4F68-4306-BCBE-640B249A4D50';.
 *      $cardTokenConfig = array();.
 *      $cardTokenConfig['authorization'] = "$publicKey" ;.
 *      $Api = CheckoutapiApi::getApi();.
 *      $cardTokenConfig[* @param array $postedParam
*   An array with the parameters that will be posted.] = array (.
 *                                              'email' =>'dhiraj.@checkout.com',
 *                                               'card' => array(.
 *                                               'phoneNumber'=>'0123465789',.
 *                                               'name'=>'test name',.
 *                                               'number' => '4543474002249996',.
 *                                               'expiryMonth' => 06,.
 *                                               'expiryYear' => 2017,.
 *                                               'cvv' => 956,.
 *                                               ).
 *                                           );.
 *     $respondCardToken = $Api->getCardToken( $cardTokenConfig );.
 *     If($respondCardToken->isValid()) {.
 *        Echo $respondCardToken->getId();.
 *     }
     else {.
 *          Echo $respondCardToken->printError();.
 *      }.
 *
 *   Those couple of lines , will create an instance of the .
 *   CheckoutapiClientClientgw3. It will then will request a card
 *   Token to the token, with a set of arguments. if the repond is
 *   Valid , we can print out the result else we can print out .
 *   The errors.
 *
 * @category Client
 * @version Release: @package_version@
 */
class CheckoutapiClientClientGW3 extends CheckoutapiClientClient {
 
  /**
   * FFFKO.
   *
   * @var string
   *   To store uri for charge url.
   */
  protected $uriCharge = NULL;

  /**
   * FFFKO.
   *
   * * .@var string $uriToken
   *   To store uri for token url.
   */
  protected $uriToken = NULL;

  /**
   * FFFKO.
   *
   * @var string
   *   To store uri for customer url.
   */
  protected $uriCustomer = NULL;

  /**
   * FFFKO.
   *
   * @var string
   */
  protected $uriProvider = NULL;
 
  /**
   * FFFKO.
   *
   * @var string
   */
  private $mode = 'dev';

  /**
   * Onstructor.
   *
   * @param array $config
   *   Configuration for class.
   */
  public function __construct(array $config = array()) {
    parent::__construct($config);

    if ($mode = $this->getMode()) {
      $this->setMode($mode);
    }

    $this->setUriCharge();
    $this->setUriToken();
    $this->setUriCustomer();
    $this->setUriProvider();
    $this->setUriRecurringPayments();
  }

  /**
   * Create Card Token.
   *
   * Simple usage:
   *   $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array (.
   *                                    'email'   =>    'dhiraj.@checkout.com',
   *                                    'card'    =>    array(.
   *                                                            'phoneNumber'      => '0123465789',.
   *                                                             'name'             => 'test name',.
   *                                                             'number'           => 'XXXXXXXXX',.
   *                                                             'expiryYear'       => 2017,.
   *                                                              'cvv'              => 956.
   *                                                           ).
   *                                   );.
   *          $respondCardToken = $Api->getCardToken( $param );.
   *  Use by having, first an instance of the gateway 3.0 and set of arguments as above
   * 
   * @param array $param
   *   Payload for creating a card token parameter.
   *
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   */
  public function getCardToken(array $param) {
    $hasError = FALSE;
    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['type'] = CheckoutapiClientConstant::TOKEN_CARD_TYPE;
    $postedParam = $param[* @param array $postedParam
*   An array with the parameters that will be posted.];
    $this->flushState();

    CheckoutapiClientValidationGW3::isEmailValid($postedParam);
    CheckoutapiClientValidationGW3::isCardValid($postedParam);

    $uri = $this->getUriToken() . '/card';

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Create payment token.
   * 
   * Simple usage:
   *   $sessionConfig[* @param array $postedParam
*   An array with the parameters that will be posted.] = array( "value"=>100, "currency"=>"GBP");.
   *      $sessionTokenObj = $Api->getPaymentToken($sessionConfig);.
   * Use by having, first an instance of the gateway 3.0 and set of argument base on documentation for creating a session token.
   *
   * @param array $param
   *   Payload param.
   *
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   */
  public function getPaymentToken(array $param) {
    $hasError = FALSE;
    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['type'] = CheckoutapiClientConstant::TOKEN_SESSION_TYPE;
    $postedParam = $param[* @param array $postedParam
*   An array with the parameters that will be posted.];
    $this->flushState();
    $isAmountValid = CheckoutapiClientValidationGW3::isValueValid($postedParam);
    $isCurrencyValid = CheckoutapiClientValidationGW3::isValidCurrency($postedParam);
    $uri = $this->getUriToken() . '/payment';

    if (!$isAmountValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid amount (in cents)', array('pram' => $param));
    }

    if (!$isCurrencyValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid currency code (ISO currency code)', array('pram' => $param));
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Create Charge.
   *
   * @param array $param
   *   Payload param.
   *
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * This methods can be call to create charge for checkout.com gateway 3.0 by passing
   * Full card details :.
   *  $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array ( 'email'=>'dhiraj.@checkout.com',
   *                                   'value'=>100,.
   *                                    'currency'=>'usd',.
   *                                   'description'=>'desc',.
   *                                   'caputure'=>FALSE,.
   *
   *                                   'card' => array(.
   *
   *                                   'phoneNumber'=>'0123465789',.
   *                                   'name'=>'test name',.
   *                                   'number' => '4543474002249996',.
   *                                   'expiryMonth' => 06,.
   *                                   'expiryYear' => 2017,.
   *                                   'cvv' => 956,.
   *
   * ).
   * );.
   * Or by passing a card token:.
   *  $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array ( 'email'=>'dhiraj.@checkout.com',
   *                                   'value'=>100,.
   *                                    'currency'=>'usd',.
   *                                   'description'=>'desc',.
   *                                   'caputure'=>FALSE,.
   *                                    'cardToken'=>'card_tok_2d033cf7-1542-4a3d-bd08-bd9d26533551'.
   *                                   ).
   *
   * Or by passing a card id:.
   * $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array ( 'email'=>'dhiraj.@checkout.com',
   *                                   'value'=>100,.
   *                                   'currency'=>'usd',.
   *                                   'description'=>'desc',.
   *                                   'caputure'=>FALSE,.
   *                                   'cardId'=>'card_fb10a0a5-05ef-4254-ac85-3aa221e8d50d'.
   *                                   ).
   * And then just call the method:.
   *       $charge = $Api->createCharge($param);.
   */
  public function createCharge(array $param) {
    $hasError = FALSE;
    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $postedParam = $param[* @param array $postedParam
*   An array with the parameters that will be posted.];
    $this->flushState();
    $isAmountValid = CheckoutapiClientValidationGW3::isValueValid($postedParam);
    $isCurrencyValid = CheckoutapiClientValidationGW3::isValidCurrency($postedParam);
    $isEmailValid = CheckoutapiClientValidationGW3::isEmailValid($postedParam);
    $isCustomerIdValid = CheckoutapiClientValidationGW3::isCustomerIdValid($postedParam);
    $isCardValid = CheckoutapiClientValidationGW3::isCardValid($postedParam);
    $isCardIdValid = CheckoutapiClientValidationGW3::isCardIdValid($postedParam);
    $isCardTokenValid = CheckoutapiClientValidationGW3::isCardToken($postedParam);

    if (!$isEmailValid && !$isCustomerIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid Email address or Customer id', array('param' => $postedParam));
    }

    if ($isCardTokenValid) {
      if (isset($postedParam['card'])) {
        $this->throwException('unset card object', array('param' => $postedParam), FALSE);
        // unset($param[* @param array $postedParam
*   An array with the parameters that will be posted.]['card']);
      }
      $this->setUriCharge('', 'token');

    } elseif ($isCardValid) {

      if (isset($postedParam['token'])) {
        $this->throwException('unset invalid token object', array('param' => $postedParam), FALSE);
        unset($param[* @param array $postedParam
*   An array with the parameters that will be posted.]['token']);
      }
      $this->setUriCharge('', 'card');

    } elseif ($isCardIdValid) {
      $this->setUriCharge('', 'card');

      if (isset($postedParam['token'])) {
        $this->throwException('unset invalid token object', array('param' => $postedParam), FALSE);
        unset($param[* @param array $postedParam
*   An array with the parameters that will be posted.]['token']);
      }

      if (isset($postedParam['card'])) {
        $this->throwException('unset invalid token object', array('param' => $postedParam), FALSE);

        if (isset($param[* @param array $postedParam
*   An array with the parameters that will be posted.]['card']['name'])) {
          unset($param[* @param array $postedParam
*   An array with the parameters that will be posted.]['card']['name']);
        }

        if (isset($param[* @param array $postedParam
*   An array with the parameters that will be posted.]['card']['number'])) {
          unset($param[* @param array $postedParam
*   An array with the parameters that will be posted.]['card']['number']);
        }

        if (isset($param[* @param array $postedParam
*   An array with the parameters that will be posted.]['card']['expiryMonth'])) {
          unset($param[* @param array $postedParam
*   An array with the parameters that will be posted.]['card']['expiryMonth']);
        }

        if (isset($param[* @param array $postedParam
*   An array with the parameters that will be posted.]['card']['expiryYear'])) {
          unset($param[* @param array $postedParam
*   An array with the parameters that will be posted.]['card']['expiryYear']);
        }
      }

    } elseif ($isEmailValid || $isCustomerIdValid) {
      $this->setUriCharge('', 'customer');
    }
    else {
      $hasError = TRUE;
      $this->throwException('Please provide  either a valid card token or a card object or a card id', array('pram' => $param));
    }

    if (!$isAmountValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid amount (in cents)', array('pram' => $param));
    }

    if (!$isCurrencyValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid currency code (ISO currency code)', array('pram' => $param));
    }

    return $this->_responseUpdateStatus($this->request($this->getUriCharge(), $param, !$hasError));

  }

  public function verifyChargePaymentToken(array $param) {
    $hasError = FALSE;
    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_GET;
    $this->flushState();

    $isTokenValid = CheckoutapiClientValidationGW3::isPaymentToken($param);
    $uri = $this->getUriCharge();

    if (!$isTokenValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid payment token ', array('param' => $param));

    }
    else {

      $uri = "$uri/{$param['paymentToken']}";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Efund  Info.
   *
   * This method returns the Captured amount, total refunded amount and the amount remaining.
   * To refund.
   *
   * $refundInfo = $Api->getRefundInfo($param);.
   */
  public function getRefundAmountInfo($param) {

    $chargeHistory = $this->getChargeHistory($param);
    $charges = $chargeHistory->getCharges();
    $chargesArray = $charges->toArray();
    $totalRefunded = 0;

    foreach ($chargesArray as $values) {
      if (in_array(CheckoutapiClientConstant::STATUS_CAPTURE, $values)) {
        $capturedAmount = $values['value'];
      }

      if (in_array(CheckoutapiClientConstant::STATUS_REFUND, $values)) {
        $totalRefunded += $values['value'];
      }
    }

    $refundInfo = array(
      'capturedAmount' => $capturedAmount,
      'totalRefunded' => $totalRefunded,
      'remainingAmount' => $capturedAmount - $totalRefunded,
    );

    return $refundInfo;

  }

  /**
   * Efund  Charge.
   *
   * This method refunds a Card Charge that has previously been created but not yet refunded.
   *  Or void a charge that has been capture.
   *
   * Simple usage:
   *   $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array (.
   *        'value'=>150.
   *      );.
   *      $refundCharge = $Api->refundCharge($param);.
   *
   * @param array $param
   *   Payload param for refund a charge.
   *
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   */
  public function refundCharge($param) {
    $chargeHistory = $this->getChargeHistory($param);
    $charges = $chargeHistory->getCharges();
    $uri = $this->getUriCharge();

    if (!empty($charges)) {
      $chargesArray = $charges->toArray();
      $toRefund = FALSE;
      $toVoid = FALSE;
      $toRefundData = FALSE;
      $toVoidData = FALSE;

      foreach ($chargesArray as $charge) {
        if (in_array(CheckoutapiClientConstant::STATUS_CAPTURE, $charge)
          || in_array(CheckoutapiClientConstant::STATUS_REFUND, $charge)
        ) {
          if (strtolower($charge['status']) == strtolower(CheckoutapiClientConstant::STATUS_CAPTURE)) {
            $toRefund = TRUE;
            $toRefundData = $charge;
            break;
          }
        }
        else {
          $toVoid = TRUE;
          $toVoidData = $charge;
        }
      }

      if ($toRefund) {
        $refundChargeId = $toRefundData['id'];
        $param['chargeId'] = $refundChargeId;
        $uri = "$uri/{$param['chargeId']}/refund";
      }

      if ($toVoid) {
        $voidChargeId = $toVoidData['id'];
        $param['chargeId'] = $voidChargeId;
        $uri = "$uri/{$param['chargeId']}/void";
      }
    }
    else {
      $this->throwException('Please provide a valid charge id', array('param' => $param));
    }

    $hasError = FALSE;
    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['type'] = CheckoutapiClientConstant::CHARGE_TYPE;

    $param['method'] = CheckoutapiClientAdapterConstant::API_POST;
    $postedParam = $param[* @param array $postedParam
*   An array with the parameters that will be posted.];

    $this->flushState();
    $isAmountValid = CheckoutapiClientValidationGW3::isValueValid($postedParam);
    $isChargeIdValid = CheckoutapiClientValidationGW3::isChargeIdValid($param);

    if (!$isChargeIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid charge id', array('param' => $param));

    }

    if (!$isAmountValid) {
      $this->throwException('Please provide a amount (in cents)', array('param' => $param), FALSE);
    }
    return $this->_responseUpdateStatus($this->request($uri, $param, !$hasError));

  }

  /**
   * Oid  Charge.
   *
   * This method void a Card Charge that has previously been created.
   *
   * Simple usage:
   *   $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array ('value'=>150);.
   *      $refundCharge = $Api->refundCharge($param);.
   *
   * @param array $param
   *   Payload param for void a charge.
   *
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   */
  public function voidCharge($param) {
    $hasError = FALSE;
    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $postedParam = $param[* @param array $postedParam
*   An array with the parameters that will be posted.];
    $this->flushState();
    $isAmountValid = CheckoutapiClientValidationGW3::isValueValid($postedParam);
    $isChargeIdValid = CheckoutapiClientValidationGW3::isChargeIdValid($param);
    $uri = $this->getUriCharge();

    if (!$isChargeIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid charge id', array('param' => $param));

    }
    else {

      $uri = "$uri/{$param['chargeId']}/void";
    }
    if (!$isAmountValid) {
      $this->throwException('Please provide a amount (in cents)', array('param' => $param), FALSE);
    }

    return $this->_responseUpdateStatus($this->request($uri, $param, !$hasError));

  }
  /**
   * Apture   Charge.
   *
   * This method allow you to capture the payment of an existing, authorised, Card Charge.
   *
   * Simple usage:
   *   $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array ( 'value'=>150 );.
   *      CaptureCharge = $Api->captureCharge($param);.
   *
   * @param array $param
   *   Payload param for caputring a charge.
   *
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   */
  public function captureCharge($param) {
    $hasError = FALSE;
    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_POST;
    $postedParam = $param[* @param array $postedParam
*   An array with the parameters that will be posted.];
    $this->flushState();
    $isAmountValid = CheckoutapiClientValidationGW3::isValueValid($postedParam);
    $isChargeIdValid = CheckoutapiClientValidationGW3::isChargeIdValid($param);
    $uri = $this->getUriCharge();

    if (!$isChargeIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid charge id', array('param' => $param));

    }
    else {

      $uri = "$uri/{$param['chargeId']}/capture";
    }
    if (!$isAmountValid) {
      $this->throwException('Please provide a amount (in cents)', array('param' => $param), FALSE);
    }

    return $this->_responseUpdateStatus($this->request($uri, $param, !$hasError));

  }

  /**
   * Pdate   Charge.
   *
   * Updates the specified Card Charge by setting the values of the parameters passed.
   *
   * Simple usage:.
   *   $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array ('description'=> 'dhiraj is doing some test');.
   *   $updateCharge = $Api->updateCharge($param);.
   *
   * @param array $param
   *   Payload param.
   *
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   */
  public function updateCharge($param) {
    $hasError = FALSE;
    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_PUT;

    $this->flushState();

    $isChargeIdValid = CheckoutapiClientValidationGW3::isChargeIdValid($param);
    $uri = $this->getUriCharge();

    if (!$isChargeIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid charge id', array('param' => $param));

    }
    else {

      $uri = "$uri/{$param['chargeId']}";
    }

    return $this->_responseUpdateStatus($this->request($this->getUriCharge(), $param, !$hasError));

  }
  /**
   * Pdate MetaData   Charge.
   *
   * Updates the specified Card Charge by setting the values of the parameters passed.
   *
   * Simple usage:
   *   $updateCharge = $Api->updateMetadata($param array('keycode'=>$value));.
   *
   * @param array $param
   *   Payload param.
   *
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   */
  public function updateMetadata($chargeObj, $metaData = array()) {
    $hasError = FALSE;
    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_PUT;

    $this->flushState();

    $chargeId = $chargeObj->getId();
    $metaArray = array();

    if ($chargeObj->getMetadata()) {
      $metaArray = $chargeObj->getMetadata()->toArray();
    }

    $newMetadata = array_merge($metaArray, $metaData);

    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['metadata'] = $newMetadata;
    $uri = $this->getUriCharge();
    $uri = "$uri/{$chargeId}";

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Update Trackid   Charge.
   *
   * Updates the specified Card Charge by setting the values of the parameters passed.
   *
   * Simple usage:
   *   $updateCharge = $Api->updateTrackId($chargeObj, $trackId);.
   *
   * @param array $param
   *   Payload param.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function updateTrackId($chargeObj, $trackId) {
    $hasError = FALSE;
    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_PUT;

    $this->flushState();

    $chargeId = $chargeObj->getId();

    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['trackId'] = $trackId;
    $uri = $this->getUriCharge();
    $uri = "$uri/{$chargeId}";

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Update PaymentToken Charge.
   *
   * Updates the specified Card Charge by setting the values of the parameters passed.
   *
   * Simple usage:
   *   $updatePaymentToken = $Api->updatePaymentToken($paymentToken);.
   *
   * @param array $param
   *   Payload param.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function updatePaymentToken($param) {
    $hasError = FALSE;
    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_PUT;

    $this->flushState();

    $uri = $this->getUriToken() . "/payment/{$param['paymentToken']}";

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Get Charge.
   *
   * Get the specified Card Charge by setting the values of the parameters passed.
   *
   * Simple usage:
   *   $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array ('description'=> 'dhiraj is doing some test');.
   *   $updateCharge = $Api->updateCharge($param);.
   *
   * @param array $param
   *   Payload param.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function getCharge($param) {
    $hasError = FALSE;
    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_GET;

    $this->flushState();

    $isChargeIdValid = CheckoutapiClientValidationGW3::isChargeIdValid($param);
    $uri = $this->getUriCharge();

    if (!$isChargeIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid charge id', array('param' => $param));

    }
    else {

      $uri = "$uri/{$param['chargeId']}";
    }

    return $this->_responseUpdateStatus($this->request($uri, $param, !$hasError));

  }

  /**
   * GetChargeHistory.
   *
   * @param mixed $param
   *   Var for param.
   */
  public function getChargeHistory($param) {

    $hasError = FALSE;
    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_GET;

    $this->flushState();

    $isChargeIdValid = CheckoutapiClientValidationGW3::isChargeIdValid($param);
    $uri = $this->getUriCharge();

    if (!$isChargeIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid charge id', array('param' => $param));

    }
    else {

      $uri = "$uri/{$param['chargeId']}/history";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Create LocalPayment Charge.
   *
   * Creates a LocalPayment Charge using a Session Token.
   *
   * This can be call in this way:.
   *   $chargeLocalPaymentConfig['authorization'] = $publicKey ;.
   *   $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array(.
   *     'email'        =>  'dhiraj.checkout@checkout.com',
   *     'token'        =>   $Api->getSessionToken($sessionConfig),.
   *     'localPayment' =>  array(.
   *       'lppId'  => $Api->getLocalPaymentProvider($localPaymentConfig)->getId().
   *     ).
   *   ) ;.
   *   $chargeLocalPaymentObj = $Api->createLocalPaymentCharge($chargeLocalPaymentConfig);.
   *
   * @param array $param
   *   Payload param for creating a localpayment.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   */
  public function createLocalPaymentCharge($param) {
    $hasError = FALSE;
    $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['type'] = CheckoutapiClientConstant::LOCALPAYMENT_CHARGE_TYPE;
    $postedParam = $param[* @param array $postedParam
*   An array with the parameters that will be posted.];
    $this->flushState();
    $uri = $this->getUriCharge();
    $isValidEmail = CheckoutapiClientValidationGW3::isEmailValid($postedParam);
    $isValidSessionToken = CheckoutapiClientValidationGW3::isSessionToken($postedParam);
    $isValidLocalPaymentHash = CheckoutapiClientValidationGW3::isLocalPyamentHashValid($postedParam);
    $param['method'] = CheckoutapiClientAdapterConstant::API_POST;
    if (!$isValidEmail) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid email address', array(* @param array $postedParam
*   An array with the parameters that will be posted. => $postedParam));
    }

    if (!$isValidSessionToken) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid session token', array(* @param array $postedParam
*   An array with the parameters that will be posted. => $postedParam));
    }

    if (!$isValidLocalPaymentHash) {
      $hasError = TRUE;
      $this->throwException('Please provide a local payment hash', array(* @param array $postedParam
*   An array with the parameters that will be posted. => $postedParam));
    }

    if (!isset($param[* @param array $postedParam
*   An array with the parameters that will be posted.]['localPayment']['userData'])) {
      $param[* @param array $postedParam
*   An array with the parameters that will be posted.]['localPayment']['userData'] = '{}';
    }
    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Create a customer.
   *
   * This method can be call in the following way:
   *   $param['customerId'] = $customerId ;.
   *   $param['cardId'] = $cardId ;.
   *   $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array (.
   *     'card'        =>  array(.
   *       'name'        =>  'New name',.
   *       'number'      => '4543474002249996',.
   *       'expiryMonth' => 08,.
   *       'expiryYear'  => 2017,.
   *       'cvv'         => 956,.
   *     ).
   *   );.
   *   $customer = $Api->createCustomer($customerConfig);.
   *
   * @param array $param
   *   Payload param for creating a customer.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function createCustomer($param) {
    $hasError = FALSE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_POST;
    $postedParam = $param[* @param array $postedParam
*   An array with the parameters that will be posted.];
    $this->flushState();
    $uri = $this->getUriCustomer();
    $isValidEmail = CheckoutapiClientValidationGW3::isEmailValid($postedParam);
    $isCardValid = CheckoutapiClientValidationGW3::isCardValid($postedParam);
    $isTokenValid = CheckoutapiClientValidationGW3::isCardToken($postedParam);

    if (!$isValidEmail) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid Email Address', array('param' => $param));
    }

    if ($isTokenValid) {
      if (isset($postedParam['card'])) {
        $this->throwException('unsetting card object', array('param' => $param), FALSE);
        unset($param[* @param array $postedParam
*   An array with the parameters that will be posted.]['card']);
      }
    } elseif ($isCardValid) {
      if (isset($postedParam['token'])) {
        $this->throwException('unsetting token ', array('param' => $param), FALSE);
        unset($param[* @param array $postedParam
*   An array with the parameters that will be posted.]['token']);
      }
    }
    else {
      $hasError = TRUE;
      $this->throwException('Please provide a valid card detail or card token', array('param' => $param));
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Get Customer.
   *
   * Simple usage :
   *   $param['customerId'] = {customerId} ;.
   *   $getCustomer = $Api->getCustomer($param);.
   *
   * @param array $param
   *   Payload param for returning a single customer.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function getCustomer($param) {
    $hasError = FALSE;

    $param['method'] = CheckoutapiClientAdapterConstant::API_GET;
    $this->flushState();
    $uri = $this->getUriCustomer();
    $isCustomerIdValid = CheckoutapiClientValidationGW3::isCustomerIdValid($param);

    if (!$isCustomerIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid customer id', array('param' => $param));
    }
    else {

      $uri = "$uri/{$param['customerId']}";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Pdate Customer.
   *
   * This method can be call in the following way:
   *   $param['customerId'] = $customerId ;.
   *   $param['cardId'] = $cardId ;.
   *   $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array (.
   *     'card'        =>  array(.
   *       'name'        =>  'New name',.
   *       'number'      => '4543474002249996',.
   *       'expiryMonth' => 08,.
   *       'expiryYear'  => 2017,.
   *       'cvv'         => 956,.
   *     ).
   *   );.
   *   $customerUpdate = $Api->updateCustomer($param);.
   *
   * @param array $param
   *   Payload param for updating.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function updateCustomer($param) {
    $hasError = FALSE;

    $param['method'] = CheckoutapiClientAdapterConstant::API_PUT;
    $this->flushState();
    $uri = $this->getUriCustomer();
    $isCustomerIdValid = CheckoutapiClientValidationGW3::isCustomerIdValid($param);

    if (!$isCustomerIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid customer id', array('param' => $param));
    }
    else {

      $uri = "$uri/{$param['customerId']}";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Getting a list of customer.
   *
   * Simple usage:
   *   $param['count'] = 100 ;.
   *   $param['from_date'] = '09/30/2014' ;.
   *   $param['to_date'] = '10/02/2014' ;.
   *   $customerUpdate = $Api->getListCustomer($param);.
   *
   * @param array $param
   *   Payload param for getting list of customer.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function getListCustomer($param) {
    $hasError = FALSE;

    $param['method'] = CheckoutapiClientAdapterConstant::API_GET;
    $this->flushState();
    $uri = $this->getUriCustomer();
    $delimiter = '?';
    $createdAt = 'created=';

    if (isset($param['created_on'])) {
      $uri = "{$uri}{$delimiter}{$createdAt}{$param['created_on']}|";
      $delimiter = '&';

    }
    else {
      if (isset($param['from_date'])) {
        $fromDate = time($param['from_date']);
        $uri = "{$uri}{$delimiter}{$createdAt}{$fromDate}";
        $delimiter = '&';
        $createdAt = '|';
      }

      if (isset($param['to_date'])) {
        $toDate = time($param['to_date']);
        $uri = "{$uri}{$createdAt}{$toDate}";
        $delimiter = '&';

      }
    }

    if (isset($param['count'])) {

      $uri = "{$uri}{$delimiter}count={$param['count']}";
      $delimiter = '&';
    }

    if (isset($param['offset'])) {
      $uri = "{$uri}{$delimiter}offset={$param['offset']}";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Delete a customer.
   *
   * This method can be call this way:
   *   $param['customerId'] = {$customerId} ;.
   *   $deleteCustomer = $Api->deleteCustomer($param);.
   *
   * @param array $param
   *   Payload param for deleteing a customer.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function deleteCustomer($param) {
    $param['method'] = CheckoutapiClientAdapterConstant::API_DELETE;
    $this->flushState();
    $uri = $this->getUriCustomer();
    $hasError = FALSE;
    $isCustomerIdValid = CheckoutapiClientValidationGW3::isCustomerIdValid($param);
    if (!$isCustomerIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid customer id', array('param' => $param));
    }
    else {

      $uri = "$uri/{$param['customerId']}";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Reating a card, link to a customer.
   *
   * Simple usage:
   *   $param['customerId'] = $customerId ;.
   *   $param['cardId'] = $cardId ;.
   *   $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array (.
   *     'card'        =>  array(.
   *       'name'        =>  'New name',.
   *       'number'      => '4543474002249996',.
   *       'expiryMonth' => 08,.
   *       'expiryYear'  => 2017,.
   *       'cvv'         => 956,.
   *     ).
   *   );.
   *   $cardObj = $Api->createCard($param);.
   * The creadCard method can be call this way and it required a customer id.
   *
   * @param array $param
   *   Payload param for creating a card.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function createCard($param) {

    $this->flushState();
    $uri = $this->getUriCustomer();
    $hasError = FALSE;
    $postedParam = $param[* @param array $postedParam
*   An array with the parameters that will be posted.];
    $isCustomerIdValid = CheckoutapiClientValidationGW3::isCustomerIdValid($param);
    $isCardValid = CheckoutapiClientValidationGW3::isCardValid($postedParam);

    if (!$isCustomerIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid customer id', array('param' => $param));
    }
    else {

      $uri = "$uri/{$param['customerId']}/cards";
    }

    if (!$isCardValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid card object', array('param' => $param));
    }
    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Update a card.
   *
   * Simple usage:
   *   $param['customerId'] = $customerId ;.
   *   $param['cardId'] = $cardId ;.
   *   $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array (.
   *     'card'        =>  array(.
   *       'name'        =>  'New name',.
   *       'number'      => '4543474002249996',.
   *       'expiryMonth' => 08,.
   *       'expiryYear'  => 2017,.
   *       'cvv'         => 956,.
   *     ).
   *   );.
   *   $updateCardObj = $Api->updateCard($param);.
   *
   * @param array $param
   *   Payload param for update a card.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function updateCard($param) {
    $this->flushState();
    $uri = $this->getUriCustomer();
    $hasError = FALSE;

    // $param['method'] = CheckoutapiClientAdapterConstant::API_PUT;
    $isCustomerIdValid = CheckoutapiClientValidationGW3::isCustomerIdValid($param);
    $isCardIdValid = CheckoutapiClientValidationGW3::isGetCardIdValid($param);

    if (!$isCustomerIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid customer id', array('param' => $param));

    } elseif (!$isCardIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid card id', array('param' => $param));
    }
    else {

      $uri = "$uri/{$param['customerId']}/cards/{$param['cardId']}";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Get a card.
   *
   * Simple usage:
   *   $param['customerId'] = $customerId ;.
   *   $param['cardId'] = $cardId ;.
   *   $getCardObj = $Api->getCard($param);.
   *
   * Required a customer id and a card id to work.
   *
   * @param array $param
   *   Payload param for getting a card info.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function getCard($param) {
    $this->flushState();
    $uri = $this->getUriCustomer();
    $hasError = FALSE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_GET;
    $isCustomerIdValid = CheckoutapiClientValidationGW3::isCustomerIdValid($param);
    $isCardIdValid = CheckoutapiClientValidationGW3::isGetCardIdValid($param);

    if (!$isCustomerIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid customer id', array('param' => $param));

    } elseif (!$isCardIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid card id', array('param' => $param));
    }
    else {

      $uri = "$uri/{$param['customerId']}/cards/{$param['cardId']}";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Get Card List.
   *
   * Simple usage:
   *   $param['customerId'] = $customerId ;.
   *   $getCardListObj = $Api->getCardList($param);.
   * Require a customer id.
   *
   * @param array $param
   *   Payload param for getting a list of cart.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function getCardList($param) {
    $this->flushState();
    $uri = $this->getUriCustomer();
    $hasError = FALSE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_GET;
    $isCustomerIdValid = CheckoutapiClientValidationGW3::isCustomerIdValid($param);

    if (!$isCustomerIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid customer id', array('param' => $param));

    }
    else {

      $uri = "$uri/{$param['customerId']}/cards";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Get Card List.
   *
   * Simple usage:
   *   $param['customerId'] = $customerId ;.
   *   $param['cardId'] = $cardId ;.
   *   $deleteCard = $Api->deleteCard($param);.
   *
   * @param array $param
   *   Payload param.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function deleteCard($param) {
    $this->flushState();
    $uri = $this->getUriCustomer();
    $hasError = FALSE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_DELETE;
    $isCustomerIdValid = CheckoutapiClientValidationGW3::isCustomerIdValid($param);
    $isCardIdValid = CheckoutapiClientValidationGW3::isGetCardIdValid($param);

    if (!$isCustomerIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid customer id', array('param' => $param));

    } elseif (!$isCardIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid card id', array('param' => $param));
    }
    else {

      $uri = "$uri/{$param['customerId']}/cards/{$param['cardId']}";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Get LocalPayment Provider list.
   *
   * Simple usage:
   *   $param['token'] = $sessionToken ;.
   *   $localPaymentListObj = $Api->getLocalPaymentList($param);.
   * Refer to create sesssionToken for getting the session token value.
   *
   * @param array $param
   *   Payload param for retriving a list of local payment provider.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function getLocalPaymentList($param) {
    $this->flushState();
    $uri = $this->getUriProvider();
    $hasError = FALSE;
    $isTokenValid = CheckoutapiClientValidationGW3::isSessionToken($param);
    $param['method'] = CheckoutapiClientAdapterConstant::API_GET;
    $delimiter = '/localpayments?';

    if (!$isTokenValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid session token', array('param' => $param));
    }
    else {

      $uri = "{$uri}{$delimiter}token={$param['token']}";
      $delimiter = '&';

      if (isset($param['countryCode'])) {
        $uri = "{$uri}{$delimiter}countryCode={$param['countryCode']}";
        $delimiter = '&';
      }

      if (isset($param['ip'])) {
        $uri = "{$uri}{$delimiter}ip={$param['ip']}";
        $delimiter = '&';
      }

      if (isset($param['limit'])) {
        $uri = "{$uri}{$delimiter}limit={$param['limit']}";
        $delimiter = '&';
      }

      if (isset($param['region'])) {
        $uri = "{$uri}{$delimiter}region={$param['region']}";
        $delimiter = '&';
      }

      if (isset($param['name'])) {
        $uri = "{$uri}{$delimiter}name={$param['name']}";

      }
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Get LocalPayment Provider.
   *
   * Simple usage:
   *   $param['token'] = $sessionToken ;.
   *   $param['providerId'] = $providerId ;.
   *   $localPaymentObj = $Api->getLocalPaymentProvider($param);.
   *
   * @param array $param
   *   PPyload param for getting a local payment provider detail.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function getLocalPaymentProvider($param) {
    $this->flushState();
    $uri = $this->getUriProvider();
    $hasError = FALSE;
    $isTokenValid = CheckoutapiClientValidationGW3::isSessionToken($param);
    $isValidProvider = CheckoutapiClientValidationGW3::isProvider($param);
    $param['method'] = CheckoutapiClientAdapterConstant::API_GET;
    $delimiter = '/localpayments/';

    if (!$isTokenValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid session token', array('param' => $param));
    }

    if (!$isValidProvider) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid provider id', array('param' => $param));
    }

    if (!$hasError) {
      $uri = "{$uri}{$delimiter}{$param['providerId']}?token={$param['token']}";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Get Card Provider list.
   *
   * Simple usage:
   *   $cardProviderListObj = $Api->getCardProvidersList($param);.
   *
   * @param array $param
   *   Payload param.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function getCardProvidersList($param) {
    $this->flushState();
    $uri = $this->getUriProvider() . '/cards';
    $hasError = FALSE;
    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Get a list of card provider.
   *
   * Simple usage:
   *   $param['providerId'] = $providerId ;.
   *   $cardProvidersObj = $Api->getCardProvider($param);.
   *
   * @param array $param
   *   Payload param for retriving a list of card by providers.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   */
  public function getCardProvider($param) {
    $this->flushState();
    $isValidProvider = CheckoutapiClientValidationGW3::isProvider($param);
    $uri = $this->getUriProvider() . '/cards';
    $hasError = FALSE;
    if (!$isValidProvider) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid provider id', array('param' => $param));
    }

    if (!$hasError) {
      $uri = "{$uri}/{$param['providerId']}";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Pdate Recurring Payment Plan.
   *
   * Updates the specified Recurring Payment Plan by setting the.
   * Values of the parameters passed.
   *
   * Simple usage:
   *  $param['planId'] = {$planId} ;.
   *  $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array (.
   *    'name'          =>  'New subscription name',.
   *    'planTrackId'   =>  'newPlanTrackId',.
   *    'autoCapTime'   =>  24,.
   *    'value'   =>  200,.
   *    'status'   =>  4.
   *  );.
   *  $updateCharge = $Api->updateCharge($param);.
   *
   * @param array $param
   *   Payload param.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function updatePaymentPlan($param) {
    $hasError = FALSE;

    $param['method'] = CheckoutapiClientAdapterConstant::API_PUT;
    $this->flushState();

    $uri = $this->getUriRecurringPayments() . '/plans';
    $isPlanIdValid = CheckoutapiClientValidationGW3::isPlanIdValid($param);

    if (!$isPlanIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid plan id', array('param' => $param));

    }
    else {

      $uri = "$uri/{$param['planId']}";
    }

    return $this->_responseUpdateStatus($this->request($uri, $param, !$hasError));

  }

  /**
   * Cancel a payment plan.
   *
   * This method can be call this way:
   *   $param['planId'] = {$planId} ;.
   *   CancelPaymentPlan = $Api->cancelPaymentPlan($param);.
   *
   * @param array $param
   *   Payload param for deleting a payment plan.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function cancelPaymentPlan($param) {
    $param['method'] = CheckoutapiClientAdapterConstant::API_DELETE;
    $this->flushState();
    $uri = $this->getUriRecurringPayments() . '/plans';
    $hasError = FALSE;
    $isPlanIdValid = CheckoutapiClientValidationGW3::isPlanIdValid($param);
    if (!$isPlanIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid plan id', array('param' => $param));
    }
    else {

      $uri = "$uri/{$param['planId']}";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Get payment plan.
   *
   * Simple usage:
   *   $param['planId'] = {planId} ;.
   *   $getPaymentPlan = $Api->getPaymentPlan($param);.
   *
   * @param array $param
   *   Payload param for returning a payment plan.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function getPaymentPlan($param) {
    $hasError = FALSE;

    $param['method'] = CheckoutapiClientAdapterConstant::API_GET;
    $this->flushState();
    $uri = $this->getUriRecurringPayments() . '/plans';
    $isPlanIdValid = CheckoutapiClientValidationGW3::isPlanIdValid($param);

    if (!$isPlanIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid plan id', array('param' => $param));
    }
    else {

      $uri = "$uri/{$param['customerId']}";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Pdate Recurring Customer Payment Plan.
   *
   * Updates the specified Recurring Customer Payment Plan by setting
   * The values of the parameters passed.
   *
   *  Simple usage:.
   *    $param['customerPlanId'] = {$customerPlanId} ;.
   *    $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array (.
   *      'cardId'   =>  'card_XXXXXXXX',.
   *      'status'   =>  1.
   *    );.
   *    $updateCharge = $Api->updateCharge($param);.
   *
   * @param array $param
   *   Payload param.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function updateCustomerPaymentPlan($param) {
    $hasError = FALSE;

    $param['method'] = CheckoutapiClientAdapterConstant::API_PUT;
    $this->flushState();

    $uri = $this->getUriRecurringPayments() . '/customers';
    $isCustomerPlanIdValid = CheckoutapiClientValidationGW3::isCustomerPlanIdValid($param);

    if (!$isCustomerPlanIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid customer plan id', array('param' => $param));

    }
    else {

      $uri = "$uri/{$param['customerPlanId']}";
    }

    return $this->responseUpdateStatus($this->request($uri, $param, !$hasError));

  }

  /**
   * Ancel a customer payment plan.
   *
   * This method can be call this way:
   *   $param['customerPlanId'] = {$customerPlanId} ;.
   *   CancelCustomerPaymentPlan = $Api->cancelCustomerPaymentPlan($param);.
   *
   * @param array $param
   *   Payload param for deleting a payment plan.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function cancelCustomerPaymentPlan($param) {
    $param['method'] = CheckoutapiClientAdapterConstant::API_DELETE;
    $this->flushState();
    $uri = $this->getUriRecurringPayments() . '/customers';
    $hasError = FALSE;
    $isCustomerPlanIdValid = CheckoutapiClientValidationGW3::isCustomerPlanIdValid($param);
    if (!$isCustomerPlanIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid customer plan id', array('param' => $param));
    }
    else {

      $uri = "$uri/{$param['customerPlanId']}";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Get customer payment plan.
   *
   * Simple usage:
   *   $param['customerPlanId'] = {customerPlanId} ;.
   *   $getCustomerPaymentPlan = $Api->getCustomerPaymentPlan($param);.
   *
   * @param array $param
   *   Payload param for returning a payment plan.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function getCustomerPaymentPlan($param) {
    $hasError = FALSE;

    $param['method'] = CheckoutapiClientAdapterConstant::API_GET;
    $this->flushState();
    $uri = $this->getUriRecurringPayments() . '/customers';
    $isCustomerPlanIdValid = CheckoutapiClientValidationGW3::isCustomerPlanIdValid($param);

    if (!$isCustomerPlanIdValid) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid plan id', array('param' => $param));
    }
    else {

      $uri = "$uri/{$param['customerPlanId']}";
    }

    return $this->request($uri, $param, !$hasError);

  }

  /**
   * Build up the request to the gateway.
   *
   * @param string $uri
   *   Endpoint to be used.
   * @param array $param
   *   Payload param.
   * @param bool $state
   *   If error occurred don't send charge.
   *
   * @return object
   *   CheckoutapiLibRespondObj.
   *
   * @throws Exception
   */
  public function request($uri, array $param, $state) {

    // @var CheckoutapiLibRespondObj $respond.
    $respond = CheckoutapiLibFactory::getSingletonInstance('CheckoutapiLibRespondObj');
    $this->setConfig($param);

    if (!isset($param[* @param array $postedParam
*   An array with the parameters that will be posted.])) {
      $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = array();
    }
    $param['rawpostedParam'] = $param[* @param array $postedParam
*   An array with the parameters that will be posted.];
    $param[* @param array $postedParam
*   An array with the parameters that will be posted.] = $this->getParser()->preparePosted($param[* @param array $postedParam
*   An array with the parameters that will be posted.]);

    if ($state) {
      $headers = $this->initHeader();
      $param['headers'] = $headers;

      // @var CheckoutapiClientAdapterAbstract $adapter.
      $adapter = $this->getAdapter($this->getProcessType(), array('uri' => $uri, 'config' => $param));

      if ($adapter) {
        $adapter->connect();
        $respondString = $adapter->request()->getRespond();
        $statusResponse = $adapter->getResourceInfo();
        $this->getParser()->setResourceInfo($statusResponse);
        $respond = $this->getParser()->parseToObj($respondString);

        if ($respond && isset($respond['errors']) && $respond->hasErrors()) {

          // @var CheckoutapiLibExceptionstate  $exceptionStateObj.
          $exceptionStateObj = $respond->getExceptionstate();
          $errors = $respond->getErrors()->toArray();
          $exceptionStateObj->flushState();

          foreach ($errors as $error) {
            $this->throwException($error, $respond->getErrors()->toArray());
          }
        } elseif ($respond && isset($respond['errorCode']) && $respond->hasErrorCode()) {
          // @var CheckoutapiLibExceptionstate  $exceptionStateObj.
          $exceptionStateObj = $respond->getExceptionstate();

          $this->throwException($respond->getMessage(), $respond->toArray());

        } elseif ($respond && $respond->getHttpStatus() != '200') {
          $this->throwException('Gateway is temporary down', $param);
        }

        $adapter->close();
      }

    }

    return $respond;

  }

  /**
   * Initialising  headers for transport layer.
   *
   * @return array
   *   A array for  headers value.
   */
   private function initHeader() {
    $headers = array('Authorization: ' . $this->getAuthorization());
    $this->setHeaders($headers);
    return $this->getHeaders();

  }

  /**
   * Getting which mode we are running live, preprod or dev.
   *
   * @param string $mode
   *   Setting in which mode will be the request.
   *
   * @throws Exception
   */
  public function setMode($mode) {

    $this->_mode = $mode;
    $this->setConfig(array('mode' => $mode));
  }

  /**
   * Return the mode  can be either dev or preprod or live.
   *
   * @return string
   *   A string .
   */
  public function getMode() {
    if (isset($this->_config['mode']) && $this->_config['mode']) {
      $this->_mode = $this->_config['mode'];
    }

    return $this->_mode;

  }

  /**
   * Method that set it charge url.
   *
   * @param string $uri
   *   Set the endpoint url.
   * @param string $sufix
   *   A sufix to the cart token.
   */
  public function setUriCharge($uri = '', $sufix = '') {
    $toSetUri = $uri;
    if (!$uri) {
      $toSetUri = $this->getUriPrefix() . 'charges';
    }

    if ($sufix) {
      $toSetUri .= "/$sufix";
    }

    $this->_uriCharge = $toSetUri;
  }

  /**
   * Return $uriCharge value.
   *
   * @return string
   *   A string.
   */
  public function getUriCharge() {
    return $this->_uriCharge;
  }

  /**
   * Get uri token.
   *
   * @param null|string
   *   The uri for the token.
   */
  public function setUriToken($uri = NULL) {
    $toSetUri = $uri;
    if (!$uri) {
      $toSetUri = $this->getUriPrefix() . 'tokens';
    }

    $this->_uriToken = $toSetUri;
  }

  /**
   * Return uri token.
   *
   * @return string
   *   A string.
   */
  public function getUriToken() {
    return $this->_uriToken;

  }

  /**
   * Get customer uri.
   *
   * @param null|string
   *   Endpoint url for customer.
   */
  public function setUriCustomer($uri = NULL) {
    $toSetUri = $uri;
    if (!$uri) {
      $toSetUri = $this->getUriPrefix() . 'customers';
    }

    $this->_uriCustomer = $toSetUri;
  }

  /**
   * Return customer uri.
   *
   * @return string
   *   A string .
   */
  public function getUriCustomer() {
    return $this->_uriCustomer;

  }

  /**
   * Get provider uri.
   *
   * @param null|string
   *   Endpoint url for provider.
   */
  public function setUriProvider($uri = NULL) {
    $toSetUri = $uri;
    if (!$uri) {
      $toSetUri = $this->getUriPrefix() . 'providers';
    }

    $this->_uriProvider = $toSetUri;
  }

  /**
   * Return provider uri.
   *
   * @return string
   *   A string.
   */
  public function getUriProvider() {
    return $this->_uriProvider;

  }

  /**
   * Get uri recurring payments.
   *
   * @param null|string
   *   The uri for the recurring payments.
   */
  public function setUriRecurringPayments($uri = NULL) {
    $toSetUri = $uri;
    if (!$uri) {
      $toSetUri = $this->getUriPrefix() . 'recurringPayments';
    }

    $this->_uriRecurringPayments = $toSetUri;
  }

  /**
   * Return uri recurring payments.
   *
   * @return string
   *   A string.
   */
  public function getUriRecurringPayments() {
    return $this->_uriRecurringPayments;

  }

  /**
   * Return which uri prefix to be used base on mode type.
   *
   * @return string
   *   A string.
   */
  private function getUriPrefix() {
    $mode = strtolower($this->getMode());
    switch ($mode) {
      case 'live':
        $prefix = CheckoutapiClientConstant::APIGW3_URI_PREFIX_LIVE . CheckoutapiClientConstant::VERSION . '/';
        break;
      default:
        $prefix = CheckoutapiClientConstant::APIGW3_URI_PREFIX_SANDBOX . CheckoutapiClientConstant::VERSION . '/';
        break;
    }
    return $prefix;

  }

  /**
   * Setting exception state log.
   *
   * @param string $message
   *   Error message.
   * @param array $stackTrace
   *   Statck trace.
   * @param bool $error
   *   If it's an error.
   */
  private function throwException($message, array $stackTrace, $error = TRUE) {
    $this->exception($message, $stackTrace, $error);
  }

  /**
   * Lushing all config.
   *
   * @todo need to remove singleton concept causing issue
   *
   * @throws Exception
   */
  public function flushState() {
    parent::flushState();
    if ($mode = $this->getMode()) {
      $this->setMode($mode);
    }
    $this->setUriCharge();
    $this->setUriToken();
    $this->setUriCustomer();
    $this->setUriProvider();
    $this->setUriRecurringPayments();

  }

  /**
   * @param mixed $config
   *   Array of configuration.
   *
   * @return string
   *   A string for script tag.
   */
  public function getJsConfig($config) {
    $renderMode = isset($config['renderMode']) ? $config['renderMode'] : 0;
    $config['widgetRenderedEvent'] = isset($config['widgetRenderedEvent']) ? $config['widgetRenderedEvent'] : '';
    $config['cardTokenReceivedEvent'] = isset($config['cardTokenReceivedEvent']) ? $config['cardTokenReceivedEvent'] : '';
    $config['readyEvent'] = isset($config['readyEvent']) ? $config['readyEvent'] : '';
    $script = " window.CKOConfig = {
                debugMode: FALSE,
                renderMode:{$renderMode},
                publicKey: '{$config['publicKey']}',
                customerEmail: '{$config['email']}',
                namespace: 'CheckoutIntegration',
                customerName: '{$config['name']}',
                value: '{$config['amount']}',
                currency: '{$config['currency']}',
                widgetContainerSelector: '{$config['widgetSelector']}',
                cardTokenReceived: function(event) { {$config['cardTokenReceivedEvent']}
                },
                 widgetRendered: function (event) { {$config['widgetRenderedEvent']}
                 },

                ready: function() { {$config['readyEvent']};

                }
            }";
    return $script;

  }

  /**
   * ChargeToObj.
   *
   * @param mixed $charge
   *   Var for charge.
   */
  public function chargeToObj($charge) {
    if ($charge) {
      $response = $this->_responseUpdateStatus($this->getParser()->parseToObj($charge));

      return $response;

    }
    return NULL;

  }

  /**
   * ResponseUpdateStatus.
   *
   * @param mixed $response
   *   Var for response.
   *
   * @return mixed
   *   A response.
   */
  private function _responseUpdateStatus($response) {

    if ($response->hasStatus() && $response->hasHttpStatus() && $response->hasHttpStatus() == 200) {
      $response->setCaptured($response->getStatus() == 'Captured');
      $response->setAuthorised($response->getStatus() == 'Authorised');
      $response->setRefunded($response->getStatus() == 'Refunded');
      $response->setVoided($response->getStatus() == 'Voided');
      $response->setExpired($response->getStatus() == 'Expired');
      $response->setDecline($response->getStatus() == 'Decline');
    } elseif ($response->hasMessage() && !$response->hasErrorCode()) {
      $responseMessage = $response->getMessage();
      $responseMessage->setCaptured($responseMessage->getStatus() == 'Captured');
      $responseMessage->setAuthorised($responseMessage->getStatus() == 'Authorised');
      $responseMessage->setRefunded($responseMessage->getStatus() == 'Refunded');
      $responseMessage->setVoided($responseMessage->getStatus() == 'Voided');
      $responseMessage->setExpired($responseMessage->getStatus() == 'Expired');
      $responseMessage->setDecline($responseMessage->getStatus() == 'Decline');
      return $responseMessage;

    }

    return $response;

  }

  /**
   * ValidateRequest.
   *
   * @param mixed $validationFields
   *   Var for validationFields.
   * @param mixed $chargeObject
   *   Var for chargeObject.
   *
   * @return mixed
   *   A formatted list.
   */
  public static function validateRequest($validationFields, $chargeObject) {

    $result = array('status' => TRUE, 'message' => array());
    if (isset($validationFields['currency']) && strtolower($validationFields['currency']) != strtolower($chargeObject->getCurrency())) {
      $result['status'] = FALSE;
      $result['message'][] = 'Currency mismatch' . ' Charge currency: ' . $chargeObject->getCurrency() . ' and order currency: ' . $validationFields['currency'];
    }

    if (isset($validationFields['value']) && $validationFields['value'] != $chargeObject->getValue()) {
      $result['status'] = FALSE;
      $result['message'][] = 'Amount mismatch ' . ' Charge Amount:' . $chargeObject->getValue() . ' and order amount: ' . $validationFields['value'];

    }

    if (isset($validationFields['trackId']) && $validationFields['trackId'] != $chargeObject->getTrackId()) {
      $result['status'] = FALSE;
      $result['message'][] = 'Track id mismatch' . ' Charge Track id:' . $chargeObject->getTrackId() . ' and order Track id: ' . $validationFields['trackId'];

    }

    return $result;

  }

  /**
   * ValueToDecimal.
   *
   * @param mixed $amount
   *   Var for amount.
   * @param mixed $currencySymbol
   *   Var for currencySymbol.
   *
   * @return int
   *   A formatted list.
   */
  public function valueToDecimal($amount, $currencySymbol) {
    $currency = strtoupper($currencySymbol);
    $threeDecimalCurrencyList = array('BHD', 'LYD', 'JOD', 'IQD', 'KWD', 'OMR', 'TND');
    $zeroDecimalCurencyList = array('BYR', 'XOF', 'BIF', 'XAF', 'KMF', 'XOF', 'DJF', 'XPF', 'GNF', 'JPY', 'KRW', 'PYG', 'RWF', 'VUV', 'VND');

    if (in_array($currency, $threeDecimalCurrencyList)) {
      $value = (int) ($amount * 1000);

    } elseif (in_array($currency, $zeroDecimalCurencyList)) {
      $value = floor($amount);

    }
    else {

      $value = round($amount * 100);

    }

    return $value;

  }

  /**
   * DecimalToValue.
   *
   * @param mixed $amount
   *   Var for amount.
   * @param mixed $currencySymbol
   *   Var for currencySymbol.
   *
   * @return string
   *   A formatted list.
   */
  public function decimalToValue($amount, $currencySymbol) {
    $currency = strtoupper($currencySymbol);
    $threeDecimalCurrencyList = array('BHD', 'LYD', 'JOD', 'IQD', 'KWD', 'OMR', 'TND');
    $zeroDecimalCurencyList = array('BYR', 'XOF', 'BIF', 'XAF', 'KMF', 'XOF', 'DJF', 'XPF', 'GNF', 'JPY', 'KRW', 'PYG', 'RWF', 'VUV', 'VND');

    if (in_array($currency, $threeDecimalCurrencyList)) {
      $value = $amount / 1000;

    } elseif (in_array($currency, $zeroDecimalCurencyList)) {
      $value = $amount;

    }
    else {
      $value = $amount / 100;

    }

    return $value;

  }

  /**
   * Check charge response.
   *
   * @return bool
   *   If response is approve or has error, return bool.
   */
  public function isAuthorise($response) {
    $result = FALSE;
    $hasError = $this->isError($response);
    $isApprove = $this->isApprove($response);

    if (!$hasError && $isApprove) {
      $result = TRUE;
    }

    return $result;

  }

  /**
   * Check if response contain error code.
   *
   * @return bool
   *   A bool.
   */
  protected function isError($response) {
    $hasError = FALSE;

    if ($response->getErrorCode()) {
      $hasError = TRUE;
    }

    return $hasError;

  }

  /**
   * Check if response is approve.
   *
   * @return bool
   *   A bool.
   */
  protected function isApprove($response) {
    $result = FALSE;

    if ($response->getResponseCode() == CheckoutapiClientConstant::RESPONSE_CODE_APPROVED
      || $response->getResponseCode() == CheckoutapiClientConstant::RESPONSE_CODE_APPROVED_RISK
    ) {
      $result = TRUE;
    }

    return $result;

  }

  /**
   * Return eventId if charge has error.
   *
   * @return mixed
   *   ChargeID if charge is decline.
   */
  public function getResponseId($response) {
    $isError = $this->isError($response);

    if ($isError) {
      $result = array(
        'message' => $response->getMessage(),
        'eventId' => $response->getEventId(),
      );

      return $result;

    }
    else {
      $result = array(
        'responseMessage' => $response->getResponseMessage(),
        'id' => $response->getId(),
      );

      return $result;

    }
  }

  /**
   * Check if response is flag.
   *
   * @return response
   *   Message.
   */
  public function isFlagResponse($response) {
    $result = FALSE;

    if ($response->getResponseCode() == CheckoutapiClientConstant::RESPONSE_CODE_APPROVED_RISK) {
      $result = array(
        'responseMessage' => $response->getResponseMessage(),
      );
    }

    return $result;
  }

}
