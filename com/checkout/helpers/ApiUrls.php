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

class ApiUrls
{
    private $_baseApiUri = null;
    private $cardTokensApiUri = null;
    private $paymentTokensApiUri = null;
    private $paymentTokenUpdateApiUri = null;
    private $cardProvidersUri = null;
    private $localPaymentProvidersUri = null;
    private $_customersApiUri = null;
    private $cardsApiUri = null;
    private $cardChargesApiUri = null;
    private $cardTokenChargesApiUri = null;
    private $defaultCardChargesApiUri = null;
    private $_chargeRefundsApiUri = null;
    private $_captureChargesApiUri = null;
    private $_updateChargesApiUri = null;
    private $_retrieveChargesApiUri = null;
    private $_retrieveChargehistoryApiUri = null;
    private $_verifyChargesApiUri = null;
    private $_chargeWithPaymenttokenUri = null;
    private $_voidChargesApiUri = null;
    private $_queryTransactionApiUri = null;
    private $_queryChargebackApiUri = null;
    private $_recurringPaymentsApiUri = null;
    private $_recurringPaymentsQueryApiUri = null;
    private $_recurringPaymentsCustomersApiUri = null;
    private $_recurringPaymentsCustomersQueryApiUri = null;
    private $_visaCheckoutCardTokenApiUri = null;

    public function __construct()
    {
        $this->setBaseApiUri(AppSetting::getSingletonInstance()->getBaseApiUri());
    }

    /**
     * get the base api url
     *
     * @return string
     */
    public function getBaseApiUri()
    {
        return $this->_baseApiUri;
    }

    /**
     * set the base api url
     *
     * @param string $baseApiUri
     */
    public function setBaseApiUri($baseApiUri)
    {
        $this->_baseApiUri = $baseApiUri;
    }

    /**
     * return url to verify a charge
     *
     * @return string
     */
    public function getVerifyChargesApiUri()
    {
        if (!$this->_verifyChargesApiUri) {
            $this->setVerifyChargesApiUri($this->getBaseApiUri() . "/charges/%s");
        }

        return $this->_verifyChargesApiUri;
    }

    /**
     * set the url for verify a charge
     *
     * @param string $verifyChargesApiUri
     */
    public function setVerifyChargesApiUri($verifyChargesApiUri)
    {
        $this->_verifyChargesApiUri = $verifyChargesApiUri;
    }

    /**
     * return card token url
     *
     * @return string
     */
    public function getCardTokensApiUri()
    {
        if (!$this->cardTokensApiUri) {
            $this->setCardTokensApiUri($this->getBaseApiUri() . "/charges/token");
        }
        return $this->cardTokensApiUri;
    }

    /**
     * set card token url
     *
     * @param string $cardTokensApiUri
     */
    public function setCardTokensApiUri($cardTokensApiUri)
    {
        $this->cardTokensApiUri = $cardTokensApiUri;
    }

    /**
     * set payment token url
     *
     * @return string
     */
    public function getPaymenttokensApiUri()
    {
        if (!$this->paymentTokensApiUri) {
            $this->setPaymenttokensApiUri($this->getBaseApiUri() . "/tokens/payment");
        }
        return $this->paymentTokensApiUri;
    }

    /**
     * set payment token url
     *
     * @param string $paymentTokensApiUri
     */
    public function setPaymenttokensApiUri($paymentTokensApiUri)
    {
        $this->paymentTokensApiUri = $paymentTokensApiUri;
    }

    /**
     * set payment token update url
     *
     * @return string
     */
    public function getPaymenttokenUpdateApiUri()
    {
        if (!$this->paymentTokenUpdateApiUri) {
            $this->setPaymenttokenUpdateApiUri($this->getBaseApiUri() . "/tokens/payment/%s");
        }
        return $this->paymentTokenUpdateApiUri;
    }

    /**
     * set payment token update url
     *
     * @param string $paymentTokenUpdateApiUri
     */
    public function setPaymenttokenUpdateApiUri($paymentTokenUpdateApiUri)
    {
        $this->paymentTokenUpdateApiUri = $paymentTokenUpdateApiUri;
    }

