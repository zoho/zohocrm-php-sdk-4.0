<?php
namespace notes;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\notes\APIException;
use com\zoho\crm\api\notes\ActionWrapper;
use com\zoho\crm\api\notes\NotesOperations;
use com\zoho\crm\api\notes\DeleteNotesParam;
use com\zoho\crm\api\notes\SuccessResponse;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class DeleteNotes
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
     * This method is used to delete notes in bulk and print the response.
     * @param notesID - The ID of the record to delete notes
     * @throws Exception
     */
    public static function deleteNotes(array $notesID)
    {
        $notesOperations = new NotesOperations();
        $paramInstance = new ParameterMap();
        foreach ($notesID as $id) {
            $paramInstance->add(DeleteNotesParam::ids(), $id);
        }
        //Call deleteNotes method that takes paramInstance as parameter
        $response = $notesOperations->deleteNotes($paramInstance);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof ActionWrapper) {
                $actionWrapper = $actionHandler;
                $actionResponses = $actionWrapper->getData();
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
$notesID=array("32222300002");
DeleteNotes::initialize();
DeleteNotes::deleteNotes($notesID);
