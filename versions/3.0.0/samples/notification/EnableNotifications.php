<?php
namespace notification;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\notification\APIException;
use com\zoho\crm\api\notification\ActionWrapper;
use com\zoho\crm\api\notification\BodyWrapper;
use com\zoho\crm\api\notification\NotificationOperations;
use com\zoho\crm\api\notification\SuccessResponse;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class EnableNotifications
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
     * <h3> Enable Notifications </h3>
     * This method is used to Enable Notifications and print the response.
     * @throws Exception
     */
    public static function enableNotifications()
    {
        $notificationOperations = new NotificationOperations();
        $bodyWrapper = new BodyWrapper();
        //List of Notification instances
        $notifications = array();
        $notificationClass = 'com\zoho\crm\api\notification\Notification';
        $notification = new $notificationClass();
        $notification->setChannelId("1006800211");
        $events = array();
        array_push($events, "Deals.all");
        //To subscribe based on particular operations on given modules.
        $notification->setEvents($events);
        $notification->setChannelExpiry(date_create("2019-05-07T15:32:24")->setTimezone(new \DateTimeZone(date_default_timezone_get())));
        //To ensure that the notification is sent from Zoho CRM, by sending back the given value in notification URL body.
        //By using this value, user can validate the notifications.
        $notification->setToken("TOKEN_FOR_VERIFICATION_OF_10068002");
        //URL to be notified (POST request)
        $notification->setNotifyUrl("https://www.zohoapis.com");
        //Add Notification instance to the list
        array_push($notifications, $notification);
        $notification2 = new $notificationClass();
        $notification2->setChannelId("1006800211");
        $events2 = array();
        array_push($events2, "Accounts.all");
        //To subscribe based on particular operations on given modules.
        $notification2->setEvents($events2);
        $dateTime = date_create("2019-05-07T15:32:24")->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        $notification2->setChannelExpiry($dateTime);
        //To ensure that the notification is sent from Zoho CRM, by sending back the given value in notification URL body.
        //By using this value, user can validate the notifications.
        $notification2->setToken("TOKEN_FOR_VERIFICATION_OF_10068002");
        //URL to be notified (POST request)
        $notification2->setNotifyUrl("https://www.zohoapis.com");
        //Add Notification instance to the list
        array_push($notifications, $notification2);
        $bodyWrapper->setWatch($notifications);
        //Call enableNotifications method that takes BodyWrapper instance as parameter
        $response = $notificationOperations->enableNotifications($bodyWrapper);
        if ($response != null) {
            echo ("Status Code: " . $response->getStatusCode());
            if ($response->isExpected()) {
                $actionHandler = $response->getObject();
                if ($actionHandler instanceof ActionWrapper) {
                    $actionWrapper =  $actionHandler;
                    $actionResponses = $actionWrapper->getWatch();
                    foreach ($actionResponses as $actionResponse) {
                        if ($actionResponse instanceof SuccessResponse) {
                            $successResponse = $actionResponse;
                            echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                            echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                            echo ("Details: ");
                            foreach ($successResponse->getDetails() as $keyName => $value) {
                                if ((is_array($value) && sizeof($value) > 0) && isset($value[0])) {
                                    if ($value[0] instanceof $notificationClass) {
                                        $eventList = $value;
                                        foreach ($eventList as $event) {
                                            echo ("Notification ChannelExpiry: ");
                                            print_r($event->getChannelExpiry());
                                            echo ("Notification ResourceUri: " . $event->getResourceUri() . "\n");
                                            echo ("Notification ResourceId: " . $event->getResourceId() . "\n");
                                            echo ("Notification ResourceName: " . $event->getResourceName() . "\n");
                                            echo ("Notification ChannelId: " . $event->getChannelId() . "\n");
                                        }
                                    }
                                } else {
                                    echo ($keyName . ": ");
                                    print_r($value);
                                }
                            }
                            echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
                        }
                        else if ($actionResponse instanceof APIException) {
                            $exception = $actionResponse;
                            echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                            echo ("Code: " . $exception->getCode()->getValue() . "\n");
                            echo ("Details: ");
                            if ($exception->getDetails() != null) {
                                foreach ($exception->getDetails() as $keyName => $keyValue) {
                                    echo ($keyName . ": " . $keyValue . "\n");
                                }
                            }
                            echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                        }
                    }
                }
                else if ($actionHandler instanceof APIException) {
                    $exception = $actionHandler;
                    echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo ("Code: " . $exception->getCode()->getValue() . "\n");
                    echo ("Details: ");
                    if ($exception->getDetails() != null) {
                        echo ("Details: \n");
                        foreach ($exception->getDetails() as $keyName => $keyValue) {
                            echo ($keyName . ": " . $keyValue . "\n");
                        }
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                }
            } else { //If response is not as expected
                print_r($response);
            }
        }
    }
}
EnableNotifications::initialize();
EnableNotifications::enableNotifications();
