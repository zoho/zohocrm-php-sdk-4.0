<?php 
namespace com\zoho\crm\api\holidays;

use com\zoho\crm\api\Header;

class UpdateHolidaysHeader
{

	public static final function XCRMORG()
	{
		return new Header('X-CRM-ORG', 'com.zoho.crm.api.Holidays.UpdateHolidaysHeader'); 

	}
} 
