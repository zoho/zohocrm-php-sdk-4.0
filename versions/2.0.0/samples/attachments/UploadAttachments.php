<?php
namespace attachments;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\attachments\AttachmentsOperations;
use com\zoho\crm\api\attachments\APIException;
use com\zoho\crm\api\attachments\FileBodyWrapper;
use com\zoho\crm\api\util\Choice;
use com\zoho\crm\api\util\StreamWrapper;
use com\zoho\crm\api\attachments\SuccessResponse;
use com\zoho\crm\api\attachments\ActionWrapper;
require_once "vendor/autoload.php";
class UploadAttachments
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
     * <h3> Upload Attachments</h3>
     * This method is used to upload an attachment to a single record of a module with ID and print the response.
     * @throws Exception
     * @param moduleAPIName The API Name of the record's module
     * @param recordId The ID of the record to upload attachment
     * @param absoluteFilePath The absolute file path of the file to be attached
     */
    public static function uploadAttachments(string $moduleAPIName, string $recordId, string $absoluteFilePath)
    {
        //example
        //$moduleAPIName = "module_api_name";
        //$recordId = "3477061177002";
        //$absoluteFilePath = "/usr/image.png"
        $attachmentOperations = new AttachmentsOperations($moduleAPIName, $recordId);
        $fileBodyWrapper = new FileBodyWrapper();
        $streamWrapper = new StreamWrapper(null, null, $absoluteFilePath);
        $fileBodyWrapper->setFile($streamWrapper);
        //Call uploadAttachment method that takes FileBodyWrapper instance as parameter
        $response = $attachmentOperations->uploadAttachment($fileBodyWrapper);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof ActionWrapper) {
                $actionWrapper = $actionHandler;
                $actionResponses = $actionWrapper->getData();
                foreach ($actionResponses as $actionResponse) {
                    if ($actionResponse instanceof SuccessResponse) {
                        $successResponse = $actionResponse;
                        echo ("Status : " . $successResponse->getStatus()->getValue() . "\n");
                        echo ("Code : " . $successResponse->getCode()->getValue() . "\n");
                        echo ("Details : \n");
                        if ($successResponse->getDetails() != null) {
                            foreach ($successResponse->getDetails() as $keyName => $keyValue) {
                                echo ($keyName . " : ");
                                print_r($keyValue);
                                echo ("\n");
                            }
                        }
                        echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
                    }
                    else if ($actionResponse instanceof APIException) {
                        $exception = $actionResponse;
                        echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                        echo ("Code: " . $exception->getCode()->getValue() . "\n");
                        echo ("Details: \n");
                        if ($exception->getDetails() != null) {
                            foreach ($exception->getDetails() as $keyName => $keyValue) {
                                echo ($keyName . ": " . $keyValue . "\n");
                            }
                        }
                        echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                    }
                }
            }
            else if ($actionHandler instanceof APIException) {
                $exception = $actionHandler;
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                echo ("Code: " . $exception->getCode()->getValue() . "\n");
                if ($exception->getDetails() != null) {
                    echo ("Details: \n");
                    foreach ($exception->getDetails() as $keyName => $keyValue) {
                        echo ($keyName . ": " . $keyValue . "\n");
                    }
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
            }
        }
    }
}
$moduleAPIName = "module_api_name";
$recordId = "34770611002";
$absoluteFilePath = "/usr/image.png";
UploadAttachments::initialize();
UploadAttachments::uploadAttachments($moduleAPIName,$recordId,$absoluteFilePath);
