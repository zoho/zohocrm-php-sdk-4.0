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
class GetVariableGroupById
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
     * <h3> Get Variable Group By Id </h3>
     * This method is used to get the details of any variable group with group id and print the response.
     * @param variableGroupId - The ID of the VariableGroup to be obtainted
     * @throws Exception
     */
    public static function getVariableGroupById(string $variableGroupId)
    {
        $variableGroupsOperations = new VariableGroupsOperations();
        //Call getVariableGroupById method that takes variableGroupId as parameter
        $response = $variableGroupsOperations->getVariableGroupById($variableGroupId);
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
$variableGroupId="320002230002";
GetVariableGroupById::initialize();
GetVariableGroupById::getVariableGroupById($variableGroupId);
