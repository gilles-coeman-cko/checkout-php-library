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
 * Time: 7:43 AM
 */

namespace com\checkout\ApiServices\Customers\RequestModels;


class CustomerCreate extends BaseCustomer
{
    protected $_baseCardCreate;

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
