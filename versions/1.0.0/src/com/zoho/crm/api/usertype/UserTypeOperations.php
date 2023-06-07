<?php 
namespace com\zoho\crm\api\usertype;

use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\util\CommonAPIHandler;
use com\zoho\crm\api\util\Constants;
use com\zoho\crm\api\util\APIResponse;

class UserTypeOperations
{

	private  $portalName;

	/**
	 * Creates an instance of UserTypeOperations with the given parameters
	 * @param string $portalName A string
	 */
	public function __Construct(string $portalName)
	{
		$this->portalName=$portalName; 

	}

	/**
	 * The method to get user types
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getUserTypes()
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/settings/portals/'); 
		$apiPath=$apiPath.(strval($this->portalName)); 
		$apiPath=$apiPath.('/user_type'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}

	/**
	 * The method to get user type
	 * @param string $userTypeId A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getUserType(string $userTypeId)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/settings/portals/'); 
		$apiPath=$apiPath.(strval($this->portalName)); 
		$apiPath=$apiPath.('/user_type/'); 
		$apiPath=$apiPath.(strval($userTypeId)); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}
} 
