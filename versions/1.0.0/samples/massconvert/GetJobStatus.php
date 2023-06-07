<?php
namespace massconvert;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\massconvert\APIException;
use com\zoho\crm\api\massconvert\MassConvertOperations;
use com\zoho\crm\api\massconvert\GetJobStatusParam;
use com\zoho\crm\api\massconvert\ResponseWrapper;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class GetJobStatus
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
    public static function getJobStatus(string $jobId)
    {
        $massConvertOperations = new MassConvertOperations();
        $paramInstance = new ParameterMap();
        $paramInstance->add(GetJobStatusParam::jobId(), $jobId);
        $response = $massConvertOperations->getJobStatus($paramInstance);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            $responseHandler = $response->getObject();
            if ($responseHandler instanceof ResponseWrapper) {
                $responseWrapper = $responseHandler;
                $status = $responseWrapper->getData();
                foreach ($status as $status1) {
                    echo ("MassConvert TotalCount: " . $status1->getTotalCount() . "\n");
                    echo ("MassConvert ConvertedCount: " . $status1->getConvertedCount() . "\n");
                    echo ("MassConvert NotConvertedCount: " . $status1->getNotConvertedCount() . "\n");
                    echo ("MassConvert FailedCount: " . $status1->getFailedCount() . "\n");
                    echo ("MassConvert Status: " . $status1->getStatus() . "\n");
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
$jobId="30034543";
GetJobStatus::initialize();
GetJobStatus::getJobStatus($jobId);
