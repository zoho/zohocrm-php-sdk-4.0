<?php

namespace com\zoho\crm\sample\emailrelatedrecords;

use com\zoho\crm\api\emailrelatedrecords\APIException;
use com\zoho\crm\api\emailrelatedrecords\EmailRelatedRecordsOperations;
use com\zoho\crm\api\emailrelatedrecords\ResponseWrapper;

class EmailRelatedRecords
{
    public static function getRelatedEmail()
    {
        // Get instance of EmailTemplatesOperations Class
        $moduleAPIName = "Leads";

        $emailTemplatesOperations = new EmailRelatedRecordsOperations("347706116799066", $moduleAPIName, null, null);

        // Call getEmailTemplates method
        $response = $emailTemplatesOperations->getRelatedEmail();
        if ($response != null) {
            //Get the status code from response
            echo ("Status code : " . $response->getStatusCode() . "\n");

            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

                return;
            }

            $responseHandler = $response->getObject();

            if ($responseHandler instanceof ResponseWrapper) {
                // Get the received ResponseWrapper instance
                $responseWrapper = $responseHandler;

                // Get the list of obtained EmailTemplate instances
                $emailTemplates = $responseWrapper->getEmails();

                foreach ($emailTemplates as $emailTemplate) {
                    $userDetails = $emailTemplate->getCc();

                    if ($userDetails != null) {
                        foreach ($userDetails as $userDetail) {
                            echo ("EmailRelatedRecords User Email: " . $userDetail->getEmail() . "\n");

                            echo ("EmailRelatedRecords User Name: " . $userDetail->getUserName() . "\n");
                        }
                    }

                    echo ("EmailRelatedRecords Summary: " . $emailTemplate->getSummary() . "\n");

                    $owner = $emailTemplate->getOwner();

                    if ($owner != null) {
                        echo ("EmailRelatedRecords User ID: " . $owner->getId() . "\n");

                        echo ("EmailRelatedRecords User Name: " . $owner->getName() . "\n");
                    }

                    echo ("EmailRelatedRecords Read: " . $emailTemplate->getRead() . "\n");

                    echo ("EmailRelatedRecords Sent: " . $emailTemplate->getSent() . "\n");

                    echo ("EmailRelatedRecords Subject: " . $emailTemplate->getSubject() . "\n");

                    echo ("EmailRelatedRecords Intent: " . $emailTemplate->getIntent() . "\n");

                    echo ("EmailRelatedRecords SentimentInfo: " . $emailTemplate->getSentimentInfo() . "\n");

                    echo ("EmailRelatedRecords MessageId: " . $emailTemplate->getMessageId() . "\n");

                    echo ("EmailRelatedRecords MessageId: " . $emailTemplate->getSource() . "\n");

                    $linkedRecord = $emailTemplate->getLinkedRecord();

                    if ($linkedRecord != null) {
                        echo ("EmailRelatedRecords LinkedRecord id : " . $linkedRecord->getId() . "\n");

                        $module = $linkedRecord->getModule();

                        if ($module != null) {
                            echo ("EmailRelatedRecords LinkedRecord Module APIName : " . $module->getAPIName() . "\n");

                            echo ("EmailRelatedRecords LinkedRecord Module Id : " . $module->getId() . "\n");
                        }
                    }

                    echo ("EmailRelatedRecords Emotion: " . $emailTemplate->getEmotion() . "\n");

                    $from = $emailTemplate->getFrom();

                    if ($from != null) {
                        echo ("EmailRelatedRecords From User Email: " . $from->getEmail() . "\n");

                        echo ("EmailRelatedRecords From User Name: " . $from->getUserName() . "\n");
                    }

                    $toUserDetails = $emailTemplate->getTo();

                    if ($toUserDetails != null) {
                        foreach ($toUserDetails as $userDetail) {
                            echo ("EmailRelatedRecords User Email: " . $userDetail->getEmail() . "\n");

                            echo ("EmailRelatedRecords User Name: " . $userDetail->getUserName() . "\n");
                        }
                    }

                    echo ("EmailRelatedRecords Time: ");
                    print_r($emailTemplate->getTime());
                    echo ("\n");

                    $status = $emailTemplate->getStatus();

                    if ($status != null) {
                        foreach ($status as $status1) {
                            echo ("EmailRelatedRecords Status Type: " . $status1->getType() . "\n");

                            echo ("EmailRelatedRecords Status Name: " . $status1->getBouncedTime() . "\n");

                            echo ("EmailRelatedRecords Status Name: " . $status1->getBouncedReason() . "\n");
                        }
                    }
                }

                // Get the Object obtained Info instance
                $info = $responseWrapper->getInfo();

                // Check if info is not null
                if ($info != null) {
                    if ($info->getCount() != null) {
                        // Get the Count of the Info
                        echo ("Record Info Count: " . $info->getCount() . "\n");
                    }

                    if ($info->getNextIndex() != null) {
                        echo ("Record Info NextIndex: " . $info->getNextIndex() . "\n");
                    }

                    if ($info->getPrevIndex() != null) {
                        echo ("Record Info PrevIndex: " . $info->getPrevIndex() . "\n");
                    }

                    if ($info->getPerPage() != null) {
                        // Get the PerPage of the Info
                        echo ("Record Info PerPage: " . $info->getPerPage() . "\n");
                    }

                    if ($info->getMoreRecords() != null) {
                        // Get the MoreRecords of the Info
                        echo ("Record Info MoreRecords: " . $info->getMoreRecords() . "\n");
                    }
                }
            }
            //Check if the request returned an exception
            else if ($responseHandler instanceof APIException) {
                //Get the received APIException instance
                $exception = $responseHandler;

                //Get the Status
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");

                //Get the Code
                echo ("Code: " . $exception->getCode()->getValue() . "\n");

                echo ("Details: ");

                if ($exception->getDetails() != null) {
                    echo ("Details: \n");

                    //Get the details map
                    foreach ($exception->getDetails() as $keyName => $keyValue) {
                        //Get each value in the map
                        echo ($keyName . ": " . $keyValue . "\n");
                    }
                }

                //Get the Message
                echo ("Message: " . $exception->getMessage() . "\n");
            }
        }
    }
}
