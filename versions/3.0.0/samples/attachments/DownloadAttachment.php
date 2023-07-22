<?php
namespace attachments;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\attachments\AttachmentsOperations;
use com\zoho\crm\api\attachments\APIException;
use com\zoho\crm\api\attachments\FileBodyWrapper;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class DownloadAttachment
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
     * <h3> Download Attachment</h3>
     * This method is used to download an attachment of a single record of a module with ID and attachment ID and write the file in the specified destination.
     * @throws Exception
     * @param moduleAPIName The API Name of the record's module
     * @param recordId The ID of the record to download attachment
     * @param attachmentId The ID of the attachment to be downloaded
     * @param destinationFolder The absolute path of the destination folder to store the attachment
     */
    public static function downloadAttachment(string $moduleAPIName, string $recordId, string $attachmentId, string $destinationFolder)
    {
        //example
        //moduleAPIName = "module_api_name";
        //recordId = "34770615177002";
        //attachmentId = "34770615177023";
        //destinationFolder = "/Users/user_name/Desktop"
        $attachmentOperations = new AttachmentsOperations($moduleAPIName, $recordId);
        //Call downloadAttachment method that takes attachmentId as parameters
        $response = $attachmentOperations->downloadAttachment($attachmentId);
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
$moduleAPIName = "module_api_name";
$recordId = "347706157002";
$attachmentId = "30615177023";
$destinationFolder = "/Users/user_name/Desktop";
DownloadAttachment::initialize();
DownloadAttachment::downloadAttachment($moduleAPIName,$recordId,$attachmentId,$destinationFolder);
