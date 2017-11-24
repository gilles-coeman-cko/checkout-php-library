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

namespace com\checkout\ApiServices\Charges\ResponseModels;


class ChargeHistory extends \com\checkout\ApiServices\SharedModels\BaseHttp
{
    protected $object;
    protected $id;
    protected $_charges;


    public function __construct($response)
    {
        parent::__construct($response);

        $this->setObject($response->getObject());
        
        if($response->getCharges()) {
            $this->_setCharges($response->getCharges());
        }
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
    public function getCharges()
    {
        return $this->_charges;
    }


    /**
     * @param mixed $object
     */
    private function setObject( $object )
    {
        $this->object = $object;
    }


    /**
     * @param mixed $charges
     */
    protected function _setCharges( $charges )
    {
        $chargesArray = $charges->toArray();
        $chargesToReturn = array();
        if($chargesArray) {
            foreach($chargesArray as $item){
                $charge  = new \com\checkout\ApiServices\SharedModels\Charge();
                $charge->setId($item['id']);
                $charge->setChargeMode($item['chargeMode']);
                $charge->setCreated($item['created']);
                $charge->setEmail($item['email']);
                $charge->setLiveMode($item['liveMode']);
                $charge->setStatus($item['status']);
                $charge->setTrackId($item['trackId']);
                $charge->setValue($item['value']);
                $charge->setStatus($item['status']);
                $charge->setResponseCode($item['responseCode']);
                $chargesToReturn[] = $charge;
            }
        }

        $this->_charges = $chargesToReturn;
    }


    /**
     * @param mixed $responseCode
     */
    private function setResponseCode( $responseCode )
    {
        $this->responseCode = $responseCode;
    }

}
