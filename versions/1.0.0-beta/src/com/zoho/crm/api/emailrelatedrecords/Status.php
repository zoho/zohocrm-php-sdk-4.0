<?php 
namespace com\zoho\crm\api\emailrelatedrecords;

use com\zoho\crm\api\util\Model;

class Status implements Model
{

	private  $type;
	private  $bouncedTime;
	private  $bouncedReason;
	private  $keyModified=array();

	/**
	 * The method to get the type
	 * @return string A string representing the type
	 */
	public  function getType()
	{
		return $this->type; 

	}

	/**
	 * The method to set the value to type
	 * @param string $type A string
	 */
	public  function setType(string $type)
	{
		$this->type=$type; 
		$this->keyModified['type'] = 1; 

	}

	/**
	 * The method to get the bouncedTime
	 * @return \DateTime An instance of \DateTime
	 */
	public  function getBouncedTime()
	{
		return $this->bouncedTime; 

	}

	/**
	 * The method to set the value to bouncedTime
	 * @param \DateTime $bouncedTime An instance of \DateTime
	 */
	public  function setBouncedTime(\DateTime $bouncedTime)
	{
		$this->bouncedTime=$bouncedTime; 
		$this->keyModified['bounced_time'] = 1; 

	}

	/**
	 * The method to get the bouncedReason
	 * @return string A string representing the bouncedReason
	 */
	public  function getBouncedReason()
	{
		return $this->bouncedReason; 

	}

	/**
	 * The method to set the value to bouncedReason
	 * @param string $bouncedReason A string
	 */
	public  function setBouncedReason(string $bouncedReason)
	{
		$this->bouncedReason=$bouncedReason; 
		$this->keyModified['bounced_reason'] = 1; 

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
