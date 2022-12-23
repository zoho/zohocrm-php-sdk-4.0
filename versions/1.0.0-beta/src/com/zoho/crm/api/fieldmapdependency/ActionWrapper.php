<?php 
namespace com\zoho\crm\api\fieldmapdependency;

use com\zoho\crm\api\util\Model;

class ActionWrapper implements Model, ActionHandler
{

	private  $mapDependency;
	private  $keyModified=array();

	/**
	 * The method to get the mapDependency
	 * @return array A array representing the mapDependency
	 */
	public  function getMapDependency()
	{
		return $this->mapDependency; 

	}

	/**
	 * The method to set the value to mapDependency
	 * @param array $mapDependency A array
	 */
	public  function setMapDependency(array $mapDependency)
	{
		$this->mapDependency=$mapDependency; 
		$this->keyModified['map_dependency'] = 1; 

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
