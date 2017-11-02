<?php

/**
 * CheckoutapiApi.
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
 * An abstract class that contain the basic functionally all parser need to inherit.
 * 
 * @category Parser
 * @package  Checkoutapi
 * @author   Dhiraj Gangoosirdar <dhiraj.gangoosirdar@checkout.com>
 * @author   Gilles Coeman <gilles.coeman@checkout.com>
 * @license  https://checkout.com/terms/ MIT License
 * @version  Release: @package_version@
 * @link     https://www.checkout.com/
 */
abstract class CheckoutapiParserParser extends CheckoutapiLibObject
{
    /**
     * Headers.
     * 
     * @var $headers array Checkoutapi hold value for headers to be send by 
     * the transport message layer
     */
    protected $headers = array();

    /**
     * Repsond Object.
     *
     * @var $respondObj null|CheckoutapiLibRespondobj Checkoutapi hold an value
     */
    protected $respondObj = null;
    protected $info = array( 'httpStatus'=>0);

    /**
     * This method need to be implimented by all children. 
     * It take a string, parse it  and then map it to an object.
     *
     * @param object $parser A parser.
     * 
     * @return CheckoutapiLibRespondobj
     */
    abstract public function parseToObj($parser);

    /**
     * Setter $respondObj.
     *
     * @param object $obj CheckoutapiLibRespondobj
     * 
     * @return void
     */
    public function setRespondobj($obj)
    {
        $this->respondObj = $obj;
    }

    /**
     * Getter $responseObj.
     * 
     * @return CheckoutapiLibRespondobj|null
     */
    public function getRespondobj()
    {
        return $this->respondObj ;
    }

    /**
     * Getter $headers.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Format the value base on the parser type.
     *
     * @param object $postedParam A var.
     * 
     * @return mixed
     */
    abstract public function preparePosted($postedParam);

    /**
     * Set Resource Info.
     *
     * @param object $info A var.
     * 
     * @return mixed
     */
    abstract public function setResourceInfo($info);

    /**
     * Get Resource Info.
     *
     * @return array
     */
    public function getResourceInfo()
    {
        return $this->info;
    }
}
