<?php 
namespace com\zoho\crm\api\territories;

use com\zoho\crm\api\Param;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\util\CommonAPIHandler;
use com\zoho\crm\api\util\Constants;
use com\zoho\crm\api\util\APIResponse;

class TerritoriesOperations
{

	/**
	 * The method to get territories
	 * @param ParameterMap $paramInstance An instance of ParameterMap
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getTerritories(ParameterMap $paramInstance=null)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/settings/territories'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ); 
		$handlerInstance->setParam($paramInstance); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}

	/**
	 * The method to create territories
	 * @param BodyWrapper $request An instance of BodyWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function createTerritories(BodyWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/settings/territories'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_POST); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_CREATE); 
		$handlerInstance->setContentType('application/json'); 
		$handlerInstance->setRequest($request); 
		$handlerInstance->setMandatoryChecker(true); 
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json'); 

	}

	/**
	 * The method to get territory
	 * @param string $id A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getTerritory(string $id)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/settings/territories/'); 
		$apiPath=$apiPath.(strval($id)); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}

	/**
	 * The method to asssign territories to record
	 * @param string $module A string
	 * @param string $record A string
	 * @param AssignWrapper $request An instance of AssignWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function asssignTerritoriesToRecord(string $module, string $record, AssignWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/'); 
		$apiPath=$apiPath.(strval($module)); 
		$apiPath=$apiPath.('/'); 
		$apiPath=$apiPath.(strval($record)); 
		$apiPath=$apiPath.('/actions/assign_territories'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_POST); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_ACTION); 
		$handlerInstance->setContentType('application/json'); 
		$handlerInstance->setRequest($request); 
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json'); 

	}

	/**
	 * The method to asssign territories to records
	 * @param string $module A string
	 * @param AssignWrapper $request An instance of AssignWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function asssignTerritoriesToRecords(string $module, AssignWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/'); 
		$apiPath=$apiPath.(strval($module)); 
		$apiPath=$apiPath.('/actions/assign_territories'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_POST); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_ACTION); 
		$handlerInstance->setContentType('application/json'); 
		$handlerInstance->setRequest($request); 
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json'); 

	}

	/**
	 * The method to remove territories to record
	 * @param string $module A string
	 * @param string $record A string
	 * @param AssignWrapper $request An instance of AssignWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function removeTerritoriesToRecord(string $module, string $record, AssignWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/'); 
		$apiPath=$apiPath.(strval($module)); 
		$apiPath=$apiPath.('/'); 
		$apiPath=$apiPath.(strval($record)); 
		$apiPath=$apiPath.('/actions/remove_territories'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_POST); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_ACTION); 
		$handlerInstance->setContentType('application/json'); 
		$handlerInstance->setRequest($request); 
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json'); 

	}

	/**
	 * The method to remove territories to records
	 * @param string $module A string
	 * @param AssignWrapper $request An instance of AssignWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function removeTerritoriesToRecords(string $module, AssignWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/'); 
		$apiPath=$apiPath.(strval($module)); 
		$apiPath=$apiPath.('/actions/remove_territories'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_POST); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_ACTION); 
		$handlerInstance->setContentType('application/json'); 
		$handlerInstance->setRequest($request); 
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json'); 

	}
} 
