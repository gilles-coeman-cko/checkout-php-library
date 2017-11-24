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
 * Time: 1:54 PM
 */

namespace com\checkout\ApiServices\Charges\ResponseModels;


class PaymentToken extends \com\checkout\ApiServices\SharedModels\BaseHttp
{
    private $id;
    private $_liveMode;
    private $responseCode;
    private $_chargeMode;
    private $_response = null;
    private $_redirectUrl;

    public function __construct($response)
    {
        parent::__construct($response);
        $this->_setChargeMode($response->getChargeMode());
        $this->_setId($response->getId());
        $this->_setLiveMode($response->getLiveMode());
        $this->setResponseCode($response->getResponseCode());
        $this->_setRedirectUrl($response->getRedirecturl());
        $this->_setResponse($response);
    }

    /**
     * @return null
     */
    public function getResponse()
    {
        return $this->_response;
    }

    /**
     * @param null $response
     */
    private function _setResponse( $response )
    {
        $this->_response = $response;
    }

    /**
     * @return mixed
     */
    public function getChargeMode()
    {
        return $this->_chargeMode;
    }

    /**
     * @param mixed $chargeMode
     */
    private function _setChargeMode( $chargeMode )
    {
        $this->_chargeMode = $chargeMode;
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
    private function _setId( $id )
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLiveMode()
    {
        return $this->_liveMode;
    }

    /**
     * @param mixed $liveMode
     */
    private function _setLiveMode( $liveMode )
    {
        $this->_liveMode = $liveMode;
    }

    /**
     * @return mixed
     */
    public function getRedirectUrl()
    {
        return $this->_redirectUrl;
    }

    /**
     * @param mixed $redirectUrl
     */
    private function _setRedirectUrl( $redirectUrl )
    {
        $this->_redirectUrl = $redirectUrl;
    }

    /**
     * @return mixed
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * @param mixed $responseCode
     */
    private function setResponseCode( $responseCode )
    {
        $this->responseCode = $responseCode;
    }

}
