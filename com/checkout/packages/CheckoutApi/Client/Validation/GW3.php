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
 * CheckoutapiClientValidationGw3.
 *
 * Checkoutapi validator class for gateway 3.0 base on documentation on http://dev.checkout.com/ref/?shell#cards
 *
 * @category Client
 * @version Release: @package_version@
 */
final class CheckoutapiClientValidationGw3 extends CheckoutapiLibObject {
  /**
   * Helper  method to check if email has been set in the payload and if it's a valid email.
   *
   * @param array $postedParam
   *   A var for postedParam.
   *
   * @return bool
   * Checkoutapi check if email valid.
   * Simple usage:.
   *          CheckoutapiClientValidationGw3::isEmailValid($postedParam);.
   */
  public static function isEmailValid($postedParam) {
    $isEmailEmpty = TRUE;
    $isValidEmail = FALSE;

    if (isset($postedParam['email'])) {

      $isEmailEmpty = CheckoutapiLibValidator::isEmpty($postedParam['email']);

    }

    if (!$isEmailEmpty) {

      $isValidEmail = CheckoutapiLibValidator::isValidEmail($postedParam['email']);

    }

    return !$isEmailEmpty && $isValidEmail;

  }

  /**
   * Helper method that is use to check if payload has set a customer id.
   *
   * @param array $postedParam
   *   A var for postedParam.
   *
   * @return bool
   * check if customer id is valid.
   * Simple usage:.
   *          CheckoutapiClientValidationGw3::CustomerIdValid($postedParam);.
   */
  public static function isCustomerIdValid($postedParam) {
    $isCustomerIdEmpty = TRUE;
    $isValidCustomerId = FALSE;

    if (isset($postedParam['customerId'])) {
      $isCustomerIdEmpty = CheckoutapiLibValidator::isEmpty($postedParam['customerId']);
    }

    if (!$isCustomerIdEmpty) {

      $isValidCustomerId = CheckoutapiLibValidator::isString($postedParam['customerId']);
    }

    return !$isCustomerIdEmpty && $isValidCustomerId;
  }

  /**
   * Helper method that is use to valid if amount is correct in a payload.
   *
   * @param array $postedParam
   *   A var for postedParam.
   *
   * @return bool
   * Checkoutapi check if amount is valid.
   * Simple usage:.
   *        CheckoutapiClientValidationGw3::isValueValid($postedParam).
   */
  public static function isValueValid($postedParam) {
    $isValid = FALSE;

    if (isset($postedParam['value'])) {

      $amount = $postedParam['value'];

      $isAmountEmpty = CheckoutapiLibValidator::isEmpty($amount);

      if (!$isAmountEmpty) {
        $isValid = TRUE;

      }

    }

    return $isValid;
  }

  /**
   * Helper method that is use check if payload has a currency set and if length of currency value is 3.
   *
   * @param array $postedParam
   *   A var for postedParam.
   *
   * @return bool
   *
   * Simple usage:.
   *      CheckoutapiClientValidationGw3::isValidCurrency($postedParam);.
   */
  public static function isValidCurrency($postedParam) {
    $isValid = FALSE;

    if (isset($postedParam['currency'])) {

      $currency = $postedParam['currency'];
      $currencyEmpty = CheckoutapiLibValidator::isEmpty($currency);

      if (!$currencyEmpty) {
        $isCurrencyLen = CheckoutapiLibValidator::isLength($currency, 3);

        if ($isCurrencyLen) {
          $isValid = TRUE;
        }
      }
    }

    return $isValid;
  }

  /**
   * Helper method that check if a name is set in the payload.
   *
   * @param array $postedParam
   *   A var for postedParam.
   *
   * @return bool
   *
   * Simple usage:.
   *      CheckoutapiClientValidationGw3::isNameValid($postedParam);.
   */
  public static function isNameValid($postedParam) {
    $isValid = FALSE;

    if (isset($postedParam['name'])) {

      $isNameEmpty = CheckoutapiLibValidator::isEmpty($postedParam['name']);
      if (!$isNameEmpty) {

        $isValid = TRUE;
      }

    }

    return $isValid;
  }

  /**
   * Helper method that check if card number is set in payload.
   *
   * @param array $param
   *   A var for param.
   *
   * @return bool
   *
   * Simple usage:.
   *      CheckoutapiClientValidationGw3::isCardNumberValid($param).
   */
  public static function isCardNumberValid($param) {
    $isValid = FALSE;

    if (isset($param['number'])) {

      $errorIsEmpty = CheckoutapiLibValidator::isEmpty($param['number']);

      if (!$errorIsEmpty) {
        //$this->logError(TRUE, "Card number can not be empty.", array('card'=>$param),FALSE);
        $isValid = TRUE;
      }

    }

    return $isValid;
  }

