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


class ChargeVoid extends BaseChargeInfo
{
    protected $_products = array();

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->_products;
    }

    /**
     * @param mixed $products
     */
    public function setProducts( \com\checkout\ApiServices\SharedModels\Product $products )
    {

        $this->_products[] = $products;
    }

}
