<?php 
namespace com\zoho\crm\api\downloadattachments;

use com\zoho\crm\api\Param;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\util\CommonAPIHandler;
use com\zoho\crm\api\util\Constants;
use com\zoho\crm\api\util\APIResponse;

class DownloadAttachmentsOperations
{

	private  $module;
	private  $recordId;
	private  $userId;
	private  $messageId;

	/**
	 * Creates an instance of DownloadAttachmentsOperations with the given parameters
	 * @param string $recordId A string
	 * @param string $module A string
	 * @param string $userId A string
	 * @param string $messageId A string
	 */
	public function __Construct(string $recordId, string $module, string $userId=null, string $messageId=null)
	{
		$this->recordId=$recordId; 
		$this->module=$module; 
		$this->userId=$userId; 
		$this->messageId=$messageId; 

	}

	/**
	 * The method to get download attachments details
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getDownloadAttachmentsDetails()
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/'); 
		$apiPath=$apiPath.(strval($this->module)); 
		$apiPath=$apiPath.('/'); 
		$apiPath=$apiPath.(strval($this->recordId)); 
		$apiPath=$apiPath.('/Emails/actions/download_attachments'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ); 
		$handlerInstance->addParam(new Param('user_id', 'com.zoho.crm.api.DownloadAttachments.GetDownloadAttachmentsDetailsParam'), $this->userId); 
		$handlerInstance->addParam(new Param('message_id', 'com.zoho.crm.api.DownloadAttachments.GetDownloadAttachmentsDetailsParam'), $this->messageId); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}
} 
