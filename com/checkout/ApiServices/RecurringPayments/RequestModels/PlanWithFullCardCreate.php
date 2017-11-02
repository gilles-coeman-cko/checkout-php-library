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

namespace com\checkout\ApiServices\RecurringPayments\RequestModels;


class PlanWithFullCardCreate extends \com\checkout\ApiServices\Charges\RequestModels\BaseCharge
{
    protected $_baseCardCreate;
    protected $_transactionIndicator;
    protected $_paymentPlans;

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
        return $this->_transactionIndicator;
    }

    /**
     * @param mixed $transactionIndicator
     */
    public function setTransactionIndicator($transactionIndicator)
    {
        $this->_transactionIndicator = $transactionIndicator;
    }

    /**
     * @return mixed
     */
    public function getPaymentPlans()
    {
        return $this->_paymentPlans;
    }

    /**
     * @param mixed $paymentPlans
     */
    public function setPaymentPlans( BaseRecurringPayment $paymentPlans )
    {
        $this->_paymentPlans[] = $paymentPlans;
    }
}
