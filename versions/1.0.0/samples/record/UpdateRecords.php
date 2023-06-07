<?php
namespace record;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\HeaderMap;
use com\zoho\crm\api\record\APIException;
use com\zoho\crm\api\record\ActionWrapper;
use com\zoho\crm\api\record\BodyWrapper;
use com\zoho\crm\api\record\LineItemProduct;
use com\zoho\crm\api\record\LineTax;
use com\zoho\crm\api\record\RecordOperations;
use com\zoho\crm\api\record\SuccessResponse;
use com\zoho\crm\api\record\{Cases, Field, Solutions, Accounts, Campaigns, Calls, Leads, Tasks, Deals, Sales_Orders, Contacts, Quotes, Events, Price_Books, Purchase_Orders, Vendors};
use com\zoho\crm\api\users\MinifiedUser;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class UpdateRecords
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
     * <h3> Update Records</h3>
     * This method is used to update records of a module and print the response.
     * @param moduleAPIName - The API Name of the module to obtain records.
     * @throws Exception
     */
    public static function updateRecords(string $moduleAPIName)
    {
        //API Name of the module to create records
        //$moduleAPIName = "module_api_name";
        $recordOperations = new RecordOperations();
        $request = new BodyWrapper();
        //List of Record instances
        $records = array();
        $recordClass = 'com\zoho\crm\api\record\Record';
        $record1 = new $recordClass();
        $record1->setId("3477061000012260006");
        /*
         * Call addFieldValue method that takes two arguments
         * 1 -> Call Field "." and choose the module from the displayed list and press "." and choose the field name from the displayed list.
         * 2 -> Value
         */
        $record1->addFieldValue(Leads::City(), "City");
        $record1->addFieldValue(Leads::LastName(), "Last Name");
        $record1->addFieldValue(Leads::FirstName(), "First Name");
        $record1->addFieldValue(Leads::Company(), "KKRNP");
        /*
         * Call addKeyValue method that takes two arguments
         * 1 -> A string that is the Field's API Name
         * 2 -> Value
         */
        $record1->addKeyValue("Custom_field", "Value");
        $record1->addKeyValue("Custom_field_2", "value");
        $recordOwner = new MinifiedUser();
        $recordOwner->setEmail("raja.k@zohocorp.com");
        $record1->addKeyValue("Owner", $recordOwner);
        /** Following methods are being used only by Inventory modules */
        $vendorName = new $recordClass();
        $vendorName->addFieldValue(Vendors::id(), "3477061000007247001");
        $record1->addFieldValue(Purchase_Orders::VendorName(), $vendorName);
        $dealName = new $recordClass();
        $dealName->addFieldValue(Deals::id(), "3477061000012112003");
        $record1->addFieldValue(Sales_Orders::DealName(), $dealName);
        $contactName = new $recordClass();
        $contactName->addFieldValue(Contacts::id(), "3477061000011383004");
        $record1->addFieldValue(Purchase_Orders::ContactName(), $contactName);
        $accountName = new $recordClass();
        $accountName->addKeyValue("name", "automatedAccount");
        $record1->addFieldValue(Quotes::AccountName(), $accountName);
        $record1->addKeyValue("Discount", 10.5);
        $inventoryLineItemList = array();
        $inventoryLineItem = new $recordClass();
        $lineItemProduct = new LineItemProduct();
        // $lineItemProduct->setId("3477061000012260001");
        $lineItemProduct->addKeyValue("Products_External", "Products_External");
        $inventoryLineItem->addKeyValue("Product_Name", $lineItemProduct);
        $inventoryLineItem->addKeyValue("Quantity", 1.5);
        $inventoryLineItem->addKeyValue("Description", "productDescription");
        $inventoryLineItem->addKeyValue("ListPrice", 10.0);
        $inventoryLineItem->addKeyValue("Discount", "5%");
        $productLineTaxes = array();
        $productLineTax = new LineTax();
        $productLineTax->setName("MyTax1123");
        $productLineTax->setPercentage(20.0);
        array_push($productLineTaxes, $productLineTax);
        $inventoryLineItem->addKeyValue("Line_Tax", $productLineTaxes);
        array_push($inventoryLineItemList, $inventoryLineItem);
        $record1->addKeyValue("Quoted_Items", $inventoryLineItemList);
        $record1->addKeyValue("Invoiced_Items", $inventoryLineItemList);
        $record1->addKeyValue("Purchase_Items", $inventoryLineItemList);
        $record1->addKeyValue("Ordered_Items", $inventoryLineItemList);
        $lineTaxes = array();
        $lineTax = new LineTax();
        $lineTax->setName("MyTax1123");
        $lineTax->setPercentage(20.0);
        array_push($lineTaxes, $lineTax);
        $record1->addKeyValue('$line_tax', $lineTaxes);
        /** End Inventory **/
        //Add Record instance to the list
        array_push($records, $record1);
        $record2 = new $recordClass();
        $record2->setId("34770619873001");
        /*
         * Call addFieldValue method that takes two arguments
         * 1 -> Call Field "." and choose the module from the displayed list and press "." and choose the field name from the displayed list.
         * 2 -> Value
         */
        $record2->addFieldValue(Leads::City(), "City");
        $record2->addFieldValue(Leads::LastName(), "Last Name");
        $record2->addFieldValue(Leads::FirstName(), "First Name");
        $record2->addFieldValue(Leads::Company(), "KKRNP");
        /*
         * Call addKeyValue method that takes two arguments
         * 1 -> A string that is the Field's API Name
         * 2 -> Value
         */
        $record2->addKeyValue("Custom_field", "Value");
        $record2->addKeyValue("Custom_field_2", "value");
        //Add Record instance to the list
        array_push($records, $record2);
        $request->setData($records);
        $trigger = array("approval", "workflow", "blueprint");
        $request->setTrigger($trigger);
        $headerInstance = new HeaderMap();
        // $headerInstance->add(CreateRecordsHeader::XEXTERNAL(), "Quotes.Quoted_Items.Product_Name.Products_External");
        //Call createRecords method that takes moduleAPIName, BodyWrapper instance and $headerInstance as parameter.
        $response = $recordOperations->updateRecords($moduleAPIName, $request, $headerInstance);
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
$moduleAPIName = "leads";
UpdateRecords::initialize();
UpdateRecords::updateRecords($moduleAPIName);
