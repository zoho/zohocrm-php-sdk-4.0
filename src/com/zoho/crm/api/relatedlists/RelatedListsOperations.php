<?php 
namespace com\zoho\crm\api\relatedlists;

use com\zoho\crm\api\Param;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\util\CommonAPIHandler;
use com\zoho\crm\api\util\Constants;
use com\zoho\crm\api\util\APIResponse;

class RelatedListsOperations
{

	private  $module;
	private  $layoutId;

	/**
	 * Creates an instance of RelatedListsOperations with the given parameters
	 * @param string $module A string
	 * @param string $layoutId A string
	 */
	public function __Construct(string $module=null, string $layoutId=null)
	{
		$this->module=$module; 
		$this->layoutId=$layoutId; 

	}

	/**
	 * The method to get related lists
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getRelatedLists()
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/settings/related_lists'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ); 
		$handlerInstance->addParam(new Param('module', 'com.zoho.crm.api.RelatedLists.GetRelatedListsParam'), $this->module); 
		$handlerInstance->addParam(new Param('layout_id', 'com.zoho.crm.api.RelatedLists.GetRelatedListsParam'), $this->layoutId); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}

	/**
	 * The method to get related list
	 * @param string $relatedListId A string
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getRelatedList(string $relatedListId)
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/settings/related_lists/'); 
		$apiPath=$apiPath.(strval($relatedListId)); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ); 
		$handlerInstance->addParam(new Param('module', 'com.zoho.crm.api.RelatedLists.GetRelatedListParam'), $this->module); 
		$handlerInstance->addParam(new Param('layout_id', 'com.zoho.crm.api.RelatedLists.GetRelatedListParam'), $this->layoutId); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}
} 
