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

namespace com\checkout\ApiServices\VisaCheckout\ResponseModels;


class VisaCheckoutCardToken
{
    private $object;
    private $id;
    private $liveMode;
    private $created;
    private $_used;
    private $card;
    private $binData;


    public  function __construct($response)
    {

        $this->setCard($response->getCard());
        $this->setCreated($response->getCreated());
        $this->setId($response->getId());
        $this->setLiveMode($response->getLiveMode());
        $this->setObject($response->getObject());
        $this->setUsed($response->getUsed());

        if ($response->getBinData() != null) {
            $this->setBinData($response->getBinData());
        }

    }



    /**
     * @param mixed $Card
     */
    private function setCard( $card )
    {
        
        $cardObg = new \com\checkout\ApiServices\Cards\ResponseModels\Card($card);
        $this->card = $cardObg;

    }

    /**
     * @param mixed $BinData
     */
    private function setBinData( $binData )
    {
        $binDataObg = new \com\checkout\ApiServices\SharedModels\BinData();
        
        $binDataObg->setBin($binData->getBin());
        $binDataObg->setObject($binData->getObject());
        $binDataObg->setIssuerCountryISO2($binData->getIssuerCountryISO2());
        $binDataObg->setCardType($binData->getCardType());
        $this->binData = $binDataObg;

    }

    /**
     * @param mixed $created
     */
    private function setCreated( $created )
    {
        $this->created = $created;
    }

    /**
     * @param mixed $id
     */
    private function setId( $id )
    {
        $this->id = $id;
    }

    /**
     * @param mixed $liveMode
     */
    private function setLiveMode( $liveMode )
    {
        $this->liveMode = $liveMode;
    }

    /**
     * @param mixed $object
     */
    private function setObject( $object )
    {
        $this->object = $object;
    }

    /**
     * @param mixed $used
     */
    private function setUsed( $used )
    {
        $this->_used = $used;
    }

    /**
     * @return mixed
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
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
    public function getLiveMode()
    {
        return $this->liveMode;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @return mixed
     */
    public function getUsed()
    {
        return $this->_used;
    }

    /**
     * @return mixed
     */
    public function getBinData()
    {
        return $this->binData;
    }

}
