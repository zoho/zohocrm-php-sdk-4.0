<?php
namespace usersterritories;
require_once "vendor/autoload.php";
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\usersterritories\APIException;
use com\zoho\crm\api\usersterritories\BodyWrapper;
use com\zoho\crm\api\usersterritories\UsersTerritoriesOperations;
use com\zoho\crm\api\usersterritories\GetTerritoriesofUserParam;
use com\zoho\crm\api\util\Choice;

class GetTerritoriesOfUser
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
    public static function getTerritoriesOfUser($userId)
    {
        $usersTerritoriesOperations = new UsersTerritoriesOperations($userId);
        $paramInstance = new ParameterMap();
        $paramInstance->add(GetTerritoriesofUserParam::page(), 1);
        $paramInstance->add(GetTerritoriesofUserParam::perPage(), 1);
        // Call getTerritoriesOfUser method that takes ParameterMap instance as parameters
        $response = $usersTerritoriesOperations->getTerritoriesOfUser($paramInstance);
        if ($response != null) {
            echo ("Status Code: " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            $responseHandler = $response->getObject();
            if ($responseHandler instanceof BodyWrapper) {
                $responseWrapper = $responseHandler;
                $usersTerritory = $responseWrapper->getTerritories();
                foreach ($usersTerritory as $territory) {
                    echo ("User Territory ID: " . $territory->getId() . "\n");
                    $manager = $territory->getManager();
                    if ($manager != null) {
                        echo ("User Territory Manager Name: " . $manager->getName() . "\n");
                        echo ("User Territory Manager ID: " . $manager->getId() . "\n");
                    }
                    $reportingTo = $territory->getReportingTo();
                    if ($reportingTo != null) {
                        echo ("User Territory ReportingTo Name: " . $reportingTo->getName() . "\n");
                        echo ("User Territory ReportingTo ID: " . $reportingTo->getId() . "\n");
                    }
                    echo ("User Territory Name: " . $territory->getName() . "\n");
                }
                $info = $responseWrapper->getInfo();
                if ($info != null) {
                    if ($info->getPerPage() != null) {
                        echo ("User Info PerPage: " . $info->getPerPage() . "\n");
                    }
                    if ($info->getCount() != null) {
                        echo ("User Info Count: " . $info->getCount() . "\n");
                    }
                    if ($info->getPage() != null) {
                        echo ("User Info Page: " . $info->getPage() . "\n");
                    }
                    if ($info->getMoreRecords() != null) {
                        echo ("User Info MoreRecords: " . $info->getMoreRecords() . "\n");
                    }
                }
            }
            else if ($responseHandler instanceof APIException) {
                $exception = $responseHandler;
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
$userId="3290329002";
GetTerritoriesOfUser::initialize();
GetTerritoriesOfUser::getTerritoriesOfUser($userId);
