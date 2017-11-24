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

class Paymentplan extends \com\checkout\ApiServices\SharedModels\BaseHttp
{

    protected $object;
    protected $planId;
    protected $name;
    protected $planTrackId;
    protected $autoCapTime;
    protected $currency;
    protected $value;
    protected $cycle;
    protected $recurringCount;
    protected $status;


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
    public function getPlanId()
    {
        return $this->planId;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return mixed
     */
    public function getPlanTrackId()
    {
        return $this->planTrackId;
    }


    /**
     * @return mixed
     */
    public function getAutoCapTime()
    {
        return $this->autoCapTime;
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
    public function getValue()
    {
        return $this->value;
    }


    /**
     * @return mixed
     */
    public function getCycle()
    {
        return $this->cycle;
    }


    /**
     * @return mixed
     */
    public function getRecurringCount()
    {
        return $this->recurringCount;
    }


    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
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
    public function setPlanId( $planId )
    {
        $this->planId = $planId;
    }

    
    /**
     * @param mixed $name
     */
    public function setName( $name )
    {
        $this->name = $name;
    }

    /**
     * @param mixed
     */
    public function setPlanTrackId( $planTrackId )
    {
        $this->planTrackId = $planTrackId;
    }


    /**
     * @param mixed
     */
    public function setAutoCapTime( $autoCapTime )
    {
        $this->autoCapTime = $autoCapTime;
    }


    /**
     * @param mixed
     */
    public function setCurrency( $currency )
    {
        $this->currency = $currency;
    }

    
    /**
     * @param mixed
     */
    public function setValue( $value )
    {
        $this->value = $value;
    }


    /**
     * @param mixed
     */
    public function setCycle( $cycle )
    {
        $this->cycle = $cycle;
    }


    /**
     * @param mixed
     */
    public function setRecurringCount( $recurringCount )
    {
        $this->recurringCount = $recurringCount;
    }


    /**
     * @param mixed
     */
    public function setStatus( $status )
    {
        $this->status = $status;
    }


    /**
     * @param mixed $responseCode
     */
    public function setResponseCode( $responseCode )
    {
        $this->responseCode = $responseCode;
    }

}
