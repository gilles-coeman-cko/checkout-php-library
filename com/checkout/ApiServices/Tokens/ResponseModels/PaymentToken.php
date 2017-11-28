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
 * Time: 4:27 PM
 */

namespace com\checkout\ApiServices\Tokens\ResponseModels;


class Paymenttoken
{
    private $id;
    private $liveMode;


    public  function __construct($response)
    {
        $this->setId($response->getId());
        $this->setLiveMode($response->getLiveMode());
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    private function setId( $id )
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLiveMode()
    {
        return $this->liveMode;
    }

    /**
     * @param mixed $liveMode
     */
    private function setLiveMode( $liveMode )
    {
        $this->liveMode = $liveMode;
    }


}
