<?php
namespace usergroups;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\usergroups\APIException;
use com\zoho\crm\api\usergroups\SourcesWrapper;
use com\zoho\crm\api\usergroups\UserGroupsOperations;
use com\zoho\crm\api\util\Choice;

require "vendor/autoload.php";
class GetSources
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
    public static function getSources($groupId)
    {
        $userGroupsOperations = new UserGroupsOperations();
        $paramInstance = new ParameterMap();
        $response = $userGroupsOperations->getSources($groupId, $paramInstance);
        if ($response != null)
        {
            echo("Status Code : " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204,304)))
            {
                echo($response->getStatusCode() == 204 ? "No Content" : "Not Modified");
                return;
            }
            if ($response->isExpected())
            {
                $responseHandler = $response->getObject();
                if ($responseHandler instanceof SourcesWrapper)
                {
                    $responseWrapper = $responseHandler;
                    $sources = $responseWrapper->getSources();
                    foreach ($sources as $source)
                    {
                        $source1 = $source->getSource();
                        if ($source1 != null)
                        {
                            echo("Sources User_name : " . $source1->getName() . "\n");
                            echo("Sources User_ID : " . $source1->getId() . "\n");
                        }
                        echo("Sources Type : " . $source->getType()->getValue() . "\n");
                        echo("Sources Subordinates : " . $source->getSubordinates() . "\n");
                    }
                    $info = $responseWrapper->getInfo();
                    if ($info != null)
                    {
                        if ($info->getPerPage() != null)
                        {
                            echo("Sources Info PerPage : " . strval($info->getPerPage())  . "\n");
                        }
                        if ($info->getCount() != null)
                        {
                            echo("Sources Info Count : " . strval($info->getCount()) . "\n");
                        }
                        if ($info->getPage() != null)
                        {
                            echo("Sources Info Page ; " . strval($info->getPage()) . "\n");
                        }
                        if ($info->getMoreRecords() != null)
                        {
                            echo("Sources Info MoreRecords : " . strval($info->getMoreRecords()) . "\n");
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
}
$groupId = 4402481219057;
GetSources::initialize();
GetSources::getSources($groupId);
