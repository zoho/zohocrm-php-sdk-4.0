<?php 
namespace com\zoho\crm\api\shifthours;

use com\zoho\crm\api\Header;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\util\CommonAPIHandler;
use com\zoho\crm\api\util\Constants;
use com\zoho\crm\api\util\APIResponse;

class ShiftHoursOperations
{

	private  $xCrmOrg;

	/**
	 * Creates an instance of ShiftHoursOperations with the given parameters
	 * @param string $xCrmOrg A string
	 */
	public function __Construct(string $xCrmOrg=null)
	{
		$this->xCrmOrg=$xCrmOrg; 

	}

	/**
	 * The method to create shift hours
	 * @param RequestWrapper $request An instance of RequestWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function createShiftHours(RequestWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/settings/business_hours/shift_hours'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_POST); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_CREATE); 
		$handlerInstance->setContentType('application/json'); 
		$handlerInstance->setRequest($request); 
		$handlerInstance->setMandatoryChecker(true); 
		$handlerInstance->addHeader(new Header('X-CRM-ORG', 'com.zoho.crm.api.ShiftHours.CreateShiftHoursHeader'), $this->xCrmOrg); 
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json'); 

	}

	/**
	 * The method to update shift hours
	 * @param RequestWrapper $request An instance of RequestWrapper
	 * @return APIResponse An instance of APIResponse
	 */
	public  function updateShiftHours(RequestWrapper $request)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/settings/business_hours/shift_hours'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_PUT); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_UPDATE); 
		$handlerInstance->setContentType('application/json'); 
		$handlerInstance->setRequest($request); 
		$handlerInstance->setMandatoryChecker(true); 
		$handlerInstance->addHeader(new Header('X-CRM-ORG', 'com.zoho.crm.api.ShiftHours.UpdateShiftHoursHeader'), $this->xCrmOrg); 
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json'); 

	}

	/**
	 * The method to get shift hours
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getShiftHours()
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/settings/business_hours/shift_hours'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ); 
		$handlerInstance->addHeader(new Header('X-CRM-ORG', 'com.zoho.crm.api.ShiftHours.GetShiftHoursHeader'), $this->xCrmOrg); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}

	/**
	 * The method to get shift hour
	 * @param string $id A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getShiftHour(string $id)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/settings/business_hours/shift_hours/'); 
		$apiPath=$apiPath.(strval($id)); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ); 
		$handlerInstance->addHeader(new Header('X-CRM-ORG', 'com.zoho.crm.api.ShiftHours.GetShiftHourHeader'), $this->xCrmOrg); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}

	/**
	 * The method to delete shift hours
	 * @param string $id A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function deleteShiftHours(string $id)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/settings/business_hours/shift_hours/'); 
		$apiPath=$apiPath.(strval($id)); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_DELETE); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_METHOD_DELETE); 
		$handlerInstance->addHeader(new Header('X-CRM-ORG', 'com.zoho.crm.api.ShiftHours.DeleteShiftHoursHeader'), $this->xCrmOrg); 
		return $handlerInstance->apiCall(ActionHandler::class, 'application/json'); 

	}
} 
