<?php

namespace downloadattachments;

use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\downloadattachments\APIException;
use com\zoho\crm\api\downloadattachments\DownloadAttachmentsOperations;
use com\zoho\crm\api\downloadattachments\GetDownloadAttachmentsDetailsParam;
use com\zoho\crm\api\downloadattachments\FileBodyWrapper;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\util\Choice;

require "vendor/autoload.php";

class GetDownloadAttachmentsDetails
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
    public static function getDownloadAttachmentsDetails($module, $recordId, $userId, $messageId, $destinationFolder)
    {
        $downloadAttachmentsOperations = new DownloadAttachmentsOperations();
        $paramInstance = new ParameterMap();
        $paramInstance->add(GetDownloadAttachmentsDetailsParam::userId(), $userId);
        $paramInstance->add(GetDownloadAttachmentsDetailsParam::messageId(), $messageId);
        $response = $downloadAttachmentsOperations->getDownloadAttachmentsDetails($recordId, $module, $paramInstance);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if ($response->getStatusCode() == 204) {
                echo ("No Content\n");
                return;
            }
            $responseHandler = $response->getObject();
            if ($responseHandler instanceof FileBodyWrapper) {
                $fileBodyWrapper = $responseHandler;
                $streamWrapper = $fileBodyWrapper->getFile();
                $fp = fopen($destinationFolder . "/" . $streamWrapper->getName(), "w");
                $stream = $streamWrapper->getStream();
                fputs($fp, $stream);
                fclose($fp);
            }
            else if ($responseHandler instanceof APIException) {
                $exception = $responseHandler;
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                echo ("Code: " . $exception->getCode()->getValue() . "\n");
                if ($exception->getDetails() != null) {
                    echo ("Details: \n");
                    foreach ($exception->getDetails() as $keyName => $keyValue) {
                        echo ($keyName . ": "); print_r($keyValue); echo("\n");
                    }
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
            }
        }
    }
}
$recordId = "548001";
$module = "Leads";
$userId = "173021";
$messageId = "c6085faef7e095623f7d04db7e";
$destinationFolder = "/php-sdk-sample-application/file";
GetDownloadAttachmentsDetails::initialize();
GetDownloadAttachmentsDetails::getDownloadAttachmentsDetails($module, $recordId, $userId, $messageId, $destinationFolder);
