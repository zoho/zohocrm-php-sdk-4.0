<?php
namespace usertype;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\usertype\APIException;
use com\zoho\crm\api\usertype\BodyWrapper;
use com\zoho\crm\api\usertype\Modules;
use com\zoho\crm\api\usertype\UserType;
use com\zoho\crm\api\usertype\UserTypeOperations;
require_once "vendor/autoload.php";
class GetUserType
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
    public static function getUserType($portalName, $userTypeId)
    {
        $userTypeOperations = new UserTypeOperations($portalName);
        $response = $userTypeOperations->getUserType($userTypeId);
        if ($response != null)
        {
            echo("Status Code : " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204,304)))
            {
                echo($response->getStatusCode() == 204 ? "No Content" : "Not Modified");
                return;
            }
            if ($response->isExpected())
            {
                $responseHandler = $response->getObject();
                if ($responseHandler instanceof BodyWrapper)
                {
                    $responseWrapper = $responseHandler;
                    $userType = $responseWrapper->getUserType();
                    foreach ($userType as $userType1)
                    {
                        if ($userType1 instanceof UserType)
                        {
                            echo("UserType Default : " . $userType1->getDefault() . "\n");
                            $personalityModule = $userType1->getPersonalityModule();
                            if ($personalityModule != null)
                            {
                                echo("UserType PersonalityModule-ID: " . $personalityModule->getId() . "\n");
                                echo("UserType PersonalityModule-APIName: " . $personalityModule->getAPIName() . "\n");
                                echo("UserType PersonalityModule-PluralLabel: " . $personalityModule->getPluralLabel() . "\n");
                            }
                            echo("UserType Name: " . $userType1->getName() . "\n");
                            echo("UserType Active: " . $userType1->getActive() . "\n");
                            echo("UserType Id: " . $userType1->getId() . "\n");
                            echo("UserType NoOfUsers: " . $userType1->getNoOfUsers() . "\n");
                            $modules = $userType1->getModules();
                            if ($modules != null)
                            {
                                foreach ($modules as $module)
                                {
                                    if ($module instanceof Modules)
                                    {
                                        echo("UserType Modules PluralLabel: " . $module->getPluralLabel() . "\n");
                                        echo("UserType Modules SharedType: " . $module->getSharedType()->getValue() . "\n");
                                        echo("userType Modules APIName: " . $module->getAPIName() . "\n");
                                        $permissions = $module->getPermissions();
                                        if ($permissions != null)
                                        {
                                            echo("UserType Modules Permissions View: " . $permissions->getView()->getValue() . "\n");
                                            echo("UserType Modules Permissions Edit: " . $permissions->getEdit() . "\n");
                                            echo("UserType Modules Permissions EditSharedRecords: " . $permissions->getEditSharedRecords() . "\n");
                                            echo("UserType Modules Permissions Create: " . $permissions->getCreate() . "\n");
                                            echo("UserType Modules Permissions Delete: " . $permissions->getDelete() . "\n");
                                        }
                                        echo("UserType Modules Id: " . $module->getId() . "\n");
                                        $filters = $module->getFilters();
                                        if ($filters != null)
                                        {
                                            foreach ($filters as $filter)
                                            {
                                                echo("USerType Modules Filters APIName: " . $filter->getAPIName() . "\n");
                                                echo("UserType Modules Filters DisplayLabel: " . $filter->getDisplayLabel() . "\n");
                                                echo("UserType Modules Filters Id: " . $filter->getId() . "\n");
                                            }
                                        }
                                        $fields = $module->getFields();
                                        if ($fields != null)
                                        {
                                            foreach ($fields as $field)
                                            {
                                                echo("UserType Modules Fields APIName: " . $field->getAPIName() . "\n");
                                                echo("UserType Modules Fields ReadOnly: " . $field->getReadOnly() . "\n");
                                                echo("UserType Modules Fields Id: " . $field->getId() . "\n");
                                            }
                                        }
                                        $layouts = $module->getLayouts();
                                        if ($layouts != null)
                                        {
                                            foreach ($layouts as $layout)
                                            {
                                                echo("UserType Modules Layouts Name: " . $layout->getName() . "\n");
                                                echo("UserType Modules Layouts DisplayLabel: " . $layout->getDisplayLabel() . "\n");
                                                echo("UserType Modules Layouts ID: " . $layout->getId() . "\n");
                                            }
                                        }
                                        $views = $module->getViews();
                                        if ($views != null)
                                        {
                                            echo("UserType Modules Views DisplayLabel: " . $views->getDisplayLabel() . "\n");
                                            echo("UserType Modules Views Name: " . $views->getName() . "\n");
                                            echo("UserType Modules Views Id: " . $views->getId() . "\n");
                                            echo("UserType Modules Permissions Type: " . $views->getType() . "\n");
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                else if ($responseHandler instanceof APIException)
                {
                    $exception = $responseHandler;
                    echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo ("Code: " . $exception->getCode()->getValue() . "\n");
                    echo ("Details: ");
                    foreach ($exception->getDetails() as $key => $value)
                    {
                        echo ($key . ": " . $value . "\n");
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
                }
            }
        }
    }
}
$portalName = "PortalAPITest1";
$userTypeId = 34043499003233;
GetUserType::initialize();
GetUserType::getUserType($portalName, $userTypeId);
