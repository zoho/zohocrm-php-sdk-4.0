<?php
namespace scoringrules;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\scoringrules\APIException;
use com\zoho\crm\api\scoringrules\GetEntityScoreRecordsParam;
use com\zoho\crm\api\scoringrules\ScoringRulesOperations;
use com\zoho\crm\api\scoringrules\EntityResponseWrapper;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class GetEntityScoreRecords
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
    public static function getEntityScoreRecords()
    {
        $scoringRulesOperations = new ScoringRulesOperations();
        $paramInstance = new ParameterMap();
        $paramInstance->add(GetEntityScoreRecordsParam::fields(), "Positive_Score");
        // Call getContactRoles method
        $response = $scoringRulesOperations->getEntityScoreRecords($paramInstance);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            $responseHandler = $response->getObject();
            if ($responseHandler instanceof EntityResponseWrapper) {
                $responseWrapper = $responseHandler;
                $entityScores = $responseWrapper->getData();
                foreach ($entityScores as $entityScore) {
                    echo ("EntityScore Id: " . $entityScore->getId() . "\n");
                    echo ("EntityScore Positive_Score: " . $entityScore->getPositiveScore() . "\n");
                }
                $info = $responseWrapper->getInfo();
                if ($info != null) {
                    if ($info->getPerPage() != null) {
                        echo ("Info PerPage: " . $info->getPerPage() . "\n");
                    }
                    if ($info->getCount() != null) {
                        echo ("Info Count: " . $info->getCount() . "\n");
                    }
                    if ($info->getPage() != null) {
                        echo ("Info Page: " . $info->getPage() . "\n");
                    }
                    if ($info->getMoreRecords() != null) {
                        echo ("Info MoreRecords: " . $info->getMoreRecords() . "\n");
                    }
                }
            }
            else if ($responseHandler instanceof APIException) {
                $exception = $responseHandler;
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                echo ("Code: " . $exception->getCode()->getValue() . "\n");
                echo ("Details: ");
                if ($exception->getDetails() != null) {
                    foreach ($exception->getDetails() as $keyName => $keyValue) {
                        echo ($keyName . ": " . $keyValue . "\n");
                    }
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
            }
        }
    }
}
GetEntityScoreRecords::initialize();
GetEntityScoreRecords::getEntityScoreRecords();
