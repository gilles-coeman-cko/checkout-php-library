<?php

/**
 * Checkout.com ApiServices\SharedModels\OkResponse.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\ApiServices\SharedModels;

/**
 * Class OkResponse.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class OkResponse extends \com\checkout\ApiServices\SharedModels\BaseHttp
{
  /**
   * Class constructor.
   *
   * @param null $response
   *   The response model.
   */
  public function __construct($response)
  {
    parent::__construct($response);
    $this->setMessage($response->getMessage());
  }

  protected $message;

  /**
   * Get the message.
   *
   * @return mixed
   *   The message.
   */
  public function getMessage()
  {
    return $this->message;
  }

  /**
   * Set the message.
   *
   * @param mixed $message
   *   The message.
   */
  public function setMessage($message)
  {
    $this->message = $message;
  }
}
