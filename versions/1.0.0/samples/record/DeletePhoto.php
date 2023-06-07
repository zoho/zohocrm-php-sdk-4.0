<?php
namespace record;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\record\APIException;
use com\zoho\crm\api\record\RecordOperations;
use com\zoho\crm\api\record\SuccessResponse;
use com\zoho\crm\api\record\{Cases, Field, Solutions, Accounts, Campaigns, Calls, Leads, Tasks, Deals, Sales_Orders, Contacts, Quotes, Events, Price_Books, Purchase_Orders, Vendors};
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class DeletePhoto
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
     * This method is used to delete a photo from a record in a module.
     * @param moduleAPIName - The API Name of the module to obtain records.
     * @param recordId - The ID of the record to be obtained.
     * @throws Exception
     */
    public static function deletePhoto(string $moduleAPIName, string $recordId)
    {
        //example
        //$moduleAPIName = "module_api_name";
        //$recordId = "34770615177002";
        $recordOperations = new RecordOperations();
        //Call getAttachments method that takes moduleAPIName and recordId as parameter
        $response = $recordOperations->deletePhoto($recordId, $moduleAPIName);
        if ($response != null) {
            echo ("Status Code: " . $response->getStatusCode() . "\n");
            if ($response->isExpected()) {
                $fileHandler = $response->getObject();
                if ($fileHandler instanceof SuccessResponse) {
                    $successResponse = $fileHandler;
                    echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                    echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                    echo ("Details: ");
                    if ($successResponse->getDetails() != null) {
                        foreach ($successResponse->getDetails() as $keyName => $keyValue) {
                            echo ($keyName . ": " . $keyValue . "\n");
                        }
                    }
                    echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
                }
                else if ($fileHandler instanceof APIException) {
                    $exception = $fileHandler;
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
            } else {
                print_r($response);
            }
        }
    }
}
$moduleAPIName = "module_api_name";
$recordId = "3477002";
DeletePhoto::initialize();
DeletePhoto::deletePhoto($moduleAPIName,$recordId);
