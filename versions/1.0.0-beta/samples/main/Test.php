<?php

require_once '../../../../../vendor/autoload.php';

use com\zoho\crm\sample\initializer\Initialize;
use com\zoho\crm\sample\attachments\Attachment;
use com\zoho\crm\sample\availablecurrencies\AvailableCurrencies;
use com\zoho\crm\sample\blueprint\BluePrint;
use com\zoho\crm\sample\bulkread\BulkRead;
use com\zoho\crm\sample\bulkwrite\BulkWrite;
use com\zoho\crm\sample\changeowner\ChangeOwner;
use com\zoho\crm\sample\contactroles\ContactRoles;
use com\zoho\crm\sample\currencies\Currency;
use com\zoho\crm\sample\customview\CustomView;
use com\zoho\crm\sample\fields\Fields;
use com\zoho\crm\sample\file\File;
use com\zoho\crm\sample\layouts\Layout;
use com\zoho\crm\sample\modules\Modules;
use com\zoho\crm\sample\notes\Note;
use com\zoho\crm\sample\organization\Organization;
use com\zoho\crm\sample\profile\Profile;
use com\zoho\crm\sample\record\Record;
use com\zoho\crm\sample\relatedlist\RelatedList;
use com\zoho\crm\sample\relatedrecords\RelatedRecords;
use com\zoho\crm\sample\role\Role;
use com\zoho\crm\sample\scoringrules\ScoringRule;
use com\zoho\crm\sample\sharerecords\ShareRecords;
use com\zoho\crm\sample\tags\Tag;
use com\zoho\crm\sample\taxes\Tax;
use com\zoho\crm\sample\territories\Territory;
use com\zoho\crm\sample\users\User;
use com\zoho\crm\sample\usersunavailability\UsersUnavailability;
use com\zoho\crm\sample\variablegroups\VariableGroup;
use com\zoho\crm\sample\variables\Variable;
use com\zoho\crm\sample\notification\Notification;
use com\zoho\crm\sample\query\Query;
use com\zoho\crm\sample\assignmentrules\AssignmentRules;
use com\zoho\crm\sample\emailtemplates\EmailTemplate;
use com\zoho\crm\sample\fieldattachments\FieldAttachment;
use com\zoho\crm\sample\inventorytemplates\InventoryTemplate;
use com\zoho\crm\sample\pipeline\PipeLine;
use com\zoho\crm\sample\sendmail\SendMail;
use com\zoho\crm\sample\wizards\Wizard;
use com\zoho\crm\sample\dealcontactroles\DealContactRoles;
use com\zoho\crm\sample\emailrelatedrecords\EmailRelatedRecords;
use com\zoho\crm\sample\fieldmapdependency\FieldMapDependency;
use com\zoho\crm\sample\fromaddresses\FromAddresses;
use com\zoho\crm\sample\masschangeowner\MassChangeOwner;
use com\zoho\crm\sample\massconvert\MassConvert;
use com\zoho\crm\sample\massdeletecvid\MassDeleteCvid;
use com\zoho\crm\sample\usergroups\UserGroups;
use com\zoho\crm\sample\usersterritories\UsersTerritories;

class Test
{
    public static function main()
    {
        Initialize::initialize();

		self::AssignmentRules();

        self::Attachment();

		self::AvailableCurrencies();

        self::BluePrint();

        self::BulkRead();

        self::BulkWrite();

		self::ChangeOwner();

        self::ContactRoles();

		self::Currency();

		self::CustomView();

		self::DealContactRoles();

		self::EmailRelatedRecords();

		self::EmailTemplate();

		self::FieldAttachment();

		self::FieldMapDependency();

		self::Field();

		self::File();

		self::FromAddresses();

		self::InventoryTemplate();

		self::Layout();

		self::MassChangeOwner();

		self::MassConvert();

		self::MassDeleteCvid();

		self::Module();

		self::Note();

		self::Notification();

		self::Organization();

		self::PipeLine();

		self::Profile();

		self::Query();

		self::Record();

		self::RelatedList();

		self::RelatedRecords();

		self::Role();

		self::ScoringRule();

		self::SendMail();

		self::ShareRecords();

		self::Tags();

		self::Tax();

		self::Territory();

		self::UserGroups();

		self::User();

		self::UsersTerritories();

		self::UsersUnavailability();

		self::VariableGroup();

		self::Variable();

		self::Wizard();
	}

