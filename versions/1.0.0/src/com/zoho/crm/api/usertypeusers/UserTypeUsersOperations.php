<?php 
namespace com\zoho\crm\api\usertypeusers;

use com\zoho\crm\api\Param;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\util\CommonAPIHandler;
use com\zoho\crm\api\util\Constants;
use com\zoho\crm\api\util\APIResponse;

class UserTypeUsersOperations
{

	private  $portalName;
	private  $userTypeId;
	private  $filters;
	private  $type;

	/**
	 * Creates an instance of UserTypeUsersOperations with the given parameters
	 * @param string $userTypeId A string
	 * @param string $portalName A string
	 * @param string $filters A string
	 * @param string $type A string
	 */
	public function __Construct(string $userTypeId, string $portalName, string $filters=null, string $type=null)
	{
		$this->userTypeId=$userTypeId; 
		$this->portalName=$portalName; 
		$this->filters=$filters; 
		$this->type=$type; 

	}

	/**
	 * The method to get users of user type
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getUsersOfUserType()
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/settings/portals/'); 
		$apiPath=$apiPath.(strval($this->portalName)); 
		$apiPath=$apiPath.('/user_type/'); 
		$apiPath=$apiPath.(strval($this->userTypeId)); 
		$apiPath=$apiPath.('/users'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ); 
		$handlerInstance->addParam(new Param('filters', 'com.zoho.crm.api.UserTypeUsers.GetUsersofUserTypeParam'), $this->filters); 
		$handlerInstance->addParam(new Param('type', 'com.zoho.crm.api.UserTypeUsers.GetUsersofUserTypeParam'), $this->type); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}
} 
