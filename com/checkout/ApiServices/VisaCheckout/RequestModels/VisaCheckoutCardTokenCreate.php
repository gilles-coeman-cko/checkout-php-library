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

namespace com\checkout\ApiServices\VisaCheckout\RequestModels;

class VisaCheckoutCardTokenCreate
{
    private $_callId            = null;
    private $_includeBinData    = null;
    

    /**
     * @param $callId
     */
    public function setCallId($callId) 
    {
        $this->_callId = $callId;
    }

    /**
     * @return null
     */
    public function getCallId() 
    {
        return $this->_callId;
    }

    /**
     * @param $includeBinData
     */
    public function setIncludeBinData($includeBinData) 
    {
        $this->_includeBinData = $includeBinData;
    }

    /**
     * @return null
     */
    public function getIncludeBinData() 
    {
        return $this->_includeBinData;
    }
}
