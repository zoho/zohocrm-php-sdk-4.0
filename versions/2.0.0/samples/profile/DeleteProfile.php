<?php
namespace profile;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\profiles\APIException;
use com\zoho\crm\api\profiles\ProfilesOperations;
use com\zoho\crm\api\profiles\DeleteProfileParam;
use com\zoho\crm\api\profiles\SuccessResponse;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class DeleteProfile
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
    public static function deleteProfile(string $profileId, string $existingprofileid)
    {
        $profilesOperations = new ProfilesOperations();
        $paramInstance = new ParameterMap();
        $paramInstance->add(DeleteProfileParam::transferTo(), $existingprofileid);
        $response = $profilesOperations->deleteProfile($profileId, $paramInstance);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof SuccessResponse) {
                $successResponse = $actionHandler;
                echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                echo ("Details: ");
                foreach ($successResponse->getDetails() as $key => $value) {
                    echo ($key . ": " . $value . "\n");
                }
                echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
            }
            else if ($actionHandler instanceof APIException) {
                $exception = $actionHandler;
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                echo ("Code: " . $exception->getCode()->getValue() . "\n");
                echo ("Details: ");
                foreach ($exception->getDetails() as $key => $value) {
                    echo ($key . ": " . $value . "\n");
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
            }
        }
    }
}
$profileId="300232200001";
$existingprofileid="32222110002";
DeleteProfile::initialize();
DeleteProfile::deleteProfile($profileId,$existingprofileid);
