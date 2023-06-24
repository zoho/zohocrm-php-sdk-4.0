<?php
namespace changeowner;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\changeowner\ChangeOwnerOperations;
use com\zoho\crm\api\changeowner\Owner;
use com\zoho\crm\api\changeowner\RelatedModule;
use com\zoho\crm\api\changeowner\APIException;
use com\zoho\crm\api\changeowner\SuccessResponse;
use com\zoho\crm\api\changeowner\ActionWrapper;
use com\zoho\crm\api\changeowner\BodyWrapper;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class UpdateRecordOwner
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
    public static function updateRecordOwner($moduleAPIName, $recordId)
    {
        // ID of the Record to be updated
        // String recordId = "52550005067923";
        $changeOwnerOperations = new ChangeOwnerOperations($moduleAPIName);
        $bodyWrapper = new BodyWrapper();
        $owner = new Owner();
        $owner->setId("3477091024");
        $bodyWrapper->setOwner($owner);
        $bodyWrapper->setNotify(true);
        $relatedModules = array();
        $relatedModule = new RelatedModule();
        $relatedModule->setId("3477686005");
        $relatedModule->setAPIName("Tasks");
        array_push($relatedModules, $relatedModule);
        $relatedModule = new RelatedModule();
        $relatedModule->setId("34770686005");
        $relatedModule->setAPIName("Tasks");
        array_push($relatedModules, $relatedModule);
        $bodyWrapper->setRelatedModules($relatedModules);
        // Call updateRecordOwner method that takes recordId and BodyWrapper instance as parameters
        $response = $changeOwnerOperations->singleUpdate($recordId, $bodyWrapper);
        if ($response != null) {
            echo ("Status Code: " . $response->getStatusCode() . "\n");
            if ($response->isExpected()) {
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
                        foreach ($exception->getDetails() as $key => $value) {
                            echo ($key . ": " . $value . "\n");
                        }
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
                }
            }
        }
    }
}
$recordId = "35205067923";
$moduleAPIName="leads";
UpdateRecordOwner::initialize();
UpdateRecordOwner::updateRecordOwner($moduleAPIName,$recordId);