  /**
   * Helper method that check if month is properly set in payload card object.
   *
   * @param array $card
   *   A var for card.
   *
   * @return bool
   *
   * Simple usage:.
   *          CheckoutapiClientValidationGw3::isMonthValid($card).
   */
  public static function isMonthValid($card) {
    $isValid = FALSE;

    if (isset($card['expiryMonth'])) {

      $isExpiryMonthEmpty = CheckoutapiLibValidator::isEmpty($card['expiryMonth'], FALSE);

      if (!$isExpiryMonthEmpty && CheckoutapiLibValidator::isInteger($card['expiryMonth']) && ($card['expiryMonth'] > 0 && $card['expiryMonth'] < 13)) {
        $isValid = TRUE;
      }
    }

    return $isValid;
  }

  /**
   * Helper method that check if year is properly set in payload.
   *
   * @param array $card
   *   A var for card.
   *
   * @return bool
   *
   * Simple usage:.
   *      CheckoutapiClientValidationGw3::isValidYear($card).
   */
  public static function isValidYear($card) {
    $isValid = FALSE;

    if (isset($card['expiryYear'])) {

      $isExpiryYear = CheckoutapiLibValidator::isEmpty($card['expiryYear']);

      if (!$isExpiryYear && CheckoutapiLibValidator::isInteger($card['expiryYear'])
        && (CheckoutapiLibValidator::isLength($card['expiryYear'], 2) || CheckoutapiLibValidator::isLength($card['expiryYear'], 4))
      ) {

        $isValid = TRUE;

      }
    }

    return $isValid;
  }

  /**
   * Helper method that check if cvv is properly set in payload.
   *
   * @param array $card
   *   A var for card.
   *
   * @return bool
   *
   * Simple usage:.
   *          CheckoutapiClientValidationGw3::isValidCvv($card).
   */
  public static function isValidCvv($card) {
    $isValid = FALSE;

    if (isset($card['cvv'])) {

      $isCvvEmpty = CheckoutapiLibValidator::isEmpty($card['cvv']);

      if (!$isCvvEmpty && CheckoutapiLibValidator::isValidCvvLen($card['cvv'])) {

        $isValid = TRUE;

      }
    }
    return $isValid;
  }

  /**
   * Helper method that check if card is properly set in payload It check if expiry date , card number , cvv and name is set.
   *
   * @param $param
   *
   * @return bool
   *
   * Simple usage:.
   *          CheckoutapiClientValidationGw3::isCardValid($param).
   */
  public static function isCardValid($param) {
    $isValid = TRUE;

    if (isset($param['card'])) {
      $card = $param['card'];

      $isNameValid = CheckoutapiClientValidationGw3::isNameValid($card);

      if (!$isNameValid) {

        $isValid = FALSE;
      }

      $isCardNumberValid = CheckoutapiClientValidationGw3::isCardNumberValid($card);

      if (!$isCardNumberValid && !isset($param['card']['number'])) {

        $isValid = FALSE;
      }

      $isValidMonth = CheckoutapiClientValidationGw3::isMonthValid($card);

      if (!$isValidMonth && !isset($param['card']['expiryMonth'])) {
        $isValid = FALSE;
      }

      $isValidYear = CheckoutapiClientValidationGw3::isValidYear($card);

      if (!$isValidYear && !isset($param['card']['expiryYear'])) {
        $isValid = FALSE;
      }

      $isValidCvv = CheckoutapiClientValidationGw3::isValidCvv($card);

      if (!$isValidCvv && !isset($param['card']['cvv'])) {
        $isValid = FALSE;
      }

      return $isValid;
    }
    return TRUE;

  }

  /**
   * Helper method that check if card id was set in payload.
   *
   * @param $param
   *
   * @return bool
   *
   * Simple usage:.
   *      CheckoutapiClientValidationGw3::CardIdValid($param).
   */
  public static function isCardIdValid($param) {
    $isValid = FALSE;
    if (isset($param['card'])) {
      $card = $param['card'];

      if (isset($card['id'])) {

        $isCardIdEmpty = CheckoutapiLibValidator::isEmpty($card['id']);

        if (!$isCardIdEmpty && CheckoutapiLibValidator::isString($card['id'])) {
          $isValid = TRUE;
        }
      }

      return $isValid;
    }
    return TRUE;

  }

  /**
   * Helper method that check if card id is set in payload.
   *
   * The difference between isCardIdValid and isGetCardIdValid is, isCardIdValid check if card id is set.
   * in postedparam where as isGetCardIdValid check if configuration pass has a card id.
   *
   * @param array $param
   *   A var for param.
   *
   * @return bool
   *
   * Simple usage:.
   *         CheckoutapiClientValidationGw3::isGetCardIdValid($param).
   */
  public static function isGetCardIdValid($param) {
    $isValid = FALSE;
    $card = $param['cardId'];

    if (isset($card)) {
      $isValid = self::isCardIdValid(array('card' => $card));
    }

    return $isValid;

  }

  /**
   * Helper method that check in payload if phone number was set.
   *
   * @param array $postedParam
   *   A var for postedParam.
   *
   * @return bool
   */
  public static function isPhoneNoValid($postedParam) {
    $isValid = FALSE;

    if (isset($postedParam['phoneNumber'])) {

      $isPhoneEmpty = CheckoutapiLibValidator::isEmpty($postedParam['phoneNumber']);

      if (!$isPhoneEmpty && CheckoutapiLibValidator::isString($postedParam['phoneNumber'])) {
        $isValid = TRUE;
      }
    }

    return $isValid;

  }

