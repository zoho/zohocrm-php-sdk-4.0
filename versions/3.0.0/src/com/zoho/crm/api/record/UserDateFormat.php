<?php 
namespace com\zoho\crm\api\record;

use com\zoho\crm\api\util\Choice;

class UserDateFormat
{

	public static function MMMdyyyy()
	{
		return new Choice('MMM d, yyyy'); 

	}
} 
