<?php 
namespace com\zoho\crm\api\masschangeowner;

use com\zoho\crm\api\Param;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\util\CommonAPIHandler;
use com\zoho\crm\api\util\Constants;
use com\zoho\crm\api\util\APIResponse;

class MassChangeOwnerOperations
{

	/**
	 * The method to change owner
	 * @param string $module A string
	 * @param Data $request An instance of Data
	 * @return APIResponse An instance of APIResponse
	 */
	public  function changeOwner(string $module, Data $request)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/'); 
		$apiPath=$apiPath.(strval($module)); 
		$apiPath=$apiPath.('/actions/mass_change_owner'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_POST); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_CREATE); 
		$handlerInstance->setContentType('application/json'); 
		$handlerInstance->setRequest($request); 
		$handlerInstance->setMandatoryChecker(true); 
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json'); 

	}

	/**
	 * The method to check status
	 * @param string $module A string
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function checkStatus(string $module, ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/'); 
		$apiPath=$apiPath.(strval($module)); 
		$apiPath=$apiPath.('/actions/mass_change_owner'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_ACTION); 
		$handlerInstance->setParam($paramInstance); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}
} 
