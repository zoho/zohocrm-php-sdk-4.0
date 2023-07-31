<?php 
namespace com\zoho\crm\api\modules;

use com\zoho\crm\api\fields\Formula;
use com\zoho\crm\api\fields\Lookup;
use com\zoho\crm\api\fields\PickListValue;
use com\zoho\crm\api\util\Model;

class SectionField implements Model
{

	private  $defaultValue;
	private  $required;
	private  $sequenceNumber;
	private  $sectionId;
	private  $apiName;
	private  $businesscardSupported;
	private  $id;
	private  $massUpdate;
	private  $convertMapping;
	private  $lookup;
	private  $formula;
	private  $subform;
	private  $pickListValues;
	private  $keyModified=array();

	/**
	 * The method to get the defaultValue
	 * @return string A string representing the defaultValue
	 */
	public  function getDefaultValue()
	{
		return $this->defaultValue; 

	}

	/**
	 * The method to set the value to defaultValue
	 * @param string $defaultValue A string
	 */
	public  function setDefaultValue(string $defaultValue)
	{
		$this->defaultValue=$defaultValue; 
		$this->keyModified['default_value'] = 1; 

	}

	/**
	 * The method to get the required
	 * @return bool A bool representing the required
	 */
	public  function getRequired()
	{
		return $this->required; 

	}

	/**
	 * The method to set the value to required
	 * @param bool $required A bool
	 */
	public  function setRequired(bool $required)
	{
		$this->required=$required; 
		$this->keyModified['required'] = 1; 

	}

	/**
	 * The method to get the sequenceNumber
	 * @return int A int representing the sequenceNumber
	 */
	public  function getSequenceNumber()
	{
		return $this->sequenceNumber; 

	}

	/**
	 * The method to set the value to sequenceNumber
	 * @param int $sequenceNumber A int
	 */
	public  function setSequenceNumber(int $sequenceNumber)
	{
		$this->sequenceNumber=$sequenceNumber; 
		$this->keyModified['sequence_number'] = 1; 

	}

	/**
	 * The method to get the sectionId
	 * @return int A int representing the sectionId
	 */
	public  function getSectionId()
	{
		return $this->sectionId; 

	}

	/**
	 * The method to set the value to sectionId
	 * @param int $sectionId A int
	 */
	public  function setSectionId(int $sectionId)
	{
		$this->sectionId=$sectionId; 
		$this->keyModified['section_id'] = 1; 

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
	 * The method to get the businesscardSupported
	 * @return bool A bool representing the businesscardSupported
	 */
	public  function getBusinesscardSupported()
	{
		return $this->businesscardSupported; 

	}

	/**
	 * The method to set the value to businesscardSupported
	 * @param bool $businesscardSupported A bool
	 */
	public  function setBusinesscardSupported(bool $businesscardSupported)
	{
		$this->businesscardSupported=$businesscardSupported; 
		$this->keyModified['businesscard_supported'] = 1; 

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
	 * The method to get the massUpdate
	 * @return bool A bool representing the massUpdate
	 */
	public  function getMassUpdate()
	{
		return $this->massUpdate; 

	}

	/**
	 * The method to set the value to massUpdate
	 * @param bool $massUpdate A bool
	 */
	public  function setMassUpdate(bool $massUpdate)
	{
		$this->massUpdate=$massUpdate; 
		$this->keyModified['mass_update'] = 1; 

	}

	/**
	 * The method to get the convertMapping
	 * @return ConvertMapping An instance of ConvertMapping
	 */
	public  function getConvertMapping()
	{
		return $this->convertMapping; 

	}

	/**
	 * The method to set the value to convertMapping
	 * @param ConvertMapping $convertMapping An instance of ConvertMapping
	 */
	public  function setConvertMapping(ConvertMapping $convertMapping)
	{
		$this->convertMapping=$convertMapping; 
		$this->keyModified['convert_mapping'] = 1; 

	}

	/**
	 * The method to get the lookup
	 * @return Lookup An instance of Lookup
	 */
	public  function getLookup()
	{
		return $this->lookup; 

	}

	/**
	 * The method to set the value to lookup
	 * @param Lookup $lookup An instance of Lookup
	 */
	public  function setLookup(Lookup $lookup)
	{
		$this->lookup=$lookup; 
		$this->keyModified['lookup'] = 1; 

	}

	/**
	 * The method to get the formula
	 * @return Formula An instance of Formula
	 */
	public  function getFormula()
	{
		return $this->formula; 

	}

	/**
	 * The method to set the value to formula
	 * @param Formula $formula An instance of Formula
	 */
	public  function setFormula(Formula $formula)
	{
		$this->formula=$formula; 
		$this->keyModified['formula'] = 1; 

	}

	/**
	 * The method to get the subform
	 * @return Subform An instance of Subform
	 */
	public  function getSubform()
	{
		return $this->subform; 

	}

	/**
	 * The method to set the value to subform
	 * @param Subform $subform An instance of Subform
	 */
	public  function setSubform(Subform $subform)
	{
		$this->subform=$subform; 
		$this->keyModified['subform'] = 1; 

	}

	/**
	 * The method to get the pickListValues
	 * @return array A array representing the pickListValues
	 */
	public  function getPickListValues()
	{
		return $this->pickListValues; 

	}

	/**
	 * The method to set the value to pickListValues
	 * @param array $pickListValues A array
	 */
	public  function setPickListValues(array $pickListValues)
	{
		$this->pickListValues=$pickListValues; 
		$this->keyModified['pick_list_values'] = 1; 

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
