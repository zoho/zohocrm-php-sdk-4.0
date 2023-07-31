<?php
namespace record;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\UserSignature;
use com\zoho\crm\api\record\APIException;
use com\zoho\crm\api\record\FileBodyWrapper;
use com\zoho\crm\api\record\RecordOperations;
use com\zoho\crm\api\record\{Cases, Field, Solutions, Accounts, Campaigns, Calls, Leads, Tasks, Deals, Sales_Orders, Contacts, Quotes, Events, Price_Books, Purchase_Orders, Vendors};
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class GetPhoto
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
     * This method is used to download a photo associated with a module.
     * @param moduleAPIName - The API Name of the module to obtain records.
     * @param recordId - The ID of the record to be obtained.
     * @param destinationFolder - The absolute path of the destination folder to store the photo.
     * @throws Exception
     */
    public static function getPhoto(string $moduleAPIName, string $recordId, string $destinationFolder)
    {
        //example
        //$moduleAPIName = "module_api_name";
        //$recordId = "34770615177002";
        //$destinationFolder = "/Users/user_name/Desktop";
        $recordOperations = new RecordOperations();
        //Call downloadAttachment method that takes moduleAPIName and recordId as parameters
        $response = $recordOperations->getPhoto($recordId, $moduleAPIName);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            if ($response->isExpected()) {
                $downloadHandler = $response->getObject();
                if ($downloadHandler instanceof FileBodyWrapper) {
                    $fileBodyWrapper = $downloadHandler;
                    $streamWrapper = $fileBodyWrapper->getFile();
                    //Create a file instance with the absolute_file_path
                    $fp = fopen($destinationFolder . "/" . $streamWrapper->getName(), "w");
                    $stream = $streamWrapper->getStream();
                    fputs($fp, $stream);
                    fclose($fp);
                }
                else if ($downloadHandler instanceof APIException) {
                    $exception = $downloadHandler;
                    echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo ("Code: " . $exception->getCode()->getValue() . "\n");
                    if ($exception->getDetails() != null) {
                        echo ("Details: \n");
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
$recordId = "34770615177002";
$destinationFolder = "/Users/user_name/Desktop";
GetPhoto::initialize();
GetPhoto::getPhoto($moduleAPIName,$recordId,$destinationFolder);
