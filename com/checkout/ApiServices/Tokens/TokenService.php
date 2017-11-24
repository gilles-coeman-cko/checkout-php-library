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

use com\checkout\ApiServices\BaseServices;
use com\checkout\ApiServices\Charges\ChargesMapper;
use com\checkout\ApiServices\SharedModels\OkResponse;
use com\checkout\ApiServices\Tokens\RequestModels\PaymentTokenUpdate;
use com\checkout\helpers\ApiHttpClient;
use com\checkout\helpers\ApiHttpClientCustomException;

class TokenService extends BaseServices
{
    /**
     * @param RequestModels\PaymentTokenCreate $requestModel
     * @return ResponseModels\PaymentToken
     * @throws ApiHttpClientCustomException
     */
    public function createPaymentToken(RequestModels\PaymentTokenCreate $requestModel)
    {
        $chargeMapper = new ChargesMapper($requestModel);

        $requestPayload = array(
            'authorization' => $this->apiSetting->getSecretKey(),
            'mode' => $this->apiSetting->getMode(),
            'postedParam' => $chargeMapper->requestPayloadConverter(),
        );

        $processCharge = ApiHttpClient::postRequest(
            $this->apiUrl->getPaymentTokensApiUri(),
            $this->apiSetting->getSecretKey(), $requestPayload
        );

        return new ResponseModels\PaymentToken($processCharge);
    }

    /**
     * @param PaymentTokenUpdate $requestModel
     * @return PaymentTokenUpdate
     * @throws ApiHttpClientCustomException
     */
    public function updatePaymentToken(RequestModels\PaymentTokenUpdate $requestModel)
    {

        $chargeMapper = new ChargesMapper($requestModel);

        $requestPayload = array(
            'authorization' => $this->apiSetting->getSecretKey(),
            'mode' => $this->apiSetting->getMode(),
            'postedParam' => $chargeMapper->requestPayloadConverter(),
        );

        $updateUri = sprintf($this->apiUrl->getPaymentTokenUpdateApiUri(), $requestModel->getId());

        $processCharge = ApiHttpClient::putRequest(
            $updateUri,
            $this->apiSetting->getSecretKey(), $requestPayload
        );

        return new  OkResponse($processCharge);
    }
}
