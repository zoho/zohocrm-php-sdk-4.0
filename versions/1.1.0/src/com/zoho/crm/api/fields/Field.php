<?php 
namespace com\zoho\crm\api\fields;

use com\zoho\crm\api\util\Choice;
use com\zoho\crm\api\util\Model;

class Field implements Model
{

	private  $dataType;
	private  $defaultValue;
	private  $sequenceNumber;
	private  $systemMandatory;
	private  $webhook;
	private  $blueprintSupported;
	private  $virtualField;
	private  $fieldReadOnly;
	private  $readOnly;
	private  $customField;
	private  $businesscardSupported;
	private  $filterable;
	private  $visible;
	private  $availableInUserLayout;
	private  $displayField;
	private  $pickListValuesSortedLexically;
	private  $sortable;
	private  $separator;
	private  $searchable;
	private  $enableColourCode;
	private  $massUpdate;
	private  $jsonType;
	private  $createdSource;
	private  $type;
	private  $displayLabel;
	private  $columnName;
	private  $apiName;
	private  $displayType;
	private  $uiType;
	private  $createdTime;
	private  $modifiedTime;
	private  $showType;
	private  $category;
	private  $id;
	private  $decimalPlace;
	private  $quickSequenceNumber;
	private  $sharingProperties;
	private  $convertMapping;
	private  $additionalColumn;
	private  $fieldLabel;
	private  $length;
	private  $allowedPermissionsToUpdate;
	private  $emailParser;
	private  $referFromField;
	private  $multiModuleLookup;
	private  $currency;
	private  $fileUpoladOptionlist;
	private  $lookup;
	private  $profiles;
	private  $viewType;
	private  $unique;
	private  $subModule;
	private  $subform;
	private  $external;
	private  $formula;
	private  $private;
	private  $multiselectlookup;
	private  $multiuserlookup;
	private  $autoNumber;
	private  $pickListValues;
	private  $crypt;
	private  $tooltip;
	private  $historyTracking;
	private  $associationDetails;
	private  $allowedModules;
	private  $keyModified=array();

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
	 * The method to get the blueprintSupported
	 * @return bool A bool representing the blueprintSupported
	 */
	public  function getBlueprintSupported()
	{
		return $this->blueprintSupported; 

	}