    /**
     * return payment token url
     *
     * @return string
     */
    public function getCardProvidersUri()
    {
        if (!$this->cardProvidersUri) {
            $this->setCardProvidersUri($this->getBaseApiUri() . "/providers/cards");
        }
        return $this->cardProvidersUri;
    }

    /**
     * set payment token url
     *
     * @param string $cardProvidersUri
     */
    public function setCardProvidersUri($cardProvidersUri)
    {
        $this->cardProvidersUri = $cardProvidersUri;
    }

    /**
     * set local payment url
     *
     * @return string
     */
    public function getLocalPaymentProvidersUri()
    {
        if (!$this->localPaymentProvidersUri) {
            $this->setLocalPaymentProvidersUri($this->getBaseApiUri() . "/providers/localpayments");
        }

        return $this->localPaymentProvidersUri;
    }

    /**
     * set local payment url
     *
     * @param string $localPaymentProvidersUri
     */
    public function setLocalPaymentProvidersUri($localPaymentProvidersUri)
    {
        $this->localPaymentProvidersUri = $localPaymentProvidersUri;
    }

    /**
     * return customer url
     *
     * @return string
     */
    public function getCustomersApiUri()
    {
        if (!$this->_customersApiUri) {
            $this->setCustomersApiUri($this->getBaseApiUri() . "/customers");
        }

        return $this->_customersApiUri;
    }

    /**
     * set customer url
     *
     * @param string $customersApiUri
     */
    public function setCustomersApiUri($customersApiUri)
    {
        $this->_customersApiUri = $customersApiUri;
    }

    /**
     * get card url
     *
     * @return string
     */
    public function getCardsApiUri()
    {
        if (!$this->cardsApiUri) {
            $this->setCardsApiUri($this->getBaseApiUri() . "/customers/%s/cards");
        }
        return $this->cardsApiUri;
    }

    /**
     * set card url
     *
     * @param string $cardsApiUri
     */
    public function setCardsApiUri($cardsApiUri)
    {
        $this->cardsApiUri = $cardsApiUri;
    }

    /**
     * get card charge url
     *
     * @return string
     */
    public function getCardChargesApiUri()
    {
        if (!$this->cardChargesApiUri) {
            $this->setCardChargesApiUri($this->getBaseApiUri() . "/charges/card");
        }
        return $this->cardChargesApiUri;
    }

    /**
     * set cart charge url
     *
     * @param string $cardChargesApiUri
     */
    public function setCardChargesApiUri($cardChargesApiUri)
    {
        $this->cardChargesApiUri = $cardChargesApiUri;
    }

    /**
     * get card token charge url
     *
     * @return string
     */
    public function getCardTokenChargesApiUri()
    {
        if (!$this->cardTokenChargesApiUri) {
            $this->setCardTokenChargesApiUri($this->getBaseApiUri() . "/charges/token");
        }
        return $this->cardTokenChargesApiUri;
    }

    /**
     * set card token charge url
     *
     * @param string $cardTokenChargesApiUri
     */
    public function setCardTokenChargesApiUri($cardTokenChargesApiUri)
    {
        $this->cardTokenChargesApiUri = $cardTokenChargesApiUri;
    }

    /**
     * get the charge payment token url
     *
     * @return string
     */
    public function getChargeWithPaymenttokenUri()
    {
        if (!$this->_chargeWithPaymenttokenUri) {
            $this->setChargeWithPaymenttokenUri($this->getBaseApiUri() . "/charges/js/card");
        }

        return $this->_chargeWithPaymenttokenUri;
    }

    /**
     * set the charge payment token url
     *
     * @param string $chargeWithPaymenttokenUri
     */
    public function setChargeWithPaymenttokenUri($chargeWithPaymenttokenUri)
    {
        $this->_chargeWithPaymenttokenUri = $chargeWithPaymenttokenUri;
    }

