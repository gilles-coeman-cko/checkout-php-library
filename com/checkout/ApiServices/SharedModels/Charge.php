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

class Charge extends \com\checkout\ApiServices\SharedModels\BaseHttp
{

    protected $object;
    protected $id;
    protected $_chargeMode;
    protected $_created;
    protected $_email;
    protected $_liveMode;
    protected $status;
    protected $_trackId;
    protected $value;
    protected $responseCode;


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
    public function getChargeMode()
    {
        return $this->_chargeMode;
    }


    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->_created;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
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
    public function getStatus()
    {
        return $this->status;
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
    public function getValue()
    {
        return $this->value;
    }


    /**
     * @return mixed
     */
    public function getResponseCode()
    {
        return $this->responseCode;
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
     * @param mixed $chargeMode
     */
    public function setChargeMode( $chargeMode )
    {
        $this->_chargeMode = $chargeMode;
    }

    /**
     * @param mixed
     */
    public function setCreated( $created )
    {
        $this->_created = $created;
    }


    /**
     * @param mixed
     */
    public function setEmail( $email )
    {
        $this->_email = $email;
    }


    /**
     * @param mixed
     */
    public function setLiveMode( $liveMode )
    {
        $this->_liveMode = $liveMode;
    }


    /**
     * @param mixed
     */
    public function setStatus( $status )
    {
        $this->status = $status;
    }


    /**
     * @param mixed
     */
    public function setTrackId( $trackId )
    {
        $this->_trackId = $trackId;
    }


    /**
     * @param mixed
     */
    public function setValue( $value )
    {
        $this->value = $value;
    }


    /**
     * @param mixed $responseCode
     */
    public function setResponseCode( $responseCode )
    {
        $this->responseCode = $responseCode;
    }

}