	public static function AssignmentRules()
	{
		$moduleAPIName = "Leads";

		$ruleId = "34770614353013";

		AssignmentRules::getAssignmentRules($moduleAPIName);

		AssignmentRules::getAssignmentRule($ruleId, $moduleAPIName);
	}

    public static function Attachment()
    {
        $moduleAPIName = "Leads";

        $recordId = "347706111829018";

        $absoluteFilePath = "/usr/download.png";

        $attachmentIds = array("347706116796001", "34770619773001");

        $destinationFolder = "/usr/";

        $attachmentId = "347706116797001";

        $attachmentURL = "https://5.imimg.com/data5/KJ/UP/MY-8655440/zoho-crm-500x500.png";

        Attachment::uploadAttachments($moduleAPIName, $recordId, $absoluteFilePath);

        Attachment::getAttachments($moduleAPIName, $recordId);

        Attachment::deleteAttachments($moduleAPIName, $recordId, $attachmentIds);

        Attachment::downloadAttachment($moduleAPIName, $recordId, $attachmentId, $destinationFolder);

        Attachment::deleteAttachment($moduleAPIName, $recordId, $attachmentId);

        Attachment::uploadLinkAttachments($moduleAPIName, $recordId, $attachmentURL);
    }

	public static function AvailableCurrencies()
	{
		AvailableCurrencies::getAvailableCurrencies();
	}

    public static function BluePrint()
	{
		$moduleAPIName = "Leads";

		$recordId = "347706116634116";

		$transitionId = "347706116801009";

        BluePrint::getBlueprint($moduleAPIName, $recordId);

		BluePrint::updateBlueprint($moduleAPIName, $recordId, $transitionId);
    }

    public static function BulkRead()
    {
        $moduleAPIName = "Leads";

		$jobId = "347706116804001";

		$destinationFolder = "/usr/";

		BulkRead::createBulkReadJob($moduleAPIName);

		BulkRead::getBulkReadJobDetails($jobId);

		BulkRead::downloadResult($jobId, $destinationFolder);
    }

    public static function BulkWrite()
	{
		$absoluteFilePath = "/usr/Leads.zip";

		$orgID = "xxx";

		$moduleAPIName = "Leads";

		$fileId  = "347706116805001";

		$jobID = "347706116804004";

		$downloadUrl = "https://download-accl.zoho.com/v2/crm/xxxx/bulk-write/347706116804004/347706116804004.zip";

		$destinationFolder = "/usr/";

		BulkWrite::uploadFile($orgID, $absoluteFilePath);

		BulkWrite::createBulkWriteJob($moduleAPIName, $fileId);

		BulkWrite::getBulkWriteJobDetails($jobID);

		BulkWrite::downloadBulkWriteResult($downloadUrl, $destinationFolder);
    }

	public static function ChangeOwner()
	{
		ChangeOwner::updateRecordsOwner("Leads");

		ChangeOwner::updateRecordOwner("Leads", "347706114563001");
	}

    public static function ContactRoles()
	{
		$contactRoleId = "347706116499004";

		$contactRoleIds = array("347706116499010","347706116499008","347706116499006","347706111927001");

		ContactRoles::getContactRoles();

		ContactRoles::createContactRoles();

		ContactRoles::updateContactRoles();

		ContactRoles::deleteContactRoles($contactRoleIds);

		ContactRoles::getContactRole($contactRoleId);

		ContactRoles::updateContactRole($contactRoleId);

		ContactRoles::deleteContactRole($contactRoleId);
    }

    public static function Currency()
	{
		$currencyId = "34770616011001";

		Currency::getCurrencies();

		Currency::addCurrencies();

		Currency::updateCurrencies();

		Currency::enableMultipleCurrencies();

		Currency::updateBaseCurrency();

		Currency::getCurrency($currencyId);

		Currency::updateCurrency($currencyId);
	}

	public static function CustomView()
	{
		$moduleAPIName = "Leads";

		$customID = "34770615629003";

		$names = ["Products", "Tasks", "Vendors", "Calls", "Leads", "Deals", "Campaigns", "Quotes", "Invoices", "Attachments", "Price_Books", "Sales_Orders", "Contacts", "Solutions", "Events", "Purchase_Orders", "Accounts", "Cases", "Notes" ];

		foreach($names as $name)
		{
			CustomView::getCustomViews($name);
		}

		CustomView::getCustomViews($moduleAPIName);

		CustomView::getCustomView($moduleAPIName, $customID);
	}

