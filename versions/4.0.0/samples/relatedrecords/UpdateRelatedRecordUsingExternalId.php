<?php
namespace relatedrecords;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\relatedrecords\APIException;
use com\zoho\crm\api\relatedrecords\ActionWrapper;
use com\zoho\crm\api\relatedrecords\BodyWrapper;
use com\zoho\crm\api\relatedrecords\RelatedRecordsOperations;
use com\zoho\crm\api\relatedrecords\SuccessResponse;
use com\zoho\crm\api\record\Record;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class UpdateRelatedRecordUsingExternalId
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
     * <h3> Update Related Record Using External Id </h3>
     * This method is used to update the relation between the records and print the response.
     * @param moduleAPIName - The API Name of the module to update related record.
     * @param externalValue -
     * @param relatedListAPIName - The API name of the related list. To get the API name of the related list.
     * @param externalFieldValue -
     * @throws Exception
     */
    public static function updateRelatedRecordUsingExternalId(string $moduleAPIName, string $externalValue, string $relatedListAPIName, string $externalFieldValue)
    {
        //API Name of the module to update record
        //$moduleAPIName = "Leads";
        //$externalValue = "3477061000005177002";
        //$relatedListAPIName = "Products";
        //$externalFieldValue = "3477061000004994115";
        //$destinationFolder = "/Users/user_name/Desktop";
        $xExternal = "Leads.External,Products.Products_External";
        $relatedRecordsOperations = new RelatedRecordsOperations($relatedListAPIName, $moduleAPIName, $xExternal);
        $request = new BodyWrapper();
        //List of Record instances
        $records = array();
        $record1 = new Record();
        /*
         * Call addKeyValue method that takes two arguments
         * 1 -> A string that is the Field's API Name
         * 2 -> Value
         */
        $record1->addKeyValue("list_price", 50.56);
        //Add Record instance to the list
        array_push($records, $record1);
        $request->setData($records);
        //Call updateRelatedRecordUsingExternalId method that takes externalFieldValue, externalValue and BodyWrapper instance as parameter.
        $response = $relatedRecordsOperations->updateRelatedRecordUsingExternalId($externalFieldValue, $externalValue, $request);
        if ($response != null) {
            echo ("Status Code: " . $response->getStatusCode() . "\n");
            if ($response->isExpected()) {
                $actionHandler = $response->getObject();
                if ($actionHandler instanceof ActionWrapper) {
                    $actionWrapper = $actionHandler;
                    $actionResponses = $actionWrapper->getData();
                    foreach ($actionResponses as $actionResponse) {
                        if ($actionResponse instanceof SuccessResponse) {
                            $successResponse = $actionResponse;
                            echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                            echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                            echo ("Details: ");
                            foreach ($successResponse->getDetails() as $key => $value) {
                                echo ($key . " : " . $value . "\n");
                            }
                            echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
                        }
                        else if ($actionResponse instanceof APIException) {
                            $exception = $actionResponse;
                            echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                            echo ("Code: " . $exception->getCode()->getValue() . "\n");
                            echo ("Details: ");
                            foreach ($exception->getDetails() as $key => $value) {
                                echo ($key . " : " . $value . "\n");
                            }
                            echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                        }
                    }
                }
                else if ($actionHandler instanceof APIException) {
                    $exception = $actionHandler;
                    echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo ("Code: " . $exception->getCode()->getValue() . "\n");
                    echo ("Details: ");
                    foreach ($exception->getDetails() as $key => $value) {
                        echo ($key . " : " . $value . "\n");
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                }
            } else {
                print_r($response);
            }
        }
    }
}
$moduleAPIName = "Leads";
$externalValue = "34770615177002";
$relatedListAPIName = "Products";
$externalFieldValue = "34770614994115";
UpdateRelatedRecordUsingExternalId::initialize();
UpdateRelatedRecordUsingExternalId::updateRelatedRecordUsingExternalId($moduleAPIName,$externalValue,$relatedListAPIName,$externalFieldValue);
