<?php
namespace record;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\UserSignature;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\record\APIException;
use com\zoho\crm\api\record\MassUpdate;
use com\zoho\crm\api\record\MassUpdateResponseWrapper;
use com\zoho\crm\api\record\RecordOperations;
use com\zoho\crm\api\record\GetMassUpdateStatusParam;
use com\zoho\crm\api\record\{Cases, Field, Solutions, Accounts, Campaigns, Calls, Leads, Tasks, Deals, Sales_Orders, Contacts, Quotes, Events, Price_Books, Purchase_Orders, Vendors};
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class GetMassUpdateStatus
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
    /**
     * This method is used to get the status of the mass update job scheduled previously and print the response.
     * @param moduleAPIName- The API Name of the module to obtain records.
     * @param jobId - The ID of the job from the response of Mass Update Records.
     * @throws Exception
     */
    public static function getMassUpdateStatus(string $moduleAPIName, string $jobId)
    {
        //example
        //$moduleAPIName = "module_api_name";
        //$recordId = "34770615177002";
        $recordOperations = new RecordOperations();
        $paramInstance = new ParameterMap();
        $paramInstance->add(GetMassUpdateStatusParam::jobId(), $jobId);
        //Call getRecord method that takes paramInstance, moduleAPIName as parameter
        $response = $recordOperations->getMassUpdateStatus($moduleAPIName, $paramInstance);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            if ($response->isExpected()) {
                $massUpdateResponseHandler = $response->getObject();
                if ($massUpdateResponseHandler instanceof MassUpdateResponseWrapper) {
                    $massUpdateResponseWrapper = $massUpdateResponseHandler;
                    $massUpdateResponses = $massUpdateResponseWrapper->getData();
                    foreach ($massUpdateResponses as $massUpdateResponse) {
                        if ($massUpdateResponse instanceof MassUpdate) {
                            $massUpdate = $massUpdateResponse;
                            echo ("MassUpdate Status: " . $massUpdate->getStatus()->getValue() . "\n");
                            echo ("MassUpdate FailedCount: " . $massUpdate->getFailedCount() . "\n");
                            echo ("MassUpdate UpdatedCount: " . $massUpdate->getUpdatedCount() . "\n");
                            echo ("MassUpdate NotUpdatedCount: " . $massUpdate->getNotUpdatedCount() . "\n");
                            echo ("MassUpdate TotalCount: " . $massUpdate->getTotalCount() . "\n");
                        }
                        else if ($massUpdateResponse instanceof APIException) {
                            $exception = $massUpdateResponse;
                            echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                            echo ("Code: " . $exception->getCode()->getValue() . "\n");
                            if ($exception->getDetails() != null) {
                                echo ("Details: ");
                                foreach ($exception->getDetails() as $keyName => $keyValue) {
                                    echo ($keyName . ": " . $keyValue . "\n");
                                }
                            }
                            echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                        }
                    }
                }
                else if ($massUpdateResponseHandler instanceof APIException) {
                    $exception = $massUpdateResponseHandler;
                    echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo ("Code: " . $exception->getCode()->getValue() . "\n");
                    echo ("Details: ");
                    if ($exception->getDetails() != null) {
                        echo ("Details: ");
                        foreach ($exception->getDetails() as $keyName => $keyValue) {
                            echo ($keyName . ": " . $keyValue . "\n");
                        }
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                }
            } else {
                print_r($response);
            }
        }
    }
}
$moduleAPIName = "module_api_name";
$jobId = "34770615177002";
GetMassUpdateStatus::initialize();
GetMassUpdateStatus::getMassUpdateStatus($moduleAPIName,$jobId);
