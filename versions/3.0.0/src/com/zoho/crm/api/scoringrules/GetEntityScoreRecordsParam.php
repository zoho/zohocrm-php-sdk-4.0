<?php 
namespace com\zoho\crm\api\scoringrules;

use com\zoho\crm\api\Param;

class GetEntityScoreRecordsParam
{

	public static final function fields()
	{
		return new Param('fields', 'com.zoho.crm.api.ScoringRules.GetEntityScoreRecordsParam'); 

	}
} 
