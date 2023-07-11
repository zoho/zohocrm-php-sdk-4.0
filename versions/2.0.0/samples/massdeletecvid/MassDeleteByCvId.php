<?php
namespace massdeletecvid;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\massdeletecvid\APIException;
use com\zoho\crm\api\massdeletecvid\ActionWrapper;
use com\zoho\crm\api\massdeletecvid\BodyWrapper;
use com\zoho\crm\api\massdeletecvid\MassDeleteCvidOperations;
use com\zoho\crm\api\massdeletecvid\MassDeleteScheduled;
use com\zoho\crm\api\massdeletecvid\RecordDeleted;
use com\zoho\crm\api\massdeletecvid\Territory;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class MassDeleteByCvId
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
    public static function massDeleteByCvid(string $moduleAPIName)
    {
        $massDeleteCvidOperations = new MassDeleteCvidOperations($moduleAPIName);
        $bodyWrapper = new BodyWrapper();
        $bodyWrapper->setCvid("34770610087501");
        $bodyWrapper->setIds(["347706106899044"]);
        $territory = new Territory();
        $territory->setId("0");
        $territory->setIncludeChild(true);
        // $bodyWrapper->setTerritory($territory);
        $response = $massDeleteCvidOperations->massDeleteByCvid($bodyWrapper);
        if ($response != null) {
            echo ("Status code : " . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof ActionWrapper) {
                $actionWrapper = $actionHandler;
                $actionResponses = $actionWrapper->getData();
                if ($actionResponses != null) {
                    foreach ($actionResponses as $actionResponse) {
                        if ($actionResponse instanceof RecordDeleted) {
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
                        else if ($actionResponse instanceof MassDeleteScheduled) {
                            $successResponse = $actionResponse;
                            echo ("Status: " .  $successResponse->getStatus()->getValue() . "\n");
                            echo ("Code: " .  $successResponse->getCode()->getValue() . "\n");
                            echo ("Details: ");
                            if ($successResponse->getDetails() != null) {
                                foreach ($successResponse->getDetails() as $keyName => $keyValue) {
                                    echo ($keyName . ": ");
                                    print_r($keyValue);
                                    echo ("\n");
                                }
                            }
                            echo ("Message: " .  $successResponse->getMessage()->getValue() . "\n");
                        }
                        else if ($actionResponse instanceof APIException) {
                            $exception = $actionResponse;
                            echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                            echo ("Code: " .  $exception->getCode()->getValue() . "\n");
                            echo ("Details: ");
                            if ($exception->getDetails() != null) {
                                foreach ($exception->getDetails() as $keyName => $keyValue) {
                                    echo ($keyName . ": ");
                                    print_r($keyValue);
                                    echo ("\n");
                                }
                            }
                            echo ("Message: " .  $exception->getMessage() . "\n");
                        }
                    }
                }
            }
            else if ($actionHandler instanceof APIException) {
                $exception = $actionHandler;
                echo ("Status: " . $exception->getStatus()->getValue() . "\n" . "\n");
                echo ("Code: " . $exception->getCode()->getValue() . "\n" . "\n");
                echo ("Details: ");
                if ($exception->getDetails() != null) {
                    foreach ($exception->getDetails() as $keyName => $keyValue) {
                        echo ($keyName . ": ");
                        print_r($keyValue);
                        echo ("\n");
                    }
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
            }
        }
    }
}
$moduleAPIName="leads";
MassDeleteByCvId::initialize();
MassDeleteByCvId::massDeleteByCvid($moduleAPIName);
