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
 * CheckoutapiClientClient
 * An abstract class for CheckoutapiClient gateway api.
 * This class encapsulate the main functionality of all gateway implimentation.
 *
 * @category Client
 * @version  Release: @package_version@
 */
abstract class CheckoutapiClientClient  extends CheckoutapiLibObject
{

    /**
     * 
     *
     * @var null $_uri Uri to where request should be made  
     */
    protected $_uri = null;


    /**
     * 
     *
     * @var array $headers Hold headers that should be pass to api 
     */
    protected $headers = array ();

    /**
     * 
     *
     * @var string $_processType  Type of adapter to be called  
     */
    protected $_processType = "curl";

    /**
     * 
     *
     * @var string $_respondType   Type of respond expecting from the server 
     */
    protected $_respondType = CheckoutapiParserConstant::API_RESPOND_TYPE_JSON;

    /**
     * 
     *
     * @var null|CheckoutapiParserParser  $_parserObj Checkoutapi use for keeping an instance of the paser 
     */
    protected $_parserObj = null;

    /**
     * constructor
     *
     * @param  array $config configutation for class
     * @throws Exception
     */

    public function __construct(array $config = array())
    {

        parent::setConfig($config);
        $this->initParser($this->getRespondType());
    }

    /**
     * Set/Get attribute wrapper
     *
     * @param  string $method method being call
     * @param  array  $args   argument for method being called
     * @return mixed
     */

    public function __call($method, $args)
    { 
        switch (substr($method, 0, 3)) {
        case 'get' :
                
            $key = substr($method, 3);
            $key = lcfirst($key);
            $data = $this->getConfig($key, isset($args[0]) ? $args[0] : null);
                
            return $data;
           
        }

        $this->exception("Api does not support this method " .$method."(".print_r($args, 1).")", debug_backtrace());
        return null;
    }

    /**
     * Checkoutapi initialise return an adapter.
     *
     * @param  $adapterName Adapter Name
     * @param  array                    $arguments argument for creating the adapter
     * @return CheckoutapiClientAdapterAbstract|null
     * @throws Exception
     */

    public function getAdapter($adapterName,  $arguments = array())
    {
        $stdName = ucfirst($adapterName);

        $classAdapterName = CheckoutapiClientConstant::ADAPTER_class_GROUP.$stdName;
        
        $class = null;

        if (class_exists($classAdapterName)) {
            /**
* 
             *
 * @var CheckoutapiClientAdapterAbstract  $class 
*/
            $class = CheckoutapiLibFactory::getSingletonInstance($classAdapterName, $arguments);
            if(isset($arguments['uri'])) {
                $class->setUri($arguments['uri']);
            }

            if(isset($arguments['config'])) {
                $class->setConfig($arguments['config']);
            }

        } else {
          
            $this->exception("Not a valid Adapter", debug_backtrace());
        } 

        return $class;
        
    }

    /**
     * Getter for $_parserObje
     *
     * @return Checkoutapi_Parser_Parser|null
     */
    public function getParser()
    {
        return $this->_parserObj;
    }

    /**
     * Setter for $_parserObj
     *
     * @param string $parser parser name
     */
    public function setParser($parser)
    {
        $this->_parserObj = $parser;

    }

    /**
     * set the headers array base on which paser we are using
     *
     * @param array $headers extra headers
     */

    public function setHeaders($headers) 
    {

        if(!$this->_parserObj) {
            $this->initParser($this->getRespondType());

        }

        /**
* 
         *
 * @var array  headers 
*/
        $this->headers = $this->getParser()->getHeaders();
        $this->headers = array_merge($this->headers, $headers);
    }

    /**
     * getters for $headers
     *
     * @return array $headers headers
     */

    public function getHeaders() 
    {
        return $this->headers ;
    }

    /**
     *  set which adapter communicator to use
     *
     * @param string $processType process type or adapter name
     */
    public function setProcessType($processType) 
    {
        $this->_processType = $processType;
    }

    /**
     * return name of adpater
     *
     * @return string $_processType  name of adapter
     */
    public function getProcessType() 
    {
        return $this->_processType ;
    }

    /**
     *  return the respond type default json
     *
     * @return string
     */
    public function getRespondType()
    {
        $_respondType = $this->_respondType;
        if($respondType = $this->getConfig('respondType')) {
            $_respondType  =  $respondType;
        }

        return $_respondType;
    }

    /**
     * create and set a parser
     *
     * @throws Exception
     */
    public function initParser()
    {
        $parserType = CheckoutapiClientConstant::PARSER_class_GROUP.$this->getRespondType(); 

        $parserObj =  CheckoutapiLibFactory::getSingletonInstance($parserType);
        $this->setParser($parserObj);       
    }

    /**
     * Setter for $_uri
     *
     * @param string $uri endpoint name
     */
    public function setUri($uri)
    {
        $this->_uri = $uri;
    }

    /**
     * Getter for $_uri
     *
     * @return string $_uri
     */

    public function getUri()
    {
        return $this->_uri;
    }

}