	public static function DealContactRoles()
	{
		$dealId = "347706111299007";
			
		$contactId = "347706114564040";
		
		DealContactRoles::getAllContactRolesOfDeal($dealId);
		
		DealContactRoles::getContactRoleOfDeal($contactId, $dealId);
		
		DealContactRoles::addContactRoleToDeal($contactId, $dealId);
		
		DealContactRoles::removeContactRoleFromDeal($contactId, $dealId);
	}

	public static function EmailRelatedRecords()
	{
		EmailRelatedRecords::getRelatedEmail();
	}

	public static function EmailTemplate()
	{
		$id = "347706179";

		EmailTemplate::getEmailTemplates("Deals");

		EmailTemplate::getEmailTemplateById($id);
	}

	public static function FieldAttachment()
	{
		$destinationFolder = "/usr/";

		FieldAttachment::getFieldAttachments("Leads","347706111613002","347706111613032", $destinationFolder);
	}

	public static function FieldMapDependency()
	{
		$module = "Leads";
		
		$layoutId = "34770610091055";
		
		$dependencyId = "347706116912001";
		
		FieldMapDependency::getMapDependencies($layoutId, $module);
		
		FieldMapDependency::createMapDependency($layoutId, $module);
		
		FieldMapDependency::updateMapDependency($layoutId, $module, $dependencyId);
		
		FieldMapDependency::getMapDependency($layoutId, $module, $dependencyId);
		
		FieldMapDependency::deleteMapDependency($layoutId, $module, $dependencyId);
	}

	public static function Field()
	{
		$moduleAPIName = "Products";

		$fieldId = "34770610769013";

		$names = ["Products", "Tasks", "Vendors", "Calls", "Leads", "Deals", "Campaigns", "Quotes", "Invoices", "Attachments", "Price_Books", "Sales_Orders", "Contacts", "Solutions", "Events", "Purchase_Orders", "Accounts", "Cases", "Notes" ];

		foreach ($names as $name)
		{
			Fields::getFields($name);
		}

		Fields::getFields($moduleAPIName);

		Fields::getField($moduleAPIName, $fieldId);
	}

	public static function File()
	{
		$destinationFolder =  "/usr/";

		$id = "ae9c7cefa418aec1d6a5cc2d9ab35c32e3e18d3d84ba3c289ac51bc61ceb0a37";

		File::uploadFiles();

		File::getFile($id, $destinationFolder);
	}

	public static function FromAddresses()
	{
		FromAddresses::getEmailAddresses();
	}

	public static function InventoryTemplate()
	{
		$id = "34770610174003";

		InventoryTemplate::getInventoryTemplates("Quotes");

		InventoryTemplate::getInventoryTemplateById($id);
	}

	public static function Layout()
	{
		$moduleAPIName = "Leads";

		$layoutId = "34770615902025";

		$names = ["Products", "Tasks", "Vendors", "Calls", "Leads", "Deals", "Campaigns", "Quotes", "Invoices", "Attachments", "Price_Books", "Sales_Orders", "Contacts", "Solutions", "Events", "Purchase_Orders", "Accounts", "Cases", "Notes" ];

		foreach ($names as $name)
		{
			Layout::getLayouts($name);
		}

		Layout::getLayouts($moduleAPIName);

		Layout::getLayout($moduleAPIName, $layoutId);
	}

	public static function MassChangeOwner()
	{
		$moduleAPIName = "DOT";
			
		$jobId = "347706116915008";
		
		MassChangeOwner::changeOwner($moduleAPIName);
		
		MassChangeOwner::checkStatus($jobId, $moduleAPIName);
	}

	public static function MassConvert()
	{
		$jobId = "347706116913016";
			
		MassConvert::massConvert();
		
		MassConvert::getJobStatus($jobId);
	}

	public static function MassDeleteCvid()
	{
		$moduleAPIName = "Leads";

		$jobId = "347706116937001";
		
		MassDeleteCvid::massDeleteByCvid($moduleAPIName);
		
		MassDeleteCvid::getMassDeleteStatus($jobId, $moduleAPIName);
	}

