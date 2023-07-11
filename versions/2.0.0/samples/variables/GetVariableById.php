<?php
namespace variables;
require_once "vendor/autoload.php";
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\util\Choice;
use com\zoho\crm\api\variables\APIException;
use com\zoho\crm\api\variables\BodyWrapper;
use com\zoho\crm\api\variables\VariablesOperations;
use com\zoho\crm\api\variables\GetVariableByIDParam;
class GetVariableById
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
     * <h3> Get Variable By Id </h3>
     * This method is used to get the details of any specific variable.
     * Specify the unique ID of the variable in your API request to get the data for that particular variable group.
     * @param variableId - The ID of the Variable to be obtainted
     * @throws Exception
     */
    public static function getVariableById(string $variableId)
    {
        $variablesOperations = new VariablesOperations();
        $paramInstance = new ParameterMap();
        $paramInstance->add(GetVariableByIDParam::group(), "General"); //"General"
        //Call getVariableByGroupId method that takes paramInstance and variableId as parameter
        $response = $variablesOperations->getVariableById($variableId, $paramInstance);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            $responseHandler = $response->getObject();
            if ($responseHandler instanceof BodyWrapper) {
                $responseWrapper = $responseHandler;
                $variables = $responseWrapper->getVariables();
                if ($variables != null) {
                    foreach ($variables as $variable) {
                        echo ("Variable APIName: " . $variable->getAPIName() . "\n");
                        echo ("Variable Name: " . $variable->getName() . "\n");
                        echo ("Variable Description: " . $variable->getDescription() . "\n");
                        echo ("Variable ID: " . $variable->getId() . "\n");
                        echo ("Variable Type: " . $variable->getType()->getValue() . "\n");
                        $variableGroup = $variable->getVariableGroup();
                        if ($variableGroup != null) {
                            echo ("Variable VariableGroup APIName: " . $variableGroup->getAPIName() . "\n");
                            echo ("Variable VariableGroup ID: " . $variableGroup->getId() . "\n");
                        }
                        echo ("Variable Value: " . $variable->getValue() . "\n");
                    }
                }
            }
            else if ($responseHandler instanceof APIException) {
                $exception = $responseHandler;
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
$variableId="300021200222";
GetVariableById::initialize();
GetVariableById::getVariableById($variableId);
