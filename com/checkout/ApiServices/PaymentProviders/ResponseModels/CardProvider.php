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
 * Time: 9:23 AM
 */

namespace com\checkout\ApiServices\PaymentProviders\ResponseModels;


class CardProvider extends \com\checkout\ApiServices\SharedModels\BaseHttp
{
    private $id;
    private $name;
    public function __construct($response)
    {
        parent::__construct($response);
        $this->_setId($response->getId());
        $this->_setName($response->getName());
    }

    /**
     * @param mixed $id
     */
    protected function _setId( $id )
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    protected function _setName( $name )
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

}
