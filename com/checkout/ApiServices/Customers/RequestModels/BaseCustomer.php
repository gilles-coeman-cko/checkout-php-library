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
 * Date: 3/19/2015
 * Time: 7:49 AM
 */

namespace com\checkout\ApiServices\Customers\RequestModels;


class BaseCustomer
{
    protected $name;
    protected $_customerName;
    protected $_email;
    protected $_phoneNumber;
    protected $_description;
    protected $_metadata = array();
    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription( $description )
    {
        $this->_description = $description;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail( $email )
    {
        $this->_email = $email;
    }

    /**
     * @return array
     */
    public function getMetadata()
    {
        return $this->_metadata;
    }

    /**
     * @param array $metadata
     */
    public function setMetadata( $metadata )
    {
        if(!empty($metadata) && is_array($metadata)) {
            $this->_metadata = array_merge_recursive($this->_metadata, $metadata);
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName( $name )
    {
        $this->name = $name;
    }
    
    /**
     * @return mixed
     */
    public function getCustomerName()
    {
        return $this->_customerName;
    }

    /**
     * @param mixed $customerName
     */
    public function setCustomerName( $customerName )
    {
        $this->_customerName = $customerName;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->_phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber( \com\checkout\ApiServices\SharedModels\Phone $phoneNumber )
    {
        $this->_phoneNumber = $phoneNumber;
    }

}
