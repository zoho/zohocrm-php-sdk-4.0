<?php

namespace com\zoho\crm\sample\usersterritories;

use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\usersterritories\APIException;
use com\zoho\crm\api\usersterritories\ActionWrapper;
use com\zoho\crm\api\usersterritories\BodyWrapper;
use com\zoho\crm\api\usersterritories\BulkValidation;
use com\zoho\crm\api\usersterritories\SuccessResponse;
use com\zoho\crm\api\usersterritories\Territory;
use com\zoho\crm\api\usersterritories\TransferActionWrapper;
use com\zoho\crm\api\usersterritories\TransferAndDelink;
use com\zoho\crm\api\usersterritories\TransferToUser;
use com\zoho\crm\api\usersterritories\TransferWrapper;
use com\zoho\crm\api\usersterritories\UsersTerritoriesOperations;
use com\zoho\crm\api\usersterritories\Validation;
use com\zoho\crm\api\usersterritories\ValidationWrapper;
use com\zoho\crm\api\usersterritories\GetTerritoriesofUserParam;

class UsersTerritories
{
    public static function getTerritoriesOfUser($userId)
    {
        // Get instance of UsersTerritoriesOperations Class
        $usersTerritoriesOperations = new UsersTerritoriesOperations($userId);

        // Get instance of ParameterMap Class
        $paramInstance = new ParameterMap();

        $paramInstance->add(GetTerritoriesofUserParam::page(), 1);

        $paramInstance->add(GetTerritoriesofUserParam::perPage(), 1);

        // Call getTerritoriesOfUser method that takes ParameterMap instance as parameters
        $response = $usersTerritoriesOperations->getTerritoriesOfUser($paramInstance);

        if ($response != null) {
            // Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");

            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

                return;
            }

            // Get object from response
            $responseHandler = $response->getObject();

            if ($responseHandler instanceof BodyWrapper) {
                // Get the received BodyWrapper instance
                $responseWrapper = $responseHandler;

                // Get the list of obtained Territory instances
                $usersTerritory = $responseWrapper->getTerritories();

                foreach ($usersTerritory as $territory) {
                    // Get the ID of each User Territory
                    echo ("User Territory ID: " . $territory->getId() . "\n");

                    // Get the manager User instance of each User Territory
                    $manager = $territory->getManager();

                    // Check if manager is not null
                    if ($manager != null) {
                        // Get the Name of the Manager
                        echo ("User Territory Manager Name: " . $manager->getName() . "\n");

                        // Get the ID of the Manager
                        echo ("User Territory Manager ID: " . $manager->getId() . "\n");
                    }

                    // Get the reportingTo Territory instance of each User Territory
                    $reportingTo = $territory->getReportingTo();

                    // Check if reportingTo is not null
                    if ($reportingTo != null) {
                        // Get the Name of the ReportingTo
                        echo ("User Territory ReportingTo Name: " . $reportingTo->getName() . "\n");

                        // Get the ID of the ReportingTo
                        echo ("User Territory ReportingTo ID: " . $reportingTo->getId() . "\n");
                    }

                    echo ("User Territory Name: " . $territory->getName() . "\n");
                }

                // Get the Object obtained Info instance
                $info = $responseWrapper->getInfo();

                // Check if info is not null
                if ($info != null) {
                    if ($info->getPerPage() != null) {
                        // Get the PerPage of the Info
                        echo ("User Info PerPage: " . $info->getPerPage() . "\n");
                    }

                    if ($info->getCount() != null) {
                        // Get the Count of the Info
                        echo ("User Info Count: " . $info->getCount() . "\n");
                    }

                    if ($info->getPage() != null) {
                        // Get the Page of the Info
                        echo ("User Info Page: " . $info->getPage() . "\n");
                    }

                    if ($info->getMoreRecords() != null) {
                        // Get the MoreRecords of the Info
                        echo ("User Info MoreRecords: " . $info->getMoreRecords() . "\n");
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

                //Get the details map4
                foreach ($exception->getDetails() as $key => $value) {
                    //Get each value in the map
                    echo ($key . ": " . $value . "\n");
                }

                //Get the Message
                echo ("Message: " . $exception->getMessage() . "\n");
            }
        }
    }

    public static function associateTerritoriesToUser($userId)
    {
        // Get instance of UsersOperations Class
        $usersTerritoriesOperations = new UsersTerritoriesOperations($userId);

        // Get instance of TerritoryBodyWrapper Class that will contain the request body
        $request = new BodyWrapper();

        // List of User instances
        $userTerritoryList = [];

        // Get instance of Territory Class
        $territory = new Territory();

        $territory->setId("34770613051397");

        array_push($userTerritoryList, $territory);

        $request->setTerritories($userTerritoryList);

        // Call updateTerritoriesOfUser method that takes TerritoryBodyWrapper instance as parameter
        $response = $usersTerritoriesOperations->associateTerritoriesToUser($request);

        if ($response != null) {
            // Get the status code from response
            echo ("Status Code: " . $response->getStatusCode());

            // Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                // Get the received TerritoryActionWrapper instance
                $responseWrapper = $actionHandler;

                // Get the list of obtained TerritoryActionResponse instances
                $actionResponses = $responseWrapper->getTerritories();

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

                        //Get the details map
                        foreach ($successResponse->getDetails() as $key => $value) {
                            //Get each value in the map
                            echo ($key . " : " . $value . "\n");
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

    public static function getSpecificTerritoryOfUser($userId, $territoryId)
    {
        // Get instance of UsersOperations Class
        $usersTerritoriesOperations = new UsersTerritoriesOperations($userId);

        // Call getTerritoriesOfUser method that takes territoryId, userId and ParameterMap instance as parameters
        $response = $usersTerritoriesOperations->getSpecificTerritoryOfUser($territoryId);

        if ($response != null) {
            // Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");

            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

                return;
            }

            // Get object from response
            $responseHandler = $response->getObject();

            if ($responseHandler instanceof BodyWrapper) {
                // Get the received ResponseWrapper instance
                $responseWrapper = $responseHandler;

                // Get the list of obtained Territory instances
                $usersTerritory = $responseWrapper->getTerritories();

                foreach ($usersTerritory as $territory) {
                    // Get the ID of each User Territory
                    echo ("User Territory ID: " . $territory->getId() . "\n");

                    // Get the manager User instance of each User Territory
                    $manager = $territory->getManager();

                    // Check if manager is not null
                    if ($manager != null) {
                        // Get the Name of the Manager
                        echo ("User Territory Manager Name: " . $manager->getName() . "\n");

                        // Get the ID of the Manager
                        echo ("User Territory Manager ID: " . $manager->getId() . "\n");
                    }

                    // Get the reportingTo Territory instance of each User Territory
                    $reportingTo = $territory->getReportingTo();

                    // Check if reportingTo is not null
                    if ($reportingTo != null) {
                        // Get the Name of the ReportingTo
                        echo ("User Territory ReportingTo Name: " . $reportingTo->getName() . "\n");

                        // Get the ID of the ReportingTo
                        echo ("User Territory ReportingTo ID: " . $reportingTo->getId() . "\n");
                    }

                    echo ("User Territory Name: " . $territory->getName() . "\n");
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

                //Get the details map4
                foreach ($exception->getDetails() as $key => $value) {
                    //Get each value in the map
                    echo ($key . ": " . $value . "\n");
                }

                //Get the Message
                echo ("Message: " . $exception->getMessage() . "\n");
            }
        }
    }

    public static function validateBeforeTransferForAllTerritories($userId)
    {
        // Get instance of UsersOperations Class
        $usersTerritoriesOperations = new UsersTerritoriesOperations($userId);

        $response = $usersTerritoriesOperations->validateBeforeTransferForAllTerritories();

        if ($response != null) {
            // Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");

            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

                return;
            }

            // Get object from response
            $responseHandler = $response->getObject();

            if ($responseHandler instanceof ValidationWrapper) {
                // Get the received TransferringResponseWrapper instance
                $responseWrapper = $responseHandler;

                // Get the list of obtained Territory instances
                $usersTerritory = $responseWrapper->getValidateBeforeTransfer();

                foreach ($usersTerritory as $validation) {
                    if ($validation instanceof BulkValidation) {
                        echo ("User Territory Validation Alert : " . $validation->getAlert() . "\n");

                        echo ("User Territory Validation Assignment : " . $validation->getAssignment() . "\n");

                        echo ("User Territory Validation Criteria : " . $validation->getCriteria() . "\n");

                        echo ("User Territory Validation Name : " . $validation->getName() . "\n");

                        echo ("User Territory Validation Id : " . $validation->getId() . "\n");
                    } else if ($validation instanceof Validation) {
                        // Get the ID of each User Territory
                        echo ("User Territory ID: " . $validation->getId() . "\n");

                        echo ("User Territory Name: " . $validation->getName() . "\n");

                        echo ("User Territory Records: " . $validation->getRecords() . "\n");
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

                //Get the details map4
                foreach ($exception->getDetails() as $key => $value) {
                    //Get each value in the map
                    echo ($key . ": " . $value . "\n");
                }

                //Get the Message
                echo ("Message: " . $exception->getMessage() . "\n");
            }
        }
    }

    public static function validateBeforeTransfer($userId, $territoryId)
    {
        // Get instance of UsersOperations Class
        $usersTerritoriesOperations = new UsersTerritoriesOperations($userId);

        // Call getValidateTerritoriesBeforeTransferring method that takes territoryId as parameters
        $response = $usersTerritoriesOperations->validateBeforeTransfer($territoryId);

        if ($response != null) {
            // Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");

            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

                return;
            }

            // Get object from response
            $responseHandler = $response->getObject();

            if ($responseHandler instanceof ValidationWrapper) {
                // Get the received ValidationWrapper instance
                $responseWrapper = $responseHandler;

                // Get the list of obtained Territory instances
                $usersTerritory = $responseWrapper->getValidateBeforeTransfer();

                foreach ($usersTerritory as $validation) {
                    if ($validation instanceof BulkValidation) {
                        echo ("User Territory Validation Alert : " . $validation->getAlert() . "\n");

                        echo ("User Territory Validation Assignment : " . $validation->getAssignment() . "\n");

                        echo ("User Territory Validation Criteria : " . $validation->getCriteria() . "\n");

                        echo ("User Territory Validation Name : " . $validation->getName() . "\n");

                        echo ("User Territory Validation Id : " . $validation->getId() . "\n");
                    } else if ($validation instanceof Validation) {
                        // Get the ID of each User Territory
                        echo ("User Territory ID: " . $validation->getId() . "\n");

                        echo ("User Territory Name: " . $validation->getName() . "\n");

                        echo ("User Territory Records: " . $validation->getRecords() . "\n");
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

                //Get the details map4
                foreach ($exception->getDetails() as $key => $value) {
                    //Get each value in the map
                    echo ($key . ": " . $value . "\n");
                }

                //Get the Message
                echo ("Message: " . $exception->getMessage() . "\n");
            }
        }
    }

    public static function delinkAndTransferFromAllTerritories($userId)
    {
        // Get instance of UsersOperations Class
        $usersTerritoriesOperations = new UsersTerritoriesOperations($userId);

        // Get instance of TransferBodyWrapper Class that will contain the request body
        $request = new TransferWrapper();

        // List of User instances
        $userTerritoryList = [];

        // Get instance of Territory Class
        $territory = new TransferAndDelink();

        $territory->setId("34770613051397");

        $transferToUser = new TransferToUser();

        $transferToUser->setId("347706113767065");

        $territory->setTransferToUser($transferToUser);

        array_push($userTerritoryList, $territory);

        $request->setTransferAndDelink($userTerritoryList);

        // Call delinkAndTransferFromAllTerritories method that takes TransferBodyWrapper instance as parameter
        $response = $usersTerritoriesOperations->delinkAndTransferFromAllTerritories($request);

        if ($response != null) {
            // Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");

            // Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof TransferActionWrapper) {
                // Get the received TransferActionWrapper instance
                $responseWrapper = $actionHandler;

                // Get the list of obtained TransferActionResponse instances
                $actionResponses = $responseWrapper->getTransferAndDelink();

                foreach ($actionResponses as $actionResponse) {
                    // Check if the request is successful
                    if ($actionResponse instanceof SuccessResponse) {
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

    public static function delinkAndTransferFromSpecificTerritory($userId, $territoryId)
    {
        // Get instance of UsersOperations Class
        $usersTerritoriesOperations = new UsersTerritoriesOperations($userId);

        // Get instance of TransferBodyWrapper Class that will contain the request body
        $request = new TransferWrapper();

        // List of User instances
        $userTerritoryList = [];

        // Get instance of Territory Class
        $territory = new TransferAndDelink();

        $territory->setId("34770613051397");

        $transferToUser = new TransferToUser();

        $transferToUser->setId("347706113767065");

        $territory->setTransferToUser($transferToUser);

        array_push($userTerritoryList, $territory);

        $request->setTransferAndDelink($userTerritoryList);

        // Call delinkAndTransferSpecificTerritoryOfUser method that takes territoryId and TransferBodyWrapper instance as parameter
        $response = $usersTerritoriesOperations->delinkAndTransferFromSpecificTerritory($territoryId, $request);

        if ($response != null) {
            // Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");

            // Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof TransferActionWrapper) {
                // Get the received TransferActionWrapper instance
                $responseWrapper = $actionHandler;

                // Get the list of obtained TransferActionResponse instances
                $actionResponses = $responseWrapper->getTransferAndDelink();

                foreach ($actionResponses as $actionResponse) {
                    // Check if the request is successful
                    if ($actionResponse instanceof SuccessResponse) {
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
