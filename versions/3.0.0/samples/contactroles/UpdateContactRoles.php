<?php
namespace contactroles;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\contactroles\BodyWrapper;
use com\zoho\crm\api\contactroles\ContactRolesOperations;
use com\zoho\crm\api\contactroles\ContactRole;
use com\zoho\crm\api\contactroles\APIException;
use com\zoho\crm\api\contactroles\ActionWrapper;
use com\zoho\crm\api\contactroles\SuccessResponse;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class UpdateContactRoles
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
     * <h3> Update Contact Roles </h3>
     * This method is used to update Contact Roles and print the response.
     * @throws Exception
     */
    public static function updateContactRoles()
    {
        $contactRolesOperations = new ContactRolesOperations();
        $bodyWrapper = new BodyWrapper();
        //List of ContactRole instances
        $contactRolesList = array();
        $cr1 = new ContactRole();
        $cr1->setId("347706116838002");
        $cr1->setName("Edited1we");
        //Add ContactRole instance to the list
        array_push($contactRolesList, $cr1);
        $cr2 = new ContactRole();
        $cr2->setId("34770615058002");
        $cr2->setName("Edited2");
        //Add ContactRole instance to the list
        array_push($contactRolesList, $cr2);
        $bodyWrapper->setContactRoles($contactRolesList);
        //Call updateContactRoles method that takes BodyWrapper instance as parameter
        $response = $contactRolesOperations->updateRoles($bodyWrapper);
        if ($response != null) {
            echo ("Status code : " . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof ActionWrapper) {
                $actionWrapper = $actionHandler;
                $actionResponses = $actionWrapper->getContactRoles();
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
UpdateContactRoles::initialize();
UpdateContactRoles::updateContactRoles();
