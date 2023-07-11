<?php

namespace portalInvite;

use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\portalinvite\ActionWrapper;
use com\zoho\crm\api\portalinvite\APIException;
use com\zoho\crm\api\portalinvite\PortalInviteOperations;
use com\zoho\crm\api\portalinvite\InviteUsersParam;
use com\zoho\crm\api\portalinvite\Success;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\util\Choice;

require "vendor/autoload.php";

class PortalInvite
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
    public static function portalInvite($recordId, $module, $userTypeId, $type)
    {
        $portalinviteOperations = new PortalInviteOperations();
        $paramInstance = new ParameterMap();
        $paramInstance->add(InviteUsersParam::userTypeId(), $userTypeId);
        $paramInstance->add(InviteUsersParam::type(), $type);
        $response = $portalinviteOperations->inviteUsers($recordId, $module, $paramInstance);
        if($response != null)
        {
            echo("Status Code: " . $response->getStatusCode());
            if($response->isExpected())
            {
                $actionHandler = $response->getObject();
                if ($actionHandler instanceof ActionWrapper)
                {
                    $actionWrapper = $actionHandler;
                    $actionResponse = $actionWrapper->getPortalInvite();
                    if ($actionResponse instanceof Success)
                    {
                        $successResponse = $actionResponse;
                        echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                        echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                        echo ("Details: ");
                        foreach ($successResponse->getDetails() as $key => $value)
                        {
                            echo ($key . " : ");
                            print_r($value);
                            echo ("\n");
                        }
                        echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
                    }
                    else if ($actionResponse instanceof APIException) {
                        $exception = $actionResponse;
                        echo("Status: " . $exception->getStatus()->getValue() . "\n");
                        echo("Code: " . $exception->getCode()->getValue() . "\n");
                        echo("Details: ");
                        foreach ($exception->getDetails() as $key => $value)
                        {
                            echo($key . " : " . $value . "\n");
                        }
                        echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                    }
                }
                elseif ($actionHandler instanceof APIException)
                {
                    $exception = $actionHandler;
                    echo("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo("Code: " . $exception->getCode()->getValue() . "\n");
                    echo("Details: ");
                    foreach ($exception->getDetails() as $key => $value)
                    {
                        echo($key . " : " . $value . "\n");
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
                }
            }
        }
    }
}
$recordId = "334000343243";
$module = "leads";
$userTypeId = "343242443243";
$type = "invite";
PortalInvite::initialize();
PortalInvite::portalInvite($recordId, $module, $userTypeId, $type);