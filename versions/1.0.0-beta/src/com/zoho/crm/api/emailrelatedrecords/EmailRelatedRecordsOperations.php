<?php 
namespace com\zoho\crm\api\emailrelatedrecords;

use com\zoho\crm\api\Param;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\util\CommonAPIHandler;
use com\zoho\crm\api\util\Constants;
use com\zoho\crm\api\util\APIResponse;

class EmailRelatedRecordsOperations
{

	private  $modulename;
	private  $record;
	private  $type;
	private  $index;

	/**
	 * Creates an instance of EmailRelatedRecordsOperations with the given parameters
	 * @param string $record A string
	 * @param string $modulename A string
	 * @param string $type A string
	 * @param string $index A string
	 */
	public function __Construct(string $record, string $modulename, string $type=null, string $index=null)
	{
		$this->record=$record; 
		$this->modulename=$modulename; 
		$this->type=$type; 
		$this->index=$index; 

	}

	/**
	 * The method to get related email
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getRelatedEmail()
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/'); 
		$apiPath=$apiPath.(strval($this->modulename)); 
		$apiPath=$apiPath.('/'); 
		$apiPath=$apiPath.(strval($this->record)); 
		$apiPath=$apiPath.('/Emails'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ); 
		$handlerInstance->addParam(new Param('type', 'com.zoho.crm.api.EmailRelatedRecords.GetRelatedEmailParam'), $this->type); 
		$handlerInstance->addParam(new Param('index', 'com.zoho.crm.api.EmailRelatedRecords.GetRelatedEmailParam'), $this->index); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}
} 
