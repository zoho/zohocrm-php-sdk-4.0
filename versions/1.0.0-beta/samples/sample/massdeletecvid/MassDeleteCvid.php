<?php

namespace com\zoho\crm\sample\massdeletecvid;

use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\massdeletecvid\APIException;
use com\zoho\crm\api\massdeletecvid\ActionWrapper;
use com\zoho\crm\api\massdeletecvid\BodyWrapper;
use com\zoho\crm\api\massdeletecvid\MassDeleteCvidOperations;
use com\zoho\crm\api\massdeletecvid\GetMassDeleteStatusParam;
use com\zoho\crm\api\massdeletecvid\MassDeleteScheduled;
use com\zoho\crm\api\massdeletecvid\RecordDeleted;
use com\zoho\crm\api\massdeletecvid\ResponseWrapper;
use com\zoho\crm\api\massdeletecvid\Territory;

class MassDeleteCvid
{
    public static function massDeleteByCvid(string $moduleAPIName)
    {
        $massDeleteCvidOperations = new MassDeleteCvidOperations($moduleAPIName);

        $bodyWrapper = new BodyWrapper();

        $bodyWrapper->setCvid("34770610087501");

        $bodyWrapper->setIds(["347706116899044"]);

        $territory = new Territory();

        $territory->setId("0");

        $territory->setIncludeChild(true);

        // $bodyWrapper->setTerritory($territory);

        $response = $massDeleteCvidOperations->massDeleteByCvid($bodyWrapper);

        if ($response != null) {
            //Get the status code from response
            echo ("Status code : " . $response->getStatusCode() . "\n");

            //Get object from response
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof ActionWrapper) {
                // Get the received ActionWrapper instance
                $actionWrapper = $actionHandler;

                // Get the list of obtained ActionResponse instances
                $actionResponses = $actionWrapper->getData();

                if ($actionResponses != null) {
                    foreach ($actionResponses as $actionResponse) {
                        // Check if the request is successful
                        if ($actionResponse instanceof RecordDeleted) {
                            // Get the received SuccessResponse instance
                            $successResponse = $actionResponse;

                            // Get the Status
                            echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");

                            // Get the Code
                            echo ("Code: " . $successResponse->getCode()->getValue() . "\n");

                            echo ("Details: ");

                            if ($successResponse->getDetails() != null) {
                                //Get the details map
                                foreach ($successResponse->getDetails() as $keyName => $keyValue) {
                                    //Get each value in the map
                                    echo ($keyName . ": " . $keyValue . "\n");
                                }
                            }

                            // Get the Message
                            echo ("Message: " .  $successResponse->getMessage() . "\n");
                        }
                        // Check if the request is successful
                        else if ($actionResponse instanceof MassDeleteScheduled) {
                            // Get the received SuccessResponse instance
                            $successResponse = $actionResponse;

                            // Get the Status
                            echo ("Status: " .  $successResponse->getStatus()->getValue() . "\n");

                            // Get the Code
                            echo ("Code: " .  $successResponse->getCode()->getValue() . "\n");

                            echo ("Details: ");

                            if ($successResponse->getDetails() != null) {
                                //Get the details map
                                foreach ($successResponse->getDetails() as $keyName => $keyValue) {
                                    //Get each value in the map
                                    echo ($keyName . ": ");
                                    print_r($keyValue);
                                    echo ("\n");
                                }
                            }

                            // Get the Message
                            echo ("Message: " .  $successResponse->getMessage()->getValue() . "\n");
                        }
                        // Check if the request returned an exception
                        else if ($actionResponse instanceof APIException) {
                            // Get the received APIException instance
                            $exception = $actionResponse;

                            // Get the Status
                            echo ("Status: " . $exception->getStatus()->getValue() . "\n");

                            // Get the Code
                            echo ("Code: " .  $exception->getCode()->getValue() . "\n");

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

                            // Get the Message
                            echo ("Message: " .  $exception->getMessage() . "\n");
                        }
                    }
                }
            }
            //Check if the request returned an exception
            else if ($actionHandler instanceof APIException) {
                //Get the received APIException instance
                $exception = $actionHandler;

                //Get the Status
                echo ("Status: " . $exception->getStatus()->getValue() . "\n" . "\n");

                //Get the Code
                echo ("Code: " . $exception->getCode()->getValue() . "\n" . "\n");

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
                echo ("Message: " . $exception->getMessage()->getValue() . "\n");
            }
        }
    }

    public static function getMassDeleteStatus(string $jobId, string $moduleAPIName)
    {
        $massDeleteCvidOperations = new MassDeleteCvidOperations($moduleAPIName);

        $paramInstance = new ParameterMap();

        $paramInstance->add(GetMassDeleteStatusParam::jobId(), $jobId);

        $response = $massDeleteCvidOperations->getMassDeleteStatus($paramInstance);

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
                    echo ("MassDelete TotalCount: " .  $status1->getTotalCount() . "\n");

                    echo ("MassDelete ConvertedCount: " .  $status1->getDeletedCount() . "\n");

                    echo ("MassDelete FailedCount: " .  $status1->getFailedCount() . "\n");

                    echo ("MassDelete Status: " .  $status1->getStatus()->getValue() . "\n");
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
                echo ("Message: " . $exception->getMessage()->getValue() . "\n");
            }
        }
    }
}
