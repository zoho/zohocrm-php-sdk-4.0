<?php 
namespace com\zoho\crm\api\relatedlists;

use com\zoho\crm\api\fields\Field;
use com\zoho\crm\api\modules\MinifiedModule;
use com\zoho\crm\api\util\Model;

class RelatedList implements Model
{

	private  $id;
	private  $sequenceNumber;
	private  $displayLabel;
	private  $apiName;
	private  $name;
	private  $action;
	private  $href;
	private  $type;
	private  $connectedmodule;
	private  $linkingmodule;
	private  $customizeSort;
	private  $customizeFields;
	private  $customizeDisplayLabel;
	private  $sortBy;
	private  $sortOrder;
	private  $fields;
	private  $module;
	private  $keyModified=array();

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
	 * The method to get the sequenceNumber
	 * @return string A string representing the sequenceNumber
	 */
	public  function getSequenceNumber()
	{
		return $this->sequenceNumber; 

	}

	/**
	 * The method to set the value to sequenceNumber
	 * @param string $sequenceNumber A string
	 */
	public  function setSequenceNumber(string $sequenceNumber)
	{
		$this->sequenceNumber=$sequenceNumber; 
		$this->keyModified['sequence_number'] = 1; 

	}

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
	 * The method to get the name
	 * @return string A string representing the name
	 */
	public  function getName()
	{
		return $this->name; 

	}

	/**
	 * The method to set the value to name
	 * @param string $name A string
	 */
	public  function setName(string $name)
	{
		$this->name=$name; 
		$this->keyModified['name'] = 1; 

	}

	/**
	 * The method to get the action
	 * @return string A string representing the action
	 */
	public  function getAction()
	{
		return $this->action; 

	}

	/**
	 * The method to set the value to action
	 * @param string $action A string
	 */
	public  function setAction(string $action)
	{
		$this->action=$action; 
		$this->keyModified['action'] = 1; 

	}

	/**
	 * The method to get the href
	 * @return string A string representing the href
	 */
	public  function getHref()
	{
		return $this->href; 

	}

	/**
	 * The method to set the value to href
	 * @param string $href A string
	 */
	public  function setHref(string $href)
	{
		$this->href=$href; 
		$this->keyModified['href'] = 1; 

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
		$this->keyModified['type'] = 1; 

	}

	/**
	 * The method to get the connectedmodule
	 * @return string A string representing the connectedmodule
	 */
	public  function getConnectedmodule()
	{
		return $this->connectedmodule; 

	}

	/**
	 * The method to set the value to connectedmodule
	 * @param string $connectedmodule A string
	 */
	public  function setConnectedmodule(string $connectedmodule)
	{
		$this->connectedmodule=$connectedmodule; 
		$this->keyModified['connectedmodule'] = 1; 

	}

	/**
	 * The method to get the linkingmodule
	 * @return string A string representing the linkingmodule
	 */
	public  function getLinkingmodule()
	{
		return $this->linkingmodule; 

	}

	/**
	 * The method to set the value to linkingmodule
	 * @param string $linkingmodule A string
	 */
	public  function setLinkingmodule(string $linkingmodule)
	{
		$this->linkingmodule=$linkingmodule; 
		$this->keyModified['linkingmodule'] = 1; 

	}

	/**
	 * The method to get the customizeSort
	 * @return bool A bool representing the customizeSort
	 */
	public  function getCustomizeSort()
	{
		return $this->customizeSort; 

	}

	/**
	 * The method to set the value to customizeSort
	 * @param bool $customizeSort A bool
	 */
	public  function setCustomizeSort(bool $customizeSort)
	{
		$this->customizeSort=$customizeSort; 
		$this->keyModified['customize_sort'] = 1; 

	}

	/**
	 * The method to get the customizeFields
	 * @return bool A bool representing the customizeFields
	 */
	public  function getCustomizeFields()
	{
		return $this->customizeFields; 

	}

	/**
	 * The method to set the value to customizeFields
	 * @param bool $customizeFields A bool
	 */
	public  function setCustomizeFields(bool $customizeFields)
	{
		$this->customizeFields=$customizeFields; 
		$this->keyModified['customize_fields'] = 1; 

	}

	/**
	 * The method to get the customizeDisplayLabel
	 * @return bool A bool representing the customizeDisplayLabel
	 */
	public  function getCustomizeDisplayLabel()
	{
		return $this->customizeDisplayLabel; 

	}

	/**
	 * The method to set the value to customizeDisplayLabel
	 * @param bool $customizeDisplayLabel A bool
	 */
	public  function setCustomizeDisplayLabel(bool $customizeDisplayLabel)
	{
		$this->customizeDisplayLabel=$customizeDisplayLabel; 
		$this->keyModified['customize_display_label'] = 1; 

	}

	/**
	 * The method to get the sortBy
	 * @return string A string representing the sortBy
	 */
	public  function getSortBy()
	{
		return $this->sortBy; 

	}

	/**
	 * The method to set the value to sortBy
	 * @param string $sortBy A string
	 */
	public  function setSortBy(string $sortBy)
	{
		$this->sortBy=$sortBy; 
		$this->keyModified['sort_by'] = 1; 

	}

	/**
	 * The method to get the sortOrder
	 * @return string A string representing the sortOrder
	 */
	public  function getSortOrder()
	{
		return $this->sortOrder; 

	}

	/**
	 * The method to set the value to sortOrder
	 * @param string $sortOrder A string
	 */
	public  function setSortOrder(string $sortOrder)
	{
		$this->sortOrder=$sortOrder; 
		$this->keyModified['sort_order'] = 1; 

	}

	/**
	 * The method to get the fields
	 * @return array A array representing the fields
	 */
	public  function getFields()
	{
		return $this->fields; 

	}

	/**
	 * The method to set the value to fields
	 * @param array $fields A array
	 */
	public  function setFields(array $fields)
	{
		$this->fields=$fields; 
		$this->keyModified['fields'] = 1; 

	}

	/**
	 * The method to get the module
	 * @return MinifiedModule An instance of MinifiedModule
	 */
	public  function getModule()
	{
		return $this->module; 

	}

	/**
	 * The method to set the value to module
	 * @param MinifiedModule $module An instance of MinifiedModule
	 */
	public  function setModule(MinifiedModule $module)
	{
		$this->module=$module; 
		$this->keyModified['module'] = 1; 

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
