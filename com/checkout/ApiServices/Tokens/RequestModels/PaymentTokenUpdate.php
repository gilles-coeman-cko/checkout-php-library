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
namespace com\checkout\ApiServices\Tokens\RequestModels;

class PaymenttokenUpdate
{
    private $id;
    protected $trackId;
    protected $udf1;
    protected $udf2;
    protected $udf3;
    protected $udf4;
    protected $udf5;
    protected $metadata = [];

    /**
     * PaymenttokenUpdate constructor.
     *
     * @param string $id
     */
    public function __construct($id)
    {
        $this->setId($id);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUdf1()
    {
        return $this->udf1;
    }

    /**
     * @param mixed $udf1
     */
    public function setUdf1($udf1)
    {
        $this->udf1 = $udf1;
    }

    /**
     * @return mixed
     */
    public function getUdf2()
    {
        return $this->udf2;
    }

    /**
     * @param mixed $udf2
     */
    public function setUdf2($udf2)
    {
        $this->udf2 = $udf2;
    }

    /**
     * @return mixed
     */
    public function getUdf3()
    {
        return $this->udf3;
    }

    /**
     * @param mixed $udf3
     */
    public function setUdf3($udf3)
    {
        $this->udf3 = $udf3;
    }

    /**
     * @return mixed
     */
    public function getUdf4()
    {
        return $this->udf4;
    }

    /**
     * @param mixed $udf4
     */
    public function setUdf4($udf4)
    {
        $this->udf4 = $udf4;
    }

    /**
     * @return mixed
     */
    public function getUdf5()
    {
        return $this->udf5;
    }

    /**
     * @param mixed $udf5
     */
    public function setUdf5($udf5)
    {
        $this->udf5 = $udf5;
    }

    /**
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param array $metadata
     */
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
    }

    /**
     * @return mixed
     */
    public function getTrackId()
    {
        return $this->trackId;
    }

    /**
     * @param mixed $trackId
     */
    public function setTrackId($trackId)
    {
        $this->trackId = $trackId;
    }
}
