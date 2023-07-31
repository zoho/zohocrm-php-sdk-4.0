<?php 
namespace com\zoho\crm\api\usergroups;

use com\zoho\crm\api\Param;

class GetStatusParam
{

	public static final function jobId()
	{
		return new Param('job_id', 'com.zoho.crm.api.UserGroups.GetStatusParam'); 

	}
} 
