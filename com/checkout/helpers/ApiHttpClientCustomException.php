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
 * final class ApiHttpClientCustomException
 *
 * Below are the tags commonly used for classes. @category through @version
 * are required.  The remainder should only be used when necessary.
 * Please use them in the order they appear here.  phpDocumentor has
 * several other tags available, feel free to use them.
 *
 * @category Api
 * @version  Release: @package_version@
 */
final class ApiHttpClientCustomException extends \Exception
{
    private $errorMessage = '';
    private $errorCode = '';
    private $eventId = '';


    function __construct($errorMessage, $errorCode, $eventId) 
    {

        $this->errorMessage = $errorMessage;
        $this->errorCode = $errorCode;
                $this->eventId = $eventId;
    }


    function getErrorMessage() 
    {
            return $this->errorMessage;
    }

    function getErrorCode() 
    {
            return $this->errorCode;
    }

    function getEventId() 
    {
            return $this->eventId;
    }
    
}
