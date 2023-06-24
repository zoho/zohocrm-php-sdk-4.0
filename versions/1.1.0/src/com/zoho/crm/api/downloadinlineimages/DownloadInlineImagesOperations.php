<?php 
namespace com\zoho\crm\api\downloadinlineimages;

use com\zoho\crm\api\Param;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\util\CommonAPIHandler;
use com\zoho\crm\api\util\Constants;
use com\zoho\crm\api\util\APIResponse;

class DownloadInlineImagesOperations
{

	private  $module;
	private  $recordId;
	private  $userId;
	private  $messageId;
	private  $id;

	/**
	 * Creates an instance of DownloadInlineImagesOperations with the given parameters
	 * @param string $recordId A string
	 * @param string $module A string
	 * @param string $userId A string
	 * @param string $messageId A string
	 * @param string $id A string
	 */
	public function __Construct(string $recordId, string $module, string $userId=null, string $messageId=null, string $id=null)
	{
		$this->recordId=$recordId; 
		$this->module=$module; 
		$this->userId=$userId; 
		$this->messageId=$messageId; 
		$this->id=$id; 

	}

	/**
	 * The method to get download inline images
	 * @return APIResponse An instance of APIResponse
	 */
	public  function getDownloadInlineImages()
	{
		$handlerInstance=new CommonAPIHandler(); 
		$apiPath=""; 
		$apiPath=$apiPath.('/crm/v4/'); 
		$apiPath=$apiPath.(strval($this->module)); 
		$apiPath=$apiPath.('/'); 
		$apiPath=$apiPath.(strval($this->recordId)); 
		$apiPath=$apiPath.('/Emails/actions/download_inline_images'); 
		$handlerInstance->setAPIPath($apiPath); 
		$handlerInstance->setHttpMethod(Constants::REQUEST_METHOD_GET); 
		$handlerInstance->setCategoryMethod(Constants::REQUEST_CATEGORY_READ); 
		$handlerInstance->addParam(new Param('user_id', 'com.zoho.crm.api.DownloadInlineImages.GetDownloadInlineImagesParam'), $this->userId); 
		$handlerInstance->addParam(new Param('message_id', 'com.zoho.crm.api.DownloadInlineImages.GetDownloadInlineImagesParam'), $this->messageId); 
		$handlerInstance->addParam(new Param('id', 'com.zoho.crm.api.DownloadInlineImages.GetDownloadInlineImagesParam'), $this->id); 
		return $handlerInstance->apiCall(ResponseHandler::class, 'application/json'); 

	}
} 
