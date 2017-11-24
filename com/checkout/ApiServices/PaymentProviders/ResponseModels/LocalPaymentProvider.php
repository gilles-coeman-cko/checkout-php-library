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


class LocalPaymentProvider extends \com\checkout\ApiServices\SharedModels\BaseHttp
{
    protected $id;
    protected $_type;
    protected $name;
    protected $_iframe;
    protected $_regions;
    protected $countryCodes;
    protected $_dimensions;
    protected $_customerFields;

    public function __construct($response)
    {
        parent::__construct($response);
        $this->setCountryCodes($response->getCountryCodes());
        $this->_setCustomerFields($response->getCustomerFields());
        $this->_setDimensions($response->getDimensions());
        $this->_setId($response->getId());
        $this->_setIframe($response->getIframe());
        $this->_setName($response->getName());
        $this->_setRegions($response->getRegions());
        $this->_setType($response->getType());

    }    /**
          * @param mixed $CountryCodes
          */
    protected function setCountryCodes( $CountryCodes )
    {
        $this->countryCodes = $CountryCodes->toArray();
    }

    /**
     * @param mixed $customerFields
     */
    protected function _setCustomerFields( $customerFields )
    {

        $dataArray = $customerFields->toArray();
        foreach ( $dataArray as $customerField ) {
            $dummyObjCart = new \CheckoutApi_LibrespondObj();
            $dummyObjCart->setConfig($customerField);
            $customerFieldObj = new \PHPPlugin\ApiServices\PaymentProviders\ResponseModels\CustomFields(
                $dummyObjCart 
            );
            $this->_customerFields[ ] = $this->getProvider($customerFieldObj);
        }

    }

    /**
     * @param mixed $dimensions
     */
    protected function _setDimensions( $dimensions )
    {
        $this->_dimensions = $dimensions->toArray();
    }

    /**
     * @param mixed $id
     */
    protected function _setId( $id )
    {
        $this->id = $id;
    }

    /**
     * @param mixed $iframe
     */
    protected function _setIframe( $iframe )
    {
        $this->_iframe = $iframe;
    }

    /**
     * @param mixed $name
     */
    protected function _setName( $name )
    {
        $this->name = $name;
    }

    /**
     * @param mixed $regions
     */
    protected function _setRegions( $regions )
    {

        $dataArray = $regions->toArray();
        foreach ( $dataArray as $region ) {
            $dummyObjCart = new \CheckoutApi_LibrespondObj();
            $dummyObjCart->setConfig($region);
            $regionsObj = new \PHPPlugin\ApiServices\PaymentProviders\ResponseModels\Region(
                $dummyObjCart 
            );
            $this->_regions[ ] = $this->getProvider($regionsObj);
        }

    }

    /**
     * @param mixed $type
     */
    protected function _setType( $type )
    {
        $this->_type = $type;
    }

    /**
     * @return mixed
     */
    public function getCountryCodes()
    {
        return $this->countryCodes;
    }

    /**
     * @return mixed
     */
    public function getCustomerFields()
    {
        return $this->_customerFields;
    }

    /**
     * @return mixed
     */
    public function getDimensions()
    {
        return $this->_dimensions;
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
    public function getIframe()
    {
        return $this->_iframe;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getRegions()
    {
        return $this->_regions;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }


}
