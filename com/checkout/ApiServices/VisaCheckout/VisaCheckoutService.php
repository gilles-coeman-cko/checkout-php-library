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

namespace com\checkout\ApiServices\VisaCheckout;

class VisaCheckoutService extends \com\checkout\ApiServices\Baseservices
{
    /**
     * @param RequestModels\VisaCheckoutCardTokenCreate $requestModel
     * @return ResponseModels\VisaCheckoutCardToken
     * @throws \Exception
     */
    public function createVisaCheckoutCardToken(RequestModels\VisaCheckoutCardTokenCreate $requestModel, $publicKey) 
    {
        $visaCheckoutMapper    = new VisaCheckoutMapper($requestModel);
        $visaCheckoutUri       = $this->apiUrl->getVisaCheckoutCardTokenApiUri();

        // echo var_dump($visaCheckoutUri);
        $requestVisaCheckout   = array (
            'authorization' => $publicKey,
            'mode'          => $this->apiSetting->getMode(),
            'postedParam'   => $visaCheckoutMapper->requestPayloadConverter(),

        );

        $processVisaCheckout   = \com\checkout\helpers\ApiHttpClient::postRequest($visaCheckoutUri, $publicKey, $requestVisaCheckout);
        $responseModel      = new ResponseModels\VisaCheckoutCardToken($processVisaCheckout);

        return $responseModel;
    }

}
