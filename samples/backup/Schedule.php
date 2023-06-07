<?php
namespace backup;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\backup\ActionWrapper;
use com\zoho\crm\api\backup\APIException;
use com\zoho\crm\api\backup\Backup;
use com\zoho\crm\api\backup\BackupOperations;
use com\zoho\crm\api\backup\BodyWrapper;
use com\zoho\crm\api\backup\SuccessResponse;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\util\Choice;

class Schedule
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
    public static function schedule()
    {
        $backupOperations = new BackupOperations();
        $bodyWrapper = new BodyWrapper();
        $backup = new Backup();
        $backup->setRrule("RRULE:FREQ=MONTHLY;INTERVAL=1;BYDAY=1TH");
        $bodyWrapper->setBackup($backup);
        $response = $backupOperations->schedule($bodyWrapper);
        if ($response != null)
        {
            echo ("Status Code: " . $response->getStatusCode());
            if($response->isExpected())
            {
                $actionHandler = $response->getObject();
                if ($actionHandler instanceof ActionWrapper)
                {
                    $actionWrapper = $actionHandler;
                    $actionResponse = $actionWrapper->getBackup();
                    if ($actionResponse instanceof SuccessResponse)
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
                        foreach ($exception->getDetails() as $key => $value) {
                            echo($key . " : " . $value . "\n");
                        }
                        echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
                    }
                }
            }
        }
    }
}
Schedule::initialize();
Schedule::schedule();
