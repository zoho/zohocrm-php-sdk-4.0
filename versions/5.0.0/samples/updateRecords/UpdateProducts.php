<?php
namespace updateRecords;

use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\HeaderMap;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\record\ActionWrapper;
use com\zoho\crm\api\record\APIException;
use com\zoho\crm\api\record\BodyWrapper;
use com\zoho\crm\api\record\Consent;
use com\zoho\crm\api\record\FileDetails;
use com\zoho\crm\api\record\Products;
use com\zoho\crm\api\record\Record;
use com\zoho\crm\api\record\RecordOperations;
use com\zoho\crm\api\record\SuccessResponse;
use com\zoho\crm\api\tags\Tag;
use com\zoho\crm\api\taxes\Tax;
use com\zoho\crm\api\users\MinifiedUser;
use com\zoho\crm\api\util\Choice;
require "vendor/autoload.php";
class UpdateProducts
{
    /**
     * @throws SDKException
     */
    public static function initialize()
    {
        $environment = USDataCenter::PRODUCTION();
        $token = (new OAuthBuilder())
            ->clientId("1000.xxxx")
            ->clientSecret("xxxxxx")
            ->refreshToken("1000.xxxxx.xxxxx")
            ->build();
        (new InitializeBuilder())
            ->environment($environment)
            ->token($token)
            ->initialize();
    }
    public static function updateProducts(String $moduleAPIName)
    {
        $recordOperations = new RecordOperations();
        $bodyWrapper = new BodyWrapper();
        $records = array();
        $recordClass = 'com\zoho\crm\api\record\Record';
        $record1 = new $recordClass();
        $record1->setId("3240323213");
        $record1->addFieldValue(Products::ProductName(), 'new Product');
        $record1->addFieldValue(Products::ProductCode(), 'Code123');
        $record1->addFieldValue(Products::ProductActive(), new Choice(true));
        $vendorName = new Record();
        $vendorName->setId("3000232340342");
        $record1->addFieldValue(Products::VendorName(), $vendorName);
        $record1->addFieldValue(Products::ProductCategory(), new Choice("Hardware"));
        $record1->addFieldValue(Products::Manufacturer(), new Choice("LexPon Inc."));
        $record1->addFieldValue(Products::SalesStartDate(), new \DateTime("2023:08:10"));
        $record1->addFieldValue(Products::SalesEndDate(), new \DateTime("2023:08:10"));
        $record1->addFieldValue(Products::SupportStartDate(), new \DateTime("2023:08:10"));
        $record1->addFieldValue(Products::SupportExpiryDate(), new \DateTime("2023:08:10"));
//         Price Info
        $record1->addFieldValue(Products::UnitPrice(), 100.1);
        $record1->addFieldValue(Products::CommissionRate(), 12.0);
        $taxes = array();
        $line_tax = new \com\zoho\crm\api\record\Tax();
        $line_tax->setId("440240020807");
        $line_tax->setValue(10.0);
        array_push($taxes, $line_tax);
        $record1->addFieldValue(Products::Tax(), $taxes);
        $record1->addFieldValue(Products::Taxable(), new Choice(true));
        // Stock info
        $record1->addFieldValue(Products::UsageUnit(), new Choice("Box"));
        $record1->addFieldValue(Products::QtyOrdered(), 100);
        $record1->addFieldValue(Products::QtyInDemand(), 120);
        $record1->addFieldValue(Products::ReorderLevel(), '');
        $handler = new MinifiedUser();
        $handler->setId("34434034434");
        $record1->addFieldValue(Products::Handler(), $handler);
        $record1->addFieldValue(Products::QtyInStock(), 200);
        //
        $record1->addFieldValue(Products::Description(), 'description');
        // used when GDPR is enabled
        $dataConsent = new Consent();
        $dataConsent->setConsentRemarks("Approved");
        $dataConsent->setConsentThrough("Email");
        $dataConsent->setContactThroughEmail(true);
        $dataConsent->setContactThroughSocial(false);
        $dataConsent->setContactThroughPhone(true);
        $dataConsent->setContactThroughSurvey(true);
        $dataConsent->setConsentDate(new \DateTime('2023-10-10'));
        $dataConsent->setDataProcessingBasis("Obtained");
        $record1->addKeyValue("Data_Processing_Basis_Details", $dataConsent);
        // for custom Fields
        $record1->addKeyValue("External", "Value12445");
        $record1->addKeyValue("Custom_Field", "custom_value");
        $record1->addKeyValue("Date_Time_1", date_create("2020-06-02T11:03:06+05:30")->setTimezone(new \DateTimeZone(date_default_timezone_get())));
        $record1->addKeyValue("Date_1", new \DateTime('2021-12-10'));
        $record1->addKeyValue("Subject", "AutomatedSDK");
        $record1->addKeyValue("Product_Name", "Automated");
        $fileDetails = array();
        $fileDetail1 = new FileDetails();
        $fileDetail1->setFileId("ae9c7cefa418aec1d6a532a6ae23d729ad87c6d90b0bd44183d280");
        array_push($fileDetails,$fileDetail1);
        $fileDetail2 = new FileDetails();
        $fileDetail2->setFileId("ae9c7cefa418aec1d6a532a6ae23d729ad87c6d90b0bd44183d2de");
        array_push($fileDetails,$fileDetail2);
        $record1->addKeyValue("File_Upload", $fileDetails);
        // for Custom User LookUp
        $user = new MinifiedUser();
        $user->setId("422222223123");
        $record1->addKeyValue("User_1", $user);
        // for Custom LookUp
        $data = new Record();
        $data->setId("4234444342123");
        $record1->addKeyValue("Lookup_1", $data);
        // for Custom PickList
        $record1->addKeyValue("Pick", new Choice("true"));
        // for Custom MultiSelect
        $record1->addKeyValue("MultiSelect", array(new Choice("Option 1"), new Choice("Option 2")));
        // for Subform
        $subformList = array();
        $subform = new Record();
        $subform->addKeyValue("CustomField", "customValue");
        $user1 = new MinifiedUser();
        $user1->setId("430332334334343");
        $subform->addKeyValue("UserField", $user1);
        array_push($subformList, $subform);
        $record1->addKeyValue("Subform_1", $subformList);
        // for MultiSelectLookUp/Custom MultiSelectLookup
        $multiselectList = array();
        $record = new Record();
        $record->addKeyValue("id", "44024884001");
        $linkingRecord = new Record();
        $linkingRecord->addKeyValue("Msl", $record);
        array_push($multiselectList,$linkingRecord);
        $record1->addKeyValue("Msl", $multiselectList);

        $tagList = array();
        $tag = new Tag();
        $tag->setName("Testtask");
        array_push($tagList, $tag);
        $record1->setTag($tagList);

        // can add update another record with same above mention fields
        $record2 = new Record();
        $record2->setId("34504312324334");
        //
        //Add Record instance to the list
        array_push($records, $record1);
        $bodyWrapper->setData($records);
        $trigger = array("approval", "workflow", "blueprint");
        $bodyWrapper->setTrigger($trigger);
        $bodyWrapper->setLarId("34770610087515");

        $headerInstance = new HeaderMap();
        // $headerInstance->add(CreateRecordsHeader::XEXTERNAL(), "Quotes.Quoted_Items.Product_Name.Products_External");
        // $headerInstance->add(CreateRecordsHeader::XEXTERNAL(), "Products.Products_External");
        //Call createRecords method that takes BodyWrapper instance as parameter.
        $response = $recordOperations->updateRecords($moduleAPIName, $bodyWrapper, $headerInstance);
        if ($response != null) {
            //Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");
            if ($response->isExpected()) {
                //Get object from response
                $actionHandler = $response->getObject();
                if ($actionHandler instanceof ActionWrapper) {
                    $actionWrapper = $actionHandler;
                    $actionResponses = $actionWrapper->getData();
                    foreach ($actionResponses as $actionResponse) {
                        if ($actionResponse instanceof SuccessResponse) {
                            $successResponse = $actionResponse;
                            echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                            echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                            echo ("Details: ");
                            foreach ($successResponse->getDetails() as $key => $value) {
                                echo ($key . " : ");
                                print_r($value);
                                echo ("\n");
                            }
                            echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
                        }
                        else if ($actionResponse instanceof APIException) {
                            $exception = $actionResponse;
                            echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                            echo ("Code: " . $exception->getCode()->getValue() . "\n");
                            echo ("Details: ");
                            foreach ($exception->getDetails() as $key => $value) {
                                echo ($key . " : " . $value . "\n");
                            }
                            echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                        }
                    }
                }
                else if ($actionHandler instanceof APIException) {
                    $exception = $actionHandler;
                    echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo ("Code: " . $exception->getCode()->getValue() . "\n");
                    echo ("Details: ");
                    foreach ($exception->getDetails() as $key => $value) {
                        echo ($key . " : " . $value . "\n");
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                }
            } else {
                print_r($response);
            }
        }
    }
}
$moduleAPIName = "Products";
UpdateProducts::initialize();
UpdateProducts::updateProducts($moduleAPIName);