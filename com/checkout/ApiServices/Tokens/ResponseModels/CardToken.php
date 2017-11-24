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
 * Date: 3/18/2015
 * Time: 9:07 AM
 */

namespace com\checkout\ApiServices\Tokens\ResponseModels;


class CardToken
{
    private $object;
    private $id;
    private $_liveMode;
    private $_created;
    private $_used;
    private $_paymentType;
    private $_card;


    public  function __construct($response)
    {

        $this->_setCard($response->getCard());
        $this->_setCreated($response->getCreated());
        $this->_setId($response->getId());
        $this->_setLiveMode($response->getLiveMode());
        $this->setObject($response->getObject());
        $this->_setPaymentType($response->getPaymentType());
        $this->_setUsed($response->getUsed());

    }



    /**
     * @param mixed $Card
     */
    private function _setCard( $card )
    {
        $cardObg = new \com\checkout\ApiServices\Cards\ResponseModels\Card();
        $billingDetails  = new \com\checkout\ApiServices\SharedModels\Address();
        $billingAddress = $card->getBillingDetails();
        $billingDetails->setAddressLine1($billingAddress->getAddressLine1());
        $billingDetails->setAddressLine2($billingAddress->getAddressLine2());
        $billingDetails->setPostcode($billingAddress->getPostcode());
        $billingDetails->setCountry($billingAddress->getCountry());
        $billingDetails->setCity($billingAddress->getCity());
        $billingDetails->setState($billingAddress->getState());
        $billingDetails->setPhone($billingAddress->getPhone());

        $cardObg->setId($card->getId());
        $cardObg->setObject($card->getObject());
        $cardObg->setName($card->getName());
        $cardObg->setLast4($card->getLast4());
        $cardObg->setPaymentMethod($card->getPaymentMethod());
        $cardObg->setFingerprint($card->getFingerprint());
        $cardObg->setCustomerId($card->getCustomerId());
        $cardObg->setExpiryMonth($card->getExpiryMonth());
        $cardObg->setExpiryYear($card->getExpiryYear());
        $cardObg->setBillingDetails($billingDetails);
        $cardObg->setCvcCheck($card->getCvcCheck());
        $cardObg->setAvsCheck($card->getAvsCheck());
        $cardObg->setAuthCode($card->getAuthCode());
        $cardObg->setDefaultCard($card->getDefaultCard());
        $cardObg->setLiveMode($card->getLiveMode());
        $this->_card = $cardObg;

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
     * @param mixed $paymentType
     */
    private function _setPaymentType( $paymentType )
    {
        $this->_paymentType = $paymentType;
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
    public function getPaymentType()
    {
        return $this->_paymentType;
    }

    /**
     * @return mixed
     */
    public function getUsed()
    {
        return $this->_used;
    }


}
