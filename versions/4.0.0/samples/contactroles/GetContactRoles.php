<?php
namespace contactroles;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\contactroles\BodyWrapper;
use com\zoho\crm\api\contactroles\ContactRolesOperations;
use com\zoho\crm\api\contactroles\APIException;
use com\zoho\crm\api\util\Choice;

require "vendor/autoload.php";
class GetContactRoles
{
    public static function initialize()
    {
        $environment = USDataCenter::PRODUCTION();
        $token = (new OAuthBuilder())
            ->clientId("1000.xxxx")
            ->clientSecret("xxxxxx")
            ->refreshToken("1000.xxxxx.xxxxx")
            ->build();
        (new InitializeBuilder())
            ->environment($environment)
            ->token($token)
            ->initialize();
    }
    /**
     * <h3> Get Contact Roles </h3>
     * This method is used to get all the Contact Roles and print the response.
     * @throws Exception
     */
    public static function getContactRoles()
    {
        $contactRolesOperations = new ContactRolesOperations();
        //Call getRoles method
        $response = $contactRolesOperations->getRoles();
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            $responseHandler = $response->getObject();
            if ($responseHandler instanceof BodyWrapper) {
                $responseWrapper = $responseHandler;
                $contactRoles = $responseWrapper->getContactRoles();
                foreach ($contactRoles as $contactRole) {
                    echo ("ContactRole ID: " . $contactRole->getId() . "\n");
                    echo ("ContactRole Name: " . $contactRole->getName() . "\n");
                    echo ("ContactRole SequenceNumber: " . $contactRole->getSequenceNumber() . "\n");
                }
            }
            else if ($responseHandler instanceof APIException) {
                $exception = $responseHandler;
                echo ("Status: " . $exception->getStatus()->getValue());
                echo ("Code: " . $exception->getCode()->getValue());
                echo ("Details: ");
                foreach ($exception->getDetails() as $key => $value) {
                    echo ($key . ": " . $value);
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
            }
        }
    }
}
GetContactRoles::initialize();
GetContactRoles::getContactRoles();
