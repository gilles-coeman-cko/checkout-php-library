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

namespace com\checkout\helpers;

/**
 * final class ApiHttpClient
 *
 * @category Api
 * @version  Release: @package_version@
 */
final class ApiHttpClient
{
    private $httpStatus = '';
    /**
     * @param String      $requestUri
     * @param String      $authenticationKey
     * @param string|null $requestPayload
     */
    public static function postRequest( $requestUri,  $authenticationKey, $requestPayload = null)
    {
        $requestPayload['method'] = 'POST';
        $temp = \CheckoutApi_Api::getApi()->request($requestUri, $requestPayload, true);
      
        if($temp && $temp->isValid()) {
            return $temp;
        }else {
            $_errorMessageCodes = $temp->getErrorMessageCodes();
            throw new ApiHttpClientCustomException($temp->getExceptionState()->getErrorMessage(), $_errorMessageCodes[0], $temp->getEventId());

        }
    }

    /**
     * @param String      $requestUri
     * @param String      $authenticationKey
     * @param string|null $requestPayload
     */
    public static function getRequest( $requestUri,  $authenticationKey, $requestPayload = null)
    {
        $requestPayload['method'] = 'GET';
        $temp = \CheckoutApi_Api::getApi()->request($requestUri, $requestPayload, true);

        if($temp  && $temp->isValid()) {
            return $temp;
        }else {
            $_errorMessageCodes = $temp->getErrorMessageCodes();
            throw new ApiHttpClientCustomException($temp->getExceptionState()->getErrorMessage(), $_errorMessageCodes[0], $temp->getEventId());
        }
    }

    /**
     * @param String      $requestUri
     * @param String      $authenticationKey
     * @param string|null $requestPayload
     */
    public static function putRequest( $requestUri,  $authenticationKey, $requestPayload = null)
    {
        $requestPayload['method'] = 'PUT';
        $temp =  \CheckoutApi_Api::getApi()->request($requestUri, $requestPayload, true);

        if($temp && $temp->isValid()) {
            return $temp;
        }else {
            $_errorMessageCodes = $temp->getErrorMessageCodes();
            throw new ApiHttpClientCustomException($temp->getExceptionState()->getErrorMessage(), $_errorMessageCodes[0], $temp->getEventId());
        }
    }


    /**
     * @param String      $requestUri
     * @param String      $authenticationKey
     * @param string|null $requestPayload
     */
    public static function deleteRequest( $requestUri,  $authenticationKey, $requestPayload = null)
    {
        $requestPayload['method'] = 'DELETE';
        $temp =  \CheckoutApi_Api::getApi()->request($requestUri, $requestPayload, true);

        if($temp && $temp->isValid()) {
            return $temp;
        }else {
            $_errorMessageCodes = $temp->getErrorMessageCodes();
            throw new ApiHttpClientCustomException($temp->getExceptionState()->getErrorMessage(), $_errorMessageCodes[0], $temp->getEventId());
        }
    }
}
