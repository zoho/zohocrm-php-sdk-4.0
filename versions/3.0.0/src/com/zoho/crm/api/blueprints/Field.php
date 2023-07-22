<?php 
namespace com\zoho\crm\api\blueprints;

use com\zoho\crm\api\customviews\SingleCriteria;
use com\zoho\crm\api\fields\AssociationDetails;
use com\zoho\crm\api\fields\AutoNumber;
use com\zoho\crm\api\fields\Crypt;
use com\zoho\crm\api\fields\Currency;
use com\zoho\crm\api\fields\External;
use com\zoho\crm\api\fields\Formula;
use com\zoho\crm\api\fields\HistoryTracking;
use com\zoho\crm\api\fields\Lookup;
use com\zoho\crm\api\fields\MultiModuleLookup;
use com\zoho\crm\api\fields\Multiselectlookup;
use com\zoho\crm\api\fields\PickListValue;
use com\zoho\crm\api\fields\Private1;
use com\zoho\crm\api\fields\Tooltip;
use com\zoho\crm\api\fields\Unique;
use com\zoho\crm\api\fields\ViewType;
use com\zoho\crm\api\layouts\MinifiedLayout;
use com\zoho\crm\api\util\Choice;
use com\zoho\crm\api\util\Model;

class Field implements Model, FieldHandler
{

	private  $mandatory;
	private  $personalityName;
	private  $customField;
	private  $webhook;
	private  $fieldLabel;
	private  $type;
	private  $fieldReadOnly;
	private  $displayLabel;
	private  $readOnly;
	private  $id;
	private  $createdTime;
	private  $filterable;
	private  $visible;
	private  $separator;
	private  $searchable;
	private  $apiName;
	private  $enableColourCode;
	private  $createdSource;
	private  $systemMandatory;
	private  $virtualField;
	private  $content;
	private  $displayType;
	private  $uiType;
	private  $validationRule;
	private  $modifiedTime;
	private  $quickSequenceNumber;
	private  $convertMapping;
	private  $length;
	private  $columnName;
	private  $type5;
	private  $displayField;
	private  $pickListValuesSortedLexically;
	private  $sortable;
	private  $transitionSequence;
	private  $message;
	private  $dataType;
	private  $decimalPlace;
	private  $criteria;
	private  $tooltip;
	private  $layouts;
	private  $associationDetails;
	private  $multiModuleLookup;
	private  $viewType;
	private  $external;
	private  $unique;
	private  $pickListValues;
	private  $private;
	private  $jsonType;
	private  $crypt;
	private  $currency;
	private  $lookup;
	private  $historyTracking;
	private  $formula;
	private  $multiselectlookup;
	private  $autoNumber;
	private  $profiles;
	private  $keyModified=array();

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
	 * The method to get the personalityName
	 * @return string A string representing the personalityName
	 */
	public  function getPersonalityName()
	{
		return $this->personalityName; 

	}

	/**
	 * The method to set the value to personalityName
	 * @param string $personalityName A string
	 */
	public  function setPersonalityName(string $personalityName)
	{
		$this->personalityName=$personalityName; 
		$this->keyModified['personality_name'] = 1; 

	}

	/**
	 * The method to get the customField
	 * @return bool A bool representing the customField
	 */
	public  function getCustomField()
	{
		return $this->customField; 

	}

	/**
	 * The method to set the value to customField
	 * @param bool $customField A bool
	 */
	public  function setCustomField(bool $customField)
	{
		$this->customField=$customField; 
		$this->keyModified['custom_field'] = 1; 

	}

	/**
	 * The method to get the webhook
	 * @return bool A bool representing the webhook
	 */
	public  function getWebhook()
	{
		return $this->webhook; 

	}

	/**
	 * The method to set the value to webhook
	 * @param bool $webhook A bool
	 */
	public  function setWebhook(bool $webhook)
	{
		$this->webhook=$webhook; 
		$this->keyModified['webhook'] = 1; 

	}

	/**
	 * The method to get the fieldLabel
	 * @return string A string representing the fieldLabel
	 */
	public  function getFieldLabel()
	{
		return $this->fieldLabel; 

	}

