<?php 
namespace com\zoho\crm\api\portalinvite;

use com\zoho\crm\api\Param;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\util\CommonAPIHandler;
use com\zoho\crm\api\util\Constants;
use com\zoho\crm\api\util\APIResponse;

class PortalInviteOperations
{

	private  $module;
	private  $record;
	private  $userTypeId;
	private  $type;

	/**
	 * Creates an instance of PortalInviteOperations with the given parameters
	 * @param string $record A string
	 * @param string $module A string
	 * @param string $userTypeId A string
	 * @param string $type A string
	 */
	public function __Construct(string $record, string $module, string $userTypeId=null, string $type=null)
	{
		$this->record=$record; 
		$this->module=$module; 
		$this->userTypeId=$userTypeId; 
		$this->type=$type; 

	}

	/**
	 * The method to invite users
	 * @return APIResponse An instance of APIResponse
	 */
	public  function inviteUsers()
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/'); 
		$apiPath=$apiPath.(strval($this->module)); 
		$apiPath=$apiPath.('/'); 
		$apiPath=$apiPath.(strval($this->record)); 
		$apiPath=$apiPath.('/actions/portal_invite'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_POST); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_ACTION); 
		$handlerInstance->addParam(new Param('user_type_id', 'com.zoho.crm.api.PortalInvite.InviteUsersParam'), $this->userTypeId); 
		$handlerInstance->addParam(new Param('type', 'com.zoho.crm.api.PortalInvite.InviteUsersParam'), $this->type); 
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json'); 

	}
} 
