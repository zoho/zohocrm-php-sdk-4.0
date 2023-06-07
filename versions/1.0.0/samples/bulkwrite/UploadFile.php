<?php
namespace bulkwrite;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\UserSignature;
use com\zoho\crm\api\bulkwrite\FileBodyWrapper;
use com\zoho\crm\api\bulkwrite\BulkWriteOperations;
use com\zoho\crm\api\util\Choice;
use com\zoho\crm\api\util\StreamWrapper;
use com\zoho\crm\api\bulkwrite\UploadFileHeader;
use com\zoho\crm\api\HeaderMap;
use com\zoho\crm\api\bulkwrite\SuccessResponse;
use com\zoho\crm\api\bulkwrite\APIException;
require_once "vendor/autoload.php";
class UploadFile
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
     * This method is used to upload a CSV file in ZIP format for bulk write API. The response contains the file_id.
     * Use this ID while making the bulk write request.
     * @param orgID The unique ID (zgid) of your organization obtained through the Organization API.
     * @param absoluteFilePath To give the zip file path you want to upload.
     * @throws Exception
     */
    public static function uploadFile(string $orgID, string $absoluteFilePath)
    {
        $bulkWriteOperations = new BulkWriteOperations();
        $fileBodyWrapper = new FileBodyWrapper();
        $streamWrapper = new StreamWrapper(null, null, $absoluteFilePath);
        // $file = fopen($absoluteFilePath, "rb");
        // $stream = fread($file, filesize($absoluteFilePath));
        // fclose($file);
        // $streamWrapper = new StreamWrapper(basename($absoluteFilePath), $stream);
        $fileBodyWrapper->setFile($streamWrapper);
        $headerInstance = new HeaderMap();
        //To indicate that this a bulk write operation
        $headerInstance->add(UploadFileHeader::feature(), "bulk-write");
        $headerInstance->add(UploadFileHeader::XCRMORG(), $orgID);
        //Call uploadFile method that takes FileBodyWrapper instance and headerInstance as parameter
        $response = $bulkWriteOperations->uploadFile($fileBodyWrapper, $headerInstance);
        if ($response != null) {
            echo ("Status code : " . $response->getStatusCode() . "\n");
            $actionResponse = $response->getObject();
            if ($actionResponse instanceof SuccessResponse) {
                $successResponse = $actionResponse;
                echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                echo ("Details: ");
                foreach ($successResponse->getDetails() as $key => $value) {
                    echo ($key . " : ");
                    print_r($value);
                    echo ("\n");
                }
                echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
            }
            else if ($actionResponse instanceof APIException) {
                $exception = $actionResponse;
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                echo ("Code: " . $exception->getCode()->getValue() . "\n");
                echo ("Details: ");
                if ($exception->getDetails() != null) {
                    foreach ($exception->getDetails() as $key => $value) {
                        echo ($key . ": " . $value . "\n");
                    }
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
            }
        }
    }
}
$orgID="100084";
$absoluteFilePath="users/user_name/documents";
UploadFile::initialize();
UploadFile::uploadFile($orgID,$absoluteFilePath);
