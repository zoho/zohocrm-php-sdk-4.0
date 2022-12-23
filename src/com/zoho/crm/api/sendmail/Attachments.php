<?php 
namespace com\zoho\crm\api\sendmail;

use com\zoho\crm\api\util\Model;

class Attachments implements Model
{

	private  $attachment;
	private  $keyModified=array();

	/**
	 * The method to get the attachment
	 * @return Attachment An instance of Attachment
	 */
	public  function getAttachment()
	{
		return $this->attachment; 

	}

	/**
	 * The method to set the value to attachment
	 * @param Attachment $attachment An instance of Attachment
	 */
	public  function setAttachment(Attachment $attachment)
	{
		$this->attachment=$attachment; 
		$this->keyModified['attachment'] = 1; 

	}

	/**
	 * The method to check if the user has modified the given key
	 * @param string $key A string
	 * @return int A int representing the modification
	 */
	public  function isKeyModified(string $key)
	{
		if(((array_key_exists($key, $this->keyModified))))
		{
			return $this->keyModified[$key]; 

		}
		return null; 

	}

	/**
	 * The method to mark the given key as modified
	 * @param string $key A string
	 * @param int $modification A int
	 */
	public  function setKeyModified(string $key, int $modification)
	{
		$this->keyModified[$key] = $modification; 

	}
} 
