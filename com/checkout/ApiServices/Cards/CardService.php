<?php

/**
 * Checkout.com ApiServices\Cards\CardService.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\ApiServices\Cards;

/**
 * Class Card Service.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Cardservice extends \com\checkout\ApiServices\Baseservices
{

  /**
   * Create a new card.
   *
   * @param RequestModels\Cardcreate $requestModel
   *   The request model.
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function createCard(RequestModels\Cardcreate $requestModel)
  {
    $cardMapper = new Cardmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $cardMapper->requestPayloadConverter(),

    );

    $createCardUri = sprintf($this->apiUrl->getCardsApiUri(), $requestModel->getCustomerId());
    $processCharge = \com\checkout\helpers\ApiHttpClient::postRequest(
      $createCardUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new ResponseModels\Card($processCharge);
    return $responseModel;
  }

  /**
   * Get a card.
   *
   * @param mixed $customerId
   *   The customer id prefixed with cust_ .
   * @param mixed $cardId
   *   The card id prefixed with card_ .
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function getCard($customerId, $cardId)
  {
    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),

    );

    $getCardUri = sprintf($this->apiUrl->getCardsApiUri(), $customerId) . '/' . $cardId;

    $processCharge = \com\checkout\helpers\ApiHttpClient::getRequest(
      $getCardUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new ResponseModels\Card($processCharge);
    return $responseModel;
  }

  /**
   * Update a card.
   *
   * @param RequestModels\Baserecurringpayment $requestModel
   *   A request model.
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function updateCard(\com\checkout\ApiServices\Cards\RequestModels\Cardupdate $requestModel)
  {
    $cardMapper = new Cardmapper($requestModel);
    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $cardMapper->requestPayloadConverterCard(),

    );

    $getCardUri = sprintf($this->apiUrl->getCardsApiUri(), $requestModel->getCustomerId()) . '/' . $requestModel->getCardId();

    $processCharge = \com\checkout\helpers\ApiHttpClient::putRequest(
      $getCardUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );
    $responseModel = new \com\checkout\ApiServices\SharedModels\OkResponse($processCharge);
    return $responseModel;
  }

  /**
   * Delete a card.
   *
   * @param mixed $customerId
   *   The customer id prefixed with cust_ .
   * @param mixed $cardId
   *   The card id prefixed with card_ .
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function deleteCard($customerId, $cardId)
  {
    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
    );

    $getCardUri = sprintf($this->apiUrl->getCardsApiUri(), $customerId) . '/' . $cardId;

    $processCharge = \com\checkout\helpers\ApiHttpClient::deleteRequest(
      $getCardUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\ApiServices\SharedModels\OkResponse($processCharge);
    return $responseModel;
  }

  /**
   * Get a list of cards.
   *
   * @param mixed $customerId
   *   The customer id prefixed with cust_ .
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function getCartList($customerId)
  {
    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),

    );

    $getCardUri = sprintf($this->apiUrl->getCardsApiUri(), $customerId);

    $processCharge = \com\checkout\helpers\ApiHttpClient::getRequest(
      $getCardUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new ResponseModels\Cardlist($processCharge);
    return $responseModel;
  }
}
