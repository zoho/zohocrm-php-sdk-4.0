<?php

namespace shifthours;

use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\shifthours\ActionWrapper;
use com\zoho\crm\api\shifthours\APIException;
use com\zoho\crm\api\shifthours\BreakHours;
use com\zoho\crm\api\shifthours\BreakHoursCustomTiming;
use com\zoho\crm\api\shifthours\CustomTiming;
use com\zoho\crm\api\shifthours\Holidays;
use com\zoho\crm\api\shifthours\RequestWrapper;
use com\zoho\crm\api\shifthours\ShiftHour;
use com\zoho\crm\api\shifthours\ShiftHoursOperations;
use com\zoho\crm\api\shifthours\SuccessResponse;
use com\zoho\crm\api\shifthours\Users;
use com\zoho\crm\api\util\Choice;
require "vendor/autoload.php";

class CreateShiftHours
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
    public static function createShiftHours()
    {
        $shifthoursOperations = new ShiftHoursOperations("440248020813");
        $request = new RequestWrapper();
        $shiftHours = array();
        $shifthour = new ShiftHour();
        $shifthour->setTimezone(new Choice("Asia/Kolkata"));
        $shifthour->setName("shift hours");
        $shifthour->setSameAsEveryday(false);
        $shiftDays = array();
        array_push($shiftDays, new Choice("Monday"));
        array_push($shiftDays, new Choice("Tuesday"));
        $shifthour->setShiftDays($shiftDays);
        // if same_as_every_day is true
        $dailyTiming = array();
        array_push($dailyTiming, "10:00");
        array_push($dailyTiming, "19:00");
        $shifthour->setDailyTiming($dailyTiming);
        // if same_as_every_day is false
        $customTimings = array();
        $customTiming = new CustomTiming();
        $shiftTiming = array();
        array_push($shiftTiming, "10:00");
        array_push($shiftTiming, "19:00");
        $customTiming->setShiftTiming($shiftTiming);
        $customTiming->setDays(new Choice("Monday"));
        array_push($customTimings, $customTiming);
        $customTiming1 = new CustomTiming();
        $shiftTiming1 = array();
        array_push($shiftTiming1, "10:00");
        array_push($shiftTiming1, "18:00");
        $customTiming1->setShiftTiming($shiftTiming1);
        $customTiming1->setDays(new Choice("Tuesday"));
        array_push($customTimings, $customTiming1);
        $shifthour->setCustomTiming($customTimings);
        //
       $breakHours = array();
       $breakhour = new BreakHours();
       $breakDays = array();
       array_push($breakDays, new Choice("Monday"));
       array_push($breakDays, new Choice("Tuesday"));
       $breakhour->setBreakDays($breakDays);
       // if same as everyday is true
       $breakhour->setSameAsEveryday(true);
       $dailyTimingForBreakHours = array();
       array_push($dailyTimingForBreakHours, "11:00");
       array_push($dailyTimingForBreakHours, "11:30");
       $breakhour->setDailyTiming($dailyTimingForBreakHours);
       array_push($breakHours, $breakhour);
       $shifthour->setBreakHours($breakHours);
        // if same_as_everyday is false
       $breakhour->setSameAsEveryday(false);
       $customTimingsForBreakHours = array();
       $customTimingForBreakHour = new BreakHoursCustomTiming();
       $breakTimings = array();
       array_push($breakTimings, "12:00");
       array_push($breakTimings, "12:15");
       $customTimingForBreakHour->setBreakTiming($breakTimings);
       $customTimingForBreakHour->setDays(new Choice("Monday"));
       array_push($customTimingsForBreakHours, $customTimingForBreakHour);
       $customTimingForBreakHour1 = new BreakHoursCustomTiming();
       $breakTimings1 = array();
       array_push($breakTimings1, "12:00");
       array_push($breakTimings1, "12:15");
       $customTimingForBreakHour1->setBreakTiming($breakTimings1);
       $customTimingForBreakHour1->setDays(new Choice("Monday"));
       array_push($customTimingsForBreakHours, $customTimingForBreakHour1);
       $breakhour->setCustomTiming($customTimingsForBreakHours);
       array_push($breakHours, $breakhour);
       $shifthour->setBreakHours($breakHours);
        //
        $users = array();
        $user = new Users();
        $user->setId("440248254001");
//        $user->setEffectiveFrom(new \DateTime("2023-08-12"));
        array_push($users, $user);
        $shifthour->setUsers($users);
        $holidays = array();
        $holiday = new Holidays();
        $holiday->setDate(new \DateTime("2021-12-12"));
//        $holiday->setId("3032423434323");
        $holiday->setName("Holi0");
        $holiday->setYear(2023);
        array_push($holidays, $holiday);
        $shifthour->setHolidays($holidays);
        array_push($shiftHours, $shifthour);
        $request->setShiftHours($shiftHours);
        $response = $shifthoursOperations->createShiftHours($request);
        if($response != null)
        {
            echo("Status Code: " . $response->getStatusCode());
            if($response->isExpected())
            {
                $actionHandler = $response->getObject();
                if ($actionHandler instanceof ActionWrapper)
                {
                    $actionWrapper = $actionHandler;
                    $actionResponses = $actionWrapper->getShiftHours();
                    if ($actionResponses != null)
                    {
                        foreach ($actionResponses as $actionResponse)
                        {
                            if ($actionResponse instanceof SuccessResponse)
                            {
                                $successResponse = $actionResponse;
                                echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                                echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                                echo ("Details: ");
                                foreach ($successResponse->getDetails() as $key => $value)
                                {
                                    echo ($key . " : ");
                                    print_r($value);
                                    echo ("\n");
                                }
                                echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
                            }
                            else if ($actionResponse instanceof APIException) {
                                $exception = $actionResponse;
                                echo("Status: " . $exception->getStatus()->getValue() . "\n");
                                echo("Code: " . $exception->getCode()->getValue() . "\n");
                                echo("Details: ");
                                foreach ($exception->getDetails() as $key => $value) {
                                    echo($key . " : " . $value . "\n");
                                }
                                echo("Message: " . $exception->getMessage() . "\n");
                            }
                        }
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
CreateShiftHours::initialize();;
CreateShiftHours::createShiftHours();