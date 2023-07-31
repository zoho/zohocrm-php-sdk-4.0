<?php

namespace associateEmail;

use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\associateemail\ActionWrapper;
use com\zoho\crm\api\associateemail\APIException;
use com\zoho\crm\api\associateemail\AssociateEmailOperations;
use com\zoho\crm\api\associateemail\Attachments;
use com\zoho\crm\api\associateemail\From;
use com\zoho\crm\api\associateemail\SUCCESS;
use com\zoho\crm\api\associateemail\To;
use com\zoho\crm\api\associateemail\Wrapper;
use com\zoho\crm\api\associateemail\AssociateEmail;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\util\Choice;


require "vendor/autoload.php";

class Associate
{
    public static function initialize()
    {
        $environment = USDataCenter::PRODUCTION();
        $token = (new OAuthBuilder())
            ->clientId("")
            ->clientSecret("xxxxxx")
            ->refreshToken("1000.xxxxx.xxxxx")
            ->build();
        (new InitializeBuilder())
            ->environment($environment)
            ->token($token)
            ->initialize();
    }
    public static function associate($recordId, $module)
    {
        $associateEmailOperations = new AssociateEmailOperations();
        $request = new Wrapper();
        $emails = array();
        for ($i=0; $i<1; $i++)
        {
            $associateEmail = new AssociateEmail();
            $from = new From();
            $from->setEmail("abc@gmail.com");
            $from->setUserName("user_name");
            $associateEmail->setFrom($from);
            $tos = array();
            $to = new To();
            $to->setEmail("abc1@gmail.com");
            $to->setUserName("user_name1");
            array_push($tos, $to);
           $tos1 = array();
           $to1 = new To();
           $to1->setEmail("abc2@gmail.com");
           $to1->setUserName("user_name2");
           array_push($tos1, $to1);
           $tos2 = array();
           $to2 = new To();
           $to2->setEmail("abc3@gmail.com");
           $to2->setUserName("user_name3");
           array_push($tos2, $to2);
            $associateEmail->setTo($tos);
           $associateEmail->setCc($tos1);
           $associateEmail->setBcc($tos2);
            $associateEmail->setSubject("final");
            $associateEmail->setOriginalMessageId("c6085fae06c46b69299e81a1e56b04ad6ffe468a49c15f");
            $associateEmail->setDateTime(date_create("2022-06-01T15:32:05")->setTimezone(new \DateTimeZone(date_default_timezone_get())));
            $associateEmail->setSent(new Choice(true));
            // $associateEmail->setContent("this is the Content");
           $associateEmail->setContent("<h3><span style=\\\"background-color: rgb(254, 255, 102)\\\">Mail is of rich text format</span></h3><h3><span style=\\\"background-color: rgb(254, 255, 102)\\\">REGARDS,</span></h3><div><span style=\\\"background-color: rgb(254, 255, 102)\\\">AZ</span></div><div><span style=\\\"background-color: rgb(254, 255, 102)\\\">ADMIN</span></div> <div></div>");
            $associateEmail->setMailFormat(new Choice("text"));
           $attachments = array();
           $attachment = new Attachments();
           $attachment->setId("csdsfrfjebjhsdehjdvbsbhhsvdvebdedeferfdjwb");
           array_push($attachments, $attachment);
            array_push($emails, $associateEmail);
        }
        $request->setEmails($emails);
        $response = $associateEmailOperations->associate($recordId, $module, $request);
        if ($response != null) {
            echo ("Status Code: " . $response->getStatusCode() . "\n");
            if ($response->isExpected()) {
                $actionHandler = $response->getObject();
                if ($actionHandler instanceof ActionWrapper) {
                    $actionWrapper = $actionHandler;
                    $actionResponses = $actionWrapper->getEmails();
                    foreach ($actionResponses as $actionResponse) {
                        if ($actionResponse instanceof SUCCESS) {
                            $successResponse = $actionResponse;
                            echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                            echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                            echo ("Details: ");
                            foreach ($successResponse->getDetails() as $key => $value) {
                                echo ($key . " : ");
                                print_r($value);
                                echo ("\n");
                            }
                            echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
                        }
                        else if ($actionResponse instanceof APIException) {
                            $exception = $actionResponse;
                            echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                            echo ("Code: " . $exception->getCode()->getValue() . "\n");
                            echo ("Details: ");
                            foreach ($exception->getDetails() as $key => $value) {
                                echo ($key . " : " . $value . "\n");
                            }
                            echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                        }
                    }
                }
                else if ($actionHandler instanceof APIException) {
                    $exception = $actionHandler;
                    echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo ("Code: " . $exception->getCode()->getValue() . "\n");
                    echo ("Details: ");
                    foreach ($exception->getDetails() as $key => $value) {
                        echo ($key . " : " . $value . "\n");
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
                }
            } else {
                print_r($response);
            }
        }
    }
}
$recordId = 4402481182075;
$moduleAPIName = "leads";
Associate::initialize();
Associate::associate($recordId, $moduleAPIName);
