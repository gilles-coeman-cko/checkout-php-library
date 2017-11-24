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

class Customerpaymentplan extends \com\checkout\ApiServices\SharedModels\BaseHttp
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
    protected $customerPlanId;
    protected $recurringCountLeft;
    protected $totalCollectedValue;
    protected $totalCollectedCount;
    protected $startDate;
    protected $previousRecurringDate;
    protected $nextRecurringDate;


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
     * @return mixed
     */
    public function getCustomerPlanId()
    {
        return $this->customerPlanId;
    }


    /**
     * @return mixed
     */
    public function getRecurringCountLeft()
    {
        return $this->recurringCountLeft;
    }


    /**
     * @return mixed
     */
    public function getTotalCollectedValue()
    {
        return $this->totalCollectedValue;
    }


    /**
     * @return mixed
     */
    public function getTotalCollectedCount()
    {
        return $this->totalCollectedCount;
    }


    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }


    /**
     * @return mixed
     */
    public function getPreviousRecurringDate()
    {
        return $this->previousRecurringDate;
    }


    /**
     * @return mixed
     */
    public function getNextRecurringDate()
    {
        return $this->nextRecurringDate;
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
     * @param mixed
     */
    public function setCustomerPlanId( $customerPlanId )
    {
        $this->customerPlanId = $customerPlanId;
    }


    /**
     * @param mixed
     */
    public function setRecurringCountLeft( $recurringCountLeft )
    {
        $this->recurringCountLeft = $recurringCountLeft;
    }


    /**
     * @param mixed
     */
    public function setTotalCollectedValue( $totalCollectedValue )
    {
        $this->totalCollectedValue = $totalCollectedValue;
    }


    /**
     * @param mixed
     */
    public function setTotalCollectedCount( $totalCollectedCount )
    {
        $this->totalCollectedCount = $totalCollectedCount;
    }


    /**
     * @param mixed
     */
    public function setStartDate( $startDate )
    {
        $this->startDate = $startDate;
    }


    /**
     * @param mixed
     */
    public function setPreviousRecurringDate( $previousRecurringDate )
    {
        $this->previousRecurringDate = $previousRecurringDate;
    }


    /**
     * @param mixed
     */
    public function setNextRecurringDate( $nextRecurringDate )
    {
        $this->nextRecurringDate = $nextRecurringDate;
    }

    /**
     * @param mixed $responseCode
     */
    public function setResponseCode( $responseCode )
    {
        $this->responseCode = $responseCode;
    }

}
