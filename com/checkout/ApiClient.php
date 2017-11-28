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
namespace com\checkout;

class ApiClient
{
    private  $_tokenService;
    private  $_chargeService;
    private  $cardService;
    private  $_customerService;
    private  $_Reportingservice;
    private  $_Recurringpaymentservice;
    private  $_visaCheckoutService;

    /**
     * @return ApiServices\Customers\Customerservice
     */
    public function customerService()
    {
        return $this->_customerService;
    }

    /**
     * @return ApiServices\Charges\Chargeservice
     */
    public function chargeService()
    {
        return $this->_chargeService;
    }

    /**
     * @return ApiServices\Tokens\TokenService
     */
    public function tokenService()
    {
        return $this->_tokenService;
    }

    /**
     * @return ApiServices\Cards\Cardservice
     */
    public function cardService()
    {
        return $this->cardService;
    }

    /**
     * @return ApiServices\Reporting\Reportingservice
     */
    public function Reportingservice()
    {
        return $this->_Reportingservice;
    }

    /**
     * @return ApiServices\Recurringpayments\Recurringpaymentservice
     */
    public function Recurringpaymentservice()
    {
        return $this->_Recurringpaymentservice;
    }

    /**
     * @return ApiServices\VisaCheckout\VisaCheckoutService
     */
    public function visaCheckoutService()
    {
        return $this->_visaCheckoutService;
    }

    public function __construct($secretKey, $env = 'sandbox' ,$debugMode = false, $connectTimeout = 60, $readTimeout =
        60
    ) {
        $appSetting = helpers\AppSetting::getSingletonInstance();
        $appSetting->setSecretKey($secretKey);
        $appSetting->setRequestTimeOut($connectTimeout);
        $appSetting->setReadTimeout($readTimeout);
        $appSetting->setDebugMode($debugMode);
        $appSetting->setMode($env);

        $this->_tokenService = new ApiServices\Tokens\TokenService($appSetting);
        $this->_chargeService = new ApiServices\Charges\Chargeservice($appSetting);
        $this->cardService = new ApiServices\Cards\Cardservice($appSetting);
        $this->_customerService = new ApiServices\Customers\Customerservice($appSetting);
        $this->_Reportingservice = new ApiServices\Reporting\Reportingservice($appSetting);
        $this->_Recurringpaymentservice = new ApiServices\Recurringpayments\Recurringpaymentservice($appSetting);
        $this->_visaCheckoutService = new ApiServices\VisaCheckout\VisaCheckoutService($appSetting);

    }
}
