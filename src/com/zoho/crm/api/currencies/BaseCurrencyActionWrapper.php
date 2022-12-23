<?php 
namespace com\zoho\crm\api\currencies;

use com\zoho\crm\api\util\Model;

class BaseCurrencyActionWrapper implements Model, ActionHandler
{

	private  $baseCurrency;
	private  $keyModified=array();

	/**
	 * The method to get the baseCurrency
	 * @return BaseCurrencyActionResponse An instance of BaseCurrencyActionResponse
	 */
	public  function getBaseCurrency()
	{
		return $this->baseCurrency; 

	}

	/**
	 * The method to set the value to baseCurrency
	 * @param BaseCurrencyActionResponse $baseCurrency An instance of BaseCurrencyActionResponse
	 */
	public  function setBaseCurrency(BaseCurrencyActionResponse $baseCurrency)
	{
		$this->baseCurrency=$baseCurrency; 
		$this->keyModified['base_currency'] = 1; 

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
