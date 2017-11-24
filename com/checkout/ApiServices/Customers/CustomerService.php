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
 * User: dhiraj.gangoosirdar
 * Date: 3/19/2015
 * Time: 7:40 AM
 */

namespace com\checkout\ApiServices\Customers;


class CustomerService extends \com\checkout\ApiServices\BaseServices
{

    public function createCustomer(RequestModels\CustomerCreate $requestModel)
    {

        $customerMapper = new CustomerMapper($requestModel);

        $requestPayload = array (
        'authorization' => $this->apiSetting->getSecretKey(),
        'mode'          => $this->apiSetting->getMode(),
        'postedParam'   => $customerMapper->requestPayloadConverter(),

        );

        $processCharge = \com\checkout\helpers\ApiHttpClient::postRequest(
            $this->apiUrl->getCustomersApiUri(),
            $this->apiSetting->getSecretKey(), $requestPayload
        );

        $responseModel = new ResponseModels\Customer($processCharge);

        return $responseModel;
    }

    public function updateCustomer(RequestModels\CustomerUpdate $requestModel)
    {

        $customerMapper = new CustomerMapper($requestModel);

        $requestPayload = array (
        'authorization' => $this->apiSetting->getSecretKey(),
        'mode'          => $this->apiSetting->getMode(),
        'postedParam'   => $customerMapper->requestPayloadConverter(),

        );
        $updateCustomerUri = $this->apiUrl->getCustomersApiUri().'/'.$requestModel->getCustomerId();
        $processCharge = \com\checkout\helpers\ApiHttpClient::putRequest(
            $updateCustomerUri,
            $this->apiSetting->getSecretKey(), $requestPayload
        );

        $responseModel = new  \com\checkout\ApiServices\SharedModels\OkResponse($processCharge);

        return $responseModel;

    }

    public function deleteCustomer($customerId)
    {

        $requestPayload = array (
        'authorization' => $this->apiSetting->getSecretKey(),
        'mode'          => $this->apiSetting->getMode(),

        );
        $deleteCustomerUri = $this->apiUrl->getCustomersApiUri().'/'.$customerId;
        $processCharge = \com\checkout\helpers\ApiHttpClient::deleteRequest(
            $deleteCustomerUri,
            $this->apiSetting->getSecretKey(), $requestPayload
        );

        $responseModel = new \com\checkout\ApiServices\SharedModels\OkResponse($processCharge);

        return $responseModel;
    }

    public function getCustomer($customerId)
    {

        $requestPayload = array (
        'authorization' => $this->apiSetting->getSecretKey(),
        'mode'          => $this->apiSetting->getMode(),

        );
        $getCustomerUri = $this->apiUrl->getCustomersApiUri().'/'.$customerId;
        $processCharge = \com\checkout\helpers\ApiHttpClient::getRequest(
            $getCustomerUri,
            $this->apiSetting->getSecretKey(), $requestPayload
        );

        $responseModel = new ResponseModels\Customer($processCharge);

        return $responseModel;
    }

    public function getCustomerList($count = null , $offset =null , $startDate = null, $endDate = null, $singleDay =
        false
    ) {
        $customerUri = $this->apiUrl->getCustomersApiUri();
        $delimiter = '?';
        $createdAt = 'created=';

        $startDateUnix = ($startDate)?time($startDate):null;
        $endDateUnix = ($endDate)?time($endDate):null;

        if($count) {
            $customerUri = "{$customerUri}{$delimiter}count={$count}";
            $delimiter = '&';
        }

        if($offset) {
            $customerUri =  "{$customerUri}{$delimiter}offset={$offset}";
            $delimiter = '&';
        }

        if($singleDay && $startDateUnix) {
            $customerUri="{$customerUri}{$delimiter}{$createdAt}{$startDateUnix}|";


        } else {
            if ($startDateUnix) {

                $customerUri = "{$customerUri}{$delimiter}{$createdAt}{$startDateUnix}";
                $createdAt = '|';
            }

            if ($endDateUnix) {
                $customerUri = "{$customerUri}{$createdAt}{$endDateUnix}";

            }
        }

        $requestPayload = array (
        'authorization' => $this->apiSetting->getSecretKey(),
        'mode'          => $this->apiSetting->getMode(),

        );

        $processCharge = \com\checkout\helpers\ApiHttpClient::getRequest(
            $customerUri,
            $this->apiSetting->getSecretKey(), $requestPayload
        );

        $responseModel = new ResponseModels\CustomerList($processCharge);

        return $responseModel;

    }

}
