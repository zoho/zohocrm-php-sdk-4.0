<?php 
namespace com\zoho\crm\api\fields;

use com\zoho\crm\api\util\Model;

class Multiselectlookup implements Model
{

	private  $displayLabel;
	private  $lookupApiname;
	private  $apiName;
	private  $connectedfieldApiname;
	private  $connectedlookupApiname;
	private  $id;
	private  $recordAccess;
	private  $linkingModule;
	private  $connectedModule;
	private  $keyModified=array();

	/**
	 * The method to get the displayLabel
	 * @return string A string representing the displayLabel
	 */
	public  function getDisplayLabel()
	{
		return $this->displayLabel; 

	}

	/**
	 * The method to set the value to displayLabel
	 * @param string $displayLabel A string
	 */
	public  function setDisplayLabel(string $displayLabel)
	{
		$this->displayLabel=$displayLabel; 
		$this->keyModified['display_label'] = 1; 

	}

	/**
	 * The method to get the lookupApiname
	 * @return string A string representing the lookupApiname
	 */
	public  function getLookupApiname()
	{
		return $this->lookupApiname; 

	}

	/**
	 * The method to set the value to lookupApiname
	 * @param string $lookupApiname A string
	 */
	public  function setLookupApiname(string $lookupApiname)
	{
		$this->lookupApiname=$lookupApiname; 
		$this->keyModified['lookup_apiname'] = 1; 

	}

	/**
	 * The method to get the aPIName
	 * @return string A string representing the apiName
	 */
	public  function getAPIName()
	{
		return $this->apiName; 

	}

	/**
	 * The method to set the value to aPIName
	 * @param string $apiName A string
	 */
	public  function setAPIName(string $apiName)
	{
		$this->apiName=$apiName; 
		$this->keyModified['api_name'] = 1; 

	}

	/**
	 * The method to get the connectedfieldApiname
	 * @return string A string representing the connectedfieldApiname
	 */
	public  function getConnectedfieldApiname()
	{
		return $this->connectedfieldApiname; 

	}

	/**
	 * The method to set the value to connectedfieldApiname
	 * @param string $connectedfieldApiname A string
	 */
	public  function setConnectedfieldApiname(string $connectedfieldApiname)
	{
		$this->connectedfieldApiname=$connectedfieldApiname; 
		$this->keyModified['connectedfield_apiname'] = 1; 

	}

	/**
	 * The method to get the connectedlookupApiname
	 * @return string A string representing the connectedlookupApiname
	 */
	public  function getConnectedlookupApiname()
	{
		return $this->connectedlookupApiname; 

	}

	/**
	 * The method to set the value to connectedlookupApiname
	 * @param string $connectedlookupApiname A string
	 */
	public  function setConnectedlookupApiname(string $connectedlookupApiname)
	{
		$this->connectedlookupApiname=$connectedlookupApiname; 
		$this->keyModified['connectedlookup_apiname'] = 1; 

	}

	/**
	 * The method to get the id
	 * @return string A string representing the id
	 */
	public  function getId()
	{
		return $this->id; 

	}

	/**
	 * The method to set the value to id
	 * @param string $id A string
	 */
	public  function setId(string $id)
	{
		$this->id=$id; 
		$this->keyModified['id'] = 1; 

	}

	/**
	 * The method to get the recordAccess
	 * @return bool A bool representing the recordAccess
	 */
	public  function getRecordAccess()
	{
		return $this->recordAccess; 

	}

	/**
	 * The method to set the value to recordAccess
	 * @param bool $recordAccess A bool
	 */
	public  function setRecordAccess(bool $recordAccess)
	{
		$this->recordAccess=$recordAccess; 
		$this->keyModified['record_access'] = 1; 

	}

	/**
	 * The method to get the linkingModule
	 * @return ModuleMap An instance of ModuleMap
	 */
	public  function getLinkingModule()
	{
		return $this->linkingModule; 

	}

	/**
	 * The method to set the value to linkingModule
	 * @param ModuleMap $linkingModule An instance of ModuleMap
	 */
	public  function setLinkingModule(ModuleMap $linkingModule)
	{
		$this->linkingModule=$linkingModule; 
		$this->keyModified['linking_module'] = 1; 

	}

	/**
	 * The method to get the connectedModule
	 * @return ModuleMap An instance of ModuleMap
	 */
	public  function getConnectedModule()
	{
		return $this->connectedModule; 

	}

	/**
	 * The method to set the value to connectedModule
	 * @param ModuleMap $connectedModule An instance of ModuleMap
	 */
	public  function setConnectedModule(ModuleMap $connectedModule)
	{
		$this->connectedModule=$connectedModule; 
		$this->keyModified['connected_module'] = 1; 

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
