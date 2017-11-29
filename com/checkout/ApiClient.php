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
     * @return Apiservices\Customers\Customerservice
     */
    public function customerService()
    {
        return $this->_customerService;
    }

    /**
     * @return Apiservices\Charges\Chargeservice
     */
    public function chargeService()
    {
        return $this->_chargeService;
    }

    /**
     * @return Apiservices\Tokens\Tokenservice
     */
    public function tokenService()
    {
        return $this->_tokenService;
    }

    /**
     * @return Apiservices\Cards\Cardservice
     */
    public function cardService()
    {
        return $this->cardService;
    }

    /**
     * @return Apiservices\Reporting\Reportingservice
     */
    public function Reportingservice()
    {
        return $this->_Reportingservice;
    }

    /**
     * @return Apiservices\Recurringpayments\Recurringpaymentservice
     */
    public function Recurringpaymentservice()
    {
        return $this->_Recurringpaymentservice;
    }

    /**
     * @return Apiservices\Visacheckout\Visacheckoutservice
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

        $this->_tokenService = new Apiservices\Tokens\Tokenservice($appSetting);
        $this->_chargeService = new Apiservices\Charges\Chargeservice($appSetting);
        $this->cardService = new Apiservices\Cards\Cardservice($appSetting);
        $this->_customerService = new Apiservices\Customers\Customerservice($appSetting);
        $this->_Reportingservice = new Apiservices\Reporting\Reportingservice($appSetting);
        $this->_Recurringpaymentservice = new Apiservices\Recurringpayments\Recurringpaymentservice($appSetting);
        $this->_visaCheckoutService = new Apiservices\Visacheckout\Visacheckoutservice($appSetting);

    }
}
