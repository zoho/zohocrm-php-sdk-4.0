<?php

namespace com\zoho\crm\sample\sendmail;

use com\zoho\crm\api\sendmail\SendMailOperations;
use com\zoho\crm\api\sendmail\Data;
use com\zoho\crm\api\sendmail\From;
use com\zoho\crm\api\sendmail\To;
use com\zoho\crm\api\inventorytemplates\InventoryTemplate;
use com\zoho\crm\api\sendmail\BodyWrapper;
use com\zoho\crm\api\sendmail\UserAddress;
use com\zoho\crm\api\sendmail\APIException;
use com\zoho\crm\api\sendmail\ActionWrapper;
use com\zoho\crm\api\sendmail\SuccessResponse;
use com\zoho\crm\api\util\Choice;

class SendMail
{
    public static function sendMail(string $recordId, string $moduleAPIName)
    {
        //Get instance of SendMailOperations Class
        $sendMailOperations = new SendMailOperations($recordId, $moduleAPIName);

        $mail = new Data();

        $from = new From();

        $from->setUserName("user");

        $from->setEmail("abc@zoho.com");

        $mail->setFrom($from);

        $to = new To();

        $to->setUserName("user2");

        $to->setEmail("abc@gmail.com");

        $mail->setTo([$to]);

        $mail->setSubject("Mail subject");

        $mail->setContent("<br><a href=\"{ConsentForm.en_US}\" id=\"ConsentForm\" class=\"en_US\" target=\"_blank\">Consent form link</a><br><br><br><br><br><h3><span style=\"background-color: rgb(254, 255, 102)\">REGARDS,</span></h3><div><span style=\"background-color: rgb(254, 255, 102)\">AZ</span></div><div><span style=\"background-color: rgb(254, 255, 102)\">ADMIN</span></div> <div></div>");

        $mail->setConsentEmail(true);

        $mail->setMailFormat(new Choice("html"));

        $template = new InventoryTemplate();

        $template->setId("34770610174009");

        $mail->setTemplate($template);

        $wrapper = new BodyWrapper();

        $wrapper->setData([$mail]);

        //Call sendMail method
        $response = $sendMailOperations->sendMail($wrapper);

        if ($response != null) {
            //Get the status code from response
            echo ("Status code : " . $response->getStatusCode() . "\n");

            //Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                //Get the received ActionWrapper instance
                $actionWrapper = $actionHandler;

                //Get the list of obtained action responses
                $actionResponses = $actionWrapper->getData();

                foreach ($actionResponses as $actionResponse) {
                    //Check if the request is successful
                    if ($actionResponse instanceof SuccessResponse) {
                        //Get the received SuccessResponse instance
                        $successResponse = $actionResponse;

                        //Get the Status
                        echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");

                        //Get the Code
                        echo ("Code: " . $successResponse->getCode()->getValue() . "\n");

                        echo ("Details: ");

                        if ($successResponse->getDetails() != null) {
                            //Get the details map
                            foreach ($successResponse->getDetails() as $keyName => $keyValue) {
                                //Get each value in the map
                                echo ($keyName . ": " . $keyValue . "\n");
                            }
                        }

                        //Get the Message
                        echo ("Message: " . $successResponse->getMessage() . "\n");
                    }
                    //Check if the request returned an exception
                    else if ($actionResponse instanceof APIException) {
                        //Get the received APIException instance
                        $exception = $actionResponse;

                        //Get the Status
                        echo ("Status: " . $exception->getStatus()->getValue() . "\n");

                        //Get the Code
                        echo ("Code: " . $exception->getCode()->getValue() . "\n");

                        echo ("Details: ");

                        if ($exception->getDetails() != null) {
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
            //Check if the request returned an exception
            else if ($actionHandler instanceof APIException) {
                //Get the received APIException instance
                $exception = $actionHandler;

                //Get the Status
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");

                //Get the Code
                echo ("Code: " . $exception->getCode()->getValue() . "\n");

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
