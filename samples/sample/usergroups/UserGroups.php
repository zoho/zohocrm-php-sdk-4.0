<?php

namespace com\zoho\crm\sample\usergroups;

use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\usergroups\APIException;
use com\zoho\crm\api\usergroups\ActionWrapper;
use com\zoho\crm\api\usergroups\BodyWrapper;
use com\zoho\crm\api\usergroups\Groups;
use com\zoho\crm\api\usergroups\Jobs;
use com\zoho\crm\api\usergroups\JobsWrapper;
use com\zoho\crm\api\usergroups\Source;
use com\zoho\crm\api\usergroups\Sources;
use com\zoho\crm\api\usergroups\SuccessResponse;
use com\zoho\crm\api\usergroups\UserGroupsOperations;
use com\zoho\crm\api\usergroups\GetStatusParam;
use com\zoho\crm\api\util\Choice;

class UserGroups
{
    public static function getGroups()
    {
        // Get instance of UserGroups Class
        $userGroupsOperations = new UserGroupsOperations();

        $response = $userGroupsOperations->getGroups();

        if ($response != null) {
            //Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

                return;
            }

            // Get object from response
            $responseHandler = $response->getObject();

            if ($responseHandler instanceof BodyWrapper) {
                // Get the received ResponseWrapper instance
                $responseWrapper = $responseHandler;

                // Get the list of obtained User instances
                $users = $responseWrapper->getUserGroups();

                foreach ($users as $user) {
                    $createdBy = $user->getCreatedBy();

                    // Check if createdBy is not null
                    if ($createdBy != null) {
                        // Get the Name of the createdBy User
                        echo ("UserGroups Created By User-Name: " .  $createdBy->getName() . "\n");

                        // Get the ID of the createdBy User
                        echo ("UserGroups Created By User-ID: " .  $createdBy->getId() . "\n");
                    }

                    $modifiedBy = $user->getModifiedBy();

                    // Check if modifiedBy is not null
                    if ($modifiedBy != null) {
                        echo ("UserGroups Modified By User-Name: " .  $modifiedBy->getName() . "\n");

                        echo ("UserGroups Modified By User-ID: " .  $modifiedBy->getId() . "\n");
                    }

                    echo ("User ModifiedTime: " .  $user->getModifiedTime() . "\n");

                    echo ("User CreatedTime: " .  $user->getCreatedTime() . "\n");

                    echo ("UserGroups Description: " .  $user->getDescription() . "\n");

                    echo ("UserGroups Id: " .  $user->getId() . "\n");

                    echo ("UserGroups Name: " .  $user->getName() . "\n");

                    $sources = $user->getSources();

                    if ($sources != null) {
                        foreach ($sources as $source) {
                            echo ("UserGroups Sources Type: " . $source->getType()->getValue() . "\n");

                            $source1 = $source->getSource();

                            if ($source1 != null) {
                                echo ("UserGroups Sources Id: " .  $source1->getId() . "\n");
                            }

                            echo ("UserGroups Sources Subordinates: " .  $source->getSubordinates() . "\n");

                            echo ("UserGroups Sources SubTerritories: " .  $source->getSubTerritories() . "\n");
                        }
                    }

                    // Get the Object obtained Info instance
                    $info = $responseWrapper->getInfo();

                    // Check if info is not null
                    if ($info != null) {
                        if ($info->getPerPage() != null) {
                            // Get the PerPage of the Info
                            echo ("User Info PerPage: " .  $info->getPerPage() . "\n");
                        }

                        if ($info->getCount() != null) {
                            // Get the Count of the Info
                            echo ("User Info Count: " .  $info->getCount() . "\n");
                        }

                        if ($info->getPage() != null) {
                            // Get the Page of the Info
                            echo ("User Info Page: " .  $info->getPage() . "\n");
                        }

                        if ($info->getMoreRecords() != null) {
                            // Get the MoreRecords of the Info
                            echo ("User Info MoreRecords: " .  $info->getMoreRecords() . "\n");
                        }
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

    public static function createGroup()
    {
        $userGroupsOperations = new UserGroupsOperations();

        // Get instance of BodyWrapper Class that will contain the request body
        $request = new BodyWrapper();

        // List of User instances
        $userList = array();

        // Get instance of User Class
        $user1 = new Groups();

        $user1->setName("test group");

        $user1->setDescription("my group");

        $sources = array();

        $source = new Sources();

        $source->setType(new Choice("users"));

        $source1 = new Source();

        $source1->setId("347706113767065");

        $source->setSource($source1);

        array_push($sources, $source);

        $user1->setSources($sources);

        array_push($userList, $user1);

        $request->setUserGroups($userList);

        $response = $userGroupsOperations->createGroup($request);

        if ($response != null) {
            //Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");

            //Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                //Get the received ActionWrapper instance
                $responseWrapper = $actionHandler;

                //Get the list of obtained ActionResponse instances
                $actionResponses = $responseWrapper->getUserGroups();

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

    public static function getGroup(string $group)
    {
        $userGroupsOperations = new UserGroupsOperations();

        $response = $userGroupsOperations->getGroup($group);

        if ($response != null) {
            //Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

                return;
            }

            // Get object from response
            $responseHandler = $response->getObject();

            if ($responseHandler instanceof BodyWrapper) {
                // Get the received ResponseWrapper instance
                $responseWrapper = $responseHandler;

                // Get the list of obtained User instances
                $users = $responseWrapper->getUserGroups();

                foreach ($users as $user) {
                    $createdBy = $user->getCreatedBy();

                    // Check if createdBy is not null
                    if ($createdBy != null) {
                        // Get the Name of the createdBy User
                        echo ("UserGroups Created By User-Name: " .  $createdBy->getName() . "\n");

                        // Get the ID of the createdBy User
                        echo ("UserGroups Created By User-ID: " .  $createdBy->getId() . "\n");
                    }

                    $modifiedBy = $user->getModifiedBy();

                    // Check if modifiedBy is not null
                    if ($modifiedBy != null) {
                        echo ("UserGroups Modified By User-Name: " .  $modifiedBy->getName() . "\n");

                        echo ("UserGroups Modified By User-ID: " .  $modifiedBy->getId() . "\n");
                    }

                    echo ("User ModifiedTime: " .  $user->getModifiedTime() . "\n");

                    echo ("User CreatedTime: ");
                    print_r($user->getCreatedTime());
                    echo ("\n");

                    echo ("UserGroups Description: " .  $user->getDescription() . "\n");

                    echo ("UserGroups Id: " .  $user->getId() . "\n");

                    echo ("UserGroups Name: " .  $user->getName() . "\n");

                    $sources = $user->getSources();

                    if ($sources != null) {
                        foreach ($sources as $source) {
                            echo ("UserGroups Sources Type: " . $source->getType()->getValue() . "\n");

                            $source1 = $source->getSource();

                            if ($source1 != null) {
                                echo ("UserGroups Sources Id: " .  $source1->getId() . "\n");
                            }

                            echo ("UserGroups Sources Subordinates: " .  $source->getSubordinates() . "\n");

                            echo ("UserGroups Sources SubTerritories: " .  $source->getSubTerritories() . "\n");
                        }
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

    public static function updateGroup(string $groupId)
    {
        $userGroupsOperations = new UserGroupsOperations();

        // Get instance of BodyWrapper Class that will contain the request body
        $request = new BodyWrapper();

        // List of User instances
        $userList = array();

        // Get instance of User Class
        $user1 = new Groups();

        $user1->setName("test group");

        $user1->setDescription("my group");

        $sources = array();

        $source = new Sources();

        $source->setType(new Choice("users"));

        $source1 = new Source();

        $source1->setId("347706113767065");

        $source->setSource($source1);

        array_push($sources, $source);

        $user1->setSources($sources);

        array_push($userList, $user1);

        $request->setUserGroups($userList);

        $response = $userGroupsOperations->updateGroup($groupId, $request);

        if ($response != null) {
            //Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");

            //Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                //Get the received ActionWrapper instance
                $responseWrapper = $actionHandler;

                //Get the list of obtained ActionResponse instances
                $actionResponses = $responseWrapper->getUserGroups();

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

    public static function deleteGroup(string $groupId)
    {
        $userGroupsOperations = new UserGroupsOperations();

        $response = $userGroupsOperations->deleteGroup($groupId);

        if ($response != null) {
            //Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");

            //Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                //Get the received ActionWrapper instance
                $responseWrapper = $actionHandler;

                //Get the list of obtained ActionResponse instances
                $actionResponses = $responseWrapper->getUserGroups();

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

    public static function getStatus(string $jobId)
    {
        $userGroupsOperations = new UserGroupsOperations();

        $paramInstance = new ParameterMap();

        $paramInstance->add(GetStatusParam::jobId(), $jobId);

        $response = $userGroupsOperations->getStatus($paramInstance);

        if ($response != null) {
            //Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

                return;
            }

            // Get object from response
            $jobHandler = $response->getObject();

            if ($jobHandler instanceof JobsWrapper) {
                // Get the received ResponseWrapper instance
                $responseWrapper = $jobHandler;

                // Get the obtained User instance
                $jobs = $responseWrapper->getDeletionJobs();

                foreach ($jobs as $job) {
                    if ($job instanceof Jobs) {
                        echo ("Status: " .  $job->getStatus() . "\n");
                    }
                }
            }
            // Check if the request returned an exception
            else if ($jobHandler instanceof APIException) {
                // Get the received APIException instance
                $exception = $jobHandler;

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
}
