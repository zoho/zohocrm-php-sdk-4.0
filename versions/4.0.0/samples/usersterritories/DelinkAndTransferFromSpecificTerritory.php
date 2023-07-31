<?php
namespace usersterritories;
require_once "vendor/autoload.php";
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\usersterritories\APIException;
use com\zoho\crm\api\usersterritories\SuccessResponse;
use com\zoho\crm\api\usersterritories\TransferActionWrapper;
use com\zoho\crm\api\usersterritories\TransferAndDelink;
use com\zoho\crm\api\usersterritories\TransferToUser;
use com\zoho\crm\api\usersterritories\TransferWrapper;
use com\zoho\crm\api\usersterritories\UsersTerritoriesOperations;
use com\zoho\crm\api\util\Choice;

class DelinkAndTransferFromSpecificTerritory
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
    public static function delinkAndTransferFromSpecificTerritory($userId, $territoryId)
    {
        $usersTerritoriesOperations = new UsersTerritoriesOperations($userId);
        $request = new TransferWrapper();
        // List of User instances
        $userTerritoryList = [];
        $territory = new TransferAndDelink();
        $territory->setId("3477061003051397");
        $transferToUser = new TransferToUser();
        $transferToUser->setId("3477061013767065");
        $territory->setTransferToUser($transferToUser);
        array_push($userTerritoryList, $territory);
        $request->setTransferAndDelink($userTerritoryList);
        // Call delinkAndTransferSpecificTerritoryOfUser method that takes territoryId and TransferBodyWrapper instance as parameter
        $response = $usersTerritoriesOperations->delinkAndTransferFromSpecificTerritory($territoryId, $request);
        if ($response != null) {
            echo ("Status Code: " . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof TransferActionWrapper) {
                $responseWrapper = $actionHandler;
                $actionResponses = $responseWrapper->getTransferAndDelink();
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
$userId="3200022322223";
$territoryId="31000021";
DelinkAndTransferFromSpecificTerritory::initialize();
DelinkAndTransferFromSpecificTerritory::delinkAndTransferFromSpecificTerritory($userId,$territoryId);
