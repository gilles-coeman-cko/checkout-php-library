<?php
/**
 * Class CheckoutapiParserJson
 * a parser to handle JSON
 * @package     Checkoutapi
 * @category     Api
 * @author       Dhiraj Gangoosirdar <dhiraj.gangoosirdar@checkout.com>
 * @copyright 2014 Integration team (http://www.checkout.com)
 */
class CheckoutapiParserJson extends CheckoutapiParserParser 
{
    /**@var  array $_headers  Content negotiation relies on the use of specific headers */
	protected $_headers = array ('Content-Type: application/json;charset=UTF-8','Accept: application/json');

    /**
     * Convert a json to a CheckoutapiLibRespondobj object
     * @param JSON $parser
     * @return CheckoutapiLibRespondobj|null
     * @throws Exception
     */
	public function parseToObj($parser)
	{
        /** @var CheckoutapiLibRespondobj $respondObj */
        $respondObj = CheckoutapiLibFactory::getInstance('CheckoutapiLibRespondobj');

		if($parser && is_string ($parser)) {
			$encoding = mb_detect_encoding($parser);
			
			if($encoding =="ASCII") {
				$parser = iconv('ASCII', 'UTF-8', $parser);
			}else {
				$parser =  mb_convert_encoding($parser, "UTF-8", $encoding);
			}
			
			$jsonObj = json_decode($parser,true);
			$jsonObj['rawOutput'] = $parser;

			$respondObj->setConfig($jsonObj);


		}
        $respondObj->setConfig($this->getResourceInfo());
		return $respondObj;
	}

    /**
     * This method prepare a posted value, so it match the header of the parser
     * @param mixed $postedparam
     * @return JSON
     */
	public function preparePosted($postedParam)
	{
		return json_encode($postedParam);
	}
    public function setResourceInfo($info)
    {
       $this->_info = $info;
    }
}