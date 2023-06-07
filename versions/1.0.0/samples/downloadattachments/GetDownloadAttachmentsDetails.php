<?php

namespace downloadattachments;

use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\downloadattachments\APIException;
use com\zoho\crm\api\downloadattachments\DownloadAttachmentsOperations;
use com\zoho\crm\api\downloadattachments\FileBodyWrapper;
use com\zoho\crm\api\InitializeBuilder;
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
        $downloadAttachmentsOperations = new DownloadAttachmentsOperations($recordId, $module, $userId, $messageId);
        $response = $downloadAttachmentsOperations->getDownloadAttachmentsDetails();
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
                        echo ($keyName . ": " . $keyValue . "\n");
                    }
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
            }
        }
    }
}
$recordId =4402480774;
$module = "leads";
$userId = 44024854001;
$messageId = "c6085fae06cbd7b75001d80f7e095623f7d04db7e";
$destinationFolder = "users/php-sdk-sample-application/file";
GetDownloadAttachmentsDetails::initialize();
GetDownloadAttachmentsDetails::getDownloadAttachmentsDetails($module, $recordId, $userId, $messageId, $destinationFolder);
