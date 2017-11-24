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
    private $_liveMode;
    private $_created;
    private $_used;
    private $_card;
    private $_binData;


    public  function __construct($response)
    {

        $this->_setCard($response->getCard());
        $this->_setCreated($response->getCreated());
        $this->_setId($response->getId());
        $this->_setLiveMode($response->getLiveMode());
        $this->setObject($response->getObject());
        $this->_setUsed($response->getUsed());

        if ($response->getBinData() != null) {
            $this->_setBinData($response->getBinData());
        }

    }



    /**
     * @param mixed $Card
     */
    private function _setCard( $card )
    {
        
        $cardObg = new \com\checkout\ApiServices\Cards\ResponseModels\Card($card);
        $this->_card = $cardObg;

    }

    /**
     * @param mixed $BinData
     */
    private function _setBinData( $binData )
    {
        $binDataObg = new \com\checkout\ApiServices\SharedModels\BinData();
        
        $binDataObg->setBin($binData->getBin());
        $binDataObg->setObject($binData->getObject());
        $binDataObg->setIssuerCountryISO2($binData->getIssuerCountryISO2());
        $binDataObg->setCardType($binData->getCardType());
        $this->_binData = $binDataObg;

    }

    /**
     * @param mixed $created
     */
    private function _setCreated( $created )
    {
        $this->_created = $created;
    }

    /**
     * @param mixed $id
     */
    private function _setId( $id )
    {
        $this->id = $id;
    }

    /**
     * @param mixed $liveMode
     */
    private function _setLiveMode( $liveMode )
    {
        $this->_liveMode = $liveMode;
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
    private function _setUsed( $used )
    {
        $this->_used = $used;
    }

    /**
     * @return mixed
     */
    public function getCard()
    {
        return $this->_card;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->_created;
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
        return $this->_liveMode;
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
        return $this->_binData;
    }

}
