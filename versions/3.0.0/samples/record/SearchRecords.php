<?php
namespace record;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\UserSignature;
use com\zoho\crm\api\HeaderMap;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\layouts\Layout;
use com\zoho\crm\api\record\APIException;
use com\zoho\crm\api\record\FileDetails;
use com\zoho\crm\api\record\LineTax;
use com\zoho\crm\api\record\Participants;
use com\zoho\crm\api\record\PricingDetails;
use com\zoho\crm\api\record\RecordOperations;
use com\zoho\crm\api\record\RecurringActivity;
use com\zoho\crm\api\record\RemindAt;
use com\zoho\crm\api\record\ResponseWrapper;
use com\zoho\crm\api\tags\Tag;
use com\zoho\crm\api\record\SearchRecordsParam;
use com\zoho\crm\api\record\{Cases, Field, Solutions, Accounts, Campaigns, Calls, Leads, Tasks, Deals, Sales_Orders, Contacts, Quotes, Events, Price_Books, Purchase_Orders, Vendors};
use com\zoho\crm\api\util\Choice;
use com\zoho\crm\api\record\Comment;
use com\zoho\crm\api\record\Consent;
use com\zoho\crm\api\attachments\Attachment;
use com\zoho\crm\api\record\ImageUpload;
use com\zoho\crm\api\users\MinifiedUser;
use com\zoho\crm\api\record\UpdateRecordHeader;
require_once "vendor/autoload.php";
class SearchRecords
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
     * <h3> Search Records</h3>
     * This method is used to search records of a module and print the response.
     * @param moduleAPIName - The API Name of the module to obtain records.
     * @throws Exception
     */
    public static function searchRecords(string $moduleAPIName)
    {
        //example, moduleAPIName = "module_api_name";
        $recordOperations = new RecordOperations();
        $paramInstance = new ParameterMap();
        $paramInstance->add(SearchRecordsParam::criteria(), "((Last_Name:starts_with:Last Name) or (Company:starts_with:fasf\\(123\\) K))");
        // $paramInstance->add(SearchRecordsParam::criteria(), "(External:in:External1)");
        $paramInstance->add(SearchRecordsParam::email(), "username@gmail.com");
        $paramInstance->add(SearchRecordsParam::phone(), "234567890");
        $paramInstance->add(SearchRecordsParam::word(), "First Name Last Name");
        $paramInstance->add(SearchRecordsParam::converted(), "both");
        $paramInstance->add(SearchRecordsParam::approved(), "both");
        $paramInstance->add(SearchRecordsParam::page(), 1);
        $paramInstance->add(SearchRecordsParam::perPage(), 2);
        $headerInstance = new HeaderMap();
        $headerInstance->add(UpdateRecordHeader::XEXTERNAL(), "Leads.External");
        //Call searchRecords method
        $response = $recordOperations->searchRecords($moduleAPIName, $paramInstance, $headerInstance);
        if ($response->isExpected()) {
            $responseHandler = $response->getObject();
            if ($responseHandler instanceof ResponseWrapper) {
                $responseWrapper = $responseHandler;
                $records = $responseWrapper->getData();
                if ($records != null) {
                    $recordClass = 'com\zoho\crm\api\record\Record';
                    foreach ($records as $record) {
                        echo ("Record ID: " . $record->getId() . "\n");
                        $createdBy = $record->getCreatedBy();
                        if ($createdBy != null) {
                            echo ("Record Created By User-ID: " . $createdBy->getId() . "\n");
                            echo ("Record Created By User-Name: " . $createdBy->getName() . "\n");
                            echo ("Record Created By User-Email: " . $createdBy->getEmail() . "\n");
                        }
                        echo ("Record CreatedTime: ");
                        print_r($record->getCreatedTime());
                        echo ("\n");
                        $modifiedBy = $record->getModifiedBy();
                        if ($modifiedBy != null) {
                            echo ("Record Modified By User-ID: " . $modifiedBy->getId() . "\n");
                            echo ("Record Modified By User-Name: " . $modifiedBy->getName() . "\n");
                            echo ("Record Modified By User-Email: " . $modifiedBy->getEmail() . "\n");
                        }
                        echo ("Record ModifiedTime: ");
                        print_r($record->getModifiedTime());
                        echo ("\n");
                        $tags = $record->getTag();
                        if ($tags != null) {
                            foreach ($tags as $tag) {
                                echo ("Record Tag Name: " . $tag->getName() . "\n");
                                echo ("Record Tag ID: " . $tag->getId() . "\n");
                            }
                        }
                        //To get particular field value
                        echo ("Record Field Value: " . $record->getKeyValue("Last_Name") . "\n"); // FieldApiName
                        echo ("Record KeyValues : \n");
                        foreach ($record->getKeyValues() as $keyName => $value) {
                            if ($value != null) {
                                if ((is_array($value) && sizeof($value) > 0) && isset($value[0])) {
                                    if ($value[0] instanceof FileDetails) {
                                        $fileDetails = $value;
                                        foreach ($fileDetails as $fileDetail) {
                                            echo ("Record FileDetails Extn: " . $fileDetail->getExtn() . "\n");
                                            echo ("Record FileDetails IsPreviewAvailable: " . $fileDetail->getIsPreviewAvailable() . "\n");
                                            echo ("Record FileDetails DownloadUrl: " . $fileDetail->getDownloadUrl() . "\n");
                                            echo ("Record FileDetails DeleteUrl: " . $fileDetail->getDeleteUrl() . "\n");
                                            echo ("Record FileDetails EntityId: " . $fileDetail->getEntityId() . "\n");
                                            echo ("Record FileDetails Mode: " . $fileDetail->getMode() . "\n");
                                            echo ("Record FileDetails OriginalSizeByte: " . $fileDetail->getOriginalSizeByte() . "\n");
                                            echo ("Record FileDetails PreviewUrl: " . $fileDetail->getPreviewUrl() . "\n");
                                            echo ("Record FileDetails FileName: " . $fileDetail->getFileName() . "\n");
                                            echo ("Record FileDetails FileId: " . $fileDetail->getFileId() . "\n");
                                            echo ("Record FileDetails AttachmentId: " . $fileDetail->getAttachmentId() . "\n");
                                            echo ("Record FileDetails FileSize: " . $fileDetail->getFileSize() . "\n");
                                            echo ("Record FileDetails CreatorId: " . $fileDetail->getCreatorId() . "\n");
                                            echo ("Record FileDetails LinkDocs: " . $fileDetail->getLinkDocs() . "\n");
                                        }
                                    } else if ($value[0] instanceof Choice) {
                                        $choice = $value;
                                        foreach ($choice as $choiceValue) {
                                            echo ("Record " . $keyName . " : " . $choiceValue->getValue() . "\n");
                                        }
                                    } else if ($value[0] instanceof Tag) {
                                        $tagList = $value;
                                        foreach ($tagList as $tag) {
                                            echo ("Record Tag Name: " . $tag->getName() . "\n");
                                            echo ("Record Tag ID: " . $tag->getId() . "\n");
                                        }
                                    } else if ($value[0] instanceof PricingDetails) {
                                        $pricingDetails = $value;
                                        foreach ($pricingDetails as $pricingDetail) {
                                            echo ("Record PricingDetails ToRange: " . $pricingDetail->getToRange() . "\n");
                                            echo ("Record PricingDetails Discount: " . $pricingDetail->getDiscount() . "\n");
                                            echo ("Record PricingDetails ID: " . $pricingDetail->getId() . "\n");
                                            echo ("Record PricingDetails FromRange: " . $pricingDetail->getFromRange() . "\n");
                                        }
                                    } else if ($value[0] instanceof Participants) {
                                        $participants = $value;
                                        foreach ($participants as $participant) {
                                            echo ("RelatedRecord Participants Name: " . $participant->getName() . "\n");
                                            echo ("RelatedRecord Participants Invited: " . $participant->getInvited() . "\n");
                                            echo ("RelatedRecord Participants ID: " . $participant->getId() . "\n");
                                            echo ("RelatedRecord Participants Type: " . $participant->getType() . "\n");
                                            echo ("RelatedRecord Participants Participant: " . $participant->getParticipant() . "\n");
                                            echo ("RelatedRecord Participants Status: " . $participant->getStatus() . "\n");
                                        }
                                    } else if ($value[0] instanceof $recordClass) {
                                        $recordList = $value;
                                        foreach ($recordList as $record1) {
                                            foreach ($record1->getKeyValues() as $key => $value1) {
                                                echo ($key . " : ");
                                                print_r($value1);
                                                echo ("\n");
                                            }
                                        }
                                    } else if ($value[0] instanceof LineTax) {
                                        $lineTaxes = $value;
                                        foreach ($lineTaxes as $lineTax) {
                                            echo ("Record ProductDetails LineTax Percentage: " . $lineTax->getPercentage() . "\n");
                                            echo ("Record ProductDetails LineTax Name: " . $lineTax->getName() . "\n");
                                            echo ("Record ProductDetails LineTax Id: " . $lineTax->getId() . "\n");
                                            echo ("Record ProductDetails LineTax Value: " . $lineTax->getValue() . "\n");
                                        }
                                    } else if ($value[0] instanceof Comment) {
                                        $comments = $value;
                                        foreach ($comments as $comment) {
                                            echo ("Record Comment CommentedBy: " . $comment->getCommentedBy() . "\n");
                                            echo ("Record Comment CommentedTime: ");
                                            print_r($comment->getCommentedTime());
                                            echo ("\n");
                                            echo ("Record Comment CommentContent: " . $comment->getCommentContent() . "\n");
                                            echo ("Record Comment Id: " . $comment->getId() . "\n");
                                        }
                                    } else if ($value[0] instanceof Attachment) {
                                        $attachments = $value;
                                        foreach ($attachments as $attachment) {
                                            $owner = $attachment->getOwner();
                                            if ($owner != null) {
                                                echo ("Record Attachment Owner User-Name: " . $owner->getName() . "\n");
                                                echo ("Record Attachment Owner User-ID: " . $owner->getId() . "\n");
                                                echo ("Record Attachment Owner User-Email: " . $owner->getEmail() . "\n");
                                            }
                                            echo ("Record Attachment Modified Time: ");
                                            print_r($attachment->getModifiedTime());
                                            echo ("\n");
                                            echo ("Record Attachment File Name: " . $attachment->getFileName() . "\n");
                                            echo ("Record Attachment Created Time: ");
                                            print_r($attachment->getCreatedTime());
                                            echo ("\n");
                                            echo ("Record Attachment File Size: " . $attachment->getSize() . "\n");
                                            $parentId = $attachment->getParentId();
                                            if ($parentId != null) {
                                                echo ("Record Attachment parent record Name: " . $parentId->getName() . "\n");
                                                echo ("Record Attachment parent record ID: " . $parentId->getId() . "\n");
                                            }
                                            echo ("Record Attachment is Editable: " . $attachment->getEditable() . "\n");
                                            echo ("Record Attachment File ID: " . $attachment->getFileId() . "\n");
                                            echo ("Record Attachment File Type: " . $attachment->getType() . "\n");
                                            echo ("Record Attachment seModule: " . $attachment->getSeModule() . "\n");
                                            $modifiedBy = $attachment->getModifiedBy();
                                            if ($modifiedBy != null) {
                                                echo ("Record Attachment Modified By User-Name: " . $modifiedBy->getName() . "\n");
                                                echo ("Record Attachment Modified By User-ID: " . $modifiedBy->getId() . "\n");
                                                echo ("Record Attachment Modified By User-Email: " . $modifiedBy->getEmail() . "\n");
                                            }
                                            echo ("Record Attachment State: " . $attachment->getState() . "\n");
                                            echo ("Record Attachment ID: " . $attachment->getId() . "\n");
                                            $createdBy = $attachment->getCreatedBy();
                                            if ($createdBy != null) {
                                                echo ("Record Attachment Created By User-Name: " . $createdBy->getName() . "\n");
                                                echo ("Record Attachment Created By User-ID: " . $createdBy->getId() . "\n");
                                                echo ("Record Attachment Created By User-Email: " . $createdBy->getEmail() . "\n");
                                            }
                                            echo ("Record Attachment LinkUrl: " . $attachment->getLinkUrl() . "\n");
                                        }
                                    } else if ($value[0] instanceof ImageUpload) {
                                        $imageUploads = $value;
                                        foreach ($imageUploads as $imageUpload) {
                                            echo ("Record " . $keyName . " Description: " . $imageUpload->getDescription() . "\n");
                                            echo ("Record " . $keyName . " PreviewId: " . $imageUpload->getPreviewId() . "\n");
                                            echo ("Record " . $keyName . " File_Name: " . $imageUpload->getFileName() . "\n");
                                            echo ("Record " . $keyName . " State: ");
                                            print_r($imageUpload->getState());
                                            echo ("\n");
                                            echo ("Record " . $keyName . " Size: " . $imageUpload->getSize() . "\n");
                                            echo ("Record " . $keyName . " SequenceNumber: " . $imageUpload->getSequenceNumber() . "\n");
                                            echo ("Record " . $keyName . " Id: " . $imageUpload->getId() . "\n");
                                            echo ("Record " . $keyName . " FileId: " . $imageUpload->getFileId() . "\n");
                                        }
                                    } else {
                                        echo ($keyName . " : ");
                                        print_r($value);
                                        echo ("\n");
                                    }
                                } else if ($value instanceof Layout) {
                                    $layout = $value;
                                    if ($layout != null) {
                                        echo ("Record " . $keyName . " ID: " . $layout->getId() . "\n");
                                        echo ("Record " . $keyName . " Name: " . $layout->getName() . "\n");
                                    }
                                } else if ($value instanceof MinifiedUser) {
                                    $user = $value;
                                    if ($user != null) {
                                        echo ("Record " . $keyName . " User-ID: " . $user->getId() . "\n");
                                        echo ("Record " . $keyName . " User-Name: " . $user->getName() . "\n");
                                        echo ("Record " . $keyName . " User-Email: " . $user->getEmail() . "\n");
                                    }
                                } else if ($value instanceof $recordClass) {
                                    $recordValue = $value;
                                    echo ("Record " . $keyName . " ID: " . $recordValue->getId() . "\n");
                                    echo ("Record " . $keyName . " Name: " . $recordValue->getKeyValue("name") . "\n");
                                } else if ($value instanceof Choice) {
                                    $choiceValue = $value;
                                    echo ("Record " . $keyName . " : " . $choiceValue->getValue() . "\n");
                                } else if ($value instanceof RemindAt) {
                                    echo ($keyName . ": " . $value->getAlarm() . "\n");
                                } else if ($value instanceof RecurringActivity) {
                                    echo ($keyName . " : RRULE" . ": " . $value->getRrule() . "\n");
                                } else if ($value instanceof Consent) {
                                    $consent = $value;
                                    echo ("Record Consent ID: " . $consent->getId());
                                    $owner = $consent->getOwner();
                                    if ($owner != null) {
                                        echo ("Record Consent Owner Name: " . $owner->getName());
                                        echo ("Record Consent Owner ID: " . $owner->getId());
                                        echo ("Record Consent Owner Email: " . $owner->getEmail());
                                    }
                                    $consentCreatedBy = $consent->getCreatedBy();
                                    if ($consentCreatedBy != null) {
                                        echo ("Record Consent CreatedBy Name: " . $consentCreatedBy->getName());
                                        echo ("Record Consent CreatedBy ID: " . $consentCreatedBy->getId());
                                        echo ("Record Consent CreatedBy Email: " . $consentCreatedBy->getEmail());
                                    }
                                    $consentModifiedBy = $consent->getModifiedBy();
                                    if ($consentModifiedBy != null) {
                                        echo ("Record Consent ModifiedBy Name: " . $consentModifiedBy->getName());
                                        echo ("Record Consent ModifiedBy ID: " . $consentModifiedBy->getId());
                                        echo ("Record Consent ModifiedBy Email: " . $consentModifiedBy->getEmail());
                                    }
                                    echo ("Record Consent CreatedTime: " . date_format($consent->getCreatedTime(), 'd-m-y-H-i-s') . "\n");
                                    echo ("Record Consent ModifiedTime: " . date_format($consent->getModifiedTime(), 'd-m-y-H-i-s') . "\n");
                                    echo ("Record Consent ContactThroughEmail: " . $consent->getContactThroughEmail() . "\n");
                                    echo ("Record Consent ContactThroughSocial: " . $consent->getContactThroughSocial() . "\n");
                                    echo ("Record Consent ContactThroughSurvey: " . $consent->getContactThroughSurvey() . "\n");
                                    echo ("Record Consent ContactThroughPhone: " . $consent->getContactThroughPhone() . "\n");
                                    echo ("Record Consent MailSentTime: " . date_format($consent->getMailSentTime(), 'd-m-y-H-i-s') . "\n");
                                    echo ("Record Consent ConsentDate: " . date_format($consent->getConsentDate(), 'd-m-y-H-i-s'). "\n");
                                    echo ("Record Consent ConsentRemarks: " . $consent->getConsentRemarks() . "\n");
                                    echo ("Record Consent ConsentThrough: " . $consent->getConsentThrough() . "\n");
                                    echo ("Record Consent DataProcessingBasis: " . $consent->getDataProcessingBasis() . "\n");
                                    //To get custom values
                                    echo ("Record Consent Lawful Reason: " . $consent->getKeyValue("Lawful_Reason"));
                                } else {
                                    echo ($keyName . " : ");
                                    print_r($value);
                                    echo ("\n");
                                }
                            } else {
                                echo ($keyName . " : ");
                                print_r($value);
                                echo ("\n");
                            }
                        }
                    }
                }
            }
            else if ($responseHandler instanceof APIException) {
                $exception = $responseHandler;
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                echo ("Code: " . $exception->getCode()->getValue() . "\n");
                echo ("Details: ");
                foreach ($exception->getDetails() as $key => $value) {
                    echo ($key . " : " . $value . "\n");
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
            }
        } else {
            print_r($response);
        }
    }
}
$moduleAPIName = "module_api_name";
SearchRecords::initialize();
SearchRecords::searchRecords($moduleAPIName);
