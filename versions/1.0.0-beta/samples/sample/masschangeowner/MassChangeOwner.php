<?php

namespace com\zoho\crm\sample\masschangeowner;

use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\masschangeowner\APIException;
use com\zoho\crm\api\masschangeowner\ActionWrapper;
use com\zoho\crm\api\masschangeowner\Data;
use com\zoho\crm\api\masschangeowner\MassChangeOwnerOperations;
use com\zoho\crm\api\masschangeowner\CheckStatusParam;
use com\zoho\crm\api\masschangeowner\Owner;
use com\zoho\crm\api\masschangeowner\ResponseWrapper;
use com\zoho\crm\api\masschangeowner\SuccessResponse;
use com\zoho\crm\api\masschangeowner\Territory;

class MassChangeOwner
{
    public static function changeOwner($moduleAPIName)
    {
        $massChangeOwnerOperations = new MassChangeOwnerOperations();

        $bodyWrapper = new Data();

        $bodyWrapper->setCvid("347706115237021");

        $owner = new Owner();

        $owner->setId("34770610173021");

        $bodyWrapper->setOwner($owner);

        $territory = new Territory();

        $territory->setId("36523977622003");

        $territory->setIncludeChild(true);

        $bodyWrapper->setTerritory($territory);

        $response = $massChangeOwnerOperations->changeOwner($moduleAPIName, $bodyWrapper);

        if ($response != null) {
            //Get the status code from response
            echo ("Status code" . $response->getStatusCode() . "\n");

            //Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                //Get the received ActionWrapper instance
                $actionWrapper = $actionHandler;

                // Get the list of obtained ActionResponse instances
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
                        echo ("Message: " . $successResponse->getMessage()->getValue() . "\n");
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

    public static function checkStatus(string $jobId, string $module)
    {
        $massChangeOwnerOperations = new MassChangeOwnerOperations();

        $paramInstance = new ParameterMap();

        $paramInstance->add(CheckStatusParam::jobId(), $jobId);

        $response = $massChangeOwnerOperations->checkStatus($module, $paramInstance);

        if ($response != null) {
            //Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

                return;
            }

            //Get object from response
            $responseHandler = $response->getObject();

            if ($responseHandler instanceof ResponseWrapper) {
                // Get the received ResponseWrapper instance
                $responseWrapper = $responseHandler;

                $status = $responseWrapper->getData();

                foreach ($status as $status1) {
                    echo ("MassChangeOwner TotalCount: " . $status1->getTotalCount());

                    echo ("MassChangeOwner UpdatedCount: " . $status1->getUpdatedCount());

                    echo ("MassChangeOwner NotUpdatedCount: " . $status1->getNotUpdatedCount());

                    echo ("MassChangeOwner FailedCount: " . $status1->getFailedCount());

                    echo ("MassChangeOwner Status: " . $status1->getStatus());
                }
            }
            //Check if the request returned an exception
            else if ($responseHandler instanceof APIException) {
                //Get the received APIException instance
                $exception = $responseHandler;

                //Get the Status
                echo ("Status: " . $exception->getStatus()->getValue());

                //Get the Code
                echo ("Code: " . $exception->getCode()->getValue());

                echo ("Details: ");

                //Get the details map
                foreach ($exception->getDetails() as $key => $value) {
                    //Get each value in the map
                    echo ($key . ": " . $value);
                }

                //Get the Message
                echo ("Message: " . $exception->getMessage());
            }
        }
    }
}
