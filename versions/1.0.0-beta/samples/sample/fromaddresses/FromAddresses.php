<?php

namespace com\zoho\crm\sample\fromaddresses;

use com\zoho\crm\api\fromaddresses\APIException;
use com\zoho\crm\api\fromaddresses\FromAddressesOperations;
use com\zoho\crm\api\fromaddresses\ResponseWrapper;

class FromAddresses
{
    public static function getEmailAddresses()
    {
        $sendMailsOperations = new FromAddressesOperations();

        $response = $sendMailsOperations->getAddresses();

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

                // Get the list of obtained UserAdress instances
                $userAddresses = $responseWrapper->getFromAddresses();

                foreach ($userAddresses as $userAddress) {
                    // Get the Email of each UserAdress
                    echo ("UserAdress Email: " . $userAddress->getEmail() . "\n");

                    // Get the Type of each UserAdress
                    echo ("UserAdress Type: " . $userAddress->getType() . "\n");

                    // Get the UserName of each UserAdress
                    echo ("UserAdress UserName: " . $userAddress->getUserName() . "\n");

                    // Get the Default of each UserAdress
                    echo ("UserAdress Default: " . $userAddress->getDefault() . "\n");
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
