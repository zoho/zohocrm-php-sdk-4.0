<?php

namespace usertypeusers;

use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\usertypeusers\APIException;
use com\zoho\crm\api\usertypeusers\BodyWrapper;
use com\zoho\crm\api\usertypeusers\Users;
use com\zoho\crm\api\usertypeusers\UserTypeUsersOperations;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";

class GetUsersOfUserType
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

    public static function getUsersOfUserType($portalName, $userTypeId)
    {
        $userTypeUsersOperations = new UserTypeUsersOperations();
        $paramInstance = new ParameterMap();
        $response = $userTypeUsersOperations->getUsersOfUserType($userTypeId, $portalName, $paramInstance);
        if ($response != null)
        {
            echo("Status Code: " . $response->getStatusCode());
            if ($response != null) {
                echo("Status Code: " . $response->getStatusCode());
                if (in_array($response->getStatusCode(), array(204, 304))) {
                    echo($response->getStatusCode() == 204 ? "No Content" : "Not Modified");
                    return;
                }
                if ($response->isExpected()) {
                    $responseHandler = $response->getObject();
                    if ($responseHandler instanceof BodyWrapper) {
                        $responseWrappr = $responseHandler;
                        $users = $responseWrappr->getUsers();
                        foreach ($users as $user) {
                            if ($user instanceof Users) {
                                echo("Users PersonalityId: " . $user->getPersonalityId());
                                echo("users Confirm: " . $user->getConfirm());
                                echo("Users StatusReasonS: " . $user->getStatusReasonS());
                                echo("users InvitedTime: " . date_format($user->getInvitedTime(), "d-m-Y-H-i-s") . "\n");
                                echo("Users Module: " . $user->getModule());
                                echo("Users Name: " . $user->getName());
                                echo("Users Active: " . $user->getActive());
                                echo("Users Email: " . $user->getEmail());
                            }
                        }
                        $info = $responseWrappr->getInfo();
                        if ($info != null) {
                            if ($info->getPerPage() != null) {
                                echo("Users Info PerPage: " . strval($info->getPerPage()));
                            }
                            if ($info->getCount() != null) {
                                echo("Users Info Count: " . strval($info->getCount()));
                            }
                            if ($info->getPage() != null) {
                                echo("Users Info Page: " . strval($info->getPage()));
                            }
                            if ($info->getMoreRecords() != null) {
                                echo("Users INfo MoreRecords: " . strval($info->getMoreRecords()));
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
}
$portalName = "PortalsAPITest1";
$userTypeId = 30424234234;
GetUsersOfUserType::initialize();
GetUsersOfUserType::getUsersOfUserType($portalName, $userTypeId);
