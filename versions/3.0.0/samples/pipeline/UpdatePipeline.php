<?php
namespace pipeline;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\pipeline\PipelineOperations;
use com\zoho\crm\api\pipeline\Maps;
use com\zoho\crm\api\pipeline\ActionWrapper;
use com\zoho\crm\api\pipeline\SuccessResponse;
use com\zoho\crm\api\pipeline\APIException;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class UpdatePipeline
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
    public static function updatePipeline($layoutId, $pipelineId)
    {
        $pipelineOperations = new PipelineOperations($layoutId);
        $pipelineClass = "com\\zoho\\crm\\api\\pipeline\\PipeLine";
        $pipeline = new $pipelineClass();
        $pipeline->setDisplayValue("Qualification");
        $pickList = new Maps();
        $pickList->setId("347706100801");
        $pickList->setSequenceNumber(1);
        $pipeline->setMaps([$pickList]);
        $bodyWrapper = "com\\zoho\\crm\\api\\pipeline\\BodyWrapper";
        $body = new $bodyWrapper();
        $body->setPipeline([$pipeline]);
        //Call updatePipeline method that takes BodyWrapper instance as parameter
        $response = $pipelineOperations->updatePipeline($pipelineId, $body);
        if ($response != null) {
            echo ("Status code" . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof ActionWrapper) {
                $actionWrapper = $actionHandler;
                $actionResponses = $actionWrapper->getPipeline();
                foreach ($actionResponses as $actionResponse) {
                    if ($actionResponse instanceof SuccessResponse) {
                        $successResponse = $actionResponse;
                        echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                        echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                        echo ("Details: ");
                        if ($successResponse->getDetails() != null) {
                            foreach ($successResponse->getDetails() as $keyName => $keyValue) {
                                echo ($keyName . ": " . $keyValue . "\n");
                            }
                        }
                        echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
                    }
                    else if ($actionResponse instanceof APIException) {
                        $exception = $actionResponse;
                        echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                        echo ("Code: " . $exception->getCode()->getValue() . "\n");
                        echo ("Details: ");
                        if ($exception->getDetails() != null) {
                            foreach ($exception->getDetails() as $keyName => $keyValue) {
                                echo ($keyName . ": " . $keyValue . "\n");
                            }
                        }
                        echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                    }
                }
            }
            else if ($actionHandler instanceof APIException) {
                $exception = $actionHandler;
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                echo ("Code: " . $exception->getCode()->getValue() . "\n");
                if ($exception->getDetails() != null) {
                    echo ("Details: \n");
                    foreach ($exception->getDetails() as $keyName => $keyValue) {
                        echo ($keyName . ": " . $keyValue . "\n");
                    }
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
            }
        }
    }
}
$layoutId="3023222332";
$pipelineId="344320203334";
UpdatePipeline::initialize();
UpdatePipeline::updatePipeline($layoutId,$pipelineId);
