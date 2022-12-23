<?php

namespace com\zoho\crm\sample\file;

use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\files\APIException;
use com\zoho\crm\api\files\ActionWrapper;
use com\zoho\crm\api\files\BodyWrapper;
use com\zoho\crm\api\files\FilesOperations;
use com\zoho\crm\api\files\SuccessResponse;
use com\zoho\crm\api\files\GetFileParam;
use com\zoho\crm\api\util\StreamWrapper;
use com\zoho\crm\api\files\FileBodyWrapper;

class File
{
    /**
     * <h3> Upload File</h3>
     * This method is used to upload a file and print the response.
     * @throws Exception
     */
    public static function uploadFiles()
    {
        //Get instance of FilesOperations Class
        $fileOperations = new FilesOperations();

        //Get instance of FileBodyWrapper Class that will contain the request body
        $bodyWrapper = new BodyWrapper();

        //Get instance of StreamWrapper class that takes absolute path of the file to be attached as parameter
        $streamWrapper = new StreamWrapper(null, null, "/usr/download.png");

        //Get instance of StreamWrapper class that takes absolute path of the file to be attached as parameter
        $streamWrapper1 = new StreamWrapper(null, null, "/usr/download.png");

        //Get instance of StreamWrapper class that takes absolute path of the file to be attached as parameter
        $streamWrapper2 = new StreamWrapper(null, null, "/usr/download.png");

        //Set file to the FileBodyWrapper instance
        $bodyWrapper->setFile([$streamWrapper, $streamWrapper1, $streamWrapper2]);

        //Get instance of ParameterMap Class
        $paramInstance = new ParameterMap();

        //Call uploadFiles method that takes BodyWrapper instance as parameter.
        $response = $fileOperations->uploadFiles($bodyWrapper, $paramInstance);

        if ($response != null) {
            //Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

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

    /**
     * <h3> Get File</h3>
     * @param id - The ID of the uploaded File.
     * @param destinationFolder - The absolute path of the destination folder to store the File
     * @throws Exception
     */
    public static function getFile(string $id, string $destinationFolder)
    {
        //example
        //id = "347706177002";
        //destinationFolder = "/Users/user_name/Desktop"

        //Get instance of FilesOperations Class
        $fileOperations = new FilesOperations();

        //Get instance of ParameterMap Class
        $paramInstance = new ParameterMap();

        $paramInstance->add(GetFileParam::id(), $id);

        //Call getFile method that takes paramInstance as parameters
        $response = $fileOperations->getFile($paramInstance);

        if ($response != null) {
            //Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

                return;
            }

            //Get object from response
            $responseHandler = $response->getObject();

            if ($responseHandler instanceof FileBodyWrapper) {
                //Get object from response
                $fileBodyWrapper = $responseHandler;

                //Get StreamWrapper instance from the returned FileBodyWrapper instance
                $streamWrapper = $fileBodyWrapper->getFile();

                //Create a file instance with the absolute_file_path
                $fp = fopen($destinationFolder . "/" . $streamWrapper->getName(), "w");

                //Get stream from the response
                $stream = $streamWrapper->getStream();

                fputs($fp, $stream);

                fclose($fp);
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
}
