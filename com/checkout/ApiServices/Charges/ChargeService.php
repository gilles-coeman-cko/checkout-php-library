<?php

/**
 * Checkout.com ApiServices\Charges\Chargeservice.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\ApiServices\Charges;

/**
 * Class Charges Service.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Chargeservice extends \com\checkout\ApiServices\Baseservices
{

  /**
   * Verify the charge by its token
   *
   * @param String $paymentToken
   *   The payment token.
   *
   * @return ResponseModels\Charge
   *   The response model.
   */
  public function verifyCharge($paymentToken)
  {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'method' => 'GET',

    );

    $retrieveChargeWithChargeUri = sprintf(
      $this->apiUrl->getRetrieveChargesApiUri(),
      $paymentToken
    );

    $processCharge = \com\checkout\helpers\ApiHttpClient::getRequest(
      $retrieveChargeWithChargeUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new ResponseModels\Charge($processCharge);
    return $responseModel;
  }

  /**
   * Creates a charge with full card details.
   *
   * @param RequestModels\CardChargeCreate $requestModel
   *   The request model.
   *
   * @return ResponseModels\Charge
   *   The response models or charge objects.
   */
  public function chargeWithCard(RequestModels\CardChargeCreate $requestModel)
  {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );
    $processCharge = \com\checkout\helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getCardChargesApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new ResponseModels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Creates a charge with full card id.
   *
   * @param RequestModels\Cardidchargecreate $requestModel
   *   The request model.
   *
   * @return ResponseModels\Charge
   *   The response models or charge objects.
   */

  public function chargeWithCardId(RequestModels\Cardidchargecreate $requestModel)
  {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );
    $processCharge = \com\checkout\helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getCardChargesApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new ResponseModels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Creates a charge with cardToken.
   *
   * @param RequestModels\Cardtokenchargecreate $requestModel
   *   The request model.
   *
   * @return ResponseModels\Charge
   *   The response models or charge objects.
   */
  public function chargeWithCardToken(RequestModels\Cardtokenchargecreate $requestModel)
  {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );

    $processCharge = \com\checkout\helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getCardTokensApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new ResponseModels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Creates a charge with Default Customer Card.
   *
   * @param RequestModels\Basecharge $requestModel
   *   The request model.
   *
   * @return ResponseModels\Charge
   *   The response models or charge objects.
   */
  public function chargeWithDefaultCustomerCard(RequestModels\Basecharge
     $requestModel
  ) {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );
    $processCharge = \com\checkout\helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getDefaultCardChargesApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new ResponseModels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Refund a charge.
   *
   * @param RequestModels\Chargerefund $requestModel
   *   The request model.
   *
   * @return ResponseModels\Charge
   *   The response models or charge objects.
   */
  public function refundCardChargeRequest(RequestModels\Chargerefund
     $requestModel
  ) {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );
    $refundUri = sprintf($this->apiUrl->getChargerefundsApiUri(), $requestModel->getChargeId());

    $processCharge = \com\checkout\helpers\ApiHttpClient::postRequest(
      $refundUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new ResponseModels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Void a charge.
   *
   * @param RequestModels\Chargevoid $requestModel
   *   The request model.
   *
   * @return ResponseModels\Charge
   *   The response models or charge objects.
   */
  public function voidCharge($chargeId, RequestModels\Chargevoid
     $requestModel
  ) {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );
    $refundUri = sprintf($this->apiUrl->getVoidChargesApiUri(), $chargeId);

    $processCharge = \com\checkout\helpers\ApiHttpClient::postRequest(
      $refundUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new ResponseModels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Capture a charge.
   *
   * @param RequestModels\Chargecapture $requestModel
   *   The request model.
   *
   * @return ResponseModels\Charge
   *   The response models or charge objects.
   */
  public function CaptureCardCharge(RequestModels\Chargecapture
     $requestModel
  ) {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );
    $refundUri = sprintf($this->apiUrl->getCaptureChargesApiUri(), $requestModel->getChargeId());

    $processCharge = \com\checkout\helpers\ApiHttpClient::postRequest(
      $refundUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new ResponseModels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Update a charge.
   *
   * @param RequestModels\Chargeupdate $requestModel
   *   The request model.
   *
   * @return ResponseModels\Charge
   *   The response models or charge objects.
   */
  public function UpdateCardCharge(RequestModels\Chargeupdate
     $requestModel
  ) {

    $chargeMapper = new Chargesmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargeMapper->requestPayloadConverter(),

    );
    $updateUri = sprintf($this->apiUrl->getUpdateChargesApiUri(), $requestModel->getChargeId());

    $processCharge = \com\checkout\helpers\ApiHttpClient::putRequest(
      $updateUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\ApiServices\SharedModels\OkResponse($processCharge);

    return $responseModel;
  }

  /**
   * Get a Charge With a ChargeId.
   *
   * @param RequestModels\ChargeRetrieve $chargeId
   *   The request model.
   *
   * @return ResponseModels\Charge
   *   The response models or charge objects.
   */
  public function getCharge($chargeId)
  {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'method' => 'GET',
    );

    $retrieveChargeWithChargeUri = sprintf($this->apiUrl->getRetrieveChargesApiUri(), $chargeId);

    $processCharge = \com\checkout\helpers\ApiHttpClient::getRequest(
      $retrieveChargeWithChargeUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new ResponseModels\Charge($processCharge);
    return $responseModel;
  }

  /**
   * Retrieve a Charge History With a ChargeId.
   *
   * @param RequestModels\ChargeRetrieve $requestModel
   *   The request model.
   *
   * @return ResponseModels\Charge
   *   The response models or charge objects.
   */
  public function getChargehistory($chargeId)
  {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'method' => 'GET',
    );

    $retrieveChargehistoryWithChargeUri = sprintf($this->apiUrl->getRetrieveChargehistoryApiUri(), $chargeId);

    $processCharge = \com\checkout\helpers\ApiHttpClient::getRequest(
      $retrieveChargehistoryWithChargeUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new ResponseModels\Chargehistory($processCharge);
    return $responseModel;
  }

}
