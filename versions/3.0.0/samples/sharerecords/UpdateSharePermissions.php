<?php
namespace sharerecords;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\sharerecords\APIException;
use com\zoho\crm\api\sharerecords\ActionWrapper;
use com\zoho\crm\api\sharerecords\BodyWrapper;
use com\zoho\crm\api\sharerecords\ShareRecord;
use com\zoho\crm\api\sharerecords\ShareRecordsOperations;
use com\zoho\crm\api\sharerecords\SuccessResponse;
use com\zoho\crm\api\users\User;
use com\zoho\crm\api\util\Choice;
require_once "vendor/autoload.php";
class UpdateSharePermissions
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
     * <h3> Update Share Permissions </h3>
     * This method is used to update the sharing permissions of a record granted to users as Read-Write, Read-only, or grant full access.
     * @param moduleAPIName - The API Name of the module to update share permissions.
     * @param recordId - The ID of the record to be obtained.
     * @throws Exception
     */
    public static function updateSharePermissions(string $moduleAPIName, string $recordId)
    {
        //example
        //moduleAPIName = "module_api_name";
        //$recordId = "3477002";
        $shareRecordsOperations = new ShareRecordsOperations($recordId, $moduleAPIName);
        $request = new BodyWrapper();
        //List of ShareRecord instances
        $shareList = array();
        $share1 = new ShareRecord();
        $share1->setShareRelatedRecords(true);
        $share1->setPermission("full_access");
        $user = new User();
        $user->setId("347706105791024");
        $share1->setUser($user);
        $sharedWith = new User();
        $sharedWith->setId("34770615791024");
        $sharedWith->addKeyValue("type", "users");
        $share1->setSharedWith($sharedWith);
        $share1->setType(new Choice("private"));
        array_push($shareList, $share1);
        $request->setShare($shareList);
        //Call updateSharePermissions method that takes BodyWrapper instance as parameter
        $response = $shareRecordsOperations->updateSharePermissions($request);
        if ($response != null) {
            echo ("Status Code: " . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof ActionWrapper) {
                $actionWrapper = $actionHandler;
                $actionResponses = $actionWrapper->getShare();
                foreach ($actionResponses as $actionResponse) {
                    if ($actionResponse instanceof SuccessResponse) {
                        $successResponse = $actionResponse;
                        echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                        echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                        if ($successResponse->getDetails() != null) {
                            echo ("Details: ");
                            foreach ($successResponse->getDetails() as $key => $value) {
                                echo ($key . " : " . $value . "\n");
                            }
                        }
                        echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
                    }
                    else if ($actionResponse instanceof APIException) {
                        $exception = $actionResponse;
                        echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                        echo ("Code: " . $exception->getCode()->getValue() . "\n");
                        echo ("Details: ");
                        foreach ($exception->getDetails() as $key => $value) {
                            echo ($key . " : " . $value . "\n");
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
                foreach ($exception->getDetails() as $key => $value) {
                    echo ($key . " : " . $value . "\n");
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
            }
        }
    }
}
$moduleAPIName="leads";
$recordId="320322343502";
UpdateSharePermissions::initialize();
UpdateSharePermissions::updateSharePermissions($moduleAPIName,$recordId);