	public static function Module()
	{
		$moduleAPIName = "apiName1";

		$moduleId = "34770613905003";

		Modules::getModules();

		Modules::getModuleByAPIName($moduleAPIName);

		Modules::updateModuleByAPIName($moduleAPIName);
		
		Modules::getModuleById($moduleId);

		Modules::updateModuleById($moduleId);
	}

	public static function Note()
	{
		$notesId = array("347706116941005","347706116941003","347706115121003");

		$noteId = "347706116941004";

		Note::getNotes();

		Note::createNotes();

		Note::updateNotes();

		Note::deleteNotes($notesId);

		Note::getNote($noteId);

		Note::updateNote($noteId);

		Note::deleteNote($noteId);
	}

	public static function Notification()
	{
		$channelIds = array("1006800211");

		Notification::enableNotifications();

		Notification::getNotificationDetails();

		Notification::updateNotifications();

		Notification::updateNotification();

		Notification::disableNotifications($channelIds);

		Notification::disableNotification();
	}

	public static function Organization()
	{
		$absoluteFilePath = "/usr//download.png";

		Organization::getOrganization();

		Organization::uploadOrganizationPhoto($absoluteFilePath);
	}

	public static function PipeLine()
	{
		$layoutId = "34770610091023";

		PipeLine::getPipelines($layoutId);

		PipeLine::createPipelines($layoutId);

		PipeLine::updatePipelines($layoutId);

		PipeLine::getPipeline($layoutId, "34770619482001");

		PipeLine::updatePipeline($layoutId, "34770619482001");

		PipeLine::transferAndDelete($layoutId);
	}

	public static function Profile()
	{
		$profileId = "347706116953001";

		$existingprofileid = "347706116715008";

		Profile::getProfiles();

		Profile::getProfile($profileId);

		Profile::cloneProfiles($profileId);

		Profile::updateProfile($profileId);

		Profile::deleteProfile($profileId, $existingprofileid);
	}

	public static function Query()
	{
		Query::getRecords();
	}

	public static function Record()
	{
		$moduleAPIName = "Leads";

		$recordId = "347706115129003";

		$externalFieldValue = "TestExternal782";

		$destinationFolder = "/usr/";

		$absoluteFilePath = "/usr//download.png";

		$recordIds = array("TestExternal783","34770616606002","34770616603294");

		$jobId = "34770619879007";

		$names = ["Products", "Tasks", "Vendors", "Calls", "Leads", "Deals", "Campaigns", "Quotes",
		"Invoices", "Attachments", "Price_Books", "Sales_Orders", "Contacts", "Solutions", "Events",
		 "Purchase_Orders", "Accounts", "Cases", "Notes"];

		foreach($names as $name)
		{
			Record::getRecords($name);
		}

		Record::getRecord($moduleAPIName, $recordId, $destinationFolder);

		Record::updateRecord($moduleAPIName, $recordId);

		Record::deleteRecord($moduleAPIName, $recordId);

		Record::getRecordUsingExternalId($moduleAPIName, $externalFieldValue, $destinationFolder);

		Record::updateRecordUsingExternalId($moduleAPIName, $externalFieldValue);
		
		Record::deleteRecordUsingExternalId($moduleAPIName, $externalFieldValue);

		Record::getRecords($moduleAPIName);

		Record::createRecords($moduleAPIName);

		Record::updateRecords($moduleAPIName);

		Record::deleteRecords($moduleAPIName, $recordIds);

		Record::upsertRecords($moduleAPIName);

		Record::getDeletedRecords($moduleAPIName);

		Record::searchRecords($moduleAPIName);

		Record::convertLead($recordId);

		Record::uploadPhoto($moduleAPIName, $recordId, $absoluteFilePath);

		Record::getPhoto($moduleAPIName, $recordId, $destinationFolder);

		Record::deletePhoto($moduleAPIName, $recordId);

		Record::massUpdateRecords($moduleAPIName);

		Record::getMassUpdateStatus($moduleAPIName, $jobId);

		Record::getRecordCount();
			
		Record::assignTerritoriesToMultipleRecords($moduleAPIName);
		
		Record::assignTerritoryToRecord($moduleAPIName, $recordId);
					
		Record::removeTerritoriesFromMultipleRecords($moduleAPIName);
					
		Record::removeTerritoriesFromRecord($moduleAPIName, $recordId);

		Record::leadConversionOptions($recordId);
	}

