<?php

/**
 * Checkout.com Api Services Recurring Payment Service.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */
namespace com\checkout\ApiServices\Recurringpayments;

/**
 * Class Recurring Payment Service.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Recurringpaymentservice extends \com\checkout\ApiServices\BaseServices
{

  /**
   * Creates a new payment plan
   *
   * @param RequestModels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function createSinglePlan(RequestModels\Baserecurringpayment $requestModel)
  {
    $Recurringpaymentmapper = new \com\checkout\ApiServices\Recurringpayments\Recurringpaymentmapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $Recurringpaymentmapper->requestPayloadConverter(),

    );

    $processCharge = \com\checkout\helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getRecurringpaymentsApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new ResponseModels\Recurringpayment($processCharge);

    return $responseModel;
  }

  /**
   * Creates multiple payment plans.
   *
   * @param array $plansArray
   *   A array filled with request model.
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function createMultiplePlans(array $plansArray)
  {
    $temporaryArray;

    foreach ($plansArray as $singlePlan) {
      $Recurringpaymentmapper = new \com\checkout\ApiServices\Recurringpayments\Recurringpaymentmapper($singlePlan);
      $_requestPayloadConverter = $Recurringpaymentmapper->requestPayloadConverter();
      $temporaryArray[] = $_requestPayloadConverter['paymentPlans'][0];
    }

    $arrayToSubmit['paymentPlans'] = $temporaryArray;

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $arrayToSubmit,

    );

    $processCharge = \com\checkout\helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getRecurringpaymentsApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new ResponseModels\Recurringpayment($processCharge);

    return $responseModel;
  }

  /**
   * Update a payment plan.
   *
   * @param RequestModels\Baserecurringpayment $requestModel
   *   A request model.
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function updatePlan(RequestModels\Planupdate $requestModel)
  {
    $Recurringpaymentmapper = new \com\checkout\ApiServices\Recurringpayments\Recurringpaymentmapper($requestModel);

    $_requestPayloadConverter = $Recurringpaymentmapper->requestPayloadConverter();

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $_requestPayloadConverter['paymentPlans'][0],

    );

    $updatePlanUri = $this->apiUrl->getRecurringpaymentsApiUri() . '/' . $requestModel->getPlanId();
    $processCharge = \com\checkout\helpers\ApiHttpClient::putRequest(
      $updatePlanUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\ApiServices\SharedModels\OkResponse($processCharge);

    return $responseModel;
  }

  /**
   * Cancel a payment plan.
   *
   * @param mixed $planId
   *   The Payment Plan id prefixed with rp_ .
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function cancelPlan($planId)
  {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),

    );
    $cancelPlanUri = $this->apiUrl->getRecurringpaymentsApiUri() . '/' . $planId;
    $processCharge = \com\checkout\helpers\ApiHttpClient::deleteRequest(
      $cancelPlanUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\ApiServices\SharedModels\OkResponse($processCharge);

    return $responseModel;
  }

  /**
   * Get a payment plan.
   *
   * @param mixed $planId
   *   The Payment Plan id prefixed with rp_ .
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function getPlan($planId)
  {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),

    );
    $getPlanUri = $this->apiUrl->getRecurringpaymentsApiUri() . '/' . $planId;
    $processCharge = \com\checkout\helpers\ApiHttpClient::getRequest(
      $getPlanUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\ApiServices\Recurringpayments\ResponseModels\Paymentplan($processCharge);

    return $responseModel;
  }

  /**
   * Create a customer plan with full card details.
   *
   * @param RequestModels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function createPlanWithFullCard(RequestModels\Planwithfullcardcreate $requestModel)
  {
    $chargesMapper = new \com\checkout\ApiServices\Charges\ChargesMapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargesMapper->requestPayloadConverter(),

    );
    $processCharge = \com\checkout\helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getCardChargesApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\ApiServices\Charges\ResponseModels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Create a customer plan with a card id.
   *
   * @param RequestModels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function createPlanWithCardId(RequestModels\Planwithcardidcreate $requestModel)
  {
    $chargesMapper = new \com\checkout\ApiServices\Charges\ChargesMapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargesMapper->requestPayloadConverter(),

    );
    $processCharge = \com\checkout\helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getCardChargesApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\ApiServices\Charges\ResponseModels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Create a customer plan with a card token.
   *
   * @param RequestModels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function createPlanWithCardToken(RequestModels\Planwithcardtokencreate $requestModel)
  {
    $chargesMapper = new \com\checkout\ApiServices\Charges\ChargesMapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargesMapper->requestPayloadConverter(),

    );
    $processCharge = \com\checkout\helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getCardTokensApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\ApiServices\Charges\ResponseModels\Charge($processCharge);

    return $responseModel;
  }

  /**
   * Create a customer plan with a payment id.
   *
   * @param RequestModels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function createPlanWithPaymentToken(RequestModels\Planwithpaymenttokencreate $requestModel)
  {
    $chargesMapper = new \com\checkout\ApiServices\Charges\ChargesMapper($requestModel);

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $chargesMapper->requestPayloadConverter(),

    );
    $processCharge = \com\checkout\helpers\ApiHttpClient::postRequest(
      $this->apiUrl->getPaymentTokensApiUri(),
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\ApiServices\Tokens\ResponseModels\PaymentToken($processCharge);

    return $responseModel;
  }

  /**
   * Update a customer plan.
   *
   * @param RequestModels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function updateCustomerPlan(RequestModels\Customerplanupdate $requestModel)
  {
    $chargesMapper = new \com\checkout\ApiServices\Charges\ChargesMapper($requestModel);

    $_requestPayloadConverter = $chargesMapper->requestPayloadConverter();

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $_requestPayloadConverter['paymentPlans'][0],

    );

    $updatePlanUri = $this->apiUrl->getRecurringpaymentsCustomersApiUri() . '/' . $requestModel->getCustomerPlanId();
    $processCharge = \com\checkout\helpers\ApiHttpClient::putRequest(
      $updatePlanUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\ApiServices\SharedModels\OkResponse($processCharge);

    return $responseModel;
  }

  /**
   * Cancel a customer plan.
   *
   * @param string $customerPlanId
   *   The customer payment plan id prefixed with cp_ .
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function cancelCustomerPlan($customerPlanId)
  {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),

    );
    $cancelPlanUri = $this->apiUrl->getRecurringpaymentsCustomersApiUri() . '/' . $customerPlanId;
    $processCharge = \com\checkout\helpers\ApiHttpClient::deleteRequest(
      $cancelPlanUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );

    $responseModel = new \com\checkout\ApiServices\SharedModels\OkResponse($processCharge);

    return $responseModel;
  }

  /**
   * Get a customer plan.
   *
   * @param string $customerPlanId
   *   The customer payment plan id prefixed with cp_ .
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function getCustomerPlan($customerPlanId)
  {

    $requestPayload = array(
      'authorization' => $this->apiSetting->getSecretKey(),
      'mode' => $this->apiSetting->getMode(),

    );
    $getPlanUri = $this->apiUrl->getRecurringpaymentsCustomersApiUri() . '/' . $customerPlanId;
    $processCharge = \com\checkout\helpers\ApiHttpClient::getRequest(
      $getPlanUri,
      $this->apiSetting->getSecretKey(), $requestPayload
    );
    echo $getPlanUri;

    $responseModel = new \com\checkout\ApiServices\Recurringpayments\ResponseModels\Customerpaymentplan($processCharge);

    return $responseModel;
  }

  /**
   * Query payments plans.
   *
   * @param RequestModels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function queryPlan(RequestModels\Querypaymentplan $requestModel)
  {
    $queryMapper = new Recurringpaymentquerymapper($requestModel);
    $queryUri = $this->apiUrl->getRecurringpaymentsQueryApiUri();
    $secretKey = $this->apiSetting->getSecretKey();

    $requestQuery = array(
      'authorization' => $secretKey,
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $queryMapper->requestQueryConverter(),

    );

    $processQuery = \com\checkout\helpers\ApiHttpClient::postRequest($queryUri, $secretKey, $requestQuery);
    $responseModel = new ResponseModels\Paymentplanlist($processQuery);

    return $responseModel;
  }

  /**
   * Query customer plans.
   *
   * @param RequestModels\Baserecurringpayment $requestModel
   *   The request model.
   *
   * @return ResponseModels\Recurringpayment
   *   The response models or recurring payments.
   */
  public function queryCustomerPlan(RequestModels\Querycustomerplan $requestModel)
  {
    $queryMapper = new Recurringpaymentquerymapper($requestModel);
    $queryUri = $this->apiUrl->getRecurringpaymentsCustomersQueryApiUri();
    $secretKey = $this->apiSetting->getSecretKey();

    $requestQuery = array(
      'authorization' => $secretKey,
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $queryMapper->requestQueryConverter(),

    );

    $processQuery = \com\checkout\helpers\ApiHttpClient::postRequest($queryUri, $secretKey, $requestQuery);
    $responseModel = new ResponseModels\Paymentplanlist($processQuery);

    return $responseModel;
  }

}
