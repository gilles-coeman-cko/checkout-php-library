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
 * Date: 3/17/2015
 * Time: 1:34 PM
 */

namespace com\checkout\ApiServices\Charges\RequestModels;


class ChargeRetrieveWithPaymentToken
{
    private  $_paymentToken;

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
}
