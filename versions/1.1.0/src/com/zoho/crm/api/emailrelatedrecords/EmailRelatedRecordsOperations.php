<?php 
namespace com\zoho\crm\api\emailrelatedrecords;

use com\zoho\crm\api\Param;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\util\CommonAPIHandler;
use com\zoho\crm\api\util\Constants;
use com\zoho\crm\api\util\APIResponse;

class EmailRelatedRecordsOperations
{

	private  $modulename;
	private  $record;

	/**
	 * Creates an instance of EmailRelatedRecordsOperations with the given parameters
	 * @param string $record A string
	 * @param string $modulename A string
	 */
	public function __Construct(string $record, string $modulename)
	{
		$this->record=$record; 
		$this->modulename=$modulename; 

	}

	/**
	 * The method to get related emails
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getRelatedEmails(ParameterMap $paramInstance=null)
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
		$handlerInstance->setParam($paramInstance); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}

	/**
	 * The method to get related email
	 * @param string $messageId A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getRelatedEmail(string $messageId)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/'); 
		$apiPath=$apiPath.(strval($this->modulename)); 
		$apiPath=$apiPath.('/'); 
		$apiPath=$apiPath.(strval($this->record)); 
		$apiPath=$apiPath.('/Emails/'); 
		$apiPath=$apiPath.(strval($messageId)); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}
} 
