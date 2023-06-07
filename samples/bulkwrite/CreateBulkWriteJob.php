<?php
namespace bulkwrite;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\bulkwrite\BulkWriteOperations;
use com\zoho\crm\api\bulkwrite\SuccessResponse;
use com\zoho\crm\api\bulkwrite\APIException;
use com\zoho\crm\api\bulkwrite\RequestWrapper;
use com\zoho\crm\api\bulkwrite\CallBack;
use com\zoho\crm\api\util\Choice;
use com\zoho\crm\api\bulkwrite\Resource;
use com\zoho\crm\api\bulkwrite\FieldMapping;
use com\zoho\crm\api\modules\MinifiedModule;
use com\zoho\crm\api\bulkwrite\DefaultValue;
require_once "vendor/autoload.php";
class CreateBulkWriteJob
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
     * <h3> Create BulkWrite Job</h3>
     * This method is used to create a bulk write job.
     * @param moduleAPIName The API Name of the record's module.
     * @param fileId The ID of the uploaded file to create BulkWrite Job.
     */
    public static function createBulkWriteJob(string $moduleAPIName, string $fileId)
    {
        $bulkWriteOperations = new BulkWriteOperations();
        $requestWrapper = new RequestWrapper();
        $callback = new CallBack();
        $callback->setUrl("https://www.example.com/callback");
        $callback->setMethod(new Choice("post"));
        //The Bulk Write Job's details are posted to this URL on successful completion of job or on failure of job.
        $requestWrapper->setCallback($callback);
        $requestWrapper->setCharacterEncoding("UTF-8");
        $requestWrapper->setOperation(new Choice("insert"));
        $resource = array();
        $resourceIns = new Resource();
        // To set the type of module that you want to import. The value is data.
        $resourceIns->setType(new Choice("data"));
        $module = new MinifiedModule();
        $module->setAPIName($moduleAPIName);
        $resourceIns->setModule($module);
        $resourceIns->setFileId($fileId);
        //True - Ignores the empty values.The default value is false.
        $resourceIns->setIgnoreEmpty(true);
        $resourceIns->setFindBy("Email");
        $fieldMappings = array();
        $fieldMapping = new FieldMapping();
        $fieldMapping->setAPIName("Last_Name");
        $fieldMapping->setIndex(0);
        array_push($fieldMappings, $fieldMapping);
        $fieldMapping = new FieldMapping();
        $fieldMapping->setAPIName("Email");
        $fieldMapping->setIndex(1);
        array_push($fieldMappings, $fieldMapping);
        $fieldMapping = new FieldMapping();
        $fieldMapping->setAPIName("Company");
        $fieldMapping->setIndex(2);
        array_push($fieldMappings, $fieldMapping);
        $fieldMapping = new FieldMapping();
        $fieldMapping->setAPIName("Phone");
        $fieldMapping->setIndex(3);
        array_push($fieldMappings, $fieldMapping);
        $fieldMapping = new FieldMapping();
        $fieldMapping->setAPIName("Website");
        //$fieldMapping->setFormat("");
        //$fieldMapping->setFindBy("");
        $defaultValue = new DefaultValue();
        $defaultValue->setValue("https://www.zohoapis.com");
        $fieldMapping->setDefaultValue($defaultValue);
        array_push($fieldMappings, $fieldMapping);
        $resourceIns->setFieldMappings($fieldMappings);
        array_push($resource, $resourceIns);
        $requestWrapper->setResource($resource);
        //Call createBulkWriteJob method that takes RequestWrapper instance as parameter
        $response = $bulkWriteOperations->createBulkWriteJob($requestWrapper);
        if ($response != null) {
            echo ("Status code : " . $response->getStatusCode() . "\n");
            $actionResponse = $response->getObject();
            if ($actionResponse instanceof SuccessResponse) {
                $successResponse = $actionResponse;
                echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                echo ("Details: ");
                foreach ($successResponse->getDetails() as $key => $value) {
                    echo ($key . ": ");
                    print_r($value);
                    echo ("\n");
                }
                echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
            }
            else if ($actionResponse instanceof APIException) {
                $exception = $actionResponse;
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                echo ("Code: " . $exception->getCode()->getValue() . "\n");
                echo ("Details: ");
                if ($exception->getDetails() != null) {
                    foreach ($exception->getDetails() as $key => $value) {
                        echo ($key . ": " . $value . "\n");
                    }
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
            }
        }
    }
}
$moduleAPIName="leads";
$fileId="";
CreateBulkWriteJob::initialize();
CreateBulkWriteJob::createBulkWriteJob($moduleAPIName,$fileId);
