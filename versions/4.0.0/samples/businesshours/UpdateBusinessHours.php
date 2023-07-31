<?php

namespace businesshours;

use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\businesshours\ActionWrapper;
use com\zoho\crm\api\businesshours\APIException;
use com\zoho\crm\api\businesshours\BodyWrapper;
use com\zoho\crm\api\businesshours\BreakHoursCustomTiming;
use com\zoho\crm\api\businesshours\BusinessHours;
use com\zoho\crm\api\businesshours\BusinessHoursCreated;
use com\zoho\crm\api\businesshours\BusinessHoursOperations;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\util\Choice;

require "vendor/autoload.php";
class UpdateBusinessHours
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
    public static function updateBusinessHours()
    {
        $businessHoursOperations = new BusinessHoursOperations("43234253");
        $request = new BodyWrapper();
        $businessHours = new BusinessHours();
        $businessHours->setId(44021017425);
        $businessHours->setSameAsEveryday(false);
        $businessDays = array();
        array_push($businessDays, new Choice("Monday"));
        array_push($businessDays, new Choice("Tuesday"));
        array_push($businessDays, new Choice("Wednesday"));
//        array_push($businessDays, new Choice("Thursday"));
//        array_push($businessDays, new Choice("Friday"));
        $businessHours->setBusinessDays($businessDays);
        $businessHours->setWeekStartsOn(new Choice("Monday"));
        $bhct = new BreakHoursCustomTiming();
        $bhct->setDays(new Choice("Monday"));
        $businessTiming = array();
        array_push($businessTiming, "09:00");
        array_push($businessTiming, "17:00");
        $bhct->setBusinessTiming($businessTiming);
        $bhct1 = new BreakHoursCustomTiming();
        $bhct1->setDays(new Choice("Tuesday"));
        $businessTiming1 = array();
        array_push($businessTiming1, "09:00");
        array_push($businessTiming1, "16:00");
        $bhct1->setBusinessTiming($businessTiming1);
        $bhct2 = new BreakHoursCustomTiming();
        $bhct2->setDays(new Choice("Wednesday"));
        $businessTiming2 = array();
        array_push($businessTiming2, "09:00");
        array_push($businessTiming2, "15:00");
        $bhct2->setBusinessTiming($businessTiming2);
        $customTiming = array();
        array_push($customTiming, $bhct);
        array_push($customTiming, $bhct1);
        array_push($customTiming, $bhct2);
        $businessHours->setCustomTiming($customTiming);
        // when sameAsEveryDay is true
       $dailyTiming = array();
       array_push($dailyTiming, "10:00");
       array_push($dailyTiming, "19:00");
        $businessHours->setType(new Choice("custom"));
        $request->setBusinessHours($businessHours);
        $response = $businessHoursOperations->updateBusinessHours($request);
        if ($response != null)
        {
            echo ("Status Code: " . $response->getStatusCode());
            if($response->isExpected())
            {
                $actionHandler = $response->getObject();
                if ($actionHandler instanceof ActionWrapper)
                {
                    $actionWrapper = $actionHandler;
                    $actionResponse = $actionWrapper->getBusinessHours();
                    if ($actionResponse instanceof BusinessHoursCreated)
                    {
                        $businessHoursCreated = $actionResponse;
                        echo ("Status: " . $businessHoursCreated->getStatus()->getValue() . "\n");
                        echo ("Code: " . $businessHoursCreated->getCode()->getValue() . "\n");
                        echo ("Details: ");
                        foreach ($businessHoursCreated->getDetails() as $key => $value)
                        {
                            echo ($key . " : ");
                            print_r($value);
                            echo ("\n");
                        }
                        echo ("Message: " . ($businessHoursCreated->getMessage() instanceof Choice ? $businessHoursCreated->getMessage()->getValue() : $businessHoursCreated->getMessage()) . "\n");
                    }
                    else if ($actionResponse instanceof APIException) {
                        $exception = $actionResponse;
                        echo("Status: " . $exception->getStatus()->getValue() . "\n");
                        echo("Code: " . $exception->getCode()->getValue() . "\n");
                        echo("Details: ");
                        foreach ($exception->getDetails() as $key => $value) {
                            echo($key . " : " . $value . "\n");
                        }
                        echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                    }
                }
                elseif ($actionHandler instanceof APIException)
                {
                    $exception = $actionHandler;
                    echo("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo("Code: " . $exception->getCode()->getValue() . "\n");
                    echo("Details: ");
                    foreach ($exception->getDetails() as $key => $value) {
                        echo($key . " : " . $value . "\n");
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
                }
            }
        }
    }
}

UpdateBusinessHours::initialize();
UpdateBusinessHours::updateBusinessHours();