<?php

/**
 * CheckoutapiApi
 *
 * PHP Version 5.6
 * 
 * @category Api
 * @package  Checkoutapi
 * @author   Dhiraj Gangoosirdar <dhiraj.gangoosirdar@checkout.com>
 * @author   Gilles Coeman <gilles.coeman@checkout.com>
 * @license  https://checkout.com/terms/ MIT License
 * @link     https://www.checkout.com/
 */
/**
 * Created by PhpStorm.
 * User: dhiraj.gangoosirdar
 * Date: 3/17/2015
 * Time: 2:41 PM
 */

namespace com\checkout\ApiServices\Tokens;

use com\checkout\ApiServices\Baseservices;
use com\checkout\ApiServices\Charges\Chargesmapper;
use com\checkout\ApiServices\SharedModels\OkResponse;
use com\checkout\ApiServices\Tokens\RequestModels\PaymenttokenUpdate;
use com\checkout\helpers\ApiHttpClient;
use com\checkout\helpers\ApiHttpClientCustomException;

class TokenService extends Baseservices
{
    /**
     * @param RequestModels\PaymenttokenCreate $requestModel
     * @return ResponseModels\Paymenttoken
     * @throws ApiHttpClientCustomException
     */
    public function createPaymenttoken(RequestModels\PaymenttokenCreate $requestModel)
    {
        $chargeMapper = new Chargesmapper($requestModel);

        $requestPayload = array(
            'authorization' => $this->apiSetting->getSecretKey(),
            'mode' => $this->apiSetting->getMode(),
            'postedParam' => $chargeMapper->requestPayloadConverter(),
        );

        $processCharge = ApiHttpClient::postRequest(
            $this->apiUrl->getPaymenttokensApiUri(),
            $this->apiSetting->getSecretKey(), $requestPayload
        );

        return new ResponseModels\Paymenttoken($processCharge);
    }

    /**
     * @param PaymenttokenUpdate $requestModel
     * @return PaymenttokenUpdate
     * @throws ApiHttpClientCustomException
     */
    public function updatePaymenttoken(RequestModels\PaymenttokenUpdate $requestModel)
    {

        $chargeMapper = new Chargesmapper($requestModel);

        $requestPayload = array(
            'authorization' => $this->apiSetting->getSecretKey(),
            'mode' => $this->apiSetting->getMode(),
            'postedParam' => $chargeMapper->requestPayloadConverter(),
        );

        $updateUri = sprintf($this->apiUrl->getPaymenttokenUpdateApiUri(), $requestModel->getId());

        $processCharge = ApiHttpClient::putRequest(
            $updateUri,
            $this->apiSetting->getSecretKey(), $requestPayload
        );

        return new  OkResponse($processCharge);
    }
}
