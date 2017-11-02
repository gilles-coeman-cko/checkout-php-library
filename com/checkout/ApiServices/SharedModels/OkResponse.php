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
namespace com\checkout\ApiServices\SharedModels;


class OkResponse extends \com\checkout\ApiServices\SharedModels\BaseHttp
{
    public function __construct($response)
    {
        parent::__construct($response);
        $this->setMessage($response->getMessage());
    }
    protected $_message;

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage( $message )
    {
        $this->_message = $message;
    }
}
