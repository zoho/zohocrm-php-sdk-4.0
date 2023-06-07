<?php
namespace scoringrules;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\scoringrules\ActionWrapper;
use com\zoho\crm\api\scoringrules\APIException;
use com\zoho\crm\api\scoringrules\ScoringRulesOperations;
use com\zoho\crm\api\scoringrules\BodyWrapper;
use com\zoho\crm\api\modules\Module;
use com\zoho\crm\api\scoringrules\Layout;
use com\zoho\crm\api\scoringrules\FieldRule;
use com\zoho\crm\api\scoringrules\Criteria;
use com\zoho\crm\api\fields\MinifiedFields;
use com\zoho\crm\api\util\Choice;
use com\zoho\crm\api\scoringrules\SuccessResponse;
require_once "vendor/autoload.php";
class CreateScoringRules
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
    public static function createScoringRules()
    {
        $scoringRulesOperations = new ScoringRulesOperations();
        $bodyWrapper = new BodyWrapper();
        // List of ScoringRule instances
        $scoringRules = [];
        $scoringRuleClass = 'com\zoho\crm\api\scoringrules\ScoringRule';
        $scoringRule = new $scoringRuleClass();
        $scoringRule->setName("Rule 13");
        $scoringRule->setDescription("Rule for Module Leads");
        $module = new Module();
        $module->setAPIName("Leads");
        $module->setId("347706102175");
        $scoringRule->setModule($module);
        $layout = new Layout();
        $layout->setAPIName("Standard");
        $layout->setId("347706101055");
        $scoringRule->setLayout($layout);
        $scoringRule->setActive(false);
        $fieldRules = [];
        $fieldRule = new FieldRule();
        $fieldRule->setScore(10);
        $criteria = new Criteria();
        $criteria->setGroupOperator(new Choice("or"));
        $group = [];
        $criteria1 = new Criteria();
        $field1 = new MinifiedFields();
        $field1->setAPIName("Company");
        $criteria1->setField($field1);
        $criteria1->setComparator(new Choice("equal"));
        $criteria1->setValue("zoho");
        array_push($group, $criteria1);
        $criteria2 = new Criteria();
        $field1 = new MinifiedFields();
        $field1->setAPIName("Designation");
        $criteria2->setField($field1);
        $criteria2->setComparator(new Choice("equal"));
        $criteria2->setValue("review");
        array_push($group, $criteria2);
        $criteria->setGroup($group);
        $fieldRule->setCriteria($criteria);
        array_push($fieldRules, $fieldRule);
        $scoringRule->setFieldRules($fieldRules);
        array_push($scoringRules, $scoringRule);
        $bodyWrapper->setScoringRules($scoringRules);
        // Call createScoringRules method that takes BodyWrapper instance as parameter
        $response = $scoringRulesOperations->createScoringRules($bodyWrapper);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof ActionWrapper) {
                $actionWrapper = $actionHandler;
                $actionResponses = $actionWrapper->getScoringRules();
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
CreateScoringRules::initialize();
CreateScoringRules::createScoringRules();
