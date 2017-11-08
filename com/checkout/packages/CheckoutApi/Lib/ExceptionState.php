<?php

/**
 * CheckoutapiApi.
 *
 * PHP Version 5.6
 *
 * @category Api
 * @package Checkoutapi
 * @license https://checkout.com/terms/ MIT License
 * @link https://www.checkout.com/
 */

/**
 * CheckoutapiLibExceptionstate.
 *
 * A class that manage and log error for a request.
 *
 * @todo need to clean up a bit the code and renaming few thing in it
 * @category Lib
 * @version Release: @package_version@
 */
class CheckoutapiLibExceptionstate extends CheckoutapiLibObject {

  /**
   * The state of error.
   *
   * @var bool
   *   If yes mean there is an error that prevent further processing.
   */
  private $errorState = FALSE;

  /**
   * Stack trace.
   *
   * @var array
   *   An array that hold a debugging stack trace.
   */
  private $trace = array();

  /**
   * Message.
   *
   * @var array
   *   An array that hold all error message for a request.
   */
  private $message = array();

  /**
   * Critical.
   *
   * @var array
   *   An array that hold the critical state of each error log for a request.
   */
  private $critical = array();

  /**
   * Debugmode.
   *
   * @var bool
   *   A flag to set debug mode on.
   */
  private $debug = FALSE;

  /**
   * Constructor class, it set if we need to debug or not.
   */
  public function __construct() {
    if (isset($_SERVER['API_CHECKOUT_DEBUG'])) {
      $this->_debug = $_SERVER['API_CHECKOUT_DEBUG'] == "TRUE" ? TRUE : FALSE;
    }
    $this->_debug = TRUE;
  }

  /**
   * Set error state TRUE for high.
   *
   * @param bool $state
   *   State of the current error.
   */
  public function setErrorState($state) {
    $this->_errorState = $state;

  }

  /**
   * Return the current error state of the object.
   *
   * @return bool
   *   Current errorstate.
   */
  private function getErrorState() {
    return $this->_errorState;

  }

  /**
   * Method that check if object state is error.
   *
   * @return bool
   *   True if in errorstate.
   */
  public function hasError() {
    return $this->getErrorState();

  }

  /**
   * Check if respond state is valid.
   *
   * @return bool
   *   True if the response state is valid.
   */
  public function isValid() {
    return !$this->getErrorState();

  }

  /**
   * Debug stack trace array.
   *
   * @param array $trace
   *   The array.
   */
  public function setTrace(array $trace) {
    $this->_trace[] = $trace;
  }

  /**
   * Checkoutapi getter for $trace.
   *
   * @return array
   *   The trace array.
   */
  public function getTrace() {
    return $this->_trace;

  }

  /**
   * Checkoutapi return array of message.
   *
   * @param mixed $message
   *   The message array.
   */
  public function setMessage($message) {

    $this->_message[md5($message)] = $message;

  }

  /**
   * Checkoutapi return an arrray of errors.
   *
   * @return array
   *   The message array.
   */
  public function getMessage() {
    return $this->_message;

  }

  /**
   * Ompile all errors in one line.
   *
   * @return string
   *   The string.
   */
  public function getErrorMessage() {
    $messages = $this->getMessage();
    $critical = $this->getCritical();
    $msgError = "";
    $i = 0;
    foreach ($messages as $message) {
      if ($critical[$i++]) {
        $msgError .= "{$message}\n";
      }
    }

    return $msgError;

  }

  /**
   * Get level of individual error.
   *
   * @param mixed $critical
   *   New critical value.
   *
   * @return mixed
   *   Will be void.
   */
  public function setCritical($critical) {
    $this->_critical[] = $critical;
  }

  /**
   * Getter for critical.
   *
   * @return array
   *   Critcal returned.
   */
  public function getCritical() {
    return $this->_critical;
  }

  /**
   * Get error state of object we can have an error but still proceed.
   *
   * @var string
   *   Error message.
   * @var array
   *   Stack trace.
   * @var bool
   *   If critical or not.
   */
  public function setLog($errorMsg, $trace, $state = TRUE) {

    $this->setErrorState($state);
    $this->setTrace($trace);
    $this->setMessage($errorMsg);
    $this->setCritical($state);
  }

  /**
   * Checkoutapi print out the error.
   *
   * @return string
   *   $errorToreturn a list of errors.
   */
  public function debug() {
    $errorToreturn = '';
    if ($this->_debug && $this->hasError()) {
      $message = $this->getMessage();
      $trace = $this->getTrace();
      $critical = $this->getCritical();

      for ($i = 0, $count = count($message); $i < $count; $i++) {

        if ($critical[$i]) {
          echo '<strong style="color:red">';
        }
        else {
          continue;
        }

        CheckoutapiUtilityUtilities::dump($message[$i] . '==> { ');

        foreach ($trace[$i] as $errorIndex => $errors) {
          echo "<pre>";
          echo $errorIndex . "=>  ";
          print_r($errors);

          echo "</pre>";
        }

        if ($critical[$i]) {
          echo '</strong>';
        }

        CheckoutapiUtilityUtilities::dump('} ');

      }

    }
    return $errorToreturn;

  }

  /**
   * Reset all attribute for the exception error object.
   */
  public function flushState() {
    $this->_errorState = FALSE;
    $this->_trace = array();
    $this->_message = array();
    $this->_critical = array();
  }

}
