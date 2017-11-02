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


class ShippingAddress extends Address
{
    protected $_recipientName;

    /**
     * @return mixed
     */
    public function getRecipientName()
    {
        return $this->_recipientName;
    }

    /**
     * @param mixed $recipientName
     */
    public function setRecipientName( $recipientName )
    {
        $this->_recipientName = $recipientName;
    }
}
