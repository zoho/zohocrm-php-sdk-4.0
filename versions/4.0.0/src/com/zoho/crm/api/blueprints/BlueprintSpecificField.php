<?php 
namespace com\zoho\crm\api\blueprints;

use com\zoho\crm\api\util\Model;

class BlueprintSpecificField implements Model, FieldHandler
{

	private  $displayLabel;
	private  $type;
	private  $dataType;
	private  $columnName;
	private  $id;
	private  $transitionSequence;
	private  $mandatory;
	private  $layouts;
	private  $content;
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
		$this->keyModified['_type'] = 1; 

	}

	/**
	 * The method to get the dataType
	 * @return string A string representing the dataType
	 */
	public  function getDataType()
	{
		return $this->dataType; 

	}

	/**
	 * The method to set the value to dataType
	 * @param string $dataType A string
	 */
	public  function setDataType(string $dataType)
	{
		$this->dataType=$dataType; 
		$this->keyModified['data_type'] = 1; 

	}

	/**
	 * The method to get the columnName
	 * @return string A string representing the columnName
	 */
	public  function getColumnName()
	{
		return $this->columnName; 

	}

	/**
	 * The method to set the value to columnName
	 * @param string $columnName A string
	 */
	public  function setColumnName(string $columnName)
	{
		$this->columnName=$columnName; 
		$this->keyModified['column_name'] = 1; 

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
	 * The method to get the transitionSequence
	 * @return int A int representing the transitionSequence
	 */
	public  function getTransitionSequence()
	{
		return $this->transitionSequence; 

	}

	/**
	 * The method to set the value to transitionSequence
	 * @param int $transitionSequence A int
	 */
	public  function setTransitionSequence(int $transitionSequence)
	{
		$this->transitionSequence=$transitionSequence; 
		$this->keyModified['transition_sequence'] = 1; 

	}

	/**
	 * The method to get the mandatory
	 * @return bool A bool representing the mandatory
	 */
	public  function getMandatory()
	{
		return $this->mandatory; 

	}

	/**
	 * The method to set the value to mandatory
	 * @param bool $mandatory A bool
	 */
	public  function setMandatory(bool $mandatory)
	{
		$this->mandatory=$mandatory; 
		$this->keyModified['mandatory'] = 1; 

	}

	/**
	 * The method to get the layouts
	 * @return bool A bool representing the layouts
	 */
	public  function getLayouts()
	{
		return $this->layouts; 

	}

	/**
	 * The method to set the value to layouts
	 * @param bool $layouts A bool
	 */
	public  function setLayouts(bool $layouts)
	{
		$this->layouts=$layouts; 
		$this->keyModified['layouts'] = 1; 

	}

	/**
	 * The method to get the content
	 * @return bool A bool representing the content
	 */
	public  function getContent()
	{
		return $this->content; 

	}

	/**
	 * The method to set the value to content
	 * @param bool $content A bool
	 */
	public  function setContent(bool $content)
	{
		$this->content=$content; 
		$this->keyModified['content'] = 1; 

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
