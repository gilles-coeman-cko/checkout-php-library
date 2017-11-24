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
namespace com\checkout\ApiServices\Charges\RequestModels;
/**
 * class CardCharge
 *
 * @package com\checkout\ApiServives\Charges\RequestModels
 * @note    make a magic function that convert in the concept of postedParam
 */
class CardChargeCreate extends BaseCharge
{
    protected $_baseCardCreate;
    protected $transactionIndicator;

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

    /**
     * @return mixed
     */
    public function getTransactionIndicator()
    {
        return $this->transactionIndicator;
    }

    /**
     * @param mixed $transactionIndicator
     */
    public function setTransactionIndicator($transactionIndicator)
    {
        $this->transactionIndicator = $transactionIndicator;
    }
}
