<?php

namespace file;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\INDataCenter;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\files\APIException;
use com\zoho\crm\api\files\ActionWrapper;
use com\zoho\crm\api\files\BodyWrapper;
use com\zoho\crm\api\files\FilesOperations;
use com\zoho\crm\api\files\SuccessResponse;
use com\zoho\crm\api\util\Choice;
use com\zoho\crm\api\util\StreamWrapper;

require "vendor/autoload.php";
class UploadFiles
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
     * <h3> Upload File</h3>
     * This method is used to upload a file and print the response.
     * @throws Exception
     */
    public static function uploadFiles()
    {
        $fileOperations = new FilesOperations();
        $bodyWrapper = new BodyWrapper();
        $streamWrapper = new StreamWrapper(null, null, "/users/Desktop/demofile2.html");
//        $streamWrapper1 = new StreamWrapper(null, null, "/Users/php-sdk-sample-application/file/download.png");
//        $streamWrapper2 = new StreamWrapper(null, null, "/Users/php-sdk-sample-application/file/download.png");
        $bodyWrapper->setFile([$streamWrapper]);
        $paramInstance = new ParameterMap();
        //Call uploadFiles method that takes BodyWrapper instance as parameter.
        $response = $fileOperations->uploadFiles($bodyWrapper, $paramInstance);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
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
                        if ($successResponse->getDetails() != null) {
                            foreach ($successResponse->getDetails() as $keyName => $keyValue) {
                                echo ($keyName . ": " . $keyValue . "\n");
                            }
                        }
                        echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
                    }
                    else if ($actionResponse instanceof APIException) {
                        $exception = $actionResponse;
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
            else if ($actionHandler instanceof APIException) {
                $exception = $actionHandler;
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                echo ("Code: " . $exception->getCode()->getValue() . "\n");
                echo ("Details: ");
                if ($exception->getDetails() != null) {
                    foreach ($exception->getDetails() as $keyName => $keyValue) {
                        echo ($keyName . ": " . $keyValue . "\n");
                    }
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
            }
        }
    }
}
UploadFiles::initialize();
UploadFiles::uploadFiles();
