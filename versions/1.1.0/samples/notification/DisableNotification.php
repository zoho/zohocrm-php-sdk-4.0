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
class DisableNotification
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
     * <h3> Disable Specific Notifications </h3>
     * This method is used to disable notifications for the specified events in a channel.
     * @throws Exception
     */
    public static function disableNotification()
    {
        $notificationOperations = new NotificationOperations();
        $bodyWrapper = new BodyWrapper();
        //List of Notification instances
        $notificationList = array();
        $notificationClass = 'com\zoho\crm\api\notification\Notification';
        $notification = new $notificationClass();
        $notification->setChannelId("1006800211");
        $events = array();
        array_push($events, "Deals.edit");
        //To subscribe based on particular operations on given modules.
        $notification->setEvents($events);
        $notification->setDeleteevents(true);
        //Add Notification instance to the list
        array_push($notificationList, $notification);
        $bodyWrapper->setWatch($notificationList);
        //Call disableNotification which takes BodyWrapper instance as parameter
        $response = $notificationOperations->disableNotification($bodyWrapper);
        if ($response != null) {
            echo ("Status Code: " . $response->getStatusCode() . "\n");
            if ($response->isExpected()) {
                $actionHandler = $response->getObject();
                if ($actionHandler instanceof ActionWrapper) {
                    $actionWrapper = $actionHandler;
                    $actionResponses = $actionWrapper->getWatch();
                    foreach ($actionResponses as $actionResponse) {
                        if ($actionResponse instanceof SuccessResponse) {
                            $successResponse = $actionResponse;
                            echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                            echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                            if ($successResponse->getDetails() != null) {
                                echo ("Details: \n");
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
                            }
                            echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
                        }
                        else if ($actionResponse instanceof APIException) {
                            $exception = $actionResponse;
                            echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                            echo ("Code: " . $exception->getCode()->getValue() . "\n");
                            if ($exception->getDetails() != null) {
                                echo ("Details: \n");
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
DisableNotification::initialize();
DisableNotification::disableNotification();
