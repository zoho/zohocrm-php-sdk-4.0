<?php 
namespace com\zoho\crm\api\usersterritories;

use com\zoho\crm\api\Param;

class GetTerritoriesOfUserParam
{

	public static final function page()
	{
		return new Param('page', 'com.zoho.crm.api.UsersTerritories.GetTerritoriesOfUserParam'); 

	}
	public static final function perPage()
	{
		return new Param('per_page', 'com.zoho.crm.api.UsersTerritories.GetTerritoriesOfUserParam'); 

	}
	public static final function count()
	{
		return new Param('count', 'com.zoho.crm.api.UsersTerritories.GetTerritoriesOfUserParam'); 

	}
	public static final function moreRecords()
	{
		return new Param('more_records', 'com.zoho.crm.api.UsersTerritories.GetTerritoriesOfUserParam'); 

	}
} 
