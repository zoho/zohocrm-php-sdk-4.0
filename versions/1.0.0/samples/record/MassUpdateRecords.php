<?php
namespace record;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\UserSignature;
use com\zoho\crm\api\record\APIException;
use com\zoho\crm\api\record\MassUpdateActionWrapper;
use com\zoho\crm\api\record\MassUpdateBodyWrapper;
use com\zoho\crm\api\record\MassUpdateSuccessResponse;
use com\zoho\crm\api\record\RecordOperations;
use com\zoho\crm\api\record\{Cases, Field, Solutions, Accounts, Campaigns, Calls, Leads, Tasks, Deals, Sales_Orders, Contacts, Quotes, Events, Price_Books, Purchase_Orders, Vendors};
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class MassUpdateRecords
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
     * This method is used to update the values of specific fields for multiple records and print the response.
     * @param moduleAPIName - The API Name of the module to obtain records.
     * @throws Exception
     */
    public static function massUpdateRecords(string $moduleAPIName)
    {
        //API Name of the module to massUpdateRecords
        //$moduleAPIName = "module_api_name";
        $recordOperations = new RecordOperations();
        $request = new MassUpdateBodyWrapper();
        //List of Record instances
        $records = array();
        $recordClass = 'com\zoho\crm\api\record\Record';
        $record1 = new $recordClass();
        /*
         * Call addKeyValue method that takes two arguments
         * 1 -> A string that is the Field's API Name
         * 2 -> Value
         */
        $record1->addKeyValue("City", "Value");
        //Add Record instance to the list
        array_push($records, $record1);
        $request->setData($records);
        // $request->setCvid("34770610087501");
        $ids = array("3477061000016940025");
        $request->setIds($ids);
        // $territory = new Territory();
        // $territory->setId("34770613051357");
        // $territory->setIncludeChild(true);
        // $request->setTerritory($territory);
        $request->setOverWrite(true);
        //Call massUpdateRecords method that takes BodyWrapper instance, ModuleAPIName as parameter.
        $response = $recordOperations->massUpdateRecords($moduleAPIName, $request);
        if ($response != null) {
            echo ("Status Code: " . $response->getStatusCode() . "\n");
            if ($response->isExpected()) {
                $massUpdateActionHandler = $response->getObject();
                if ($massUpdateActionHandler instanceof MassUpdateActionWrapper) {
                    $massUpdateActionWrapper = $massUpdateActionHandler;
                    $massUpdateActionResponses = $massUpdateActionWrapper->getData();
                    foreach ($massUpdateActionResponses as $massUpdateActionResponse) {
                        if ($massUpdateActionResponse instanceof MassUpdateSuccessResponse) {
                            $massUpdateSuccessResponse = $massUpdateActionResponse;
                            echo ("Status: " . $massUpdateSuccessResponse->getStatus()->getValue() . "\n");
                            echo ("Code: " . $massUpdateSuccessResponse->getCode()->getValue() . "\n");
                            if ($massUpdateSuccessResponse->getDetails() != null) {
                                echo ("Details: ");
                                foreach ($massUpdateSuccessResponse->getDetails() as $keyName => $keyValue) {
                                    echo ($keyName . ": ");
                                    print_r($keyValue);
                                    echo ("\n");
                                }
                            }
                            echo ("Message: " . ($massUpdateSuccessResponse->getMessage() instanceof Choice ? $massUpdateSuccessResponse->getMessage()->getValue() : $massUpdateSuccessResponse->getMessage()) . "\n");
                        }
                        else if ($massUpdateActionResponse instanceof APIException) {
                            $exception = $massUpdateActionResponse;
                            echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                            echo ("Code: " . $exception->getCode()->getValue() . "\n");
                            echo ("Details: ");
                            if ($exception->getDetails() != null) {
                                foreach ($exception->getDetails() as $keyName => $keyValue) {
                                    echo ($keyName . ": " . $keyValue . "\n");
                                }
                            }
                            echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                        }
                    }
                }
                else if ($massUpdateActionHandler instanceof APIException) {
                    $exception = $massUpdateActionHandler;
                    echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo ("Code: " . $exception->getCode()->getValue() . "\n");
                    if ($exception->getDetails() != null) {
                        echo ("Details: ");
                        foreach ($exception->getDetails() as $keyName => $keyValue) {
                            echo ($keyName . ": " . $keyValue . "\n");
                        }
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                }
            } else {
                print_r($response);
            }
        }
    }
}
$moduleAPIName="leads";
MassUpdateRecords::initialize();
MassUpdateRecords::massUpdateRecords($moduleAPIName);
