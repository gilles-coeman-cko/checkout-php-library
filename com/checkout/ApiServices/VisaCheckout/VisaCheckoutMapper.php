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
 * Created by PhpStorm.
 * Date: 22.12.2015
 * Time: 12:57
 */
namespace com\checkout\ApiServices\VisaCheckout;

class VisaCheckoutMapper
{
    private $requestModel;

    /**
     * @param $requestModel
     */
    public  function __construct($requestModel)
    {
        $this->setRequestModel($requestModel);
    }

    /**
     * @return mixed
     */
    public function getRequestModel()
    {
        return $this->requestModel;
    }

    /**
     * @param mixed $requestModel
     */
    public function setRequestModel($requestModel)
    {
        $this->requestModel = $requestModel;
    }

    /**
     * @param null $requestModel
     * @return array|null
     */
    public function requestPayloadConverter($requestModel = null )
    {
        $requestVisaCheckout = null;
        if(!$requestModel) {
            $requestModel = $this->getRequestModel();
        }

        if($requestModel) {
            $requestVisaCheckout = array();

            if(method_exists($requestModel, 'getCallId') && ($callId = $requestModel->getCallId())) {
                $requestVisaCheckout['callId'] = $callId;
            }

            if(method_exists($requestModel, 'getIncludeBinData') && ($includeBinData = $requestModel->getIncludeBinData())) {
                $requestVisaCheckout['includeBinData'] = $includeBinData;
            }
        }

        return $requestVisaCheckout;
    }

}
