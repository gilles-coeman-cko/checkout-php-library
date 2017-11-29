<?php

/**
 * Checkout.com Apiservices\Baseservices.
 *
 * PHP Version 5.6
 *
 * @category Api Services
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

namespace com\checkout\Apiservices;

use com\checkout\helpers\ApiUrls;
use com\checkout\helpers\AppSetting;

/**
 * Class Base Services.
 *
 * @category Api Services
 * @version Release: @package_version@
 */
class Baseservices
{
  protected $apiSetting = null;
  protected $apiUrl = null;

  /**
   * Class constructor.
   *
   * @param AppSetting $apiSetting
   *   The api Settings.
   * @param ApiUrls|null $apiUrl
   *   The api URLs.
   */
  public function __construct(AppSetting $apiSetting, ApiUrls $apiUrl = null)
  {
    $this->setApiSetting($apiSetting);
    if (!$this->getApiUrl() && !$apiUrl) {
      $apiUrl = new ApiUrls();
      $apiUrl->setBaseApiUri($apiSetting->getBaseApiUri());
    }
    $this->setApiUrl($apiUrl);
  }

  /**
   * Get the API settings.
   *
   * @return \com\checkout\helpers\AppSetting
   *   The API Settings.
   */
  public function getApiSetting()
  {
    return $this->apiSetting;
  }

  /**
   * Set the API settings.
   *
   * @param \com\checkout\helpers\AppSetting $apiSetting
   *   The API Settings.
   */
  public function setApiSetting($apiSetting)
  {
    $this->apiSetting = $apiSetting;
  }

  /**
   * Get the API URL.
   *
   * @return string
   *   The API URL.
   */
  public function getApiUrl()
  {
    return $this->apiUrl;
  }

  /**
   * Get the API URL.
   *
   * @param string $apiUrl
   *   The API URL.
   */
  public function setApiUrl($apiUrl)
  {
    $this->apiUrl = $apiUrl;
  }
}
