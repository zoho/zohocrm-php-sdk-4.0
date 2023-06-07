<?php
namespace variables;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\util\Choice;
use com\zoho\crm\api\variables\APIException;
use com\zoho\crm\api\variables\ActionWrapper;
use com\zoho\crm\api\variables\BodyWrapper;
use com\zoho\crm\api\variables\SuccessResponse;
use com\zoho\crm\api\variables\VariablesOperations;
class UpdateVariables
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
     *  <h3> Update Variables </h3>
     * This method is used to update details of variables in CRM and print the response.
     * @throws Exception
     */
    public static function updateVariables()
    {
        $variablesOperations = new VariablesOperations();
        $request = new BodyWrapper();
        //List of Variable instances
        $variableList = array();
        $variableClass = 'com\zoho\crm\api\variables\Variable';
        $variable1 = new $variableClass();
        $variable1->setId("34770613485001");
        $variable1->setValue("4763");
        $variable1->setAPIName("er");
        array_push($variableList, $variable1);
        $variable1 = new $variableClass();
        $variable1->setId("347706112448013");
        $variable1->setAPIName("eer");
        $variable1->setDescription("This is a new description");
        array_push($variableList, $variable1);
        $variable1 = new $variableClass();
        $variable1->setId("34770617444012");
        $variable1->setAPIName("re");
        array_push($variableList, $variable1);
        $request->setVariables($variableList);
        //Call updateVariables method that takes BodyWrapper class instance as parameter
        $response = $variablesOperations->updateVariables($request);
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
                        echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
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
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
            }
        }
    }
}
UpdateVariables::initialize();
UpdateVariables::updateVariables();
