<?php

namespace com\zoho\crm\sample\massconvert;

use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\massconvert\APIException;
use com\zoho\crm\api\massconvert\AssignTo;
use com\zoho\crm\api\massconvert\Convert;
use com\zoho\crm\api\massconvert\MassConvertOperations;
use com\zoho\crm\api\massconvert\GetJobStatusParam;
use com\zoho\crm\api\massconvert\MoveAttachmentsTo;
use com\zoho\crm\api\massconvert\RelatedModule;
use com\zoho\crm\api\massconvert\ResponseWrapper;
use com\zoho\crm\api\massconvert\SuccessResponse;
use com\zoho\crm\api\record\Record;
use com\zoho\crm\api\record\Deals;
use com\zoho\crm\api\util\Choice;

class MassConvert
{
    public static function massConvert()
    {
        $massConvertOperations = new MassConvertOperations();

        $bodyWrapper = new Convert();

        $bodyWrapper->setIds(["347706116634119"]);

        $deals = new Record();

        $deals->addFieldValue(Deals::Amount(), 1.00);

        $deals->addFieldValue(Deals::DealName(), "V4SDK");

        $deals->addFieldValue(Deals::ClosingDate(), new \DateTime('2022-12-20'));

        $deals->addFieldValue(Deals::Pipeline(), new Choice("Standard(Standard)"));

        $deals->addFieldValue(Deals::Stage(), new Choice("Closed Won"));

        $bodyWrapper->setDeals($deals);

        $carryovertags = new MoveAttachmentsTo();

        $carryovertags->setId("34770612179");

        $carryovertags->setAPIName("Contacts");

        $bodyWrapper->setCarryOverTags([$carryovertags]);

        $related_modules = array();

        $relatedmodule = new RelatedModule();

        $relatedmodule->setAPIName("Tasks");

        $relatedmodule->setId("34770612193");

        array_push($related_modules, $relatedmodule);

        $relatedmodule = new RelatedModule();

        $relatedmodule->setAPIName("Events");

        $relatedmodule->setId("34770612195");

        array_push($related_modules, $relatedmodule);

        $bodyWrapper->setRelatedModules($related_modules);

        $assign_to = new AssignTo();

        $assign_to->setId("34770610173021");

        $bodyWrapper->setAssignTo($assign_to);

        $move_attachments_to = new MoveAttachmentsTo();

        $move_attachments_to->setAPIName("Contacts");

        $move_attachments_to->setId("34770612179");

        $bodyWrapper->setMoveAttachmentsTo($move_attachments_to);

        $response = $massConvertOperations->massConvert($bodyWrapper);

        if ($response != null) {
            //Get the status code from response
            echo ("Status code : " . $response->getStatusCode() . "\n");

            //Get object from response
            $actionHandler = $response->getObject();

            //Check if the request is successful
            if ($actionHandler instanceof SuccessResponse) {
                //Get the received SuccessResponse instance
                $successResponse = $actionHandler;

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
            else if ($actionHandler instanceof APIException) {
                //Get the received APIException instance
                $exception = $actionHandler;

                //Get the Status
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");

                //Get the Code
                echo ("Code: " . $exception->getCode()->getValue() . "\n");

                echo ("Details: ");

                if ($exception->getDetails() != null) {
                    //Get the details map
                    foreach ($exception->getDetails() as $keyName => $keyValue) {
                        //Get each value in the map
                        echo ($keyName . ": ");
                        print_r($keyValue);
                        echo ("\n");
                    }
                }

                //Get the Message
                echo ("Message: " . $exception->getMessage() . "\n");
            }
        }
    }

    public static function getJobStatus(string $jobId)
    {
        $massConvertOperations = new MassConvertOperations();

        $paramInstance = new ParameterMap();

        $paramInstance->add(GetJobStatusParam::jobId(), $jobId);

        $response = $massConvertOperations->getJobStatus($paramInstance);

        if ($response != null) {
            //Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

                return;
            }

            // Get object from response
            $responseHandler = $response->getObject();

            if ($responseHandler instanceof ResponseWrapper) {
                // Get the received ResponseWrapper instance
                $responseWrapper = $responseHandler;

                $status = $responseWrapper->getData();

                foreach ($status as $status1) {
                    echo ("MassConvert TotalCount: " . $status1->getTotalCount() . "\n");

                    echo ("MassConvert ConvertedCount: " . $status1->getConvertedCount() . "\n");

                    echo ("MassConvert NotConvertedCount: " . $status1->getNotConvertedCount() . "\n");

                    echo ("MassConvert FailedCount: " . $status1->getFailedCount() . "\n");

                    echo ("MassConvert Status: " . $status1->getStatus() . "\n");
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

                //Get the details map
                foreach ($exception->getDetails() as $key => $value) {
                    //Get each value in the map
                    echo ($key . ": " . $value . "\n");
                }

                //Get the Message
                echo ("Message: " . $exception->getMessage() . "\n");
            }
        }
    }
}
