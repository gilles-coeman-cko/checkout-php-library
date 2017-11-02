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
namespace com\checkout\ApiServices\Cards\RequestModels;
/**
 * class CardCharge
 *
 * @package PHPPlugin\ApiServives\Charges\RequestModels
 * @note    make a magic function that convert in the concept of postedParam
 */
class CardCreate
{
    private $_customerId;
    private $_baseCardCreate;

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->_customerId;
    }

    /**
     * @param mixed $customerId
     */
    public function setCustomerId( $customerId )
    {
        $this->_customerId = $customerId;
    }

    /**
     * @return mixed
     */
    public function getBaseCardCreate()
    {
        return $this->_baseCardCreate;
    }

    /**
     * @param mixed $baseCardCreate
     */
    public function setBaseCardCreate( \com\checkout\ApiServices\Cards\RequestModels\BaseCardCreate $baseCardCreate )
    {
        $this->_baseCardCreate = $baseCardCreate;
    }
}
