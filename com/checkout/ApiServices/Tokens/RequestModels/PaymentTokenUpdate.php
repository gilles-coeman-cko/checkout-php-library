<?php

/**
 * Checkout.com Apiservices\Tokens\Responsemodels\Paymenttokenupdate.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices\Tokens\Requestmodels;

/**
 * Class Payment Token Update.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Paymenttokenupdate
{
  private $id;
  protected $trackId;
  protected $udf1;
  protected $udf2;
  protected $udf3;
  protected $udf4;
  protected $udf5;
  protected $metadata = [];

  /**
   * Paymenttokenupdate constructor.
   *
   * @param string $id
   */
  public function __construct($id)
  {
    $this->setId($id);
  }

  /**
   * Get a card token id.
   *
   * Note: The card token is prefix card_tok_.
   * Note: A cardToken can only be used once and will expire after 15 minutes.
   *
   * @return mixed
   *   The id.
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set a card token id.
   *
   * Note: The card token is prefix card_tok_.
   * Note: A cardToken can only be used once and will expire after 15 minutes.
   *
   * @param mixed $id
   *   The id.
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  /**
   * Get the user defined field 1.
   *
   * User defined field 1, max. 100 characters
   *
   * @return mixed
   *   The udf1.
   */
  public function getUdf1()
  {
    return $this->udf1;
  }

  /**
   * Set the user defined field 1.
   *
   * User defined field 1, max. 100 characters
   *
   * @param mixed $udf1
   *   The udf1.
   */
  public function setUdf1($udf1)
  {
    $this->udf1 = $udf1;
  }

  /**
   * Get the user defined field 2.
   *
   * User defined field 2, max. 100 characters
   *
   * @return mixed
   *   The udf2.
   */
  public function getUdf2()
  {
    return $this->udf2;
  }

  /**
   * Set the user defined field 2.
   *
   * User defined field 2, max. 100 characters
   *
   * @param mixed $udf2
   *   The udf2.
   */
  public function setUdf2($udf2)
  {
    $this->udf2 = $udf2;
  }

  /**
   * Get the user defined field 3.
   *
   * User defined field 3, max. 100 characters
   *
   * @return mixed
   *   The udf3.
   */
  public function getUdf3()
  {
    return $this->udf3;
  }

  /**
   * Set the user defined field 3.
   *
   * User defined field 3, max. 100 characters
   *
   * @param mixed $udf3
   *   The udf3.
   */
  public function setUdf3($udf3)
  {
    $this->udf3 = $udf3;
  }

  /**
   * Get the user defined field 4.
   *
   * User defined field 4, max. 100 characters
   *
   * @return mixed
   *   The udf4.
   */
  public function getUdf4()
  {
    return $this->udf4;
  }

  /**
   * Set the user defined field 4.
   *
   * User defined field 4, max. 100 characters
   *
   * @param mixed $udf4
   *   The udf4.
   */
  public function setUdf4($udf4)
  {
    $this->udf4 = $udf4;
  }

  /**
   * Get the user defined field 5.
   *
   * User defined field 5, max. 100 characters
   *
   * @return mixed
   *   The udf5.
   */
  public function getUdf5()
  {
    return $this->udf5;
  }

  /**
   * Set the user defined field 5.
   *
   * User defined field 5, max. 100 characters
   *
   * @param mixed $udf5
   *   The udf5.
   */
  public function setUdf5($udf5)
  {
    $this->udf5 = $udf5;
  }

  /**
   * Get a hash of FieldName and value pairs.
   *
   * A hash of FieldName and value pairs e.g. {'keys1': 'Value1'}.
   * Max length of key(s) and value(s) is 100 each. A max. of 10 KVP are allowed.
   *
   * @return mixed
   *   The metadata.
   */
  public function getMetadata()
  {
    return $this->metadata;
  }

  /**
   * Set a hash of FieldName and value pairs.
   *
   * A hash of FieldName and value pairs e.g. {'keys1': 'Value1'}.
   * Max length of key(s) and value(s) is 100 each. A max. of 10 KVP are allowed.
   *
   * @param mixed $metadata
   *   The metadata.
   */
  public function setMetadata($metadata)
  {
    $this->metadata = $metadata;
  }

  /**
   * Get a track id.
   *
   * Order tracking id generated by the merchant. Max length 50 characters.
   *
   * @return mixed
   *   The trackId.
   */
  public function getTrackId()
  {
    return $this->trackId;
  }

  /**
   * Set a track id.
   *
   * Order tracking id generated by the merchant. Max length 50 characters.
   *
   * @param mixed $trackId
   *   The trackId.
   */
  public function setTrackId($trackId)
  {
    $this->trackId = $trackId;
  }
}
