<?php
namespace massconvert;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\massconvert\APIException;
use com\zoho\crm\api\massconvert\AssignTo;
use com\zoho\crm\api\massconvert\Convert;
use com\zoho\crm\api\massconvert\MassConvertOperations;
use com\zoho\crm\api\massconvert\MoveAttachmentsTo;
use com\zoho\crm\api\massconvert\RelatedModule;
use com\zoho\crm\api\massconvert\SuccessResponse;
use com\zoho\crm\api\record\Record;
use com\zoho\crm\api\record\Deals;
use com\zoho\crm\api\util\Choice;
require_once "vendor/autoload.php";
class MassConvert
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
    public static function massConvert()
    {
        $massConvertOperations = new MassConvertOperations();
        $bodyWrapper = new Convert();
        $bodyWrapper->setIds(["347706106634119"]);
        $deals = new Record();
        $deals->addFieldValue(Deals::Amount(), 10000.00);
        $deals->addFieldValue(Deals::DealName(), "V4SDK");
        $deals->addFieldValue(Deals::ClosingDate(), new \DateTime('2022-12-20'));
        $deals->addFieldValue(Deals::Pipeline(), new Choice("Standard(Standard)"));
        $deals->addFieldValue(Deals::Stage(), new Choice("Closed Won"));
        $bodyWrapper->setDeals($deals);
        $carryovertags = new MoveAttachmentsTo();
        $carryovertags->setId("34770610179");
        $carryovertags->setAPIName("Contacts");
        $bodyWrapper->setCarryOverTags([$carryovertags]);
        $related_modules = array();
        $relatedmodule = new RelatedModule();
        $relatedmodule->setAPIName("Tasks");
        $relatedmodule->setId("3477061002193");
        array_push($related_modules, $relatedmodule);
        $relatedmodule = new RelatedModule();
        $relatedmodule->setAPIName("Events");
        $relatedmodule->setId("347706102195");
        array_push($related_modules, $relatedmodule);
        $bodyWrapper->setRelatedModules($related_modules);
        $assign_to = new AssignTo();
        $assign_to->setId("347706100173021");
        $bodyWrapper->setAssignTo($assign_to);
        $move_attachments_to = new MoveAttachmentsTo();
        $move_attachments_to->setAPIName("Contacts");
        $move_attachments_to->setId("3477062179");
        $bodyWrapper->setMoveAttachmentsTo($move_attachments_to);
        $response = $massConvertOperations->massConvert($bodyWrapper);
        if ($response != null) {
            echo ("Status code : " . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof SuccessResponse) {
                $successResponse = $actionHandler;
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
            else if ($actionHandler instanceof APIException) {
                $exception = $actionHandler;
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                echo ("Code: " . $exception->getCode()->getValue() . "\n");
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
MassConvert::initialize();
MassConvert::massConvert();
