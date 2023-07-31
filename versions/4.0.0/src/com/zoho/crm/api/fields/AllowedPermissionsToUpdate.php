<?php 
namespace com\zoho\crm\api\fields;

use com\zoho\crm\api\util\Model;

class AllowedPermissionsToUpdate implements Model
{

	private  $readWrite;
	private  $hidden;
	private  $readOnly;
	private  $keyModified=array();

	/**
	 * The method to get the readWrite
	 * @return bool A bool representing the readWrite
	 */
	public  function getReadWrite()
	{
		return $this->readWrite; 

	}

	/**
	 * The method to set the value to readWrite
	 * @param bool $readWrite A bool
	 */
	public  function setReadWrite(bool $readWrite)
	{
		$this->readWrite=$readWrite; 
		$this->keyModified['read_write'] = 1; 

	}

	/**
	 * The method to get the hidden
	 * @return bool A bool representing the hidden
	 */
	public  function getHidden()
	{
		return $this->hidden; 

	}

	/**
	 * The method to set the value to hidden
	 * @param bool $hidden A bool
	 */
	public  function setHidden(bool $hidden)
	{
		$this->hidden=$hidden; 
		$this->keyModified['hidden'] = 1; 

	}

	/**
	 * The method to get the readOnly
	 * @return bool A bool representing the readOnly
	 */
	public  function getReadOnly()
	{
		return $this->readOnly; 

	}

	/**
	 * The method to set the value to readOnly
	 * @param bool $readOnly A bool
	 */
	public  function setReadOnly(bool $readOnly)
	{
		$this->readOnly=$readOnly; 
		$this->keyModified['read_only'] = 1; 

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
