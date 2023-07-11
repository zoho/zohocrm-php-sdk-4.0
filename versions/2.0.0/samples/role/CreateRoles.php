<?php
namespace role;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\roles\APIException;
use com\zoho\crm\api\roles\RolesOperations;
use com\zoho\crm\api\roles\SuccessResponse;
use com\zoho\crm\api\roles\BodyWrapper;
use com\zoho\crm\api\users\MinifiedUser;
use com\zoho\crm\api\roles\ActionWrapper;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class CreateRoles
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
    public static function createRoles()
    {
        $rolesOperations = new RolesOperations();
        $bodyWrapper = new BodyWrapper();
        // List of Role instances
        $roles = [];
        $roleClass = 'com\zoho\crm\api\roles\Role';
        $role = new $roleClass();
        $role->setName("Product Manager321321");
        $reportingTo = new MinifiedUser();
        $reportingTo->setId("3477061026005");
        $role->setReportingTo($reportingTo);
        $role->setDescription("Schedule and manage resources");
        $role->setShareWithPeers(true);
        // Add ContactRole instance to the list
        array_push($roles, $role);
        $bodyWrapper->setRoles($roles);
        // Call createRoles method that takes BodyWrapper instance as parameter
        $response = $rolesOperations->createRoles($bodyWrapper);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof ActionWrapper) {
                $actionWrapper = $actionHandler;
                $actionResponses = $actionWrapper->getRoles();
                foreach ($actionResponses as $actionResponse) {
                    if ($actionResponse instanceof SuccessResponse) {
                        $successResponse = $actionResponse;
                        echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                        echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                        echo ("Details: ");
                        if ($successResponse->getDetails() != null) {
                            foreach ($successResponse->getDetails() as $keyName => $keyValue) {
                                echo ($keyName . ": " . $keyValue . "\n");
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
CreateRoles::initialize();
CreateRoles::createRoles();