	public static function RelatedList()
	{
		$moduleAPIName = "Leads";

		$relatedListId = "34770616819126";

		$names = ["Products", "Tasks", "Vendors", "Calls", "Leads", "Deals", "Campaigns", "Quotes", "Invoices", "Attachments", "Price_Books", "Sales_Orders", "Contacts", "Solutions", "Events", "Purchase_Orders", "Accounts", "Cases", "Notes" ];

		foreach ($names as $name)
		{
			RelatedList::getRelatedLists($name);
		}

		RelatedList::getRelatedLists($moduleAPIName);

		RelatedList::getRelatedList($moduleAPIName, $relatedListId);
	}

	public static function RelatedRecords()
	{
		$moduleAPIName = "leads";

		$recordId = "347706112109001";

		$relatedListAPIName = "products";

		$relatedRecordId = "347706110697001";

		$relatedListIds = array("AutomatedSDKExternal", "34770615919001");

		$destinationFolder =  "/usr/";

		$externalValue = "TestExternalLead111";

		$externalFieldValue = "Products_External";

		RelatedRecords::getRelatedRecords($moduleAPIName, $recordId, $relatedListAPIName);

		RelatedRecords::updateRelatedRecords($moduleAPIName, $recordId, $relatedListAPIName);

		RelatedRecords::delinkRecords($moduleAPIName, $recordId, $relatedListAPIName, $relatedListIds);

		RelatedRecords::getRelatedRecordsUsingExternalId($moduleAPIName, $externalValue, $relatedListAPIName);
			
		RelatedRecords::updateRelatedRecordsUsingExternalId($moduleAPIName, $externalValue, $relatedListAPIName);
			
		RelatedRecords::deleteRelatedRecordsUsingExternalId($moduleAPIName, $externalValue, $relatedListAPIName, $relatedListIds);

		RelatedRecords::getRelatedRecord($moduleAPIName, $recordId, $relatedListAPIName, $relatedRecordId, $destinationFolder);

		RelatedRecords::updateRelatedRecord($moduleAPIName, $recordId, $relatedListAPIName, $relatedRecordId);

		RelatedRecords::delinkRecord($moduleAPIName, $recordId, $relatedListAPIName, $relatedRecordId);

		RelatedRecords::getRelatedRecordUsingExternalId($moduleAPIName, $externalValue, $relatedListAPIName, $externalFieldValue, $destinationFolder);
			
		RelatedRecords::updateRelatedRecordUsingExternalId($moduleAPIName, $externalValue, $relatedListAPIName, $externalFieldValue);
			
		RelatedRecords::deleteRelatedRecordUsingExternalId($moduleAPIName, $externalValue, $relatedListAPIName, $externalFieldValue);
	}

	public static function Role()
	{
		$roleId = "347706116953007";

		Role::getRoles();

		Role::createRoles();

		Role::updateRoles();

		Role::getRole($roleId);

		Role::updateRole($roleId);

		Role::deleteRole($roleId);
	}

	public static function ScoringRule()
	{
		$id = "347706116948003";

		ScoringRule::getScoringRules();
		
		ScoringRule::getScoringRule($id);
		
		ScoringRule::createScoringRules();
		
		ScoringRule::updateScoringRules($id);
		
		ScoringRule::updateScoringRule($id);
		
		ScoringRule::deleteScoringRules();
		
		ScoringRule::deleteScoringRule($id);
		
		ScoringRule::scoringRuleExecutionUsingLayoutId("Leads");
		
		ScoringRule::scoringRuleExecutionUsingRuleIds("Leads");
		
		ScoringRule::activateScoringRule($id);
		
		ScoringRule::deactivateScoringRule($id);
		
		ScoringRule::cloneScoringRule($id);
		
		ScoringRule::getEntityScoreRecords();
		
		ScoringRule::getEntityScoreRecord("347706115129003", "Leads");
	}

	public static function SendMail()
	{
		SendMail::sendMail("347706112984009","Leads");
	}

	public static function ShareRecords()
	{
		$moduleAPIName = "Leads";

		$recordId = "34770615623115";

		ShareRecords::getSharedRecordDetails($moduleAPIName, $recordId);

		ShareRecords::shareRecord($moduleAPIName, $recordId);

		ShareRecords::updateSharePermissions($moduleAPIName, $recordId);

		ShareRecords::revokeSharedRecord($moduleAPIName, $recordId);
	}