	/**
	 * The method to set the value to blueprintSupported
	 * @param bool $blueprintSupported A bool
	 */
	public  function setBlueprintSupported(bool $blueprintSupported)
	{
		$this->blueprintSupported=$blueprintSupported; 
		$this->keyModified['blueprint_supported'] = 1; 

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
	 * The method to get the availableInUserLayout
	 * @return bool A bool representing the availableInUserLayout
	 */
	public  function getAvailableInUserLayout()
	{
		return $this->availableInUserLayout; 

	}

	/**
	 * The method to set the value to availableInUserLayout
	 * @param bool $availableInUserLayout A bool
	 */
	public  function setAvailableInUserLayout(bool $availableInUserLayout)
	{
		$this->availableInUserLayout=$availableInUserLayout; 
		$this->keyModified['available_in_user_layout'] = 1; 

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
	 * The method to get the createdSource
	 * @return string A string representing the createdSource
	 */
	public  function getCreatedSource()
	{
		return $this->createdSource; 

	}

	/**
	 * The method to set the value to createdSource
	 * @param string $createdSource A string
	 */
	public  function setCreatedSource(string $createdSource)
	{
		$this->createdSource=$createdSource; 
		$this->keyModified['created_source'] = 1; 

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
	 * The method to get the displayType
	 * @return int A int representing the displayType
	 */
	public  function getDisplayType()
	{
		return $this->displayType; 

	}

	/**
	 * The method to set the value to displayType
	 * @param int $displayType A int
	 */
	public  function setDisplayType(int $displayType)
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
	 * The method to get the showType
	 * @return int A int representing the showType
	 */
	public  function getShowType()
	{
		return $this->showType; 

	}

	/**
	 * The method to set the value to showType
	 * @param int $showType A int
	 */
	public  function setShowType(int $showType)
	{
		$this->showType=$showType; 
		$this->keyModified['show_type'] = 1; 

	}

	/**
	 * The method to get the category
	 * @return int A int representing the category
	 */
	public  function getCategory()
	{
		return $this->category; 

	}

	/**
	 * The method to set the value to category
	 * @param int $category A int
	 */
	public  function setCategory(int $category)
	{
		$this->category=$category; 
		$this->keyModified['category'] = 1; 

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
	 * The method to get the quickSequenceNumber
	 * @return string A string representing the quickSequenceNumber
	 */
	public  function getQuickSequenceNumber()
	{
		return $this->quickSequenceNumber; 

	}

	/**
	 * The method to set the value to quickSequenceNumber
	 * @param string $quickSequenceNumber A string
	 */
	public  function setQuickSequenceNumber(string $quickSequenceNumber)
	{
		$this->quickSequenceNumber=$quickSequenceNumber; 
		$this->keyModified['quick_sequence_number'] = 1; 

	}

	/**
	 * The method to get the sharingProperties
	 * @return SharingProperties An instance of SharingProperties
	 */
	public  function getSharingProperties()
	{
		return $this->sharingProperties; 

	}

	/**
	 * The method to set the value to sharingProperties
	 * @param SharingProperties $sharingProperties An instance of SharingProperties
	 */
	public  function setSharingProperties(SharingProperties $sharingProperties)
	{
		$this->sharingProperties=$sharingProperties; 
		$this->keyModified['sharing_properties'] = 1; 

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
	 * The method to get the additionalColumn
	 * @return string A string representing the additionalColumn
	 */
	public  function getAdditionalColumn()
	{
		return $this->additionalColumn; 

	}

	/**
	 * The method to set the value to additionalColumn
	 * @param string $additionalColumn A string
	 */
	public  function setAdditionalColumn(string $additionalColumn)
	{
		$this->additionalColumn=$additionalColumn; 
		$this->keyModified['additional_column'] = 1; 

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
	 * The method to get the length
	 * @return Choice An instance of Choice
	 */
	public  function getLength()
	{
		return $this->length; 

	}

	/**
	 * The method to set the value to length
	 * @param Choice $length An instance of Choice
	 */
	public  function setLength(Choice $length)
	{
		$this->length=$length; 
		$this->keyModified['length'] = 1; 

	}

	/**
	 * The method to get the allowedPermissionsToUpdate
	 * @return AllowedPermissionsToUpdate An instance of AllowedPermissionsToUpdate
	 */
	public  function getAllowedPermissionsToUpdate()
	{
		return $this->allowedPermissionsToUpdate; 

	}

	/**
	 * The method to set the value to allowedPermissionsToUpdate
	 * @param AllowedPermissionsToUpdate $allowedPermissionsToUpdate An instance of AllowedPermissionsToUpdate
	 */
	public  function setAllowedPermissionsToUpdate(AllowedPermissionsToUpdate $allowedPermissionsToUpdate)
	{
		$this->allowedPermissionsToUpdate=$allowedPermissionsToUpdate; 
		$this->keyModified['allowed_permissions_to_update'] = 1; 

	}

	/**
	 * The method to get the emailParser
	 * @return EmailParser An instance of EmailParser
	 */
	public  function getEmailParser()
	{
		return $this->emailParser; 

	}

	/**
	 * The method to set the value to emailParser
	 * @param EmailParser $emailParser An instance of EmailParser
	 */
	public  function setEmailParser(EmailParser $emailParser)
	{
		$this->emailParser=$emailParser; 
		$this->keyModified['email_parser'] = 1; 

	}

	/**
	 * The method to get the referFromField
	 * @return ReferFromField An instance of ReferFromField
	 */
	public  function getReferFromField()
	{
		return $this->referFromField; 

	}

	/**
	 * The method to set the value to referFromField
	 * @param ReferFromField $referFromField An instance of ReferFromField
	 */
	public  function setReferFromField(ReferFromField $referFromField)
	{
		$this->referFromField=$referFromField; 
		$this->keyModified['refer_from_field'] = 1; 

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
	 * The method to get the fileUpoladOptionlist
	 * @return array A array representing the fileUpoladOptionlist
	 */
	public  function getFileUpoladOptionlist()
	{
		return $this->fileUpoladOptionlist; 

	}

	/**
	 * The method to set the value to fileUpoladOptionlist
	 * @param array $fileUpoladOptionlist A array
	 */
	public  function setFileUpoladOptionlist(array $fileUpoladOptionlist)
	{
		$this->fileUpoladOptionlist=$fileUpoladOptionlist; 
		$this->keyModified['file_upolad_optionlist'] = 1; 

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
	 * The method to get the unique
	 */
	public  function getUnique()
	{
		return $this->unique; 

	}

	/**
	 * The method to set the value to unique
	 * @param 
	 */
	public  function setUnique( $unique)
	{
		$this->unique=$unique; 
		$this->keyModified['unique'] = 1; 

	}

	/**
	 * The method to get the subModule
	 * @return ModuleMap An instance of ModuleMap
	 */
	public  function getSubModule()
	{
		return $this->subModule; 

	}

	/**
	 * The method to set the value to subModule
	 * @param ModuleMap $subModule An instance of ModuleMap
	 */
	public  function setSubModule(ModuleMap $subModule)
	{
		$this->subModule=$subModule; 
		$this->keyModified['sub_module'] = 1; 

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
	 * The method to get the multiuserlookup
	 * @return Multiselectlookup An instance of Multiselectlookup
	 */
	public  function getMultiuserlookup()
	{
		return $this->multiuserlookup; 

	}

	/**
	 * The method to set the value to multiuserlookup
	 * @param Multiselectlookup $multiuserlookup An instance of Multiselectlookup
	 */
	public  function setMultiuserlookup(Multiselectlookup $multiuserlookup)
	{
		$this->multiuserlookup=$multiuserlookup; 
		$this->keyModified['multiuserlookup'] = 1; 

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
	 * The method to get the allowedModules
	 * @return array A array representing the allowedModules
	 */
	public  function getAllowedModules()
	{
		return $this->allowedModules; 

	}

	/**
	 * The method to set the value to allowedModules
	 * @param array $allowedModules A array
	 */
	public  function setAllowedModules(array $allowedModules)
	{
		$this->allowedModules=$allowedModules; 
		$this->keyModified['allowed_modules'] = 1; 

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
