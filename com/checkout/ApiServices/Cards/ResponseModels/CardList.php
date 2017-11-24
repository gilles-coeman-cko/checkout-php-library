<?php

/**
 * Checkout.com Api Services Recurring Payment Card List.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\ApiServices\Cards\ResponseModels;

/**
 * Class Card List.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class CardList extends \com\checkout\ApiServices\SharedModels\BaseHttp
{
  private $object;
  private $count;
  private $data;

  /**
   * Class constructor.
   *
   * @param mixed $requestModel
   *   The request model.
   */
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
  private function setCount($count)
  {
    $this->count = $count;
  }
  public function getCount()
  {
    return $this->count;
  }
  /**
   * @param mixed $data
   */
  private function setData($data)
  {
    $arrayData = $data->toArray();
    foreach ($arrayData as $card) {
      $this->data[] = $this->getCard($card);
    }
  }
  public function getData()
  {
    return $this->data;
  }
  /**
   * @param mixed $object
   */
  private function setObject($object)
  {
    $this->object = $object;
  }
  private function getCard($card)
  {
    $dummyObjCart = new \CheckoutApi_LibrespondObj();
    $dummyObjCart->setConfig($card);
    $cardObg = new \com\checkout\ApiServices\Cards\ResponseModels\Card($dummyObjCart);
    return $cardObg;
  }
}
