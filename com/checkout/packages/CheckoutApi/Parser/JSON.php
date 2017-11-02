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

/**
 * A parser to handle JSON.
 *
 * @category Parser
 * @package  Checkoutapi
 * @author   Dhiraj Gangoosirdar <dhiraj.gangoosirdar@checkout.com>
 * @author   Gilles Coeman <gilles.coeman@checkout.com>
 * @license  https://checkout.com/terms/ MIT License
 * @version  Release: @package_version@
 * @link     https://www.checkout.com/
 */
class CheckoutapiParserJson extends CheckoutapiParserParser
{
    /**
     * Headers.
     *
     * @var array $headers Content negotiation relies on the use of specific headers 
     */
    protected $headers = array (
        'Content-Type: application/json;charset=UTF-8',
        'Accept: application/json'
    );

    /**
     * Convert a json to a CheckoutapiLibRespondobj object.
     *
     * @param JSON $parser A var.
     *
     * @return CheckoutapiLibRespondobj|null
     *
     * @throws Exception
     */
    public function parseToObj($parser)
    {
        $respondObj = CheckoutapiLibFactory::getInstance('CheckoutapiLibRespondobj');

        if ($parser && is_string($parser)) {
            $encoding = mb_detect_encoding($parser);
            
            if ($encoding =="ASCII") {
                $parser = iconv('ASCII', 'UTF-8', $parser);
            } else {
                $parser =  mb_convert_encoding($parser, "UTF-8", $encoding);
            }
            
            $jsonObj = json_decode($parser, true);
            $jsonObj['rawOutput'] = $parser;

            $respondObj->setConfig($jsonObj);


        }
        $respondObj->setConfig($this->getResourceInfo());
        return $respondObj;
    }

    /**
     * This method prepare a posted value, so it match the header of the parser
     *
     * @param mixed $postedParam A var.
     * 
     * @return JSON
     */
    public function preparePosted($postedParam)
    {
        return json_encode($postedParam);
    }

    /**
     * This method sets a posted value, so it match the header of the parser
     *
     * @param mixed $info A var.
     * 
     * @return JSON
     */
    public function setResourceInfo($info)
    {
        $this->info = $info;
    }
}
