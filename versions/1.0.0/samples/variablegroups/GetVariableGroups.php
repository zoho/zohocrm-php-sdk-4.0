<?php
namespace variablegroups;
require_once "vendor/autoload.php";
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\util\Choice;
use com\zoho\crm\api\variablegroups\APIException;
use com\zoho\crm\api\variablegroups\ResponseWrapper;
use com\zoho\crm\api\variablegroups\VariableGroupsOperations;
class GetVariableGroups
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
     * <h3> Get Variable Groups </h3>
     * This method is used to get the details of any variable group and print the response.
     * @throws Exception
     */
    public static function getVariableGroups()
    {
        $variableGroupsOperations = new VariableGroupsOperations();
        //Call getVariableGroups method
        $response = $variableGroupsOperations->getVariableGroups();
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            $responseHandler = $response->getObject();
            if ($responseHandler instanceof ResponseWrapper) {
                $responseWrapper = $responseHandler;
                $variableGroups = $responseWrapper->getVariableGroups();
                if ($variableGroups != null) {
                    foreach ($variableGroups as $variableGroup) {
                        echo ("VariableGroup DisplayLabel: " . $variableGroup->getDisplayLabel() . "\n");
                        echo ("VariableGroup APIName: " . $variableGroup->getAPIName() . "\n");
                        echo ("VariableGroup Name: " . $variableGroup->getName() . "\n");
                        echo ("VariableGroup Description: " . $variableGroup->getDescription() . "\n");
                        echo ("VariableGroup ID: " . $variableGroup->getId() . "\n");
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
GetVariableGroups::initialize();
GetVariableGroups::getVariableGroups();
