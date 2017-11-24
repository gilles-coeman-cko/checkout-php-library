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
 * Date: 3/23/2015
 * Time: 9:22 AM
 */

namespace com\checkout\ApiServices\PaymentProviders;


class PaymentProviderService extends \com\checkout\ApiServices\BaseServices
{
    public function getCardProviderList()
    {
        $requestPayload = array (
        'authorization' => $this->apiSetting->getPublicKey(),
        'mode'          => $this->apiSetting->getMode(),

        );

        $processCharge = \com\checkout\helpers\ApiHttpClient::getRequest(
            $this->apiUrl->getCardProvidersUri(),
            $this->apiSetting->getPublicKey(), $requestPayload
        );

        $responseModel = new ResponseModels\CardProviderList($processCharge);

        return $responseModel;
    }

    public function getCardProvider($id)
    {
        $requestPayload = array (
        'authorization' => $this->apiSetting->getPublicKey(),
        'mode'          => $this->apiSetting->getMode(),

        );
        $cardProviderByIdUri = $this->apiUrl->getCardProvidersUri()."/$id";
        $processCharge = \com\checkout\helpers\ApiHttpClient::getRequest(
            $cardProviderByIdUri,
            $this->apiSetting->getPublicKey(), $requestPayload
        );

        $responseModel = new \com\checkout\ApiServices\PaymentProviders\ResponseModels\CardProvider($processCharge);

        return $responseModel;
    }
}
