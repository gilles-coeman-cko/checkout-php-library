<?php

/**
 * Checkout.com ApiServices\Charges\RequestModels\Chargevoid.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\ApiServices\Charges\RequestModels;

/**
 * Class Charge Void.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Chargevoid extends Basechargeinfo
{
  protected $products = array();

  /**
   * Get the array of Product information.
   *
   * @return mixed
   *   The products.
   */
  public function getProducts()
  {
    return $this->products;
  }

  /**
   * Set the array of Product information.
   *
   * @param mixed $products
   *   The products.
   */
  public function setProducts(\com\checkout\ApiServices\SharedModels\Product $products)
  {

    $this->products[] = $products;
  }

}
