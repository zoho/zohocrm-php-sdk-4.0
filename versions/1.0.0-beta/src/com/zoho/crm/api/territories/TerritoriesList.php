<?php 
namespace com\zoho\crm\api\territories;

use com\zoho\crm\api\util\Model;

class TerritoriesList implements Model
{

	private  $territorymap;
	private  $keyModified=array();

	/**
	 * The method to get the territorymap
	 * @return TerritoryMap An instance of TerritoryMap
	 */
	public  function getTerritorymap()
	{
		return $this->territorymap; 

	}

	/**
	 * The method to set the value to territorymap
	 * @param TerritoryMap $territorymap An instance of TerritoryMap
	 */
	public  function setTerritorymap(TerritoryMap $territorymap)
	{
		$this->territorymap=$territorymap; 
		$this->keyModified['TerritoryMap'] = 1; 

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
