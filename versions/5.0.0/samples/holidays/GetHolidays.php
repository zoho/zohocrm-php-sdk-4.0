<?php

namespace holidays;

use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\HeaderMap;
use com\zoho\crm\api\holidays\APIException;
use com\zoho\crm\api\holidays\GetHolidaysHeader;
use com\zoho\crm\api\holidays\GetHolidaysParam;
use com\zoho\crm\api\holidays\Holiday;
use com\zoho\crm\api\holidays\Holidays;
use com\zoho\crm\api\holidays\HolidaysOperations;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\util\Choice;

require "vendor/autoload.php";

class GetHolidays
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
    public static function getHolidays()
    {
        $holidayOperations = new HolidaysOperations();
        $paramInsatnce = new ParameterMap();
        $paramInsatnce->add(GetHolidaysParam::year(), 2023);
        $paramInsatnce->add(GetHolidaysParam::shiftId(), "4402481216036");
        $headerInstance = new HeaderMap();
        $headerInstance->add(GetHolidaysHeader::XCRMORG(), "4402420813");
        $response = $holidayOperations->getHolidays($paramInsatnce, $headerInstance);
        if ($response != null)
        {
            echo("Status Code: " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204,304)))
            {
                echo($response->getStatusCode() == 204 ? "No Content" : "Not Modified");
                return;
            }
            if ($response->isExpected())
            {
                $responseHandler = $response->getObject();
                if ($responseHandler instanceof Holidays)
                {
                    $responseWrapper = $responseHandler;
                    $holidays = $responseWrapper->getHolidays();
                    if ($holidays != null)
                    {
                        echo ("Holidays : " . "\n");
                        foreach ($holidays as $holiday)
                        {
                            if ($holiday instanceof Holiday)
                            {
                                echo("Holiday Id: " . $holiday->getId() . "\n");
                                echo("Name : " . $holiday->getName() . "\n");
                                echo("date : " . date_format($holiday->getDate(), 'd-m-y-H-i-s') . "\n");
                                echo("year : " . $holiday->getYear()) . "\n";
                                echo("type : " . $holiday->getType()->getValue() . "\n");
                                $shifthour = $holiday->getShiftHour();
                                if ($shifthour != null)
                                {
                                    echo("ShiftHour : " . "\n");
                                    echo("name : "  . $shifthour->getName() . "\n");
                                    echo("shifthour Id : " . $shifthour->getId() . "\n");
                                }
                            }
                        }
                    }
                    $info = $responseWrapper->getInfo();
                    if ($info != null)
                    {
                        echo("info : " . "\n");
                        echo("perpage : " . $info->getPerPage() . "\n");
                        echo("count : " . $info->getCount() . "\n");
                        echo("page : " . $info->getPage() . "\n");
                        echo("more record : " . $info->getMoreRecords() . "\n");
                    }
                }
                else if ($responseHandler instanceof APIException)
                {
                    $exception = $responseHandler;
                    echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo ("Code: " . $exception->getCode()->getValue() . "\n");
                    echo ("Details: ");
                    if ($exception->getDetails() != null) {
                        echo ("Details: \n");
                        foreach ($exception->getDetails() as $keyName => $keyValue) {
                            echo ($keyName . ": " . $keyValue . "\n");
                        }
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
                }
            }
        }
    }
}
GetHolidays::initialize();
GetHolidays::getHolidays();