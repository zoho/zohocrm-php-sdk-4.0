<?php
namespace modules;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\modules\APIException;
use com\zoho\crm\api\modules\ActionWrapper;
use com\zoho\crm\api\modules\BodyWrapper;
use com\zoho\crm\api\modules\ModulesOperations;
use com\zoho\crm\api\modules\SuccessResponse;
use com\zoho\crm\api\profiles\Profile;
use com\zoho\crm\api\modules\ModuleMeta;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class UpdateModuleByAPIName
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
     * <h3> Update Module By APIName </h3>
     * This method is used to update module details using module APIName and print the response.
     * @param moduleAPIName The API Name of the module to obtain metadata
     * @throws Exception
     */
    public static function updateModuleByAPIName(string $moduleAPIName)
    {
        //example, apiName = "module_api_name";
        $moduleOperations = new ModulesOperations();
        $modules = array();
        $profiles = array();
        $profile = new Profile();
        $profile->setId("34770610026014");
        $profile->setDelete(true);
        array_push($profiles, $profile);
        $module = new ModuleMeta();
        $module->setProfiles($profiles);
        array_push($modules, $module);
        $request = new BodyWrapper();
        $request->setModules($modules);
        //Call updateModuleByAPIName method that takes BodyWrapper instance and moduleAPIName as parameter
        $response = $moduleOperations->updateModuleByAPIName($moduleAPIName, $request);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof ActionWrapper) {
                $actionWrapper = $actionHandler;
                $actionResponses = $actionWrapper->getModules();
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
$moduleAPIName="leads";
UpdateModuleByAPIName::initialize();
UpdateModuleByAPIName::updateModuleByAPIName($moduleAPIName);
