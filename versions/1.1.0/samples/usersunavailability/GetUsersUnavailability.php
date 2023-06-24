<?php
namespace usersunavailability;
require_once "vendor/autoload.php";
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\usersunavailability\APIException;
use com\zoho\crm\api\usersunavailability\BodyWrapper;
use com\zoho\crm\api\usersunavailability\UsersUnavailabilityOperations;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\util\Choice;

class GetUsersUnavailability
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
    public static function getUsersUnavailability($id)
    {
        $usersUnavailabilityOperations = new UsersUnavailabilityOperations();
        $paramInstance = new ParameterMap();
        // Call getUserUnavailabilityHours method that takes id and ParameterMap instance as parameters
        $response = $usersUnavailabilityOperations->getUsersUnavailability($id, $paramInstance);
        if ($response != null) {
            echo ("Status Code: " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            $responseHandler = $response->getObject();
            if ($responseHandler instanceof BodyWrapper) {
                $responseWrapper = $responseHandler;
                $users = $responseWrapper->getUsersUnavailability();
                foreach ($users as $usersUnavailability) {
                    echo ("UsersUnavailability Comments: " . $usersUnavailability->getComments() . "\n");
                    echo ("UsersUnavailability From: ");
                    print_r($usersUnavailability->getFrom());
                    echo ("\n");
                    echo ("UsersUnavailability Id: " . $usersUnavailability->getId() . "\n");
                    echo ("UsersUnavailability to: ");
                    print_r($usersUnavailability->getTo());
                    echo ("\n");
                    $user = $usersUnavailability->getUser();
                    if ($user != null) {
                        echo ("UsersUnavailability User-Name: " . $user->getName() . "\n");
                        echo ("UsersUnavailability User-Id: " . $user->getId() . "\n");
                        echo ("UsersUnavailability User-ZuId: " . $user->getZuid() . "\n");
                    }
                }
                $info = $responseWrapper->getInfo();
                if ($info != null) {
                    if ($info->getPerPage() != null) {
                        echo ("User Info PerPage: " . $info->getPerPage() . "\n");
                    }
                    if ($info->getCount() != null) {
                        echo ("User Info Count: " . $info->getCount() . "\n");
                    }
                    if ($info->getPage() != null) {
                        echo ("User Info Page: " . $info->getPage() . "\n");
                    }
                    if ($info->getMoreRecords() != null) {
                        echo ("User Info MoreRecords: " . $info->getMoreRecords() . "\n");
                    }
                }
            }
            else if ($responseHandler instanceof APIException) {
                $exception = $responseHandler;
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                echo ("Code: " . $exception->getCode()->getValue() . "\n");
                echo ("Details: ");
                foreach ($exception->getDetails() as $key => $value) {
                    echo ($key . ": " . $value . "\n");
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
            }
        }
    }
}
$id="320232000012";
GetUsersUnavailability::initialize();
GetUsersUnavailability::getUsersUnavailability($id);
