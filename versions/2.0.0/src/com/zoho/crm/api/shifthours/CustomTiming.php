<?php 
namespace com\zoho\crm\api\shifthours;

use com\zoho\crm\api\util\Choice;
use com\zoho\crm\api\util\Model;

class CustomTiming implements Model
{

	private  $shiftTiming;
	private  $days;
	private  $keyModified=array();

	/**
	 * The method to get the shiftTiming
	 * @return array A array representing the shiftTiming
	 */
	public  function getShiftTiming()
	{
		return $this->shiftTiming; 

	}

	/**
	 * The method to set the value to shiftTiming
	 * @param array $shiftTiming A array
	 */
	public  function setShiftTiming(array $shiftTiming)
	{
		$this->shiftTiming=$shiftTiming; 
		$this->keyModified['shift_timing'] = 1; 

	}

	/**
	 * The method to get the days
	 * @return Choice An instance of Choice
	 */
	public  function getDays()
	{
		return $this->days; 

	}

	/**
	 * The method to set the value to days
	 * @param Choice $days An instance of Choice
	 */
	public  function setDays(Choice $days)
	{
		$this->days=$days; 
		$this->keyModified['days'] = 1; 

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
