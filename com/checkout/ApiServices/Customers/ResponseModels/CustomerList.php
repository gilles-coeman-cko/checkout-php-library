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
 * Time: 7:48 AM
 */

namespace com\checkout\ApiServices\Customers\ResponseModels;


class CustomerList  extends \com\checkout\ApiServices\SharedModels\BaseHttp
{
    private $object;
    private $count;
    private $data;

    public function __construct($response)
    {
        parent::__construct($response);
        $this->setCount($response->getCount());
        $this->setData($response->getData());
        $this->setObject($response->getObject());
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param mixed $count
     */
    private function setCount( $count )
    {
        $this->count = $count;
    }

    /**
     * @param mixed $data
     */
    private function setData( $data )
    {
        $dataArray = $data->toArray();
        foreach($dataArray as $customer){
            $this->data[] = $this->getCustomer($customer);
        }
    }

    /**
     * @param mixed $object
     */

    private function setObject( $object )
    {
        $this->object = $object;
    }

    private function getCustomer( $customer )
    {
        $dummyObjCart = new \CheckoutApi_LibrespondObj();
        $dummyObjCart->setConfig($customer);
        $cardObg = new Customer($dummyObjCart);
        return $cardObg;
    }

}
