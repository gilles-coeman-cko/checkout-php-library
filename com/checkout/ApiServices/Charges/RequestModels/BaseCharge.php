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
namespace com\checkout\ApiServices\Charges\RequestModels;

class BaseCharge extends BaseChargeInfo
{
    protected $_email;
    protected $_customerName;
    protected $_customerId;
    protected $_description;
    protected $_autoCapture;
    protected $autoCapTime;
    protected $_shippingDetails;
    protected $_products = array();
    protected $value;
    protected $currency;
    protected $_customerIp;
    protected $_chargeMode;
    protected $_riskCheck;
    protected $_attemptN3D;
    protected $_billingDetails;

    /**
     * @return mixed
     */
    public function getCustomerIp()
    {
        return $this->_customerIp;
    }

    /**
     * @param mixed $customerIp
     */
    public function setCustomerIp( $customerIp )
    {
        $this->_customerIp = $customerIp;
    }
    
    /**
     * @return mixed
     */
    public function getCustomerName()
    {
        return $this->_customerName;
    }

    /**
     * @param mixed $customerName
     */
    public function setCustomerName( $customerName )
    {
        $this->_customerName = $customerName;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency( $currency )
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue( $value )
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail( $email )
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->_customerId;
    }

    /**
     * @param mixed $customerId
     */
    public function setCustomerId( $customerId )
    {
        $this->_customerId = $customerId;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription( $description )
    {
        $this->_description = $description;
    }

    /**
     * @return mixed
     */
    public function getAutoCapture()
    {
        return $this->_autoCapture;
    }

    /**
     * @param mixed $autoCapture
     */
    public function setAutoCapture( $autoCapture )
    {
        $this->_autoCapture = $autoCapture;
    }

    /**
     * @return mixed
     */
    public function getAutoCapTime()
    {
        return $this->autoCapTime;
    }

    /**
     * @param mixed $autoCapTime
     */
    public function setAutoCapTime( $autoCapTime )
    {
        $this->autoCapTime = $autoCapTime;
    }

    /**
     * @return mixed
     */
    public function getShippingDetails()
    {
        return $this->_shippingDetails;
    }

    /**
     * @param mixed $shippingDetails
     */
    public function setShippingDetails( \com\checkout\ApiServices\SharedModels\Address $shippingDetails )
    {
        $this->_shippingDetails = $shippingDetails;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->_products;
    }

    /**
     * @param mixed $products
     */
    public function setProducts( \com\checkout\ApiServices\SharedModels\Product $products )
    {

        $this->_products[] = $products;
    }

    public function getChargeMode()
    {
        return $this->_chargeMode;
    }

    /**
     * @param mixed $chargeMode
     */
    public function setChargeMode( $chargeMode )
    {
        $this->_chargeMode = $chargeMode;
    }

    public function getRiskCheck()
    {
        return $this->_riskCheck;
    }

    /**
     * @param mixed $riskCheck
     */
    public function setRiskCheck( $riskCheck)
    {
        $this->_riskCheck= $riskCheck;
    }

    /**
     * @param mixed $attemptN3D
     */
    public function setAttemptN3D( $attemptN3D)
    {
        $this->_attemptN3D= $attemptN3D;
    }

    public function getAttemptN3D()
    {
        return $this->_attemptN3D;
    }

    /**
     * @param mixed billingDetails
     */
    public function setBillingDetails( $billingDetails)
    {
        $this->_billingDetails= $billingDetails;
    }
 
    public function getBillingDetails()
    {
        return $this->_billingDetails;
    }
}
