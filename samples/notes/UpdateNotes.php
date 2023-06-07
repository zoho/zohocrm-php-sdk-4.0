<?php
namespace notes;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\notes\APIException;
use com\zoho\crm\api\notes\ActionWrapper;
use com\zoho\crm\api\notes\BodyWrapper;
use com\zoho\crm\api\notes\NotesOperations;
use com\zoho\crm\api\notes\SuccessResponse;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class UpdateNotes
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
     * <h3> Update Notes</h3>
     * This method is used to update an existing note and print the response.
     * @throws Exception
     */
    public static function updateNotes()
    {
        $notesOperations = new NotesOperations();
        $bodyWrapper = new BodyWrapper();
        //List of Note instances
        $notes = array();
        $noteClass = 'com\zoho\crm\api\notes\Note';
        $note = new $noteClass();
        $note->setId("347706116941005");
        $note->setNoteTitle("Contacted12");
        $note->setNoteContent("Need to do further tracking12");
        //Add Note instance to the list
        array_push($notes, $note);
        $note = new $noteClass();
        $note->setId("34770615121005");
        $note->setNoteTitle("Contacted13");
        $note->setNoteContent("Need to do further tracking13");
        //Add Note instance to the list
        array_push($notes, $note);
        $bodyWrapper->setData($notes);
        //Call updateNotes method that takes BodyWrapper instance as parameter
        $response = $notesOperations->updateNotes($bodyWrapper);
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
                                echo ($keyName . " : ");
                                print_r($keyValue);
                                echo ("\n");
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
UpdateNotes::initialize();
UpdateNotes::updateNotes();
