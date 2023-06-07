<?php
namespace usertype;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\INDataCenter;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\usertype\APIException;
use com\zoho\crm\api\usertype\BodyWrapper;
use com\zoho\crm\api\usertype\UserType;
use com\zoho\crm\api\usertype\UserTypeOperations;
use com\zoho\crm\api\util\Choice;

require "vendor/autoload.php";
class GetUserTypes
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
    public static function getUserTypes($portalName)
    {
        $userTypeOperations = new UserTypeOperations($portalName);
        $response = $userTypeOperations->getUserTypes();
        if ($response != null)
        {
            echo("Status Code: " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204,304)))
            {
                echo($response->getStatusCode() == 204 ? "No Content" : "Not Modified");
                return;
            }
            if ($response->isExpected())
            {
                $responseHandler = $response->getObject();
                if ($responseHandler instanceof BodyWrapper)
                {
                    $responseWrappr = $responseHandler;
                    $userType = $responseWrappr->getUserType();
                    foreach ($userType as $userType1)
                    {
                        if ($userType1 instanceof UserType)
                        {
                            echo("UserType CreatedTime: " . date_format($userType1->getCreatedTime(), "d-m-Y-H-i-s") . "\n");
                            echo("userType Default: " . $userType1->getDefault() . "\n");
                            echo("userType ModifiedTime: " . date_format($userType1->getModifiedTime(), "d-m-Y-H-i-s") . "\n");
                            $personalityModule = $userType1->getPersonalityModule();
                            if ($personalityModule != null)
                            {
                                echo("UserType PersonalityModule-ID: " . $personalityModule->getId() . "\n");
                                echo("UserType PersonalityModule-APIName: " . $personalityModule->getAPIName() . "\n");
                                echo("UserType PersonalityModule-PluralLabel: " . $personalityModule->getPluralLabel() . "\n");
                            }
                            echo("UserType Name: " . $userType1->getName() . "\n");
                            $modifiedBy = $userType1->getModifiedBy();
                            if ($modifiedBy != null)
                            {
                                echo("UserType ModifiedBy User-ID: " . $modifiedBy->getId() . "\n");
                                echo("UserType ModifiedBy User0-Name: " . $modifiedBy->getName() . "\n");
                            }
                            echo("UserType Active: " . $userType1->getActive() . "\n");
                            echo("UserType Id: " . $userType1->getId() . "\n");
                            $createdBy = $userType1->getCreatedBy();
                            if ($createdBy != null)
                            {
                                echo("UserType CreatedBy User-ID: " . $createdBy->getId() . "\n");
                                echo("UserType CreatedBy User-Name: " . $createdBy->getName() . "\n");
                            }
                            echo("UserType NoOfUsers: " . $userType1->getNoOfUsers() . "\n");
                        }
                    }
                }
                else if ($responseHandler instanceof APIException)
                {
                    $exception = $responseHandler;
                    echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo ("Code: " . $exception->getCode()->getValue() . "\n");
                    echo ("Details: ");
                    foreach ($exception->getDetails() as $key => $value)
                    {
                        echo ($key . ": " . $value . "\n");
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
                }
            }
        }
    }
}
$portalName = "PortalsAPITest1";
GetUserTypes::initialize();
GetUserTypes::getUserTypes($portalName);
