<?php
namespace attachments;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\attachments\AttachmentsOperations;
use com\zoho\crm\api\attachments\APIException;
use com\zoho\crm\api\attachments\SuccessResponse;
use com\zoho\crm\api\attachments\ActionWrapper;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\attachments\UploadLinkAttachmentParam;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class UploadLinkAttachments
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
     * <h3> Upload Link Attachments</h3>
     * This method is used to upload link attachment to a single record of a module with ID and print the response.
     * @param moduleAPIName The API Name of the record's module
     * @param recordId The ID of the record to upload Link attachment
     * @param attachmentURL The attachmentURL of the doc or image link to be attached
     */
    public static function uploadLinkAttachments(string $moduleAPIName, string $recordId, string $attachmentURL)
    {
        //example
        //$moduleAPIName = "module_api_name";
        //$recordId = "34770615177002";
        //$attachmentURL = "https://5.imimg.com/data5/KJ/UP/MY-8655440/zoho-crm-500x500.png";
        $attachmentOperations = new AttachmentsOperations($moduleAPIName, $recordId);
        $paramInstance = new ParameterMap();
        $paramInstance->add(UploadLinkAttachmentParam::attachmentUrl(), $attachmentURL);
        //Call uploadAttachment method that takes paramInstance as parameter
        $response = $attachmentOperations->uploadLinkAttachment($paramInstance);
        if ($response != null) {
            echo ("Status code" . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof ActionWrapper) {
                $actionWrapper = $actionHandler;
                $actionResponses = $actionWrapper->getData();
                foreach ($actionResponses as $actionResponse) {
                    if ($actionResponse instanceof SuccessResponse) {
                        $successResponse = $actionResponse;
                        echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                        echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
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
$recordId = "347706151002";
$attachmentURL = "https://5.imimg.com/KJ/UP/MY-8655440/500x500.png";
UploadLinkAttachments::initialize();
UploadLinkAttachments::uploadLinkAttachments($moduleAPIName,$recordId,$attachmentURL);
