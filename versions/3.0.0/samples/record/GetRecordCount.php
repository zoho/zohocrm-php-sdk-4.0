<?php
namespace record;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\UserSignature;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\record\APIException;
use com\zoho\crm\api\record\RecordOperations;
use com\zoho\crm\api\record\{Cases, Field, Solutions, Accounts, Campaigns, Calls, Leads, Tasks, Deals, Sales_Orders, Contacts, Quotes, Events, Price_Books, Purchase_Orders, Vendors};
use com\zoho\crm\api\record\RecordCountParam;
use com\zoho\crm\api\record\CountWrapper;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class GetRecordCount
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
    public static function getRecordCount()
    {
        $recordOperations = new RecordOperations();
        $moduleAPIName = "Leads";
        $paramInstance = new ParameterMap();
        $paramInstance->add(RecordCountParam::phone(), "(990) 000-0000");
        $response = $recordOperations->recordCount($moduleAPIName, $paramInstance);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            if ($response->isExpected()) {
                $countHandler = $response->getObject();
                if ($countHandler instanceof CountWrapper) {
                    $countWrapper = $countHandler;
                    echo ("Record Count: " . $countWrapper->getCount() . "\n");
                }
                else if ($countHandler instanceof APIException) {
                    $exception = $countHandler;
                    echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo ("Code: " . $exception->getCode()->getValue() . "\n");
                    echo ("Details: ");
                    foreach ($exception->getDetails() as $key => $value) {
                        echo ($key . " : " . $value . "\n");
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                }
            } else { //If response is not as expected
                print_r($response);
            }
        }
    }
}
GetRecordCount::initialize();
GetRecordCount::getRecordCount();
