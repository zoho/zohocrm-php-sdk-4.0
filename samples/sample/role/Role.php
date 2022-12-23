<?php

namespace com\zoho\crm\sample\role;

use com\zoho\crm\api\roles\APIException;
use com\zoho\crm\api\roles\RolesOperations;
use com\zoho\crm\api\roles\DeleteRoleParam;
use com\zoho\crm\api\roles\SuccessResponse;
use com\zoho\crm\api\roles\BodyWrapper;
use com\zoho\crm\api\users\MinifiedUser;
use com\zoho\crm\api\roles\ActionWrapper;
use com\zoho\crm\api\ParameterMap;

class Role
{
    /**
     * <h3> Get Roles </h3>
     * This method is used to retrieve the data of roles through an API request and print the response.
     * @throws Exception
     */
    public static function getRoles()
    {
        //Get instance of RolesOperations Class
        $rolesOperations = new RolesOperations();

        //Call getRoles method
        $response = $rolesOperations->getRoles();

        if ($response != null) {
            //Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

                return;
            }

            //Get object from response
            $responseHandler = $response->getObject();

            if ($responseHandler instanceof BodyWrapper) {
                //Get the received ResponseWrapper instance
                $responseWrapper = $responseHandler;

                //Get the list of obtained Role instances
                $roles = $responseWrapper->getRoles();

                foreach ($roles as $role) {
                    //Get the DisplayLabel of each Role
                    echo ("Role DisplayLabel: " . $role->getDisplayLabel() . "\n");

                    //Get the forecastManager User instance of each Role
                    $forecastManager = $role->getForecastManager();

                    //Check if forecastManager is not null
                    if ($forecastManager != null) {
                        //Get the ID of the forecast Manager
                        echo ("Role Forecast Manager User-ID: " . $forecastManager->getId() . "\n");

                        //Get the name of the forecast Manager
                        echo ("Role Forecast Manager User-Name: " . $forecastManager->getName() . "\n");
                    }

                    //Get the ShareWithPeers of each Role
                    echo ("Role ShareWithPeers: ");
                    print_r($role->getShareWithPeers());
                    echo ("\n");

                    //Get the Name of each Role
                    echo ("Role Name: " . $role->getName() . "\n");

                    //Get the Description of each Role
                    echo ("Role Description: " . $role->getDescription() . "\n");

                    //Get the Id of each Role
                    echo ("Role ID: " . $role->getId() . "\n");

                    //Get the reportingTo User instance of each Role
                    $reportingTo = $role->getReportingTo();

                    //Check if reportingTo is not null
                    if ($reportingTo != null) {
                        //Get the ID of the reportingTo User
                        echo ("Role ReportingTo User-ID: " . $reportingTo->getId() . "\n");

                        //Get the name of the reportingTo User
                        echo ("Role ReportingTo User-Name: " . $reportingTo->getName() . "\n");
                    }

                    //Get the AdminUser of each Role
                    echo ("Role AdminUser: ");
                    print_r($role->getAdminUser());
                    echo ("\n");
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

    public static function createRoles()
    {
        // Get instance of RolesOperations Class
        $rolesOperations = new RolesOperations();

        // Get instance of BodyWrapper Class that will contain the request body
        $bodyWrapper = new BodyWrapper();

        // List of Role instances
        $roles = [];

        $roleClass = 'com\zoho\crm\api\roles\Role';

        // Get instance of Role Class
        $role = new $roleClass();

        // Set name of the Role
        $role->setName("Product Manager321321");

        $reportingTo = new MinifiedUser();

        $reportingTo->setId("34770610026005");

        $role->setReportingTo($reportingTo);

        $role->setDescription("Schedule and manage resources");

        $role->setShareWithPeers(true);

        // Add ContactRole instance to the list
        array_push($roles, $role);

        // Set the list to roles in BodyWrapper instance
        $bodyWrapper->setRoles($roles);

        // Call createRoles method that takes BodyWrapper instance as parameter
        $response = $rolesOperations->createRoles($bodyWrapper);

        if ($response != null) {
            // Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            // Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                // Get the received ActionWrapper instance
                $actionWrapper = $actionHandler;

                // Get the list of obtained ActionResponse instances
                $actionResponses = $actionWrapper->getRoles();

                foreach ($actionResponses as $actionResponse) {
                    // Check if the request is successful
                    if ($actionResponse instanceof SuccessResponse) {
                        // Get the received SuccessResponse instance
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

    public static function updateRoles()
    {
        // Get instance of RolesOperations Class
        $rolesOperations = new RolesOperations();

        // Get instance of BodyWrapper Class that will contain the request body
        $bodyWrapper = new BodyWrapper();

        // List of Role instances
        $roles = [];

        $roleClass = 'com\zoho\crm\api\roles\Role';

        // Get instance of Role Class
        $role = new $roleClass();

        $role->setId("347706116953007");

        // Set name of the Role
        $role->setName("Product Manager4321321");

        $reportingTo = new MinifiedUser();

        $reportingTo->setId("34770610026005");

        // $role->setReportingTo($reportingTo);

        $role->setDescription("Schedule and manage resources");

        // $role->setShareWithPeers(true);

        // Add ContactRole instance to the list
        array_push($roles, $role);

        // Set the list to roles in BodyWrapper instance
        $bodyWrapper->setRoles($roles);

        // Call updateRoles method that takes BodyWrapper instance as parameter
        $response = $rolesOperations->updateRoles($bodyWrapper);

        if ($response != null) {
            // Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            // Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                // Get the received ActionWrapper instance
                $actionWrapper = $actionHandler;

                // Get the list of obtained ActionResponse instances
                $actionResponses = $actionWrapper->getRoles();

                foreach ($actionResponses as $actionResponse) {
                    // Check if the request is successful
                    if ($actionResponse instanceof SuccessResponse) {
                        // Get the received SuccessResponse instance
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

    /**
     * <h3> Get Role </h3>
     * This method is used to retrieve the data of single role through an API request and print the response.
     * @param roleId The ID of the Role to be obtained
     * @throws Exception
     */
    public static function getRole(string $roleId)
    {
        //example, roleId = "34781";

        //Get instance of RolesOperations Class
        $rolesOperations = new RolesOperations();

        //Call getRoles method
        $response = $rolesOperations->getRole($roleId);

        if ($response != null) {
            //Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

                return;
            }

            //Get object from response
            $responseHandler = $response->getObject();

            if ($responseHandler instanceof BodyWrapper) {
                //Get the received ResponseWrapper instance
                $responseWrapper = $responseHandler;

                //Get the list of obtained Role instances
                $roles = $responseWrapper->getRoles();

                foreach ($roles as $role) {
                    //Get the DisplayLabel of each Role
                    echo ("Role DisplayLabel: " . $role->getDisplayLabel() . "\n");

                    //Get the forecastManager User instance of each Role
                    $forecastManager = $role->getForecastManager();

                    //Check if forecastManager is not null
                    if ($forecastManager != null) {
                        //Get the ID of the forecast Manager
                        echo ("Role Forecast Manager User-ID: " . $forecastManager->getId() . "\n");

                        //Get the name of the forecast Manager
                        echo ("Role Forecast Manager User-Name: " . $forecastManager->getName() . "\n");
                    }

                    //Get the ShareWithPeers of each Role
                    echo ("Role ShareWithPeers: ");
                    print_r($role->getShareWithPeers());
                    echo ("\n");

                    //Get the Name of each Role
                    echo ("Role Name: " . $role->getName() . "\n");

                    //Get the Description of each Role
                    echo ("Role Description: " . $role->getDescription() . "\n");

                    //Get the Id of each Role
                    echo ("Role ID: " . $role->getId() . "\n");

                    //Get the reportingTo User instance of each Role
                    $reportingTo = $role->getReportingTo();

                    //Check if reportingTo is not null
                    if ($reportingTo != null) {
                        //Get the ID of the reportingTo User
                        echo ("Role ReportingTo User-ID: " . $reportingTo->getId() . "\n");

                        //Get the name of the reportingTo User
                        echo ("Role ReportingTo User-Name: " . $reportingTo->getName() . "\n");
                    }

                    //Get the AdminUser of each Role
                    echo ("Role AdminUser: ");
                    print_r($role->getAdminUser());
                    echo ("\n");
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

    public static function updateRole($roleId)
    {
        // Get instance of RolesOperations Class
        $rolesOperations = new RolesOperations();

        // Get instance of BodyWrapper Class that will contain the request body
        $bodyWrapper = new BodyWrapper();

        // List of Role instances
        $roles = [];

        $roleClass = 'com\zoho\crm\api\roles\Role';

        // Get instance of Role Class
        $role = new $roleClass();

        // Set name of the Role
        $role->setName("Product Manager3421");

        $reportingTo = new MinifiedUser();

        $reportingTo->setId("34770610026005");

        $role->setReportingTo($reportingTo);

        $role->setDescription("Schedule and manage resources");

        $role->setShareWithPeers(true);

        // Add ContactRole instance to the list
        array_push($roles, $role);

        // Set the list to roles in BodyWrapper instance
        $bodyWrapper->setRoles($roles);

        // Call updateRole method that takes roleId and BodyWrapper instance as parameter
        $response = $rolesOperations->updateRole($roleId, $bodyWrapper);

        if ($response != null) {
            // Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            // Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                // Get the received ActionWrapper instance
                $actionWrapper = $actionHandler;

                // Get the list of obtained ActionResponse instances
                $actionResponses = $actionWrapper->getRoles();

                foreach ($actionResponses as $actionResponse) {
                    // Check if the request is successful
                    if ($actionResponse instanceof SuccessResponse) {
                        // Get the received SuccessResponse instance
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

    public static function deleteRole($roleId)
    {
        // Get instance of RolesOperations Class
        $rolesOperations = new RolesOperations();

        $paramInstance = new ParameterMap();

        $paramInstance->add(DeleteRoleParam::transferToId(), "34770610026008");

        // Call deleteRole method that takes roleId and paramInstance as parameter
        $response = $rolesOperations->deleteRole($roleId, $paramInstance);
        if ($response != null) {
            // Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            // Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                // Get the received ActionWrapper instance
                $actionWrapper = $actionHandler;

                // Get the list of obtained ActionResponse instances
                $actionResponses = $actionWrapper->getRoles();

                foreach ($actionResponses as $actionResponse) {
                    // Check if the request is successful
                    if ($actionResponse instanceof SuccessResponse) {
                        // Get the received SuccessResponse instance
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
