<?php

/**
 * Checkout.com ApiServices\Reporting\Reportingservice.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\ApiServices\Reporting;

/**
 * Class Reporting Service.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Reportingservice extends \com\checkout\ApiServices\Baseservices
{
  /**
   * Request the transactions.
   *
   * @param RequestModels\Transactionfilter $requestModel
   *   The request model.
   *
   * @return ResponseModels\Transactionlist
   *   Return the server response.
   *
   * @throws Exception
   */
  public function queryTransaction(RequestModels\Transactionfilter $requestModel)
  {
    $Reportingmapper = new Reportingmapper($requestModel);
    $reportingUri = $this->apiUrl->getQueryTransactionApiUri();
    $secretKey = $this->apiSetting->getSecretKey();

    $requestReporting = array(
      'authorization' => $secretKey,
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $Reportingmapper->requestReportingConverter(),

    );

    $processReporting = \com\checkout\helpers\ApiHttpClient::postRequest($reportingUri, $secretKey, $requestReporting);
    $responseModel = new ResponseModels\Transactionlist($processReporting);

    return $responseModel;
  }

  /**
   * Request the chargebacks.
   *
   * @param RequestModels\Transactionfilter $requestModel
   *   The request model.
   *
   * @return ResponseModels\Transactionlist
   *   Return the server response.
   *
   * @throws Exception
   */
  public function queryChargeback(RequestModels\Transactionfilter $requestModel)
  {
    $Reportingmapper = new Reportingmapper($requestModel);
    $reportingUri = $this->apiUrl->getQueryChargebackApiUri();
    $secretKey = $this->apiSetting->getSecretKey();

    $requestReporting = array(
      'authorization' => $secretKey,
      'mode' => $this->apiSetting->getMode(),
      'postedParam' => $Reportingmapper->requestReportingConverter(),

    );

    $processReporting = \com\checkout\helpers\ApiHttpClient::postRequest($reportingUri, $secretKey, $requestReporting);
    $responseModel = new ResponseModels\Chargebacklist($processReporting);

    return $responseModel;
  }

}
