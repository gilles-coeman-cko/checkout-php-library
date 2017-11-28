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


class CustomFields extends \com\checkout\ApiServices\SharedModels\BaseHttp
{
    protected $_key;
    protected $dataType;
    protected $_label;
    protected $_required;
    protected $_order;
    protected $_minLength;
    protected $_maxLength;
    protected $_isActive;
    protected $_errorCodes;
    protected $_lookupValues;

    public function __construct($response)
    {
        parent::__construct($response);
        $this->setDataType($response->getDataType());
        $this->setErrorCodes($response->getErrorCodes());
        $this->sethisActive($response->gethisActive());
        $this->setKey($response->getKey());
        $this->setLabel($response->getLabel());
        $this->setLookupValues($response->getLookupValues());
        $this->setMaxLength($response->getMaxLength());
        $this->setMinLength($response->getMinLength());
        $this->setOrder($response->getOrder());
        $this->setRequired($response->getRequired());

    }

    /**
     * @param mixed $dataType
     */
    protected function setDataType( $dataType )
    {
        $this->dataType = $dataType;
    }

    /**
     * @param mixed $errorCodes
     */
    protected function setErrorCodes( $errorCodes )
    {
        $this->_errorCodes = $errorCodes->toArray();
    }

    /**
     * @param mixed $isActive
     */
    protected function setIsActive( $isActive )
    {
        $this->_isActive = $isActive;
    }

    /**
     * @param mixed $key
     */
    protected function setKey( $key )
    {
        $this->_key = $key;
    }

    /**
     * @param mixed $label
     */
    protected function setLabel( $label )
    {
        $this->_label = $label;
    }

    /**
     * @param mixed $lookupValues
     */
    protected function setLookupValues( $lookupValues )
    {
        $this->_lookupValues = $lookupValues->toArray();
    }

    /**
     * @param mixed $maxLength
     */
    protected function setMaxLength( $maxLength )
    {
        $this->_maxLength = $maxLength;
    }

    /**
     * @param mixed $minLength
     */
    protected function setMinLength( $minLength )
    {
        $this->_minLength = $minLength;
    }

    /**
     * @param mixed $order
     */
    protected function setOrder( $order )
    {
        $this->_order = $order;
    }

    /**
     * @param mixed $required
     */
    protected function setRequired( $required )
    {
        $this->_required = $required;
    }

    /**
     * @return mixed
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * @param mixed $dataType
     */
    public function setDataType( $dataType )
    {
        $this->dataType = $dataType;
    }

    /**
     * @return mixed
     */
    public function getErrorCodes()
    {
        return $this->_errorCodes;
    }

    /**
     * @param mixed $errorCodes
     */
    public function setErrorCodes( $errorCodes )
    {
        $this->_errorCodes = $errorCodes;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->_isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive( $isActive )
    {
        $this->_isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->_key;
    }

    /**
     * @param mixed $key
     */
    public function setKey( $key )
    {
        $this->_key = $key;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->_label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel( $label )
    {
        $this->_label = $label;
    }

    /**
     * @return mixed
     */
    public function getLookupValues()
    {
        return $this->_lookupValues;
    }

    /**
     * @param mixed $lookupValues
     */
    public function setLookupValues( $lookupValues )
    {
        $this->_lookupValues = $lookupValues;
    }

    /**
     * @return mixed
     */
    public function getMaxLength()
    {
        return $this->_maxLength;
    }

    /**
     * @param mixed $maxLength
     */
    public function setMaxLength( $maxLength )
    {
        $this->_maxLength = $maxLength;
    }

    /**
     * @return mixed
     */
    public function getMinLength()
    {
        return $this->_minLength;
    }

    /**
     * @param mixed $minLength
     */
    public function setMinLength( $minLength )
    {
        $this->_minLength = $minLength;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->_order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder( $order )
    {
        $this->_order = $order;
    }

    /**
     * @return mixed
     */
    public function getRequired()
    {
        return $this->_required;
    }

    /**
     * @param mixed $required
     */
    public function setRequired( $required )
    {
        $this->_required = $required;
    }

}
