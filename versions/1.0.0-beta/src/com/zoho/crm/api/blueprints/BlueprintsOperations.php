<?php 
namespace com\zoho\crm\api\blueprints;

use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\util\CommonAPIHandler;
use com\zoho\crm\api\util\Constants;
use com\zoho\crm\api\util\APIResponse;

class BlueprintsOperations
{

	private  $moduleAPIName;
	private  $recordId;

	/**
	 * Creates an instance of BlueprintsOperations with the given parameters
	 * @param string $recordId A string
	 * @param string $moduleAPIName A string
	 */
	public function __Construct(string $recordId, string $moduleAPIName)
	{
		$this->recordId=$recordId; 
		$this->moduleAPIName=$moduleAPIName; 

	}

	/**
	 * The method to get blueprint
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getBlueprint()
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/'); 
		$apiPath=$apiPath.(strval($this->moduleAPIName)); 
		$apiPath=$apiPath.('/'); 
		$apiPath=$apiPath.(strval($this->recordId)); 
		$apiPath=$apiPath.('/actions/blueprint'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}

	/**
	 * The method to update blueprint
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function updateBlueprint(BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/'); 
		$apiPath=$apiPath.(strval($this->moduleAPIName)); 
		$apiPath=$apiPath.('/'); 
		$apiPath=$apiPath.(strval($this->recordId)); 
		$apiPath=$apiPath.('/actions/blueprint'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_PUT); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_UPDATE); 
		$handlerInstance->setContentType('application/json'); 
		$handlerInstance->setRequest($request); 
		$handlerInstance->setMandatoryChecker(true); 
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json'); 

	}
} 