	public static function Tags()
	{
		$moduleAPIName = "Leads";

		$tagId = "347706114924";

		$recordId =  "34770615623115";

		$tagNames = array("addtag1", "addtag12");

		$recordIds = array("34770615623115", "34770616454014");

		$conflictId = "347706112193003";

		Tag::getTags($moduleAPIName);

		Tag::createTags($moduleAPIName);

		Tag::updateTags($moduleAPIName);

		Tag::updateTag($moduleAPIName, $tagId);

		Tag::deleteTag($tagId);

		Tag::mergeTags($tagId, $conflictId);

		Tag::addTagsToRecord($moduleAPIName, $recordId);

		Tag::removeTagsFromRecord($moduleAPIName, $recordId, $tagNames);

		Tag::addTagsToMultipleRecords($moduleAPIName, $recordIds, $tagNames);

		Tag::removeTagsFromMultipleRecords($moduleAPIName, $recordIds, $tagNames);

		Tag::getRecordCountForTag($moduleAPIName, $tagId);
	}

	public static function Tax()
	{
		$taxId = "34770611485";

		Tax::getTaxes();

		Tax::updateTaxes();

		Tax::getTax($taxId);
	}

	public static function Territory()
	{
		$territoryId = "34770613051397";

		Territory::getTerritories();

		Territory::getTerritory($territoryId);
	}

	public static function UserGroups()
	{
		$groupId = "347706116953028";
		
		$jobId = "347706116953028";
		
		UserGroups::getGroups();
		
		UserGroups::createGroup();
		
		UserGroups::getGroup($groupId);
		
		UserGroups::updateGroup($groupId);
		
		UserGroups::deleteGroup($groupId);
		
		UserGroups::getStatus($jobId);
	}

	public static function User()
	{
		$userId = "347706116972001";

		User::getUsers();

		User::createUser();

		User::updateUsers();

		User::getUser($userId);

		User::updateUser($userId);

		User::deleteUser($userId);
	}

	public static function UsersTerritories()
	{
		$userId = "34770615791024";

		$territoryId = '34770613051397';

		UsersTerritories::getTerritoriesOfUser($userId);
			
		UsersTerritories::associateTerritoriesToUser($userId);
		
		UsersTerritories::getSpecificTerritoryOfUser($userId, $territoryId);
		
		UsersTerritories::validateBeforeTransferForAllTerritories($userId);
		
		UsersTerritories::validateBeforeTransfer($userId, $territoryId);
		
		UsersTerritories::delinkAndTransferFromAllTerritories($userId);
		
		UsersTerritories::delinkAndTransferFromSpecificTerritory($userId, $territoryId);
	}

	public static function UsersUnavailability()
	{
		$userId = "347706115179001";
			
		$id = "347706116973";

		UsersUnavailability::getUsersUnavailabilites();
		
		UsersUnavailability::getUsersUnavailability($userId);
		
		UsersUnavailability::createUsersUnavailability();
		
		UsersUnavailability::updateUsersUnavailabilites();
		
		UsersUnavailability::updateUsersUnavailability($id);
		
		UsersUnavailability::deleteUsersUnavailabilityHour($id);
	}

	public static function VariableGroup()
	{
		$variableGroupName = "General";

		$variableGroupId = "34770613089001";

		VariableGroup::getVariableGroups();

		VariableGroup::getVariableGroupById($variableGroupId);

		VariableGroup::getVariableGroupByAPIName($variableGroupName);
	}

	public static function Variable()
	{
		$variableIds = array("347706116957026","347706116957028");

		$variableId = "347706110178013";

		$variableName = "Variable551";

		Variable::getVariables();

		Variable::createVariables();

		Variable::updateVariables();

		Variable::deleteVariables($variableIds);

		Variable::getVariableById($variableId);

		Variable::updateVariableById($variableId);

		Variable::deleteVariable($variableId);

		Variable::getVariableForAPIName($variableName);

		Variable::updateVariableByAPIName($variableName);
	}

	public static function Wizard()
	{
		$wizardId = "34770619497009";

		Wizard::getWizards();

		Wizard::getWizardById($wizardId, "34770610091055");
	}
}

Test::main();
?>