<?php 
namespace com\zoho\crm\api\usersunavailability;

use com\zoho\crm\api\Param;

class GetUsersUnavailabilityParam
{

	public static final function includeInnerDetails()
	{
		return new Param('include_inner_details', 'com.zoho.crm.api.UsersUnavailability.GetUsersUnavailabilityParam'); 

	}
} 
