<?php
namespace usergroups;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\usergroups\APIException;
use com\zoho\crm\api\usergroups\SourcesCountWrapper;
use com\zoho\crm\api\usergroups\UserGroupsOperations;
use com\zoho\crm\api\util\Choice;

require "vendor/autoload.php";
class GetSourcesCount
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
    public static function getSourcesCount($groupId)
    {
        $userGroupsOperations = new UserGroupsOperations();
        $response = $userGroupsOperations->getSourcesCount($groupId);
        if ($response != null)
        {
            echo ("Status Code : " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304)))
            {
                echo($response->getStatusCode() == 204 ? "No Content" : "Not Modified");
                return;
            }
            if ($response->isExpected())
            {
                $responseHandler = $response->getObject();
                if ($responseHandler instanceof SourcesCountWrapper)
                {
                    $responseWrapper = $responseHandler;
                    $sourcesCount = $responseWrapper->getSourcesCount();
                    if ($sourcesCount != null)
                    {
                        foreach ($sourcesCount as $count)
                        {
                            echo("Sources Count Territories : " . $count->getTerritories() . "\n");
                            echo("Sources Count Roles : " . $count->getRoles() . "\n");
                            echo("Sources Count Groups : " . $count->getGroups() . "\n");
                            $users = $count->getUsers();
                            if ($users != null)
                            {
                                echo ("Sources Users Inactive : " . $users->getInactive() . "\n");
                                echo("Sources Users Deleted : " . $users->getDeleted() . "\n");
                                echo("Sources Users Groups : " . $users->getActive() . "\n");
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
$groupId = 4402481175053;
GetSourcesCount::initialize();
GetSourcesCount::getSourcesCount($groupId);
