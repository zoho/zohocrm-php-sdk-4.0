<?php 
namespace com\zoho\crm\api\emailrelatedrecords;

use com\zoho\crm\api\Param;

class GetRelatedEmailsParam
{

	public static final function type()
	{
		return new Param('type', 'com.zoho.crm.api.EmailRelatedRecords.GetRelatedEmailsParam'); 

	}
	public static final function index()
	{
		return new Param('index', 'com.zoho.crm.api.EmailRelatedRecords.GetRelatedEmailsParam'); 

	}
	public static final function ownerId()
	{
		return new Param('owner_id', 'com.zoho.crm.api.EmailRelatedRecords.GetRelatedEmailsParam'); 

	}
} 
