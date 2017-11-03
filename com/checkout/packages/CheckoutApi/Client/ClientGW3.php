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
 * class CheckoutapiClientClientgw3.
 * This class in an interface to the Checkout Gateway 3.0.
 * It provide access to all endpoint setup by the gateway.
 * The simplest usage would be example creating a card token:.
 *      $secretKey = 'sk_test_CC937715-4F68-4306-BCBE-640B249A4D50';.
 *      $cardTokenConfig = array();.
 *      $cardTokenConfig['authorization'] = "$publicKey" ;.
 *      $Api = CheckoutapiApi::getApi();.
 *      $cardTokenConfig['postedParam'] = array (.
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
 *     if($respondCardToken->isValid()) {.
 *        echo $respondCardToken->getId();.
 *     }
     else {.
 *          echo $respondCardToken->printError();.
 *      }.
 *
 *   Those couple of lines , will create an instance of the .
 *   CheckoutapiClientClientgw3. It will then will request a card 
 *   token to the token, with a set of arguments. if the repond is 
 *   valid , we can print out the result else we can print out .
 *   the errors.
 *
 * @category Client
 * @version Release: @package_version@
 */
class CheckoutapiClientClientGW3 extends CheckoutapiClientClient {
  
  /**
   * FFFKO.
   *
   * @var string $uriCharge 
   *   To store uri for charge url.
   **/
  protected $uriCharge = NULL;

  /**
   * FFFKO.
   *
   * * .@var string $uriToken 
   *   To store uri for token url.
   **/
  protected $uriToken = NULL;

  /**
   * FFFKO.
   *
   * @var string $uriCustomer 
   *   To store uri for customer url.
   */
  protected $uriCustomer = NULL;

  /**
   * FFFKO.
   *
   * @var string $uriProvider to store uri for customer url
   */
  protected $uriProvider = NULL;
  
  /**
   * FFFKO.
   *
   * @var string  $mode dev|preprod|live the url that the library will use , dev , preprod or live
   */
  private $mode = 'dev';

  /**
   * Onstructor.
   *
   * @param array $config
   *   configuration for class.
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
   * Reate Card Token.
   *
   * @param array $param
   *   payload for creating a card token parameter.
   *
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * Simple usage:.
   *          $param['postedParam'] = array (.
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
   */
  public function getCardToken(array $param) {
    $hasError = FALSE;
    $param['postedParam']['type'] = CheckoutapiClientConstant::TOKEN_CARD_TYPE;
    $postedParam = $param['postedParam'];
    $this->flushState();

    CheckoutapiClientValidationGW3::isEmailValid($postedParam);
    CheckoutapiClientValidationGW3::isCardValid($postedParam);

    $uri = $this->getUriToken() . '/card';

    return $this->request($uri, $param, !$hasError);
  }

  /**
   * Reate payment token.
   *
   * @param array $param
   *   payload param.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * Simple usage:.
   *      $sessionConfig['postedParam'] = array( "value"=>100, "currency"=>"GBP");.
   *      $sessionTokenObj = $Api->getPaymentToken($sessionConfig);.
   * Use by having, first an instance of the gateway 3.0 and set of argument base on documentation for creating a session token.
   */
  public function getPaymentToken(array $param) {
    $hasError = FALSE;
    $param['postedParam']['type'] = CheckoutapiClientConstant::TOKEN_SESSION_TYPE;
    $postedParam = $param['postedParam'];
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
   * Reate Charge.
   *
   * @param array $param
   *   payload param.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * This methods can be call to create charge for checkout.com gateway 3.0 by passing
   * full card details :.
   *  $param['postedParam'] = array ( 'email'=>'dhiraj.@checkout.com',
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
   * or by passing a card token:.
   *  $param['postedParam'] = array ( 'email'=>'dhiraj.@checkout.com',
   *                                   'value'=>100,.
   *                                    'currency'=>'usd',.
   *                                   'description'=>'desc',.
   *                                   'caputure'=>FALSE,.
   *                                    'cardToken'=>'card_tok_2d033cf7-1542-4a3d-bd08-bd9d26533551'.
   *                                   ).
   *
   * or by passing a card id:.
   * $param['postedParam'] = array ( 'email'=>'dhiraj.@checkout.com',
   *                                   'value'=>100,.
   *                                   'currency'=>'usd',.
   *                                   'description'=>'desc',.
   *                                   'caputure'=>FALSE,.
   *                                   'cardId'=>'card_fb10a0a5-05ef-4254-ac85-3aa221e8d50d'.
   *                                   ).
   * and then just call the method:.
   *       $charge = $Api->createCharge($param);.
   */
  public function createCharge(array $param) {
    $hasError = FALSE;
    $param['postedParam']['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $postedParam = $param['postedParam'];
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
        // unset($param['postedParam']['card']);
      }
      $this->setUriCharge('', 'token');

    } elseif ($isCardValid) {

      if (isset($postedParam['token'])) {
        $this->throwException('unset invalid token object', array('param' => $postedParam), FALSE);
        unset($param['postedParam']['token']);
      }
      $this->setUriCharge('', 'card');

    } elseif ($isCardIdValid) {
      $this->setUriCharge('', 'card');

      if (isset($postedParam['token'])) {
        $this->throwException('unset invalid token object', array('param' => $postedParam), FALSE);
        unset($param['postedParam']['token']);
      }

      if (isset($postedParam['card'])) {
        $this->throwException('unset invalid token object', array('param' => $postedParam), FALSE);

        if (isset($param['postedParam']['card']['name'])) {
          unset($param['postedParam']['card']['name']);
        }

        if (isset($param['postedParam']['card']['number'])) {
          unset($param['postedParam']['card']['number']);
        }

        if (isset($param['postedParam']['card']['expiryMonth'])) {
          unset($param['postedParam']['card']['expiryMonth']);
        }

        if (isset($param['postedParam']['card']['expiryYear'])) {
          unset($param['postedParam']['card']['expiryYear']);
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
    $param['postedParam']['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
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
   * to refund.
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
   *  or void a charge that has been capture.
   *
   * @param array $param
   *   payload param for refund a charge.
   *
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * Simple usage:.
   *      $param['postedParam'] = array (.
   *        'value'=>150.
   *      );.
   *      $refundCharge = $Api->refundCharge($param);.
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
    $param['postedParam']['type'] = CheckoutapiClientConstant::CHARGE_TYPE;

    $param['method'] = CheckoutapiClientAdapterConstant::API_POST;
    $postedParam = $param['postedParam'];

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
   * @param array $param
   *   payload param for void a charge.
   *
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * Simple usage:.
   *      $param['postedParam'] = array ('value'=>150);.
   *      $refundCharge = $Api->refundCharge($param);.
   */
  public function voidCharge($param) {
    $hasError = FALSE;
    $param['postedParam']['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $postedParam = $param['postedParam'];
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
   * @param array $param
   *   payload param for caputring a charge.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * Simple usage:.
   *      $param['postedParam'] = array ( 'value'=>150 );.
   *      captureCharge = $Api->captureCharge($param);.
   */
  public function captureCharge($param) {
    $hasError = FALSE;
    $param['postedParam']['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_POST;
    $postedParam = $param['postedParam'];
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
   * @param array $param
   *   payload param.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *  Simple usage:.
   *      $param['postedParam'] = array ('description'=> 'dhiraj is doing some test');.
   *      $updateCharge = $Api->updateCharge($param);.
   */
  public function updateCharge($param) {
    $hasError = FALSE;
    $param['postedParam']['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
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
   * @param array $param
   *   payload param.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *  Simple usage:.
   *
   *      $updateCharge = $Api->updateMetadata($param array('keycode'=>$value));.
   */
  public function updateMetadata($chargeObj, $metaData = array()) {
    $hasError = FALSE;
    $param['postedParam']['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_PUT;

    $this->flushState();

    $chargeId = $chargeObj->getId();
    $metaArray = array();

    if ($chargeObj->getMetadata()) {
      $metaArray = $chargeObj->getMetadata()->toArray();
    }

    $newMetadata = array_merge($metaArray, $metaData);

    $param['postedParam']['metadata'] = $newMetadata;
    $uri = $this->getUriCharge();
    $uri = "$uri/{$chargeId}";

    return $this->request($uri, $param, !$hasError);
  }

  /**
   * Pdate Trackid   Charge.
   *
   * Updates the specified Card Charge by setting the values of the parameters passed.
   *
   * @param array $param
   *   payload param.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *  Simple usage:.
   *
   *      $updateCharge = $Api->updateTrackId($chargeObj, $trackId);.
   */
  public function updateTrackId($chargeObj, $trackId) {
    $hasError = FALSE;
    $param['postedParam']['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_PUT;

    $this->flushState();

    $chargeId = $chargeObj->getId();

    $param['postedParam']['trackId'] = $trackId;
    $uri = $this->getUriCharge();
    $uri = "$uri/{$chargeId}";

    return $this->request($uri, $param, !$hasError);
  }

  /**
   * Pdate PaymentToken Charge.
   *
   * Updates the specified Card Charge by setting the values of the parameters passed.
   *
   * @param array $param
   *   payload param.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *  Simple usage:.
   *
   *      $updatePaymentToken = $Api->updatePaymentToken($paymentToken);.
   */
  public function updatePaymentToken($param) {
    $hasError = FALSE;
    $param['postedParam']['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_PUT;

    $this->flushState();

    $uri = $this->getUriToken() . "/payment/{$param['paymentToken']}";

    return $this->request($uri, $param, !$hasError);
  }

  /**
   * Et   Charge.
   *
   * Get the specified Card Charge by setting the values of the parameters passed.
   *
   * @param array $param
   *   payload param.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *  Simple usage:.
   *      $param['postedParam'] = array ('description'=> 'dhiraj is doing some test');.
   *      $updateCharge = $Api->updateCharge($param);.
   */
  public function getCharge($param) {
    $hasError = FALSE;
    $param['postedParam']['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
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
   * FFFetChargeHistory.
   *
   * @param mixed $param
   *   Var for param.
   */
  public function getChargeHistory($param) {

    $hasError = FALSE;
    $param['postedParam']['type'] = CheckoutapiClientConstant::CHARGE_TYPE;
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
   * Reate LocalPayment Charge.
   *
   * Creates a LocalPayment Charge using a Session Token and.
   *
   * @param array $param
   *   payload param for creating a localpayment.
   * @return CheckoutapiLibRespondObj
   * This can be call in this way:.
   *      $chargeLocalPaymentConfig['authorization'] = $publicKey ;.
   *      $param['postedParam'] = array(.
   *               'email'        =>  'dhiraj.checkout@checkout.com',
   *               'token'        =>   $Api->getSessionToken($sessionConfig),.
   *               'localPayment' =>  array(.
   *                                      'lppId'  => $Api->getLocalPaymentProvider($localPaymentConfig)->getId().
   *                                   ).
   *       ) ;.
   *      $chargeLocalPaymentObj = $Api->createLocalPaymentCharge($chargeLocalPaymentConfig);.
   */
  public function createLocalPaymentCharge($param) {
    $hasError = FALSE;
    $param['postedParam']['type'] = CheckoutapiClientConstant::LOCALPAYMENT_CHARGE_TYPE;
    $postedParam = $param['postedParam'];
    $this->flushState();
    $uri = $this->getUriCharge();
    $isValidEmail = CheckoutapiClientValidationGW3::isEmailValid($postedParam);
    $isValidSessionToken = CheckoutapiClientValidationGW3::isSessionToken($postedParam);
    $isValidLocalPaymentHash = CheckoutapiClientValidationGW3::isLocalPyamentHashValid($postedParam);
    $param['method'] = CheckoutapiClientAdapterConstant::API_POST;
    if (!$isValidEmail) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid email address', array('postedParam' => $postedParam));
    }

    if (!$isValidSessionToken) {
      $hasError = TRUE;
      $this->throwException('Please provide a valid session token', array('postedParam' => $postedParam));
    }

    if (!$isValidLocalPaymentHash) {
      $hasError = TRUE;
      $this->throwException('Please provide a local payment hash', array('postedParam' => $postedParam));
    }

    if (!isset($param['postedParam']['localPayment']['userData'])) {
      $param['postedParam']['localPayment']['userData'] = '{}';
    }
    return $this->request($uri, $param, !$hasError);
  }

  /**
   * Reate a customer.
   *
   * @param array $param
   *   payload param for creating a customer.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   * This method can be call in the following way:.
   *      $customerConfig['postedParam'] = array (.
   *                                           'email'        => 'dhiraj.@checkout.com',
   *                                           'name'         => 'test customer',.
   *                                           'description'  => 'desc',.
   *                                           'card'         =>  array(.
   *                                                               'name'        => 'test name',.
   *                                                               'number'      => '4543474002249996',.
   *                                                               'expiryMonth' => 06,.
   *                                                               'expiryYear'  => 2017,.
   *                                                               'cvv'         => 956,.
   *
   *                                                              ).
   *                                          );.
   *      $customer = $Api->createCustomer($customerConfig);.
   */
  public function createCustomer($param) {
    $hasError = FALSE;
    $param['method'] = CheckoutapiClientAdapterConstant::API_POST;
    $postedParam = $param['postedParam'];
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
        unset($param['postedParam']['card']);
      }
    } elseif ($isCardValid) {
      if (isset($postedParam['token'])) {
        $this->throwException('unsetting token ', array('param' => $param), FALSE);
        unset($param['postedParam']['token']);
      }
    }
    else {
      $hasError = TRUE;
      $this->throwException('Please provide a valid card detail or card token', array('param' => $param));
    }

    return $this->request($uri, $param, !$hasError);
  }

  /**
   * Et Customer.
   *
   * @param array $param
   *   payload param for returning a single customer.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * Simple usage :.
   *      $param['customerId'] = {customerId} ;.
   *      $getCustomer = $Api->getCustomer($param);.
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
   * @param array $param
   *   payload param for updating.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   * This method can be call in the following way:.
   *
   *      $param['customerId'] = {$customerId} ;.
   *      $param['postedParam'] = array (.
   *                          'email'         =>  'dhiraj.@checkout.com',
   *                          'name'          =>  'customer name',.
   *                          'description'   =>  'desc',.
   *                          'card'          =>   array(.
   *                                                      'name'        =>  'test name',.
   *                                                      'number'      =>  '4543474002249996',.
   *                                                      'expiryMonth' =>  06,.
   *                                                      'expiryYear'  =>  2017,.
   *                                                      'cvv'         =>  956,.
   *
   *                                                       ).
   *                          );.
   *      $customerUpdate = $Api->updateCustomer($param);.
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
   * Etting a list of customer.
   *
   * @param array $param
   *   payload param for getting list of customer.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *  Simple Usage:.
   *       $param['count'] = 100 ;.
   *       $param['from_date'] = '09/30/2014' ;.
   *       $param['to_date'] = '10/02/2014' ;.
   *       $customerUpdate = $Api->getListCustomer($param);.
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
   * Elete a customer.
   *
   * @param array $param
   *   payload param for deleteing a customer.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   * This method can be call this way:.
   *      $param['customerId'] = {$customerId} ;.
   *      $deleteCustomer = $Api->deleteCustomer($param);.
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
   * @param array $param
   *   payload param for creating a card.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * Simple usage:.
   *
   *      $param['customerId'] = $Api->createCustomer($customerConfig)->getId() ;.
   *      $param['postedParam'] = array (.
   *               'customerID'=> $customerId,.
   *               'card' => array(.
   *               'name'=>'test name',.
   *               'number' => '4543474002249996',.
   *               'expiryMonth' => 06,.
   *               'expiryYear' => 2017,.
   *               'cvv' => 956,.
   *               ).
   *       );.
   *      $cardObj = $Api->createCard($param);.
   * The creadCard method can be call this way and it required a customer id.
   */
  public function createCard($param) {

    $this->flushState();
    $uri = $this->getUriCustomer();
    $hasError = FALSE;
    $postedParam = $param['postedParam'];
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
   * Pdate a card.
   *
   * @param array $param
   *   payload param for update a card.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *  Simple usage:.
   *      $param['customerId'] = $customerId ;.
   *       $param['cardId'] = $cardId ;.
   *      $param['postedParam'] = array (.
   *                              'card'        =>  array(.
   *                              'name'        =>  'New name',.
   *                              'number'      => '4543474002249996',.
   *                              'expiryMonth' => 08,.
   *                              'expiryYear'  => 2017,.
   *                              'cvv'         => 956,.
   *                              ).
   *                  );.
   *      $updateCardObj = $Api->updateCard($param);.
   */
  public function updateCard($param) {
    $this->flushState();
    $uri = $this->getUriCustomer();
    $hasError = FALSE;

    //  $param['method'] = CheckoutapiClientAdapterConstant::API_PUT;
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
   * Et a card.
   *
   * @param array $param
   *   payload param for getting a card info.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * Simple usage:.
   *       $param['customerId'] = $customerId ;.
   *       $param['cardId'] = $cardId ;.
   *       $getCardObj = $Api->getCard($param);.
   *
   * Required a customer id and a card id to work.
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
   * Et Card List.
   *
   * @param array $param
   *   payload param for getting a list of cart.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * Simple usage:.
   *      $param['customerId'] = $customerId ;.
   *      $getCardListObj = $Api->getCardList($param);.
   * Require a customer id.
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
   * Et Card List.
   *
   * @param array $param
   *   payload param.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * Simple usage:.
   *       $param['customerId'] = $customerId ;.
   *       $param['cardId'] = $cardId ;.
   *       $deleteCard = $Api->deleteCard($param);.
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
   * Et LocalPayment Provider list.
   *
   * @param array $param
   *   payload param for retriving a list of local payment provider.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * Simple usage:.
   *       $param['token'] = $sessionToken ;.
   *       $localPaymentListObj = $Api->getLocalPaymentList($param);.
   * refer to create sesssionToken for getting the session token value.
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
   * Et LocalPayment Provider.
   *
   * @param array $param
   *   payload param for getting a local payment provider dettail.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * Simple usage:.
   *          $param['token'] = $sessionToken ;.
   *          $param['providerId'] = $providerId ;.
   *          $localPaymentObj = $Api->getLocalPaymentProvider($param);.
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
   * Et Card Provider list.
   *
   * @param array $param
   *   payload param.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * Simple usage:.
   *       $cardProviderListObj = $Api->getCardProvidersList($param);.
   */
  public function getCardProvidersList($param) {
    $this->flushState();
    $uri = $this->getUriProvider() . '/cards';
    $hasError = FALSE;
    return $this->request($uri, $param, !$hasError);
  }

  /**
   * Et a list of card provider.
   *
   * @param array $param
   *   Payload param for retriving a list of card by providers.
   * @return CheckoutapiLibRespondObj
   *
   * Simple usage:.
   *      $param['providerId'] = $providerId ;.
   *      $cardProvidersObj = $Api->getCardProvider($param);.
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
   * Pdate   Recurring Payment Plan.
   *
   * Updates the specified Recurring Payment Plan by setting the.
   * values of the parameters passed.
   *
   * @param array $param
   *   Payload param.
   *
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *  Simple usage:.
   *      $param['planId'] = {$planId} ;.
   *      $param['postedParam'] = array (.
   *                          'name'          =>  'New subscription name',.
   *                          'planTrackId'   =>  'newPlanTrackId',.
   *                          'autoCapTime'   =>  24,.
   *                          'value'   =>  200,.
   *                          'status'   =>  4.
   *                          );.
   *      $updateCharge = $Api->updateCharge($param);.
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
   * Ancel a payment plan.
   *
   * @param array $param
   *   payload param for deleting a payment plan.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   * This method can be call this way:.
   *      $param['planId'] = {$planId} ;.
   *      cancelPaymentPlan = $Api->cancelPaymentPlan($param);.
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
   * Et payment plan.
   *
   * @param array $param
   *   payload param for returning a payment plan.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * Simple usage :.
   *      $param['planId'] = {planId} ;.
   *      $getPaymentPlan = $Api->getPaymentPlan($param);.
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
   * Pdate   Recurring Customer Payment Plan.
   *
   * Updates the specified Recurring Customer Payment Plan by setting the values of the parameters passed.
   *
   * @param array $param
   *   payload param.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *  Simple usage:.
   *      $param['customerPlanId'] = {$customerPlanId} ;.
   *      $param['postedParam'] = array (.
   *                          'cardId'   =>  'card_XXXXXXXX',.
   *                          'status'   =>  1.
   *                          );.
   *      $updateCharge = $Api->updateCharge($param);.
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
   * @param array $param
   *   payload param for deleting a payment plan.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   * This method can be call this way:.
   *      $param['customerPlanId'] = {$customerPlanId} ;.
   *      cancelCustomerPaymentPlan = $Api->cancelCustomerPaymentPlan($param);.
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
   * Et customer payment plan.
   *
   * @param array $param
   *   payload param for returning a payment plan.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   *
   * Simple usage :.
   *      $param['customerPlanId'] = {customerPlanId} ;.
   *      $getCustomerPaymentPlan = $Api->getCustomerPaymentPlan($param);.
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
   * Uild up the request to the gateway.
   *
   * @param string $uri
   *   endpoint to be used.
   * @param array $param
   *   payload param.
   * @param bool $state
   *   if error occurred don't send charge.
   * @return CheckoutapiLibRespondObj
   *
   * @throws Exception
   */
  public function request($uri, array $param, $state) {

    /**
     * FFFKO.
     *
     * @var CheckoutapiLibRespondObj $respond
     */
    $respond = CheckoutapiLibFactory::getSingletonInstance('CheckoutapiLibRespondObj');
    $this->setConfig($param);

    if (!isset($param['postedParam'])) {
      $param['postedParam'] = array();
    }
    $param['rawpostedParam'] = $param['postedParam'];
    $param['postedParam'] = $this->getParser()->preparePosted($param['postedParam']);

    if ($state) {
      $headers = $this->initHeader();
      $param['headers'] = $headers;

      /**
       * FFFKO.
       *
       * @var CheckoutapiClientAdapterAbstract $adapter
       */
      $adapter = $this->getAdapter($this->getProcessType(), array('uri' => $uri, 'config' => $param));

      if ($adapter) {
        $adapter->connect();
        $respondString = $adapter->request()->getRespond();
        $statusResponse = $adapter->getResourceInfo();
        $this->getParser()->setResourceInfo($statusResponse);
        $respond = $this->getParser()->parseToObj($respondString);

        if ($respond && isset($respond['errors']) && $respond->hasErrors()) {

          /**
           * FFFKO.
           *
           * @var CheckoutapiLibExceptionstate  $exceptionStateObj
           */
          $exceptionStateObj = $respond->getExceptionstate();
          $errors = $respond->getErrors()->toArray();
          $exceptionStateObj->flushState();

          foreach ($errors as $error) {
            $this->throwException($error, $respond->getErrors()->toArray());
          }
        } elseif ($respond && isset($respond['errorCode']) && $respond->hasErrorCode()) {
          /**
           * FFFKO.
           *
           * @var CheckoutapiLibExceptionstate  $exceptionStateObj
           */
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
   * Nitialising  headers for transport layer.
   *
   * @return array headers value
   */
  private function initHeader() {
    $headers = array('Authorization: ' . $this->getAuthorization());
    $this->setHeaders($headers);
    return $this->getHeaders();
  }

  /**
   * Etting which mode we are running live, preprod or dev.
   *
   * @param string $mode
   *   setting in which mode will be the request.
   * @throws Exception
   */
  public function setMode($mode) {

    $this->_mode = $mode;
    $this->setConfig(array('mode' => $mode));
  }

  /**
   * Eturn the mode  can be either dev or preprod or live.
   *
   * @return string
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
   *   set the endpoint url.
   * @param string $sufix
   *   a sufix to the cart token.
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
   * Eturn $uriCharge value.
   *
   * @return string
   */
  public function getUriCharge() {
    return $this->_uriCharge;
  }

  /**
   * Et uri token.
   *
   * @param null|string $uri
   *   the uri for the token.
   */
  public function setUriToken($uri = NULL) {
    $toSetUri = $uri;
    if (!$uri) {
      $toSetUri = $this->getUriPrefix() . 'tokens';
    }

    $this->_uriToken = $toSetUri;
  }

  /**
   * Eturn uri token.
   *
   * @return string
   */
  public function getUriToken() {
    return $this->_uriToken;
  }

  /**
   * Et customer uri.
   *
   * @param null|string $uri
   *   endpoint url for customer.
   */
  public function setUriCustomer($uri = NULL) {
    $toSetUri = $uri;
    if (!$uri) {
      $toSetUri = $this->getUriPrefix() . 'customers';
    }

    $this->_uriCustomer = $toSetUri;
  }

  /**
   * Eturn customer uri.
   *
   * @return string
   */
  public function getUriCustomer() {
    return $this->_uriCustomer;
  }

  /**
   * Et provider uri.
   *
   * @param null|string $uri
   *   endpoint url for provider.
   */
  public function setUriProvider($uri = NULL) {
    $toSetUri = $uri;
    if (!$uri) {
      $toSetUri = $this->getUriPrefix() . 'providers';
    }

    $this->_uriProvider = $toSetUri;
  }

  /**
   * Eturn provider uri.
   *
   * @return string
   */
  public function getUriProvider() {
    return $this->_uriProvider;
  }

  /**
   * Et uri recurring payments.
   *
   * @param null|string $uri
   *   the uri for the recurring payments.
   */
  public function setUriRecurringPayments($uri = NULL) {
    $toSetUri = $uri;
    if (!$uri) {
      $toSetUri = $this->getUriPrefix() . 'recurringPayments';
    }

    $this->_uriRecurringPayments = $toSetUri;
  }

  /**
   * Eturn uri recurring payments.
   *
   * @return string
   */
  public function getUriRecurringPayments() {
    return $this->_uriRecurringPayments;
  }

  /**
   * Eturn which uri prefix to be used base on mode type.
   *
   * @return string
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
   * Etting exception state log.
   *
   * @param string $message
   *   error message.
   * @param array $stackTrace
   *   statck trace.
   * @param bool $error
   *   if it's an error.
   */
  private function throwException($message, array $stackTrace, $error = TRUE) {
    $this->exception($message, $stackTrace, $error);
  }

  /**
   * Lushing all config.
   *
   * @todo   need to remove singleton concept causing issue
   *
   * @reset  all state
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
   * @param $config
   *
   * array of configuration.
   * @return string script tag
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
   * FFFhargeToObj.
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
   * FFFresponseUpdateStatus.
   *
   * @param mixed $response
   *   Var for response.
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
   * FFFalidateRequest.
   *
   * @param mixed $validationFields
   *   Var for validationFields.
   * @param mixed $chargeObject
   *   Var for chargeObject.
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
   * FFFalueToDecimal.
   *
   * @param mixed $amount
   *   Var for amount.
   * @param mixed $currencySymbol
   *   Var for currencySymbol.
   */
  public function valueToDecimal($amount, $currencySymbol) {
    $currency = strtoupper($currencySymbol);
    $threeDecimalCurrencyList = array('BHD', 'LYD', 'JOD', 'IQD', 'KWD', 'OMR', 'TND');
    $zeroDecimalCurencyList = array('BYR', 'XOF', 'BIF', 'XAF', 'KMF', 'XOF', 'DJF', 'XPF', 'GNF', 'JPY', 'KRW', 'PYG', 'RWF', 'VUV', 'VND');

    if (in_array($currency, $threeDecimalCurrencyList)) {
      $value = (int) ($amount * 1000);.

    } elseif (in_array($currency, $zeroDecimalCurencyList)) {
      $value = floor($amount);

    }
    else {

      $value = round($amount * 100);.

    }

    return $value;

  }

  /**
   * FFFecimalToValue.
   *
   * @param mixed $amount
   *   Var for amount.
   * @param mixed $currencySymbol
   *   Var for currencySymbol.
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
   * Heck charge response.
   *
   * If response is approve or has error, return bool.
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
   * Heck if response contain error code.
   *
   * return bool.
   */
  protected function isError($response) {
    $hasError = FALSE;

    if ($response->getErrorCode()) {
      $hasError = TRUE;
    }

    return $hasError;
  }

  /**
   * Heck if response is approve.
   *
   * return bool.
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
   * Eturn eventId if charge has error.
   *
   * return chargeID if charge is decline.
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
   * Heck if response is flag.
   *
   * return response message.
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