	/**
	 * The method to set the value to fieldLabel
	 * @param string $fieldLabel A string
	 */
	public  function setFieldLabel(string $fieldLabel)
	{
		$this->fieldLabel=$fieldLabel; 
		$this->keyModified['field_label'] = 1; 

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
	 * The method to get the fieldReadOnly
	 * @return bool A bool representing the fieldReadOnly
	 */
	public  function getFieldReadOnly()
	{
		return $this->fieldReadOnly; 

	}

	/**
	 * The method to set the value to fieldReadOnly
	 * @param bool $fieldReadOnly A bool
	 */
	public  function setFieldReadOnly(bool $fieldReadOnly)
	{
		$this->fieldReadOnly=$fieldReadOnly; 
		$this->keyModified['field_read_only'] = 1; 

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
	 * The method to get the readOnly
	 * @return bool A bool representing the readOnly
	 */
	public  function getReadOnly()
	{
		return $this->readOnly; 

	}

	/**
	 * The method to set the value to readOnly
	 * @param bool $readOnly A bool
	 */
	public  function setReadOnly(bool $readOnly)
	{
		$this->readOnly=$readOnly; 
		$this->keyModified['read_only'] = 1; 

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
	 * The method to get the createdTime
	 * @return \DateTime An instance of \DateTime
	 */
	public  function getCreatedTime()
	{
		return $this->createdTime; 

	}

	/**
	 * The method to set the value to createdTime
	 * @param \DateTime $createdTime An instance of \DateTime
	 */
	public  function setCreatedTime(\DateTime $createdTime)
	{
		$this->createdTime=$createdTime; 
		$this->keyModified['created_time'] = 1; 

	}

	/**
	 * The method to get the filterable
	 * @return bool A bool representing the filterable
	 */
	public  function getFilterable()
	{
		return $this->filterable; 

	}

	/**
	 * The method to set the value to filterable
	 * @param bool $filterable A bool
	 */
	public  function setFilterable(bool $filterable)
	{
		$this->filterable=$filterable; 
		$this->keyModified['filterable'] = 1; 

	}

	/**
	 * The method to get the visible
	 * @return bool A bool representing the visible
	 */
	public  function getVisible()
	{
		return $this->visible; 

	}

	/**
	 * The method to set the value to visible
	 * @param bool $visible A bool
	 */
	public  function setVisible(bool $visible)
	{
		$this->visible=$visible; 
		$this->keyModified['visible'] = 1; 

	}

	/**
	 * The method to get the separator
	 * @return bool A bool representing the separator
	 */
	public  function getSeparator()
	{
		return $this->separator; 

	}

	/**
	 * The method to set the value to separator
	 * @param bool $separator A bool
	 */
	public  function setSeparator(bool $separator)
	{
		$this->separator=$separator; 
		$this->keyModified['separator'] = 1; 

	}

	/**
	 * The method to get the searchable
	 * @return bool A bool representing the searchable
	 */
	public  function getSearchable()
	{
		return $this->searchable; 

	}

	/**
	 * The method to set the value to searchable
	 * @param bool $searchable A bool
	 */
	public  function setSearchable(bool $searchable)
	{
		$this->searchable=$searchable; 
		$this->keyModified['searchable'] = 1; 

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
	 * The method to get the enableColourCode
	 * @return bool A bool representing the enableColourCode
	 */
	public  function getEnableColourCode()
	{
		return $this->enableColourCode; 

	}

	/**
	 * The method to set the value to enableColourCode
	 * @param bool $enableColourCode A bool
	 */
	public  function setEnableColourCode(bool $enableColourCode)
	{
		$this->enableColourCode=$enableColourCode; 
		$this->keyModified['enable_colour_code'] = 1; 

	}

	/**
	 * The method to get the createdSource
	 * @return bool A bool representing the createdSource
	 */
	public  function getCreatedSource()
	{
		return $this->createdSource; 

	}

	/**
	 * The method to set the value to createdSource
	 * @param bool $createdSource A bool
	 */
	public  function setCreatedSource(bool $createdSource)
	{
		$this->createdSource=$createdSource; 
		$this->keyModified['created_source'] = 1; 

	}

	/**
	 * The method to get the systemMandatory
	 * @return bool A bool representing the systemMandatory
	 */
	public  function getSystemMandatory()
	{
		return $this->systemMandatory; 

	}

	/**
	 * The method to set the value to systemMandatory
	 * @param bool $systemMandatory A bool
	 */
	public  function setSystemMandatory(bool $systemMandatory)
	{
		$this->systemMandatory=$systemMandatory; 
		$this->keyModified['system_mandatory'] = 1; 

	}

	/**
	 * The method to get the virtualField
	 * @return bool A bool representing the virtualField
	 */
	public  function getVirtualField()
	{
		return $this->virtualField; 

	}

	/**
	 * The method to set the value to virtualField
	 * @param bool $virtualField A bool
	 */
	public  function setVirtualField(bool $virtualField)
	{
		$this->virtualField=$virtualField; 
		$this->keyModified['virtual_field'] = 1; 

	}

	/**
	 * The method to get the content
	 * @return string A string representing the content
	 */
	public  function getContent()
	{
		return $this->content; 

	}

	/**
	 * The method to set the value to content
	 * @param string $content A string
	 */
	public  function setContent(string $content)
	{
		$this->content=$content; 
		$this->keyModified['content'] = 1; 

	}

	/**
	 * The method to get the displayType
	 * @return Choice An instance of Choice
	 */
	public  function getDisplayType()
	{
		return $this->displayType; 

	}

	/**
	 * The method to set the value to displayType
	 * @param Choice $displayType An instance of Choice
	 */
	public  function setDisplayType(Choice $displayType)
	{
		$this->displayType=$displayType; 
		$this->keyModified['display_type'] = 1; 

	}

	/**
	 * The method to get the uiType
	 * @return int A int representing the uiType
	 */
	public  function getUiType()
	{
		return $this->uiType; 

	}

	/**
	 * The method to set the value to uiType
	 * @param int $uiType A int
	 */
	public  function setUiType(int $uiType)
	{
		$this->uiType=$uiType; 
		$this->keyModified['ui_type'] = 1; 

	}

	/**
	 * The method to get the validationRule
	 * @return ValidationRule An instance of ValidationRule
	 */
	public  function getValidationRule()
	{
		return $this->validationRule; 

	}

	/**
	 * The method to set the value to validationRule
	 * @param ValidationRule $validationRule An instance of ValidationRule
	 */
	public  function setValidationRule(ValidationRule $validationRule)
	{
		$this->validationRule=$validationRule; 
		$this->keyModified['validation_rule'] = 1; 

	}

	/**
	 * The method to get the modifiedTime
	 * @return \DateTime An instance of \DateTime
	 */
	public  function getModifiedTime()
	{
		return $this->modifiedTime; 

	}

	/**
	 * The method to set the value to modifiedTime
	 * @param \DateTime $modifiedTime An instance of \DateTime
	 */
	public  function setModifiedTime(\DateTime $modifiedTime)
	{
		$this->modifiedTime=$modifiedTime; 
		$this->keyModified['modified_time'] = 1; 

	}

	/**
	 * The method to get the quickSequenceNumber
	 * @return int A int representing the quickSequenceNumber
	 */
	public  function getQuickSequenceNumber()
	{
		return $this->quickSequenceNumber; 

	}

	/**
	 * The method to set the value to quickSequenceNumber
	 * @param int $quickSequenceNumber A int
	 */
	public  function setQuickSequenceNumber(int $quickSequenceNumber)
	{
		$this->quickSequenceNumber=$quickSequenceNumber; 
		$this->keyModified['quick_sequence_number'] = 1; 

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
	 * The method to get the length
	 * @return int A int representing the length
	 */
	public  function getLength()
	{
		return $this->length; 

	}

	/**
	 * The method to set the value to length
	 * @param int $length A int
	 */
	public  function setLength(int $length)
	{
		$this->length=$length; 
		$this->keyModified['length'] = 1; 

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
	 * The method to get the type5
	 * @return string A string representing the type5
	 */
	public  function getType5()
	{
		return $this->type5; 

	}

	/**
	 * The method to set the value to type5
	 * @param string $type5 A string
	 */
	public  function setType5(string $type5)
	{
		$this->type5=$type5; 
		$this->keyModified['_type'] = 1; 

	}

	/**
	 * The method to get the displayField
	 * @return bool A bool representing the displayField
	 */
	public  function getDisplayField()
	{
		return $this->displayField; 

	}

	/**
	 * The method to set the value to displayField
	 * @param bool $displayField A bool
	 */
	public  function setDisplayField(bool $displayField)
	{
		$this->displayField=$displayField; 
		$this->keyModified['display_field'] = 1; 

	}

	/**
	 * The method to get the pickListValuesSortedLexically
	 * @return bool A bool representing the pickListValuesSortedLexically
	 */
	public  function getPickListValuesSortedLexically()
	{
		return $this->pickListValuesSortedLexically; 

	}

	/**
	 * The method to set the value to pickListValuesSortedLexically
	 * @param bool $pickListValuesSortedLexically A bool
	 */
	public  function setPickListValuesSortedLexically(bool $pickListValuesSortedLexically)
	{
		$this->pickListValuesSortedLexically=$pickListValuesSortedLexically; 
		$this->keyModified['pick_list_values_sorted_lexically'] = 1; 

	}

	/**
	 * The method to get the sortable
	 * @return bool A bool representing the sortable
	 */
	public  function getSortable()
	{
		return $this->sortable; 

	}

	/**
	 * The method to set the value to sortable
	 * @param bool $sortable A bool
	 */
	public  function setSortable(bool $sortable)
	{
		$this->sortable=$sortable; 
		$this->keyModified['sortable'] = 1; 

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
	 * The method to get the message
	 * @return string A string representing the message
	 */
	public  function getMessage()
	{
		return $this->message; 

	}

	/**
	 * The method to set the value to message
	 * @param string $message A string
	 */
	public  function setMessage(string $message)
	{
		$this->message=$message; 
		$this->keyModified['message'] = 1; 

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
	 * The method to get the decimalPlace
	 * @return int A int representing the decimalPlace
	 */
	public  function getDecimalPlace()
	{
		return $this->decimalPlace; 

	}

	/**
	 * The method to set the value to decimalPlace
	 * @param int $decimalPlace A int
	 */
	public  function setDecimalPlace(int $decimalPlace)
	{
		$this->decimalPlace=$decimalPlace; 
		$this->keyModified['decimal_place'] = 1; 

	}

	/**
	 * The method to get the criteria
	 * @return SingleCriteria An instance of SingleCriteria
	 */
	public  function getCriteria()
	{
		return $this->criteria; 

	}

	/**
	 * The method to set the value to criteria
	 * @param SingleCriteria $criteria An instance of SingleCriteria
	 */
	public  function setCriteria(SingleCriteria $criteria)
	{
		$this->criteria=$criteria; 
		$this->keyModified['criteria'] = 1; 

	}

	/**
	 * The method to get the tooltip
	 * @return Tooltip An instance of Tooltip
	 */
	public  function getTooltip()
	{
		return $this->tooltip; 

	}

	/**
	 * The method to set the value to tooltip
	 * @param Tooltip $tooltip An instance of Tooltip
	 */
	public  function setTooltip(Tooltip $tooltip)
	{
		$this->tooltip=$tooltip; 
		$this->keyModified['tooltip'] = 1; 

	}

	/**
	 * The method to get the layouts
	 * @return MinifiedLayout An instance of MinifiedLayout
	 */
	public  function getLayouts()
	{
		return $this->layouts; 

	}

	/**
	 * The method to set the value to layouts
	 * @param MinifiedLayout $layouts An instance of MinifiedLayout
	 */
	public  function setLayouts(MinifiedLayout $layouts)
	{
		$this->layouts=$layouts; 
		$this->keyModified['layouts'] = 1; 

	}

	/**
	 * The method to get the associationDetails
	 * @return AssociationDetails An instance of AssociationDetails
	 */
	public  function getAssociationDetails()
	{
		return $this->associationDetails; 

	}

	/**
	 * The method to set the value to associationDetails
	 * @param AssociationDetails $associationDetails An instance of AssociationDetails
	 */
	public  function setAssociationDetails(AssociationDetails $associationDetails)
	{
		$this->associationDetails=$associationDetails; 
		$this->keyModified['association_details'] = 1; 

	}

	/**
	 * The method to get the multiModuleLookup
	 * @return MultiModuleLookup An instance of MultiModuleLookup
	 */
	public  function getMultiModuleLookup()
	{
		return $this->multiModuleLookup; 

	}

	/**
	 * The method to set the value to multiModuleLookup
	 * @param MultiModuleLookup $multiModuleLookup An instance of MultiModuleLookup
	 */
	public  function setMultiModuleLookup(MultiModuleLookup $multiModuleLookup)
	{
		$this->multiModuleLookup=$multiModuleLookup; 
		$this->keyModified['multi_module_lookup'] = 1; 

	}

	/**
	 * The method to get the viewType
	 * @return ViewType An instance of ViewType
	 */
	public  function getViewType()
	{
		return $this->viewType; 

	}

	/**
	 * The method to set the value to viewType
	 * @param ViewType $viewType An instance of ViewType
	 */
	public  function setViewType(ViewType $viewType)
	{
		$this->viewType=$viewType; 
		$this->keyModified['view_type'] = 1; 

	}

	/**
	 * The method to get the external
	 * @return External An instance of External
	 */
	public  function getExternal()
	{
		return $this->external; 

	}

	/**
	 * The method to set the value to external
	 * @param External $external An instance of External
	 */
	public  function setExternal(External $external)
	{
		$this->external=$external; 
		$this->keyModified['external'] = 1; 

	}

	/**
	 * The method to get the unique
	 * @return Unique An instance of Unique
	 */
	public  function getUnique()
	{
		return $this->unique; 

	}

	/**
	 * The method to set the value to unique
	 * @param Unique $unique An instance of Unique
	 */
	public  function setUnique(Unique $unique)
	{
		$this->unique=$unique; 
		$this->keyModified['unique'] = 1; 

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
	 * The method to get the private
	 * @return Private1 An instance of Private1
	 */
	public  function getPrivate()
	{
		return $this->private; 

	}

	/**
	 * The method to set the value to private
	 * @param Private1 $private An instance of Private1
	 */
	public  function setPrivate(Private1 $private)
	{
		$this->private=$private; 
		$this->keyModified['private'] = 1; 

	}

	/**
	 * The method to get the jsonType
	 * @return string A string representing the jsonType
	 */
	public  function getJsonType()
	{
		return $this->jsonType; 

	}

	/**
	 * The method to set the value to jsonType
	 * @param string $jsonType A string
	 */
	public  function setJsonType(string $jsonType)
	{
		$this->jsonType=$jsonType; 
		$this->keyModified['json_type'] = 1; 

	}

	/**
	 * The method to get the crypt
	 * @return Crypt An instance of Crypt
	 */
	public  function getCrypt()
	{
		return $this->crypt; 

	}

	/**
	 * The method to set the value to crypt
	 * @param Crypt $crypt An instance of Crypt
	 */
	public  function setCrypt(Crypt $crypt)
	{
		$this->crypt=$crypt; 
		$this->keyModified['crypt'] = 1; 

	}

	/**
	 * The method to get the currency
	 * @return Currency An instance of Currency
	 */
	public  function getCurrency()
	{
		return $this->currency; 

	}

	/**
	 * The method to set the value to currency
	 * @param Currency $currency An instance of Currency
	 */
	public  function setCurrency(Currency $currency)
	{
		$this->currency=$currency; 
		$this->keyModified['currency'] = 1; 

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
	 * The method to get the historyTracking
	 * @return HistoryTracking An instance of HistoryTracking
	 */
	public  function getHistoryTracking()
	{
		return $this->historyTracking; 

	}

	/**
	 * The method to set the value to historyTracking
	 * @param HistoryTracking $historyTracking An instance of HistoryTracking
	 */
	public  function setHistoryTracking(HistoryTracking $historyTracking)
	{
		$this->historyTracking=$historyTracking; 
		$this->keyModified['history_tracking'] = 1; 

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
	 * The method to get the multiselectlookup
	 * @return Multiselectlookup An instance of Multiselectlookup
	 */
	public  function getMultiselectlookup()
	{
		return $this->multiselectlookup; 

	}

	/**
	 * The method to set the value to multiselectlookup
	 * @param Multiselectlookup $multiselectlookup An instance of Multiselectlookup
	 */
	public  function setMultiselectlookup(Multiselectlookup $multiselectlookup)
	{
		$this->multiselectlookup=$multiselectlookup; 
		$this->keyModified['multiselectlookup'] = 1; 

	}

	/**
	 * The method to get the autoNumber
	 * @return AutoNumber An instance of AutoNumber
	 */
	public  function getAutoNumber()
	{
		return $this->autoNumber; 

	}

	/**
	 * The method to set the value to autoNumber
	 * @param AutoNumber $autoNumber An instance of AutoNumber
	 */
	public  function setAutoNumber(AutoNumber $autoNumber)
	{
		$this->autoNumber=$autoNumber; 
		$this->keyModified['auto_number'] = 1; 

	}

	/**
	 * The method to get the profiles
	 * @return array A array representing the profiles
	 */
	public  function getProfiles()
	{
		return $this->profiles; 

	}

	/**
	 * The method to set the value to profiles
	 * @param array $profiles A array
	 */
	public  function setProfiles(array $profiles)
	{
		$this->profiles=$profiles; 
		$this->keyModified['profiles'] = 1; 

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
