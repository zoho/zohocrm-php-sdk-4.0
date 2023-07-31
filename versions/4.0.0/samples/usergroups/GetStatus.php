<?php
namespace usergroups;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\usergroups\APIException;
use com\zoho\crm\api\usergroups\Jobs;
use com\zoho\crm\api\usergroups\JobsWrapper;
use com\zoho\crm\api\usergroups\UserGroupsOperations;
use com\zoho\crm\api\usergroups\GetStatusParam;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class GetStatus
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
    public static function getStatus(string $jobId)
    {
        $userGroupsOperations = new UserGroupsOperations();
        $paramInstance = new ParameterMap();
        $paramInstance->add(GetStatusParam::jobId(), $jobId);
        $response = $userGroupsOperations->getStatus($paramInstance);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            $jobHandler = $response->getObject();
            if ($jobHandler instanceof JobsWrapper) {
                $responseWrapper = $jobHandler;
                $jobs = $responseWrapper->getDeletionJobs();
                foreach ($jobs as $job) {
                    if ($job instanceof Jobs) {
                        echo ("Status: " .  $job->getStatus() . "\n");
                    }
                }
            }
            else if ($jobHandler instanceof APIException) {
                $exception = $jobHandler;
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
$jobId="180000424";
GetStatus::initialize();
GetStatus::getStatus($jobId);
