<?php

/**
 * Checkout.com helpers\ApiHttpClient.
 *
 * PHP Version 5.6
 *
 * @category Helpers
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\helpers;

/**
 * Final class Api Http Client.
 *
 * @category Helpers
 * @version Release: @package_version@
 */
final class ApiHttpClient
{
  private $httpStatus = '';

  /**
   * Post the request.
   *
   * @param String $requestUri
   *   The request uri.
   * @param String $authenticationKey
   *   The authentication key.
   * @param string|null $requestPayload
   *   The payload.
   *
   * @return mixed|CheckoutApi_Api
   *   The request respons.
   */
  public static function postRequest(
    $requestUri,
    $authenticationKey,
    $requestPayload = null
  ) {
    $requestPayload['method'] = 'POST';
    $temp = \CheckoutApi_Api::getApi()
      ->request($requestUri, $requestPayload, true);

    if ($temp && $temp->isValid()) {
      return $temp;
    } else {
      $_errorMessageCodes = $temp
        ->getErrorMessageCodes();
      throw new ApiHttpClientCustomException(
        $temp
          ->getExceptionState()
          ->getErrorMessage(),
        $_errorMessageCodes[0],
        $temp
          ->getEventId()
      );
    }
  }

  /**
   * Get the request.
   *
   * @param String $requestUri
   *   The request uri.
   * @param String $authenticationKey
   *   The authentication key.
   * @param string|null $requestPayload
   *   The payload.
   *
   * @return mixed|CheckoutApi_Api
   *   The request respons.
   */
  public static function getRequest(
    $requestUri,
    $authenticationKey,
    $requestPayload = null
  ) {
    $requestPayload['method'] = 'GET';
    $temp = \CheckoutApi_Api::getApi()
      ->request($requestUri, $requestPayload, true);

    if ($temp && $temp->isValid()) {
      return $temp;
    } else {
      $_errorMessageCodes = $temp->getErrorMessageCodes();
      throw new ApiHttpClientCustomException(
        $temp
          ->getExceptionState()
          ->getErrorMessage(),
        $_errorMessageCodes[0],
        $temp
          ->getEventId()
      );
    }
  }

  /**
   * Put the request.
   *
   * @param String $requestUri
   *   The request uri.
   * @param String $authenticationKey
   *   The authentication key.
   * @param string|null $requestPayload
   *   The payload.
   *
   * @return mixed|CheckoutApi_Api
   *   The request respons.
   */
  public static function putRequest(
    $requestUri,
    $authenticationKey,
    $requestPayload = null) {
    $requestPayload['method'] = 'PUT';
    $temp = \CheckoutApi_Api::getApi()
      ->request($requestUri, $requestPayload, true);

    if ($temp && $temp->isValid()) {
      return $temp;
    } else {
      $_errorMessageCodes = $temp
        ->getErrorMessageCodes();
      throw new ApiHttpClientCustomException(
        $temp
          ->getExceptionState()
          ->getErrorMessage(),
        $_errorMessageCodes[0],
        $temp
          ->getEventId()
      );
    }
  }

  /**
   * Delete the request.
   *
   * @param String $requestUri
   *   The request uri.
   * @param String $authenticationKey
   *   The authentication key.
   * @param string|null $requestPayload
   *   The payload.
   *
   * @return mixed|CheckoutApi_Api
   *   The request respons.
   */
  public static function deleteRequest(
    $requestUri,
    $authenticationKey,
    $requestPayload = null
  ) {
    $requestPayload['method'] = 'DELETE';
    $temp = \CheckoutApi_Api::getApi()
      ->request($requestUri, $requestPayload, true);

    if ($temp && $temp->isValid()) {
      return $temp;
    } else {
      $_errorMessageCodes = $temp
        ->getErrorMessageCodes();
      throw new ApiHttpClientCustomException(
        $temp
          ->getExceptionState()
          ->getErrorMessage(),
        $_errorMessageCodes[0],
        $temp
          ->getEventId()
      );
    }
  }
}
