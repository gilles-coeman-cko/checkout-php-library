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
namespace  com\checkout\ApiServices\Cards\RequestModels;

class BaseCard
{
    protected $name;
    protected $_expiryMonth;
    protected $_expiryYear;
    protected $_billingDetails;
    protected $_defaultCard;
    
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
    public function getExpiryMonth()
    {
        return $this->_expiryMonth;
    }

    /**
     * @param mixed $expiryMonth
     */
    public function setExpiryMonth( $expiryMonth )
    {
        $this->_expiryMonth = $expiryMonth;
    }

    /**
     * @return mixed
     */
    public function getExpiryYear()
    {
        return $this->_expiryYear;
    }

    /**
     * @param mixed $expiryYear
     */
    public function setExpiryYear( $expiryYear )
    {
        $this->_expiryYear = $expiryYear;
    }

    /**
     * @return mixed
     */
    public function getBillingDetails()
    {
        return $this->_billingDetails;
    }

    /**
     * @param mixed $billingDetails
     */
    public function setBillingDetails( \com\checkout\ApiServices\SharedModels\Address $billingDetails )
    {
        $this->_billingDetails = $billingDetails;
    }
           
    /**
     * @return mixed
     */
    public function getDefaultCard()
    {
        return $this->_defaultCard;
    }
    
    /**
     * @param mixed $defaultCard
     */
    public function setDefaultCard( $defaultCard )
    {
        $this->_defaultCard = $defaultCard;
    }
}