  /**
   * Helper method that check that check if token is set in payload.
   *
   * @param array $param
   *   A var for param.
   *
   * @return bool
   *
   * Simple usage:.
   *       CheckoutapiClientValidationGw3::isCardToken($param).
   */
  public static function isCardToken($param) {
    $isValid = FALSE;

    if (isset($param['cardToken'])) {
      $isTokenEmpty = CheckoutapiLibValidator::isEmpty($param['cardToken']);

      if (!$isTokenEmpty) {
        $isValid = TRUE;
      }
    }

    return $isValid;
  }

  /**
   * Helper method that check that check if paymentToken is set in payload.
   *
   * @param array $param
   *   A var for param.
   *
   * @return bool
   *
   * Simple usage:.
   *       CheckoutapiClientValidationGw3::isPaymentToken($param).
   */
  public static function isPaymentToken($param) {
    $isValid = FALSE;

    if (isset($param['paymentToken'])) {
      $isTokenEmpty = CheckoutapiLibValidator::isEmpty($param['paymentToken']);

      if (!$isTokenEmpty) {
        $isValid = TRUE;
      }
    }

    return $isValid;
  }
  /**
   * Helper method that check that check if session token is set in payload.
   *
   * @param array $param
   *   A var for param.
   *
   * @return bool
   *
   * Simple usage:.
   *      CheckoutapiClientValidationGw3::isSessionToken($param).
   */
  public static function isSessionToken($param) {
    $isValid = FALSE;

    if (isset($param['token'])) {
      $isTokenEmpty = CheckoutapiLibValidator::isEmpty($param['token']);

      if (!$isTokenEmpty) {
        $isValid = TRUE;
      }
    }

    return $isValid;
  }

  /**
   * Helper method that check if localpayment object is valid in payload It check if lppId is set.
   *
   * @param array $postedParam
   *   A var for postedParam.
   *
   * @return bool
   *
   * Simple usage:.
   *       CheckoutapiClientValidationGw3::isLocalPyamentHashValid($postedParam).
   */
  public static function isLocalPyamentHashValid($postedParam) {
    $isValid = FALSE;

    if (isset($postedParam['localPayment']) && !(CheckoutapiLibValidator::isEmpty($postedParam['localPayment']))) {
      if (isset($postedParam['localPayment']['lppId']) && !(CheckoutapiLibValidator::isEmpty($postedParam['localPayment']['lppId']))) {
        $isValid = TRUE;
      }
    }

    return $isValid;
  }

  /**
   * Helper method that check if a charge id was set in the payload.
   *
   * @param array $param
   *   A var for param.
   *
   * @return bool
   *
   * Simple usage:.
   *       CheckoutapiClientValidationGw3::isChargeIdValid($param).
   */
  public static function isChargeIdValid($param) {
    $isValid = FALSE;

    if (isset($param['chargeId']) && !(CheckoutapiLibValidator::isEmpty($param['chargeId']))) {
      $isValid = TRUE;
    }
    return $isValid;
  }

  /**
   * Helper method that check provider id is set in payload.
   *
   * @param $param
   *
   * @return bool
   *
   * Simple usage:.
   *      CheckoutapiClientValidationGw3::isProvider($param).
   */
  public static function isProvider($param) {
    $isValid = FALSE;

    if (isset($param['providerId']) && !(CheckoutapiLibValidator::isEmpty($param['providerId']))) {
      $isValid = TRUE;
    }
    return $isValid;
  }

  /**
   * Helper method that check plan id is set in payload.
   *
   * @param $param
   *
   * @return bool
   *
   * Simple usage:.
   *      CheckoutapiClientValidationGw3::isPlanIdValid($param).
   */
  public static function isPlanIdValid($postedParam) {
    $isPlanIdEmpty = TRUE;
    $isValidPlanId = FALSE;

    if (isset($postedParam['planId'])) {
      $isPlanIdEmpty = CheckoutapiLibValidator::isEmpty($postedParam['planId']);
    }

    if (!$isPlanIdEmpty) {

      $isValidPlanId = CheckoutapiLibValidator::isString($postedParam['planId']);
    }

    return !$isPlanIdEmpty && $isValidPlanId;
  }

  /**
   * Helper method that check customer plan id is set in payload.
   *
   * @param $param
   *
   * @return bool
   *
   * Simple usage:.
   *      CheckoutapiClientValidationGw3::isCustomerPlanIdValid($param).
   */
  public static function isCustomerPlanIdValid($postedParam) {
    $isCustomerPlanIdEmpty = TRUE;
    $isValidCustomerPlanId = FALSE;

    if (isset($postedParam['customerPlanIdValid'])) {
      $isCustomerPlanIdEmpty = CheckoutapiLibValidator::isEmpty($postedParam['customerPlanIdValid']);
    }

    if (!$isCustomerPlanIdEmpty) {

      $isValidCustomerPlanId = CheckoutapiLibValidator::isString($postedParam['customerPlanIdValid']);
    }

    return !$isCustomerPlanIdEmpty && $isValidCustomerPlanId;
  }
}
