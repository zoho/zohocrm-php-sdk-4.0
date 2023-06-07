<?php
namespace file;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\INDataCenter;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\files\APIException;
use com\zoho\crm\api\files\FilesOperations;
use com\zoho\crm\api\files\GetFileParam;
use com\zoho\crm\api\files\FileBodyWrapper;
use com\zoho\crm\api\util\Choice;
require "vendor/autoload.php";
class GetFile
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
     * <h3> Get File</h3>
     * @param id - The ID of the uploaded File.
     * @param destinationFolder - The absolute path of the destination folder to store the File
     * @throws Exception
     */
    public static function getFile(string $id, string $destinationFolder)
    {
        //example
        //id = "347706177002";
        //destinationFolder = "/Users/user_name/Desktop"
        $fileOperations = new FilesOperations();
        $paramInstance = new ParameterMap();
        $paramInstance->add(GetFileParam::id(), $id);
        //Call getFile method that takes paramInstance as parameters
        $response = $fileOperations->getFile($paramInstance);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
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
$id = "c6085fa6b1061e063a64154e30b905c6e1efa82c6";
$destinationFolder = "/users/php-sdk-sample-application/file";
GetFile::initialize();
GetFile::getFile($id,$destinationFolder);
