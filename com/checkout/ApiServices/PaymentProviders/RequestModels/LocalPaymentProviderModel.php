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
 * Time: 9:23 AM
 */

namespace com\checkout\ApiServices\PaymentProviders\RequestModels;


class LocalPaymentProviderModel
{
    private $_providerId;
    private $_paymentToken;
    private $_ip;
    private $countryCode;
    private $_limit;
    private $name;
    private $_region;

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param mixed $countryCode
     */
    public function setCountryCode( $countryCode )
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->_ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp( $ip )
    {
        $this->_ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->_limit;
    }

    /**
     * @param mixed $limit
     */
    public function setLimit( $limit )
    {
        $this->_limit = $limit;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName( $name )
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPaymentToken()
    {
        return $this->_paymentToken;
    }

    /**
     * @param mixed $paymentToken
     */
    public function setPaymentToken( $paymentToken )
    {
        $this->_paymentToken = $paymentToken;
    }

    /**
     * @return mixed
     */
    public function getProviderId()
    {
        return $this->_providerId;
    }

    /**
     * @param mixed $providerId
     */
    public function setProviderId( $providerId )
    {
        $this->_providerId = $providerId;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->_region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion( $region )
    {
        $this->_region = $region;
    }

}
