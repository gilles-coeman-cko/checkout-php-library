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
 * Time: 11:31 AM
 */

namespace com\checkout\ApiServices\Charges\RequestModels;


class CardTokenChargeCreate extends BaseCharge
{
    private $_cardToken;
    protected $transactionIndicator;

    /**
     * @return mixed
     */
    public function getCardToken()
    {
        return $this->_cardToken;
    }

    /**
     * @param mixed $cardToken
     */
    public function setCardToken( $cardToken )
    {
        $this->_cardToken = $cardToken;
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
