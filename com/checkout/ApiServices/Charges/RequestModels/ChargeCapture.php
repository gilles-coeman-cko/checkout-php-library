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
 * Time: 12:17 PM
 */

namespace com\checkout\ApiServices\Charges\RequestModels;


class ChargeCapture
{
    private $_chargeId;
    private $_value;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @param mixed $value
     */
    public function setValue( $value )
    {
        $this->_value = $value;
    }

    /**
     * @return mixed
     */
    public function getChargeId()
    {
        return $this->_chargeId;
    }

    /**
     * @param mixed $chargeId
     */
    public function setChargeId( $chargeId )
    {
        $this->_chargeId = $chargeId;
    }
}
