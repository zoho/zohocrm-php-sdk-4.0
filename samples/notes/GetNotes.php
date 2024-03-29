<?php
namespace notes;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\HeaderMap;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\notes\APIException;
use com\zoho\crm\api\notes\NotesOperations;
use com\zoho\crm\api\notes\GetNotesParam;
use com\zoho\crm\api\notes\ResponseWrapper;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class GetNotes
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
     * <h3> Get Notes </h3>
     * This method is used to get the list of notes and print the response.
     * @throws Exception
     */
    public static function getNotes()
    {
        $notesOperations = new NotesOperations();
        $paramInstance = new ParameterMap();
        $paramInstance->add(GetNotesParam::page(), 1);
        //$paramInstance->add(GetNotesParam::perPage(), 1);
        $paramInstance->add(GetNotesParam::fields(), "id");
        $headerInstance = new HeaderMap();
        // $headerInstance->add(GetNotesHeader::IfModifiedSince(), date_create("2019-05-07T15:32:24")->setTimezone(new \DateTimeZone(date_default_timezone_get())));
        //Call getNotes method that takes paramInstance and headerInstance as parameters
        $response = $notesOperations->getNotes($paramInstance, $headerInstance);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            $responseHandler = $response->getObject();
            if ($responseHandler instanceof ResponseWrapper) {
                $responseWrapper = $responseHandler;
                $notes = $responseWrapper->getData();
                foreach ($notes as $note) {
                    $owner = $note->getOwner();
                    if ($owner != null) {
                        echo ("Note Owner User-Name: " . $owner->getName() . "\n");
                        echo ("Note Owner User-ID: " . $owner->getId() . "\n");
                        echo ("Note Owner Email: " . $owner->getEmail() . "\n");
                    }
                    echo ("Note ModifiedTime: ");
                    print_r($note->getModifiedTime());
                    echo ("\n");
                    $attachments = $note->getAttachments();
                    if ($attachments != null) {
                        foreach ($attachments as $attachment) {
                            self::printAttachment($attachment);
                        }
                    }
                    echo ("Note CreatedTime: ");
                    print_r($note->getCreatedTime());
                    echo ("\n");
                    $parentId = $note->getParentId();
                    if ($parentId != null) {
                        echo ("Note parent record Name: ");
                        print_r($parentId->getKeyValue("name"));
                        echo ("\n");
                        echo ("Note parent record ID: " . $parentId->getId() . "\n");
                    }
                    echo ("Note Editable: ");
                    print_r($note->getEditable());
                    echo ("\n");
                    echo ("Note SharingPermission: " . $note->getSharingPermission() . "\n");
                    echo ("Note SeModule: " . $note->getSeModule() . "\n");
                    echo ("Note IsSharedToClient: ");
                    print_r($note->getIsSharedToClient());
                    echo ("\n");
                    $modifiedBy = $note->getModifiedBy();
                    if ($modifiedBy != null) {
                        echo ("Note Modified By User-Name: " . $modifiedBy->getName() . "\n");
                        echo ("Note Modified By User-ID: " . $modifiedBy->getId() . "\n");
                        echo ("Note Modified By User-Email: " . $modifiedBy->getEmail() . "\n");
                    }
                    echo ("Note Size: ");
                    print_r($note->getSize());
                    echo ("\n");
                    echo ("Note State: " . $note->getState() . "\n");
                    echo ("Note VoiceNote: ");
                    print_r($note->getVoiceNote());
                    echo ("\n");
                    echo ("Note Id: " . $note->getId() . "\n");
                    $createdBy = $note->getCreatedBy();
                    if ($createdBy != null) {
                        echo ("Note Created By User-Name: " . $createdBy->getName() . "\n");
                        echo ("Note Created By User-ID: " . $createdBy->getId() . "\n");
                        echo ("Note Created By User-Email: " . $createdBy->getEmail() . "\n");
                    }
                    echo ("Note NoteTitle: " . $note->getNoteTitle() . "\n");
                    echo ("Note NoteContent: " . $note->getNoteContent() . "\n");
                }
                $info = $responseWrapper->getInfo();
                if ($info != null) {
                    echo ("Note Info PerPage: " . $info->getPerPage() . "\n");
                    echo ("Note Info Count: " . $info->getCount() . "\n");
                    echo ("Note Info Page: " . $info->getPage() . "\n");
                    echo ("Note Info MoreRecords: ");
                    print_r($info->getMoreRecords());
                    echo ("\n");
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
    private static function printAttachment($attachment)
    {
        $owner = $attachment->getOwner();
        if ($owner != null) {
            echo ("Note Attachment Owner User-Name: " . $owner->getName() . "\n");
            echo ("Note Attachment Owner User-ID: " . $owner->getId() . "\n");
            echo ("Note Attachment Owner User-Email: " . $owner->getEmail() . "\n");
        }
        echo ("Note Attachment Modified Time: ");
        print_r($attachment->getModifiedTime());
        echo ("\n");
        echo ("Note Attachment File Name: " . $attachment->getFileName() . "\n");
        echo ("Note Attachment Created Time: ");
        print_r($attachment->getCreatedTime());
        echo ("\n");
        echo ("Note Attachment File Size: " . $attachment->getSize() . "\n");
        $parentId = $attachment->getParentId();
        if ($parentId != null) {
            echo ("Note Attachment parent record Name: " . $parentId->getName() . "\n");
            echo ("Note Attachment parent record ID: " . $parentId->getId() . "\n");
        }
        echo ("Note Attachment is Editable: " . $attachment->getEditable() . "\n");
        echo ("Note Attachment SharingPermission: " . $attachment->getSharingPermission() . "\n");
        echo ("Note Attachment File ID: " . $attachment->getFileId() . "\n");
        echo ("Note Attachment File Type: " . $attachment->getType() . "\n");
        echo ("Note Attachment seModule: " . $attachment->getSeModule() . "\n");
        $modifiedBy = $attachment->getModifiedBy();
        if ($modifiedBy != null) {
            echo ("Note Attachment Modified By User-Name: " . $modifiedBy->getName() . "\n");
            echo ("Note Attachment Modified By User-ID: " . $modifiedBy->getId() . "\n");
            echo ("Note Attachment Modified By User-Email: " . $modifiedBy->getEmail() . "\n");
        }
        echo ("Note Attachment Type: " . $attachment->getAttachmentType() . "\n");
        echo ("Note Attachment State: " . $attachment->getState() . "\n");
        echo ("Note Attachment ID: " . $attachment->getId() . "\n");
        $createdBy = $attachment->getCreatedBy();
        if ($createdBy != null) {
            echo ("Note Attachment Created By User-Name: " . $createdBy->getName() . "\n");
            echo ("Note Attachment Created By User-ID: " . $createdBy->getId() . "\n");
            echo ("Note Attachment Created By User-Email: " . $createdBy->getEmail() . "\n");
        }
        echo ("Note Attachment LinkUrl: " . $attachment->getLinkUrl() . "\n");
    }
}
GetNotes::initialize();
GetNotes::getNotes();
