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
 * Date: 5/12/2015
 * Time: 8:20 AM
 */

namespace com\checkout\ApiServices\SharedModels;


class Phone
{
    protected $_number;
    protected $countryCode;

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->_number;
    }

    /**
     * @param mixed $countryCode
     */
    public function setCountryCode( $countryCode )
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @param mixed $number
     */
    public function setNumber( $number )
    {
        $this->_number = $number;
    }

    public function getPhoneDetails()
    {
        return array(
            'number'      => $this->_number,
            'countryCode' => $this->countryCode
        );
    }
}
