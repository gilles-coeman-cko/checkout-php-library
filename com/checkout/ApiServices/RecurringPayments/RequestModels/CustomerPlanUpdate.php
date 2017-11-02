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


class CustomerPlanUpdate extends BaseRecurringPayment
{
    private $_customerPlanId;
    private $_cardId;

    /**
     * @return mixed
     */
    public function getCustomerPlanId()
    {
        return $this->_customerPlanId;
    }

    /**
     * @param mixed $planId
     */
    public function setCustomerPlanId( $customerPlanId )
    {
        $this->_customerPlanId = $customerPlanId;
    }

    /**
     * @return mixed
     */
    public function getCardId()
    {
        return $this->_cardId;
    }

    /**
     * @param mixed $cardId
     */
    public function setCardId( $cardId )
    {
        $this->_cardId = $cardId;
    }
}
