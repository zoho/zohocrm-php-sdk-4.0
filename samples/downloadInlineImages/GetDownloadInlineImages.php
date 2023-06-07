<?php

namespace downloadInlineImages;

use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\downloadinlineimages\APIException;
use com\zoho\crm\api\downloadinlineimages\DownloadInlineImagesOperations;
use com\zoho\crm\api\downloadinlineimages\FileBodyWrapper;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\util\Choice;

require "vendor/autoload.php";

class GetDownloadInlineImages
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
    public static function getDownloadInlineImages($module, $recordId, $userId, $messageId, $id, $destinationFolder)
    {
        $downloadInlineImagesOperations = new DownloadInlineImagesOperations($recordId, $module, $userId, $messageId , $id);
        $response = $downloadInlineImagesOperations->getDownloadInlineImages();
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
$recordId =4402400774074;
$module = "leads";
$userId = 4402480254001;
$messageId = "c6085fae0efab46ba7961727d69e719ae66cbf54a03bd40c";
$destinationFolder = "/users/php-sdk-sample-application/file";
$id = "179f60b8703bc6f6c60c12501b04e6891233fd8e9506e1119667564d7d1017304deeb964d78a3321";
GetDownloadInlineImages::initialize();
GetDownloadInlineImages::getDownloadInlineImages($module, $recordId, $userId, $messageId, $id, $destinationFolder);