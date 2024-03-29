<?php
namespace record;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\UserSignature;
use com\zoho\crm\api\HeaderMap;
use com\zoho\crm\api\record\APIException;
use com\zoho\crm\api\record\ActionWrapper;
use com\zoho\crm\api\record\BodyWrapper;
use com\zoho\crm\api\record\FileDetails;
use com\zoho\crm\api\record\LineItemProduct;
use com\zoho\crm\api\record\LineTax;
use com\zoho\crm\api\record\RecordOperations;
use com\zoho\crm\api\record\SuccessResponse;
use com\zoho\crm\api\tags\Tag;
use com\zoho\crm\api\record\{Cases, Field, Solutions, Accounts, Campaigns, Calls, Leads, Tasks, Deals, Sales_Orders, Contacts, Quotes, Events, Price_Books, Purchase_Orders, Vendors};
use com\zoho\crm\api\record\Consent;
use com\zoho\crm\api\users\MinifiedUser;
use com\zoho\crm\api\record\UpdateRecordHeader;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class UpdateRecordUsingExternalId
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
    /**
     * <h3> UpdateRecordUsingExternalId</h3>
     * This method is used to update a single record of a module with ID and print the response.
     * @param moduleAPIName - The API Name of the record's module.
     * @param externalFieldValue - The ID of the record to be obtained.
     * @throws Exception
     */
    public static function updateRecordUsingExternalId(string $moduleAPIName, string $externalFieldValue)
    {
        //API Name of the module to update record
        //$moduleAPIName = "module_api_name";
        //$recordId = "3477002";
        $recordOperations = new RecordOperations();
        $request = new BodyWrapper();
        //List of Record instances
        $records = array();
        $recordClass = 'com\zoho\crm\api\record\Record';
        $record1 = new $recordClass();
        /*
         * Call addFieldValue method that takes two arguments
         * 1 -> Call Field "." and choose the module from the displayed list and press "." and choose the field name from the displayed list.
         * 2 -> Value
        */
        $record1->addFieldValue(Leads::City(), "City");
        $record1->addFieldValue(Leads::LastName(), "Last Name");
        $record1->addFieldValue(Leads::FirstName(), "First Name");
        $record1->addFieldValue(Leads::Company(), "KKRNP");
        // $accounts = new $recordClass();
        // $accounts->addKeyValue("id", "3477061000005848009");
        // $record1->addFieldValue(Contacts::AccountName(), $accounts);
        /*
         * Call addKeyValue method that takes two arguments
         * 1 -> A string that is the Field's API Name
         * 2 -> Value
         */
        $record1->addKeyValue("Custom_field", "Value");
        $record1->addKeyValue("Custom_field_2", "value");
        $record1->addKeyValue("Date_1", new \DateTime('2020-03-08'));
        $record1->addKeyValue("Date_Time_2", date_create("2021-06-02T11:03:06+05:30")->setTimezone(new \DateTimeZone(date_default_timezone_get())));
        $fileDetails = array();
        $fileDetail1 = new FileDetails();
        $fileDetail1->setAttachmentId("347005");
        $fileDetail1->setDelete("null");
        array_push($fileDetails, $fileDetail1);
        $fileDetail2 = new FileDetails();
        $fileDetail2->setFileId("ae9c7cefa418aec1d6a5cc2d9ab35c32244f4e660f3702f05463e2fd0a2d8c1c");
        array_push($fileDetails, $fileDetail2);
        $fileDetail3 = new FileDetails();
        $fileDetail3->setFileId("ae9c7cefa418aec1d6a5cc2d9ab35c326a3f4c7562925ac9afc0f7433dd2098c");
        array_push($fileDetails, $fileDetail3);
        $record1->addKeyValue("File_Upload", $fileDetails);
        $recordOwner = new MinifiedUser();
        $recordOwner->setEmail("abc@zoho.com");
        $record1->addKeyValue("Owner", $recordOwner);
        //Used when GDPR is enabled
        $dataConsent = new Consent();
        $dataConsent->setConsentRemarks("Approved.");
        $dataConsent->setConsentThrough("Email");
        $dataConsent->setContactThroughEmail(true);
        $dataConsent->setContactThroughSocial(false);
        $record1->addKeyValue("Data_Processing_Basis_Details", $dataConsent);
        $subformList = [];
        $subform = new $recordClass();
        $subform->addKeyValue("Subform FieldAPIName", "FieldValue");
        array_push($subformList, $subform);
        $record1->addKeyValue("Subform Name", $subformList);
        /** Following methods are being used only by Inventory modules */
        $dealName = new $recordClass();
        $dealName->addFieldValue(Deals::id(), "3477061000012112003");
        $record1->addFieldValue(Sales_Orders::DealName(), $dealName);
        $contactName = new $recordClass();
        $contactName->addFieldValue(Contacts::id(), "3477061000011853001");
        $record1->addFieldValue(Purchase_Orders::ContactName(), $contactName);
        $accountName = new $recordClass();
        $accountName->addKeyValue("name", "automatedAccount");
        $record1->addFieldValue(Quotes::AccountName(), $accountName);
        $record1->addKeyValue("Discount", 10.5);
        $inventoryLineItemList = [];
        $inventoryLineItem = new $recordClass();
        $lineItemProduct = new LineItemProduct();
        $lineItemProduct->setId("3477061000012107031");
        // $lineItemProduct->addKeyValue("Products_External", "AutomatedSDKExternal");
        $inventoryLineItem->addKeyValue("Description", "asd");
        $inventoryLineItem->addKeyValue("Discount", "5");
        $parentId = new $recordClass();
        $parentId->setId("3524033000007331017");
        //		inventoryLineItem->addKeyValue("Parent_Id", 5);
        $inventoryLineItem->addKeyValue("Sequence_Number", "1");
        $lineitemProduct = new LineItemProduct();
        $lineitemProduct->setId("3524033000003659082");
        $inventoryLineItem->addKeyValue("Product_Name", $lineItemProduct);
        $inventoryLineItem->addKeyValue("Sequence_Number", "1");
        $inventoryLineItem->addKeyValue("Quantity", 123.2);
        $inventoryLineItem->addKeyValue("Tax", 123.2);
        array_push($inventoryLineItemList, $inventoryLineItem);
        $productLineTaxes = [];
        $productLineTax = new LineTax();
        $productLineTax->setName("MyT2ax1134");
        $productLineTax->setPercentage(20.0);
        array_push($productLineTaxes, $productLineTax);
        $inventoryLineItem->addKeyValue("Line_Tax", $productLineTaxes);
        array_push($inventoryLineItemList, $inventoryLineItem);
        $record1->addKeyValue("Quoted_Items", $inventoryLineItemList);
        $lineTaxes = [];
        $lineTax = new LineTax();
        $lineTax->setName("MyT2ax1134");
        $lineTax->setPercentage(20.0);
        array_push($lineTaxes, $lineTax);
        $record1->addKeyValue('$line_tax', $lineTaxes);
        /** End Inventory **/
        $tagList = [];
        $tag = new Tag();
        $tag->setName("Testtask1");
        array_push($tagList, $tag);
        $record1->setTag($tagList);
        //Add Record instance to the list
        array_push($records, $record1);
        $request->setData($records);
        $trigger = array("approval", "workflow", "blueprint");
        $request->setTrigger($trigger);
        $headerInstance = new HeaderMap();
        $headerInstance->add(UpdateRecordHeader::XEXTERNAL(), "Quotes.Quoted_Items.Product_Name.Products_External");
        //Call updateRecordUsingExternalId method that takes externalFieldValue, ModuleAPIName, BodyWrapper instance and headerInstance as parameter.
        $response = $recordOperations->updateRecordUsingExternalId($externalFieldValue, $moduleAPIName, $request, $headerInstance);
        if ($response != null) {
            echo ("Status Code: " . $response->getStatusCode() . "\n");
            if ($response->isExpected()) {
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
$moduleAPIName = "module_api_name";
$extenalFieldValue= "external";
UpdateRecordUsingExternalId::initialize();
UpdateRecordUsingExternalId::updateRecordUsingExternalId($moduleAPIName,$extenalFieldValue);
