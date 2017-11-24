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
 * Date: 3/23/2015
 * Time: 9:24 AM
 */

namespace com\checkout\ApiServices\PaymentProviders\ResponseModels;


class Region extends \com\checkout\ApiServices\SharedModels\BaseHttp
{
    private $_regionId;
    private $name;

    public function __construct($response)
    {
        parent::__construct($response);
        $this->_setName($response->getName());
        $this->_setRegionId($response->getRegionId());
    }
    /**
     * @param mixed $name
     */
    private function _setName( $name )
    {
        $this->name = $name;
    }

    /**
     * @param mixed $regionId
     */
    private function _setRegionId( $regionId )
    {
        $this->_regionId = $regionId;
    }
}
