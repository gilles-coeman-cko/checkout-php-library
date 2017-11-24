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

namespace com\checkout\ApiServices\SharedModels;

class Transaction extends \com\checkout\ApiServices\SharedModels\BaseHttp
{

    protected $object;
    protected $id;
    protected $_originId;
    protected $_date;
    protected $status;
    protected $_type;
    protected $_amount;
    protected $_scheme;
    protected $responseCode;
    protected $currency;
    protected $_liveMode;
    protected $_businessName;
    protected $_channelName;
    protected $_trackId;
    protected $_customerId;
    protected $_customerName;
    protected $_customerEmail;

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    
    /**
     * @return mixed
     */
    public function getOriginId()
    {
        return $this->_originId;
    }

    
    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->_date;
    }

    
    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    
    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    
    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    
    /**
     * @return mixed
     */
    public function getScheme()
    {
        return $this->_scheme;
    }

    
    /**
     * @return mixed
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    
    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    
    /**
     * @return mixed
     */
    public function getLiveMode()
    {
        return $this->_liveMode;
    }

    
    /**
     * @return mixed
     */
    public function getBusinessName()
    {
        return $this->_businessName;
    }

    
    /**
     * @return mixed
     */
    public function getChannelName()
    {
        return $this->_channelName;
    }

    
    /**
     * @return mixed
     */
    public function getTrackId()
    {
        return $this->_trackId;
    }

    
    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->_customerId;
    }

    
    /**
     * @return mixed
     */
    public function getCustomerName()
    {
        return $this->_customerName;
    }

    
    /**
     * @return mixed
     */
    public function getCustomerEmail()
    {
        return $this->_customerEmail;
    }

    
    /**
     * @param mixed $object
     */
    public function setObject( $object )
    {
        $this->object = $object;
    }

    /**
     * @param mixed $id
     */
    public function setId( $id )
    {
        $this->id = $id;
    }


    /**
     * @param mixed $originId
     */
    public function setOriginId( $originId )
    {
        $this->_originId = $originId;
    }


    /**
     * @param mixed $date
     */
    public function setDate( $date )
    {
        $this->_date = $date;
    }


    /**
     * @param mixed $status
     */
    public function setStatus( $status )
    {
        $this->status = $status;
    }


    /**
     * @param mixed $type
     */
    public function setType( $type )
    {
        $this->_type = $type;
    }


    /**
     * @param mixed $amount
     */
    public function setAmount( $amount )
    {
        $this->_amount = $amount;
    }


    /**
     * @param mixed $scheme
     */
    public function setScheme( $scheme )
    {
        $this->_scheme = $scheme;
    }


    /**
     * @param mixed $responseCode
     */
    public function setResponsecode( $responseCode )
    {
        $this->responseCode = $responseCode;
    }


    /**
     * @param mixed $currency
     */
    public function setCurrency( $currency )
    {
        $this->currency = $currency;
    }


    /**
     * @param mixed $liveMode
     */
    public function setLiveMode( $liveMode )
    {
        $this->_liveMode = $liveMode;
    }


    /**
     * @param mixed $businessName
     */
    public function setBusinessName( $businessName )
    {
        $this->_businessName = $businessName;
    }


    /**
     * @param mixed $channelName
     */
    public function setChannelName( $channelName )
    {
        $this->_channelName = $channelName;
    }


    /**
     * @param mixed $trackId
     */
    public function setTrackId( $trackId )
    {
        $this->_trackId = $trackId;
    }


    /**
     * @param mixed $customerId
     */
    public function setCustomerId( $customerId )
    {
        $this->_customerId = $customerId;
    }


    /**
     * @param mixed $customerName
     */
    public function setCustomerName( $customerName )
    {
        $this->_customerName = $customerName;
    }


    /**
     * @param mixed $customerEmail
     */
    public function setCustomerEmail( $customerEmail )
    {
        $this->_customerEmail = $customerEmail;
    }

}
