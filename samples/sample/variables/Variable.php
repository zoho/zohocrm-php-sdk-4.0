<?php

namespace com\zoho\crm\sample\variables;

use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\variables\VariableGroup;
use com\zoho\crm\api\variables\APIException;
use com\zoho\crm\api\variables\ActionWrapper;
use com\zoho\crm\api\variables\BodyWrapper;
use com\zoho\crm\api\variables\SuccessResponse;
use com\zoho\crm\api\variables\VariablesOperations;
use com\zoho\crm\api\variables\DeleteVariablesParam;
use com\zoho\crm\api\variables\GetVariableByIDParam;
use com\zoho\crm\api\variables\GetVariableByAPINameParam;
use com\zoho\crm\api\variables\GetVariablesParam;
use com\zoho\crm\api\util\Choice;

class Variable
{

    /**
     * <h3> Get Variables </h3>
     * This method is used to retrieve all the available variables through an API request and print the response.
     * @throws Exception
     */
    public static function getVariables()
    {
        //Get instance of VariablesOperations Class
        $variablesOperations = new VariablesOperations();

        //Get instance of ParameterMap Class
        $paramInstance = new ParameterMap();

        $paramInstance->add(GetVariablesParam::group(), "General");

        //Call getVariables method that takes paramInstance as parameter
        $response = $variablesOperations->getVariables($paramInstance);

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
                //Get the received ActionWrapper instance
                $responseWrapper = $responseHandler;

                //Get the obtained Variable instance
                $variables = $responseWrapper->getVariables();

                if ($variables != null) {
                    foreach ($variables as $variable) {
                        //Get the APIName of each Variable
                        echo ("Variable APIName: " . $variable->getAPIName() . "\n");

                        //Get the Name of each Variable
                        echo ("Variable Name: " . $variable->getName() . "\n");

                        //Get the Description of each Variable
                        echo ("Variable Description: " . $variable->getDescription() . "\n");

                        //Get the ID of each Variable
                        echo ("Variable ID: " . $variable->getId() . "\n");

                        //Get the Source of each Variable
                        echo ("Variable Source: " . $variable->getSource() . "\n");

                        //Get the Type of each Variable
                        echo ("Variable Type: " . $variable->getType()->getValue() . "\n");

                        // Get the VariableGroup instance of each Variable
                        $variableGroup = $variable->getVariableGroup();

                        //Check if variableGroup is not null
                        if ($variableGroup != null) {
                            //Get the Name of each VariableGroup
                            echo ("Variable VariableGroup APIName: " . $variableGroup->getAPIName() . "\n");

                            //Get the ID of each VariableGroup
                            echo ("Variable VariableGroup ID: " . $variableGroup->getId() . "\n");
                        }

                        //Get the Value of each Variable
                        echo ("Variable Value: " . $variable->getValue() . "\n");
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
     * <h3> Create Variables </h3>
     * This method is used to create a new variable in CRM and print the response.
     * @throws Exception
     */
    public static function createVariables()
    {
        //Get instance of VariablesOperations Class
        $variablesOperations = new VariablesOperations();

        //Get instance of BodyWrapper Class that will contain the request body
        $request = new BodyWrapper();

        //List of Variable instances
        $variableList = array();

        $variableClass = 'com\zoho\crm\api\variables\Variable';

        //Get instance of Variable Class
        $variable1 = new $variableClass();

        $variable1->setName("Variable66143e423");

        $variable1->setAPIName("Variable66143e423");

        $variableGroup = new VariableGroup();

        $variableGroup->setName("General");

        $variableGroup->setId("34770613089001");

        $variable1->setVariableGroup($variableGroup);

        $variable1->setType(new Choice("integer"));

        $variable1->setValue("42");

        $variable1->setDescription("This denotes variable 5 description");

        array_push($variableList, $variable1);

        $variable1 = new $variableClass();

        $variable1->setName("Variable66143e42");

        $variable1->setAPIName("Variable66143e42");

        $variableGroup = new VariableGroup();

        $variableGroup->setName("General");

        $variable1->setVariableGroup($variableGroup);

        $variable1->setType(new Choice("text"));

        $variable1->setValue("H2ello");

        $variable1->setDescription("This denotes variable 6 description");

        array_push($variableList, $variable1);

        $request->setVariables($variableList);

        //Call createVariables method that takes BodyWrapper instance as parameter
        $response = $variablesOperations->createVariable($request);

        if ($response != null) {
            //Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");

            //Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                //Get the received ActionWrapper instance
                $actionWrapper = $actionHandler;

                //Get the list of obtained ActionResponse instances
                $actionResponses = $actionWrapper->getVariables();

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

                        //Get the details map
                        foreach ($exception->getDetails() as $key => $value) {
                            //Get each value in the map
                            echo ($key . " : " . $value . "\n");
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
     *  <h3> Update Variables </h3>
     * This method is used to update details of variables in CRM and print the response.
     * @throws Exception
     */
    public static function updateVariables()
    {
        //Get instance of VariablesOperations Class
        $variablesOperations = new VariablesOperations();

        //Get instance of BodyWrapper Class that will contain the request body
        $request = new BodyWrapper();

        //List of Variable instances
        $variableList = array();

        $variableClass = 'com\zoho\crm\api\variables\Variable';

        //Get instance of Variable Class
        $variable1 = new $variableClass();

        $variable1->setId("347706113485001");

        $variable1->setValue("4763");

        $variable1->setAPIName("er");

        array_push($variableList, $variable1);

        $variable1 = new $variableClass();

        $variable1->setId("347706112448013");
        $variable1->setAPIName("eer");

        $variable1->setDescription("This is a new description");

        array_push($variableList, $variable1);

        $variable1 = new $variableClass();

        $variable1->setId("34770617444012");

        $variable1->setAPIName("re");

        array_push($variableList, $variable1);

        $request->setVariables($variableList);

        //Call updateVariables method that takes BodyWrapper class instance as parameter
        $response = $variablesOperations->updateVariables($request);

        if ($response != null) {
            //Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");

            //Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                //Get the received ActionWrapper instance
                $actionWrapper = $actionHandler;

                //Get the list of obtained ActionResponse instances
                $actionResponses = $actionWrapper->getVariables();

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

                        //Get the details map
                        foreach ($exception->getDetails() as $key => $value) {
                            //Get each value in the map
                            echo ($key . " : " . $value . "\n");
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
     *  <h3> Delete Variables </h3>
     * This method is used to delete details of multiple variables in CRM simultaneously and print the response.
     * @param variableIds - The ID of the Variable to be obtainted
     * @throws Exception
     */
    public static function deleteVariables(array $variableIds)
    {
        //Get instance of VariablesOperations Class
        $variablesOperations = new VariablesOperations();

        //Get instance of ParameterMap Class
        $paramInstance = new ParameterMap();

        foreach ($variableIds as $variableId) {
            $paramInstance->add(DeleteVariablesParam::ids(), $variableId);
        }

        //Call deleteVariables method that takes BodyWrapper class instance as parameter
        $response = $variablesOperations->deleteVariables($paramInstance);

        if ($response != null) {
            //Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");

            //Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                //Get the received ActionWrapper instance
                $actionWrapper = $actionHandler;

                //Get the list of obtained ActionResponse instances
                $actionResponses = $actionWrapper->getVariables();

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

                        //Get the details map
                        foreach ($exception->getDetails() as $key => $value) {
                            //Get each value in the map
                            echo ($key . " : " . $value . "\n");
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
     * <h3> Get Variable By Id </h3>
     * This method is used to get the details of any specific variable.
     * Specify the unique ID of the variable in your API request to get the data for that particular variable group.
     * @param variableId - The ID of the Variable to be obtainted
     * @throws Exception
     */
    public static function getVariableById(string $variableId)
    {
        //Get instance of VariablesOperations Class
        $variablesOperations = new VariablesOperations();

        //Get instance of ParameterMap Class
        $paramInstance = new ParameterMap();

        $paramInstance->add(GetVariableByIDParam::group(), "General"); //"General"

        //Call getVariableByGroupId method that takes paramInstance and variableId as parameter
        $response = $variablesOperations->getVariableById($variableId, $paramInstance);

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
                //Get the received ActionWrapper instance
                $responseWrapper = $responseHandler;

                //Get the obtained Variable instance
                $variables = $responseWrapper->getVariables();

                if ($variables != null) {
                    foreach ($variables as $variable) {
                        //Get the APIName of each Variable
                        echo ("Variable APIName: " . $variable->getAPIName() . "\n");

                        //Get the Name of each Variable
                        echo ("Variable Name: " . $variable->getName() . "\n");

                        //Get the Description of each Variable
                        echo ("Variable Description: " . $variable->getDescription() . "\n");

                        //Get the ID of each Variable
                        echo ("Variable ID: " . $variable->getId() . "\n");

                        //Get the Type of each Variable
                        echo ("Variable Type: " . $variable->getType()->getValue() . "\n");

                        // Get the VariableGroup instance of each Variable
                        $variableGroup = $variable->getVariableGroup();

                        //Check if variableGroup is not null
                        if ($variableGroup != null) {
                            //Get the Name of each VariableGroup
                            echo ("Variable VariableGroup APIName: " . $variableGroup->getAPIName() . "\n");

                            //Get the ID of each VariableGroup
                            echo ("Variable VariableGroup ID: " . $variableGroup->getId() . "\n");
                        }

                        //Get the Value of each Variable
                        echo ("Variable Value: " . $variable->getValue() . "\n");
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
     * <h3> Update Variable By Id </h3>
     * This method is used to update details of a specific variable in CRM and print the response.
     * @param variableId - The ID of the Variable to be obtainted
     * @throws Exception
     */
    public static function updateVariableById(string $variableId)
    {
        //Get instance of VariablesOperations Class
        $variablesOperations = new VariablesOperations();

        //Get instance of BodyWrapper Class that will contain the request body
        $request = new BodyWrapper();

        //List of Variable instances
        $variableList = array();

        $variableClass = 'com\zoho\crm\api\variables\Variable';

        //Get instance of Variable Class
        $variable1 = new $variableClass();

        $variable1->setAPIName("TestAPIName");

        array_push($variableList, $variable1);

        $request->setVariables($variableList);

        //Call updateVariableById method that takes BodyWrapper instance and variableId as parameter
        $response = $variablesOperations->updateVariableById($variableId, $request);

        if ($response != null) {
            //Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");

            //Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                //Get the received ActionWrapper instance
                $actionWrapper = $actionHandler;

                //Get the list of obtained ActionResponse instances
                $actionResponses = $actionWrapper->getVariables();

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

                        //Get the details map
                        foreach ($exception->getDetails() as $key => $value) {
                            //Get each value in the map
                            echo ($key . " : " . $value . "\n");
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
     *  <h3> Delete Variable </h3>
     * This method is used to delete details of a specific variable in CRM and print the response.
     * @param variableId - The ID of the Variable to be obtainted
     * @throws Exception
     */
    public static function deleteVariable(string $variableId)
    {
        //Get instance of VariablesOperations Class
        $variablesOperations = new VariablesOperations();

        //Call deleteVariable method that takes variableId as parameter
        $response = $variablesOperations->deleteVariable($variableId);

        if ($response != null) {
            //Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");

            //Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                //Get the received ActionWrapper instance
                $actionWrapper = $actionHandler;

                //Get the list of obtained ActionResponse instances
                $actionResponses = $actionWrapper->getVariables();

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

                        //Get the details map
                        foreach ($exception->getDetails() as $key => $value) {
                            //Get each value in the map
                            echo ($key . " : " . $value . "\n");
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
     * This method is used to get the details of any specific variable.
     * Specify the unique name of the variable in your API request to get the data for that particular variable group.
     * @param variableName - The name of the Variable to be obtainted
     * @throws Exception
     */
    public static function getVariableForAPIName(string $variableName)
    {
        //Get instance of VariablesOperations Class
        $variablesOperations = new VariablesOperations();

        //Get instance of ParameterMap Class
        $paramInstance = new ParameterMap();

        $paramInstance->add(GetVariableByAPINameParam::group(), "General"); //"34770613089001"

        //Call getVariableForGroupAPIName method that takes paramInstance and variableName as parameter
        $response = $variablesOperations->getVariableByApiname($variableName, $paramInstance);

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
                //Get the received ActionWrapper instance
                $responseWrapper = $responseHandler;

                //Get the obtained Variable instance
                $variables = $responseWrapper->getVariables();

                if ($variables != null) {
                    foreach ($variables as $variable) {
                        //Get the APIName of each Variable
                        echo ("Variable APIName: " . $variable->getAPIName() . "\n");

                        //Get the Name of each Variable
                        echo ("Variable Name: " . $variable->getName() . "\n");

                        //Get the Description of each Variable
                        echo ("Variable Description: " . $variable->getDescription() . "\n");

                        //Get the ID of each Variable
                        echo ("Variable ID: " . $variable->getId() . "\n");

                        //Get the Type of each Variable
                        echo ("Variable Type: " . $variable->getType()->getValue() . "\n");

                        // Get the VariableGroup instance of each Variable
                        $variableGroup = $variable->getVariableGroup();

                        //Check if variableGroup is not null
                        if ($variableGroup != null) {
                            //Get the Name of each VariableGroup
                            echo ("Variable VariableGroup APIName: " . $variableGroup->getAPIName() . "\n");

                            //Get the ID of each VariableGroup
                            echo ("Variable VariableGroup ID: " . $variableGroup->getId() . "\n");
                        }

                        //Get the Value of each Variable
                        echo ("Variable Value: " . $variable->getValue() . "\n");
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
     * This method is used to update details of a specific variable in CRM and print the response.
     * @param variableName - The name of the Variable to be obtainted
     * @throws Exception
     */
    public static function updateVariableByAPIName(string $variableName)
    {
        //Get instance of VariablesOperations Class
        $variablesOperations = new VariablesOperations();

        //Get instance of BodyWrapper Class that will contain the request body
        $request = new BodyWrapper();

        //List of Variable instances
        $variableList = array();

        $variableClass = 'com\zoho\crm\api\variables\Variable';

        //Get instance of Variable Class
        $variable1 = new $variableClass();

        $variable1->setDescription("Test update Variable By APIName");

        array_push($variableList, $variable1);

        $request->setVariables($variableList);

        //Call updateVariableByAPIName method that takes BodyWrapper instance and variableName as parameter
        $response = $variablesOperations->updateVariableByAPIName($variableName, $request);

        if ($response != null) {
            //Get the status code from response
            echo ("Status Code: " . $response->getStatusCode() . "\n");

            //Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                //Get the received ActionWrapper instance
                $actionWrapper = $actionHandler;

                //Get the list of obtained ActionResponse instances
                $actionResponses = $actionWrapper->getVariables();

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

                        //Get the details map
                        foreach ($exception->getDetails() as $key => $value) {
                            //Get each value in the map
                            echo ($key . " : " . $value . "\n");
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