    /**
     * @return string
     */
    public function getDefaultCardChargesApiUri()
    {
        if (!$this->defaultCardChargesApiUri) {
            $this->setDefaultCardChargesApiUri($this->getBaseApiUri() . "/charges/customer");
        }
        return $this->defaultCardChargesApiUri;
    }

    /**
     * @param string $defaultCardChargesApiUri
     */
    public function setDefaultCardChargesApiUri($defaultCardChargesApiUri)
    {
        $this->defaultCardChargesApiUri = $defaultCardChargesApiUri;
    }

    /**
     * @return string
     */
    public function getChargerefundsApiUri()
    {
        if (!$this->_chargeRefundsApiUri) {
            $this->setChargerefundsApiUri($this->getBaseApiUri() . "/charges/%s/refund");
        }
        return $this->_chargeRefundsApiUri;
    }

    /**
     * @param string $chargeRefundsApiUri
     */
    public function setChargerefundsApiUri($chargeRefundsApiUri)
    {
        $this->_chargeRefundsApiUri = $chargeRefundsApiUri;
    }

    /**
     * @return string
     */
    public function getCaptureChargesApiUri()
    {
        if (!$this->_captureChargesApiUri) {
            $this->setCaptureChargesApiUri($this->getBaseApiUri() . "/charges/%s/capture");
        }
        return $this->_captureChargesApiUri;
    }

    /**
     * @param string $captureChargesApiUri
     */
    public function setCaptureChargesApiUri($captureChargesApiUri)
    {
        $this->_captureChargesApiUri = $captureChargesApiUri;
    }

    /**
     * @return string
     */
    public function getUpdateChargesApiUri()
    {
        if (!$this->_updateChargesApiUri) {
            $this->setUpdateChargesApiUri($this->getBaseApiUri() . "/charges/%s");
        }
        return $this->_updateChargesApiUri;
    }

    /**
     * @return null
     */
    public function getVoidChargesApiUri()
    {
        if (!$this->_voidChargesApiUri) {
            $this->setVoidChargesApiUri($this->getBaseApiUri() . "/charges/%s/void");
        }
        return $this->_voidChargesApiUri;
    }

    /**
     * @return null
     */
    public function getQueryTransactionApiUri()
    {
        if (!$this->_queryTransactionApiUri) {
            $this->setQueryTransactionApiUri($this->getBaseApiUri() . "/reporting/transactions");
        }

        return $this->_queryTransactionApiUri;
    }

    /**
     * @param $queryTransactionApiUri
     */
    public function setQueryTransactionApiUri($queryTransactionApiUri)
    {
        $this->_queryTransactionApiUri = $queryTransactionApiUri;
    }

    /**
     * @return null
     */
    public function getQueryChargebackApiUri()
    {
        if (!$this->_queryChargebackApiUri) {
            $this->setQueryChargebackApiUri($this->getBaseApiUri() . "/reporting/chargebacks");
        }

        return $this->_queryChargebackApiUri;
    }

    /**
     * @param $queryChargebackApiUri
     */
    public function setQueryChargebackApiUri($queryChargebackApiUri)
    {
        $this->_queryChargebackApiUri = $queryChargebackApiUri;
    }

    /**
     * @param null $voidChargesApiUri
     */
    public function setVoidChargesApiUri($voidChargesApiUri)
    {
        $this->_voidChargesApiUri = $voidChargesApiUri;
    }

    /**
     * @return string
     */
    public function getRetrieveChargesApiUri()
    {

        if (!$this->_retrieveChargesApiUri) {
            $this->setRetrieveChargesApiUri($this->getBaseApiUri() . "/charges/%s");
        }

        return $this->_retrieveChargesApiUri;
    }

    /**
     * @param string $retrieveChargesApiUri
     */
    public function setRetrieveChargesApiUri($retrieveChargesApiUri)
    {
        $this->_retrieveChargesApiUri = $retrieveChargesApiUri;
    }

