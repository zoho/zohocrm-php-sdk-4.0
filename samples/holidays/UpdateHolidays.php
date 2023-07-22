<?php

namespace holidays;

use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\HeaderMap;
use com\zoho\crm\api\holidays\ActionWrapper;
use com\zoho\crm\api\holidays\APIException;
use com\zoho\crm\api\holidays\Holiday;
use com\zoho\crm\api\holidays\Holidays;
use com\zoho\crm\api\holidays\HolidaysOperations;
use com\zoho\crm\api\holidays\ShiftHour;
use com\zoho\crm\api\holidays\SuccessResponse;
use com\zoho\crm\api\holidays\UpdateHolidaysHeader;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\util\Choice;
require "vendor/autoload.php";

class UpdateHolidays
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
    public static function updateHolidays()
    {
        $holidaysOperations = new HolidaysOperations();
        $request = new Holidays();
        $holidays = array();
        $holiday = new Holiday();
        $holiday->setId(440248000001218028);
        $holiday->setName("holi");
        $holiday->setDate(new \DateTime('2023-12-12'));
        $holiday->setType(new Choice("shift_holiday"));
        // when type is shift holiday
        $shifthour = new ShiftHour();
        $shifthour->setName("shift hour for Tx");
        $shifthour->setId(440248000001221189);
        $holiday->setShiftHour($shifthour);
        //
        $holiday->setYear(2023);
        array_push($holidays, $holiday);
        $request->setHolidays($holidays);
        $headerInsatnce = new HeaderMap();
        $headerInsatnce->add(UpdateHolidaysHeader::XCRMORG(), "440248020813");
        $response = $holidaysOperations->updateHolidays($request, $headerInsatnce);
        if($response != null)
        {
            echo("Status Code: " . $response->getStatusCode());
            if($response->isExpected())
            {
                $actionHandler = $response->getObject();
                if ($actionHandler instanceof ActionWrapper)
                {
                    $actionWrapper = $actionHandler;
                    $actionResponses = $actionWrapper->getHolidays();
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
                                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
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
UpdateHolidays::initialize();
UpdateHolidays::updateHolidays();