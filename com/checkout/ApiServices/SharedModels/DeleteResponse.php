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
 * Date: 3/18/2015
 * Time: 11:49 AM
 */

namespace com\checkout\ApiServices\SharedModels;


class DeleteResponse extends \com\checkout\ApiServices\SharedModels\BaseHttp
{
    private $_delete;
    private $id;
    public function __construct($response)
    {
        parent::__construct($response);
        $this->_setDelete($response->getDeleted());
        $this->_setId($response->getId());
    }

    /**
     * @return mixed
     */
    public function getDelete()
    {
        return $this->_delete;
    }

    /**
     * @param mixed $delete
     */
    private function _setDelete( $delete )
    {
        $this->_delete = $delete;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    private function _setId( $id )
    {
        $this->id = $id;
    }
}
