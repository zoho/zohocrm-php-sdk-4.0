<?php

namespace createRecords;

use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\HeaderMap;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\record\Accounts;
use com\zoho\crm\api\record\ActionWrapper;
use com\zoho\crm\api\record\APIException;
use com\zoho\crm\api\record\BodyWrapper;
use com\zoho\crm\api\record\Consent;
use com\zoho\crm\api\record\FileDetails;
use com\zoho\crm\api\record\LineItemProduct;
use com\zoho\crm\api\record\LineTax;
use com\zoho\crm\api\record\Quotes;
use com\zoho\crm\api\record\Record;
use com\zoho\crm\api\record\RecordOperations;
use com\zoho\crm\api\record\SuccessResponse;
use com\zoho\crm\api\tags\Tag;
use com\zoho\crm\api\users\MinifiedUser;
use com\zoho\crm\api\util\Choice;
require "vendor/autoload.php";

class CreateQuotes
{
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
    public static function createQuotes($moduleAPIName)
    {
        $recordOperations = new RecordOperations();
        $bodyWrapper = new BodyWrapper();
        $records = array();
        $recordClass = 'com\zoho\crm\api\record\Record';
        $record1 = new $recordClass();
        $accountName = new Record();
        $accountName->addFieldValue(Accounts::id(), "440248000001179025");
        $record1->addFieldValue(Quotes::AccountName(), $accountName);
        $record1->addFieldValue(Quotes::Subject(), "new Quote");
        $record1->addFieldValue(Quotes::Adjustment(), 10.0);
        $record1->addFieldValue(Quotes::ValidTill(), new \DateTime('2023-09-19'));
        $record1->addFieldValue(Quotes::Team(), "teamName");
        $record1->addFieldValue(Quotes::TermsAndConditions(), "details of terms and Conditions");
        $record1->addFieldValue(Quotes::Description(), "description");
        $dealName = new Record();
        $dealName->setId("3400000034234034");
        $record1->addFieldValue(Quotes::DealName(), $dealName);
        $contactName = new Record();
        $contactName->setId("345000003423434");
        $record1->addFieldValue(Quotes::ContactName(), $contactName);
        $record1->addFieldValue(Quotes::QuoteStage(), new Choice("Draft"));
        $record1->addFieldValue(Quotes::Carrier(), new Choice("FedEX"));
        $inventoryLineItemList = array();
        $inventoryLineItem = new Record();
        $lineItemProduct = new LineItemProduct();
        $lineItemProduct->setId("440248000000954344");
        $inventoryLineItem->addKeyValue("Description", "asd");
        $inventoryLineItem->addKeyValue("Discount", "5");
        $inventoryLineItem->addKeyValue("Quantity", 10.0);
        $inventoryLineItem->addKeyValue("List_Price", 100.0);
        $inventoryLineItem->addKeyValue("Product_Name", $lineItemProduct);
//        $inventoryLineItem->addKeyValue("Product_Category_1", "hardware");
        $productLineTaxes = array();
        $productLineTax = new LineTax();
        $productLineTax->setName("Vat");
        $productLineTax->setValue(10.0);
        $productLineTax->setId("440248000000020810");
        $productLineTax->setPercentage(10.0);
        array_push($productLineTaxes, $productLineTax);
        $inventoryLineItem->addKeyValue("Line_Tax", $productLineTaxes);
        array_push($inventoryLineItemList, $inventoryLineItem);
        $record1->addFieldValue(Quotes::QuotedItems(), $inventoryLineItemList);
        $lineTaxes = array();
        $lineTax = new LineTax();
        $lineTax->setName("MyTax1123");
        $lineTax->setPercentage(20.0);
        array_push($lineTaxes, $lineTax);
        $record1->addKeyValue('$line_tax', $lineTaxes);
        // Address info
        $record1->addFieldValue(Quotes::BillingCity(), "city");
        $record1->addFieldValue(Quotes::BillingState(), "state");
        $record1->addFieldValue(Quotes::BillingCountry(), "country");
        $record1->addFieldValue(Quotes::BillingCode(), "code");
        $record1->addFieldValue(Quotes::BillingStreet(), "street");
        $record1->addFieldValue(Quotes::ShippingState(), "state");
        $record1->addFieldValue(Quotes::ShippingCity(), "city");
        $record1->addFieldValue(Quotes::ShippingCountry(), "country");
        $record1->addFieldValue(Quotes::ShippingStreet(), "street");
        $record1->addFieldValue(Quotes::ShippingCode(), "code");
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
        $fileDetail1->setFileId("ae9c7cefa418aec1d6a5cc2d9ab35c32a6ae23d729ad87c6d90b0bd44183d280");
        array_push($fileDetails, $fileDetail1);
        $fileDetail2 = new FileDetails();
        $fileDetail2->setFileId("ae9c7cefa418aec1d6a5cc2d9ab35c32a6ae23d729ad87c6d90b0bd44183d2de");
        array_push($fileDetails, $fileDetail2);
        $record1->addKeyValue("File_Upload", $fileDetails);
        // for Custom User LookUp
        $user = new MinifiedUser();
        $user->setId("4222222222222323123");
        $record1->addKeyValue("User_1", $user);
        // for Custom LookUp
        $data = new Record();
        $data->setId("4232434444444342123");
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
        $user1->setId("430300000032334334343");
        $subform->addKeyValue("UserField", $user1);
        array_push($subformList, $subform);
        $record1->addKeyValue("Subform_1", $subformList);
        // for MultiSelectLookUp/Custom MultiSelectLookup
        $multiselectList = array();
        $record = new Record();
        $record->addKeyValue("id", "440248000000884001");
        $linkingRecord = new Record();
        $linkingRecord->addKeyValue("Msl", $record);
        array_push($multiselectList, $linkingRecord);
        $record1->addKeyValue("Msl", $multiselectList);
        //
        $tagList = array();
        $tag = new Tag();
        $tag->setName("Testtask");
        array_push($tagList, $tag);
        $record1->setTag($tagList);
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
        $response = $recordOperations->createRecords($moduleAPIName, $bodyWrapper, $headerInstance);
        if ($response != null) {
            //Get the status code from response
            echo("Status Code: " . $response->getStatusCode() . "\n");
            if ($response->isExpected()) {
                //Get object from response
                $actionHandler = $response->getObject();
                if ($actionHandler instanceof ActionWrapper) {
                    $actionWrapper = $actionHandler;
                    $actionResponses = $actionWrapper->getData();
                    foreach ($actionResponses as $actionResponse) {
                        if ($actionResponse instanceof SuccessResponse) {
                            $successResponse = $actionResponse;
                            echo("Status: " . $successResponse->getStatus()->getValue() . "\n");
                            echo("Code: " . $successResponse->getCode()->getValue() . "\n");
                            echo("Details: ");
                            foreach ($successResponse->getDetails() as $key => $value) {
                                echo($key . " : ");
                                print_r($value);
                                echo("\n");
                            }
                            echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
                        } else if ($actionResponse instanceof APIException) {
                            $exception = $actionResponse;
                            echo("Status: " . $exception->getStatus()->getValue() . "\n");
                            echo("Code: " . $exception->getCode()->getValue() . "\n");
                            echo("Details: ");
                            foreach ($exception->getDetails() as $key => $value) {
                                echo($key . " : " . $value . "\n");
                            }
                            echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                        }
                    }
                } else if ($actionHandler instanceof APIException) {
                    $exception = $actionHandler;
                    echo("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo("Code: " . $exception->getCode()->getValue() . "\n");
                    echo("Details: ");
                    foreach ($exception->getDetails() as $key => $value) {
                        echo($key . " : " . $value . "\n");
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                }
            } else {
                print_r($response);
            }
        }
    }
}
$moduleAPIName = "Quotes";
CreateQuotes::initialize();
CreateQuotes::createQuotes($moduleAPIName);