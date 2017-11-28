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
 * Time: 2:43 PM
 */

namespace com\checkout\ApiServices\Tokens\RequestModels;


class CardTokenCreate extends Basecharge
{
    protected $baseCardcreate;

    /**
     * @return mixed
     */
    public function getBasecardcreate()
    {
        return $this->baseCardcreate;
    }

    /**
     * @param mixed $baseCardcreate
     */
    public function setBasecardcreate( Basecardcreate $baseCardcreate )
    {
        $this->baseCardcreate = $baseCardcreate;
    }
}
