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
 * Date: 3/19/2015
 * Time: 7:44 AM
 */

namespace com\checkout\ApiServices\Customers\RequestModels;


class CustomerUpdate extends BaseCustomer
{

    private $_customerId;

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
}