    /**
     * @return string
     */
    public function getRetrieveChargehistoryApiUri()
    {

        if (!$this->_retrieveChargehistoryApiUri) {
            $this->setRetrieveChargehistoryApiUri($this->getBaseApiUri() . "/charges/%s/history");
        }

        return $this->_retrieveChargehistoryApiUri;
    }

    /**
     * @param string $retrieveChargehistoryApiUri
     */
    public function setRetrieveChargehistoryApiUri($retrieveChargehistoryApiUri)
    {
        $this->_retrieveChargehistoryApiUri = $retrieveChargehistoryApiUri;
    }

    /**
     * @param string $updateChargesApiUri
     */
    public function setUpdateChargesApiUri($updateChargesApiUri)
    {
        $this->_updateChargesApiUri = $updateChargesApiUri;
    }

    /**
     * @return string
     */
    public function getRecurringpaymentsApiUri()
    {

        if (!$this->_recurringPaymentsApiUri) {
            $this->setRecurringpaymentsApiUri($this->getBaseApiUri() . "/recurringPayments/plans");
        }

        return $this->_recurringPaymentsApiUri;
    }

    /**
     * @param string $recurringPaymentsApiUri
     */
    public function setRecurringpaymentsApiUri($recurringPaymentsApiUri)
    {
        $this->_recurringPaymentsApiUri = $recurringPaymentsApiUri;
    }

    /**
     * @return string
     */
    public function getRecurringpaymentsQueryApiUri()
    {

        if (!$this->_recurringPaymentsQueryApiUri) {
            $this->setRecurringpaymentsQueryApiUri($this->getBaseApiUri() . "/recurringPayments/plans/search");
        }

        return $this->_recurringPaymentsQueryApiUri;
    }

    /**
     * @param string $recurringPaymentsQueryApiUri
     */
    public function setRecurringpaymentsQueryApiUri($recurringPaymentsQueryApiUri)
    {
        $this->_recurringPaymentsQueryApiUri = $recurringPaymentsQueryApiUri;
    }

    /**
     * @return string
     */
    public function getRecurringpaymentsCustomersApiUri()
    {

        if (!$this->_recurringPaymentsCustomersApiUri) {
            $this->setRecurringpaymentsCustomersApiUri($this->getBaseApiUri() . "/recurringPayments/customers");
        }

        return $this->_recurringPaymentsCustomersApiUri;
    }

    /**
     * @param string $recurringPaymentsCustomersApiUri
     */
    public function setRecurringpaymentsCustomersApiUri($recurringPaymentsCustomersApiUri)
    {
        $this->_recurringPaymentsCustomersApiUri = $recurringPaymentsCustomersApiUri;
    }

    /**
     * @return string
     */
    public function getRecurringpaymentsCustomersQueryApiUri()
    {

        if (!$this->_recurringPaymentsCustomersQueryApiUri) {
            $this->setRecurringpaymentsCustomersQueryApiUri($this->getBaseApiUri() . "/recurringPayments/customers/search");
        }

        return $this->_recurringPaymentsCustomersQueryApiUri;
    }

    /**
     * @param string $recurringPaymentsCustomersQueryApiUri
     */
    public function setRecurringpaymentsCustomersQueryApiUri($recurringPaymentsCustomersQueryApiUri)
    {
        $this->_recurringPaymentsCustomersQueryApiUri = $recurringPaymentsCustomersQueryApiUri;
    }

    /**
     * @return string
     */
    public function getVisaCheckoutCardTokenApiUri()
    {
        if (!$this->_visaCheckoutCardTokenApiUri) {
            $this->setVisaCheckoutCardTokenApiUri($this->getBaseApiUri() . "/tokens/card/visa-checkout");
        }

        return $this->_visaCheckoutCardTokenApiUri;
    }

    /**
     * @param string $visaCheckoutCardTokenApiUri
     */
    public function setVisaCheckoutCardTokenApiUri($visaCheckoutCardTokenApiUri)
    {
        $this->_visaCheckoutCardTokenApiUri = $visaCheckoutCardTokenApiUri;
    }
}
