<?php

/**
 * Checkout.com ApiServices\SharedModels\Charge.
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
 * Class Charge.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Charge extends \com\checkout\ApiServices\SharedModels\BaseHttp
{
  protected $object;
  protected $id;
  protected $chargeMode;
  protected $created;
  protected $email;
  protected $liveMode;
  protected $status;
  protected $trackId;
  protected $value;
  protected $responseCode;

  /**
   * Get an object.
   *
   * @return mixed
   *   The object.
   */
  public function getObject()
  {
    return $this->object;
  }

  /**
   * Get the string that uniquely identifies the transaction.
   *
   * Note: The card id is prefixed with charge_.
   *
   * @return mixed
   *   The chargeId.
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Get a valid charge mode.
   *
   * Options:
   *   1 for No 3D.
   *   2 for 3D.
   *   3 for Local Payment.
   *
   * @return mixed
   *   The chargeMode.
   */
  public function getChargeMode()
  {
    return $this->chargeMode;
  }

  /**
   * Get the UTC date and time based on ISO 8601 profile.
   *
   * @return mixed
   *   The created date.
   */
  public function getCreated()
  {
    return $this->created;
  }

  /**
   * Get the email address of the customer.
   *
   * @return mixed
   *   The email.
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Get the live mode.
   *
   * Defined as true if live keys were used in the request.
   * Defined as false if test keys were used in the request.
   *
   * @return mixed
   *   The LiveMode.
   */
  public function getLiveMode()
  {
    return $this->liveMode;
  }

  /**
   * Get Status of the charge.
   *
   * The '10000' is equivalent to approved.
   *
   * @return mixed
   *   The status.
   */
  public function getStatus()
  {
    return $this->status;
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
   * Get the value of the transaction.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @return mixed
   *   The value.
   */
  public function getValue()
  {
    return $this->value;
  }

  /**
   * Get a response code indicating the status of the request.
   *
   * @return mixed
   *   The responseCode.
   */
  public function getResponseCode()
  {
    return $this->responseCode;
  }

  /**
   * Set an object.
   *
   * @param int $object
   *   The object.
   */
  public function setObject($object)
  {
    $this->object = $object;
  }

  /**
   * Set the string that uniquely identifies the transaction.
   *
   * Note: The card id is prefixed with charge_.
   *
   * @param mixed $id
   *   The chargeId.
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  /**
   * Set a valid charge mode.
   *
   * Options:
   *   1 for No 3D.
   *   2 for 3D.
   *   3 for Local Payment.
   *
   * @param mixed $chargeMode
   *   The chargeMode.
   */
  public function setChargeMode($chargeMode)
  {
    $this->chargeMode = $chargeMode;
  }

  /**
   * Set the UTC date and time based on ISO 8601 profile.
   *
   * @param mixed $created
   *   The created date.
   */
  public function setCreated($created)
  {
    $this->created = $created;
  }

  /**
   * Set the email address of the customer.
   *
   * @param mixed $email
   *   The email.
   */
  public function setEmail($email)
  {
    $this->email = $email;
  }

  /**
   * Set the live mode.
   *
   * Defined as true if live keys were used in the request.
   * Defined as false if test keys were used in the request.
   *
   * @param mixed $liveMode
   *   The LiveMode.
   */
  public function setLiveMode($liveMode)
  {
    $this->liveMode = $liveMode;
  }

  /**
   * Set Status of the charge.
   *
   * The '10000' is equivalent to approved.
   *
   * @param mixed $status
   *   The status.
   */
  public function setStatus($status)
  {
    $this->status = $status;
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

  /**
   * Set the value of the transaction.
   *
   * A non-zero positive integer (i.e. decimal figures not allowed).
   * For most currencies, value is divided into 100 units
   * (e.g. "value = 100" is equivalent to 1 US Dollar).
   *
   * @param mixed $value
   *   The value.
   */
  public function setValue($value)
  {
    $this->value = $value;
  }

  /**
   * Set a response code indicating the status of the request.
   *
   * @param mixed $responseCode
   *   The responseCode.
   */
  public function setResponseCode($responseCode)
  {
    $this->responseCode = $responseCode;
  }

}
