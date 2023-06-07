<?php
namespace variables;
require_once "vendor/autoload.php";
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\variables\VariableGroup;
use com\zoho\crm\api\variables\APIException;
use com\zoho\crm\api\variables\ActionWrapper;
use com\zoho\crm\api\variables\BodyWrapper;
use com\zoho\crm\api\variables\SuccessResponse;
use com\zoho\crm\api\variables\VariablesOperations;
use com\zoho\crm\api\util\Choice;
class CreateVariables
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
     * <h3> Create Variables </h3>
     * This method is used to create a new variable in CRM and print the response.
     * @throws Exception
     */
    public static function createVariables()
    {
        $variablesOperations = new VariablesOperations();
        $request = new BodyWrapper();
        //List of Variable instances
        $variableList = array();
        $variableClass = 'com\zoho\crm\api\variables\Variable';
        $variable1 = new $variableClass();
        $variable1->setName("Variable66143e423");
        $variable1->setAPIName("Variable66143e423");
        $variableGroup = new VariableGroup();
        $variableGroup->setName("General");
        $variableGroup->setId("347706103089001");
        $variable1->setVariableGroup($variableGroup);
        $variable1->setType(new Choice("integer"));
        $variable1->setValue("42");
        $variable1->setDescription("This denotes variable 5 description");
        array_push($variableList, $variable1);
        $variable1 = new $variableClass();
        $variable1->setName("Variable66143e42");
        $variable1->setAPIName("Variable66143e42");
        $variableGroup = new VariableGroup();
        $variableGroup->setName("General");
        $variable1->setVariableGroup($variableGroup);
        $variable1->setType(new Choice("text"));
        $variable1->setValue("H2ello");
        $variable1->setDescription("This denotes variable 6 description");
        array_push($variableList, $variable1);
        $request->setVariables($variableList);
        //Call createVariables method that takes BodyWrapper instance as parameter
        $response = $variablesOperations->createVariable($request);
        if ($response != null) {
            echo ("Status Code: " . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof ActionWrapper) {
                $actionWrapper = $actionHandler;
                $actionResponses = $actionWrapper->getVariables();
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
CreateVariables::initialize();
CreateVariables::createVariables();
