<?php 
namespace com\zoho\crm\api\territories;

use com\zoho\crm\api\util\Model;

class AssociatedUsersCount implements Model
{

	private  $count;
	private  $territory;
	private  $keyModified=array();

	/**
	 * The method to get the count
	 * @return string A string representing the count
	 */
	public  function getCount()
	{
		return $this->count; 

	}

	/**
	 * The method to set the value to count
	 * @param string $count A string
	 */
	public  function setCount(string $count)
	{
		$this->count=$count; 
		$this->keyModified['count'] = 1; 

	}

	/**
	 * The method to get the territory
	 * @return MinifiedTerritory An instance of MinifiedTerritory
	 */
	public  function getTerritory()
	{
		return $this->territory; 

	}

	/**
	 * The method to set the value to territory
	 * @param MinifiedTerritory $territory An instance of MinifiedTerritory
	 */
	public  function setTerritory(MinifiedTerritory $territory)
	{
		$this->territory=$territory; 
		$this->keyModified['territory'] = 1; 

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
