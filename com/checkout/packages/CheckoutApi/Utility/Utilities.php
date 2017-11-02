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
 * CheckoutapiUtilityUtilities
 * A small utility class to wrap some of php function
 *
 * @category Utility
 * @package  Checkoutapi
 * @author   Dhiraj Gangoosirdar <dhiraj.gangoosirdar@checkout.com>
 * @author   Gilles Coeman <gilles.coeman@checkout.com>
 * @license  https://checkout.com/terms/ MIT License
 * @version  Release: @package_version@
 * @link     https://www.checkout.com/
 */
final class CheckoutapiUtilityUtilities
{
    /**
     * Checkoutapi check if a php extension is loaded
     *
     * @param mixed $extension Var.
     * 
     * @return bool
     */
    public static function checkExtension($extension)
    {
        return extension_loaded($extension); 
    }

    /**
     * Checkoutapi print on screen any value given to it.
     *
     * @param mixed $toPrint Var.
     * 
     * @return void
     */
    public static function dump($toPrint)
    {
        echo '<pre>';
        print_r($toPrint);
        echo '</pre>';
    }
}
