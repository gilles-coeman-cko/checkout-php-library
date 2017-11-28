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
        $this->setCustomerFields($response->getCustomerFields());
        $this->setDimensions($response->getDimensions());
        $this->setId($response->getId());
        $this->setIframe($response->getIframe());
        $this->setName($response->getName());
        $this->setRegions($response->getRegions());
        $this->setType($response->getType());

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
    protected function setCustomerFields( $customerFields )
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
    protected function setDimensions( $dimensions )
    {
        $this->_dimensions = $dimensions->toArray();
    }

    /**
     * @param mixed $id
     */
    protected function setId( $id )
    {
        $this->id = $id;
    }

    /**
     * @param mixed $iframe
     */
    protected function setIframe( $iframe )
    {
        $this->_iframe = $iframe;
    }

    /**
     * @param mixed $name
     */
    protected function setName( $name )
    {
        $this->name = $name;
    }

    /**
     * @param mixed $regions
     */
    protected function setRegions( $regions )
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
    protected function setType( $type )
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
