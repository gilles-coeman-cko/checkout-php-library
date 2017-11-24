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


class CardProviderList extends \com\checkout\ApiServices\SharedModels\BaseHttp
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
        foreach($dataArray as $cardP){
            $this->data[] = $this->setCardProvider($cardP);
        }
    }

    private function setCardProvider($cardP)
    {
        $dummyObjCart = new \CheckoutApi_LibrespondObj();
        $dummyObjCart->setConfig($cardP);
        $cardObg = new \PHPPlugin\ApiServices\PaymentProviders\ResponseModels\CardProvider($dummyObjCart);
        return $cardObg;
    }
    /**
     * @param mixed $object
     */
    private function setObject( $object )
    {
        $this->object = $object;
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

}
