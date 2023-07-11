<?php
namespace dealcontactroles;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\dealcontactroles\APIException;
use com\zoho\crm\api\dealcontactroles\ActionWrapper;
use com\zoho\crm\api\dealcontactroles\BodyWrapper;
use com\zoho\crm\api\dealcontactroles\ContactRole;
use com\zoho\crm\api\dealcontactroles\Data;
use com\zoho\crm\api\dealcontactroles\DealContactRolesOperations;
use com\zoho\crm\api\dealcontactroles\SuccessResponse;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class AddContactRoleToDeal
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
    public static function addContactRoleToDeal($contactId, $dealId)
    {
        $contactRolesOperations = new DealContactRolesOperations();
        $bodyWrapper = new BodyWrapper();
        $data = array();
        $data1 = new Data();
        $contactRole = new ContactRole();
        $contactRole->setId("347700918508");
        $contactRole->setName("contactRole1211");
        $data1->setContactRole($contactRole);
        array_push($data, $data1);
        $bodyWrapper->setData($data);
        //Call createContactRoles method that takes BodyWrapper instance as parameter
        $response = $contactRolesOperations->associateContactRoleToDeal($contactId, $dealId, $bodyWrapper);
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
$contactId="321212312";
$dealId="320000123";
AddContactRoleToDeal::initialize();
AddContactRoleToDeal::addContactRoleToDeal($contactId,$dealId);
