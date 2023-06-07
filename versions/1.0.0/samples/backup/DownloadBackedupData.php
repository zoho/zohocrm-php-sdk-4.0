<?php
namespace backup;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\backup\APIException;
use com\zoho\crm\api\backup\BackupOperations;
use com\zoho\crm\api\backup\FileBodyWrapper;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\util\Choice;

class DownloadBackedupData
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
    public static function downloadBackedUpData($downloadUrl, $destinationFolder)
    {
        $backupOperations = new BackupOperations();
        $response = $backupOperations->downloadBackedUpData($downloadUrl);
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
                //Create a file instance with the absolute_file_path
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
$downloadUrl = "https://download-accl.com/v2/123456789/backup/31763003/Data_001.zip";
$destinationFolder = "Users/sdk-sample/file";
DownloadBackedupData::initialize();
DownloadBackedupData::downloadBackedUpData($downloadUrl, $destinationFolder);
