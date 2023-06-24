<?php
namespace currencies;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\util\Choice;
use com\zoho\crm\api\currencies\APIException;
use com\zoho\crm\api\currencies\SuccessResponse;
use com\zoho\crm\api\currencies\BaseCurrencyWrapper;
use com\zoho\crm\api\currencies\BaseCurrencyActionWrapper;
use com\zoho\crm\api\currencies\CurrenciesOperations;
use com\zoho\crm\api\currencies\Format;
require_once "vendor/autoload.php";
class UpdateBaseCurrency
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
     * <h3> Update Currency </h3>
     * This method is used to update base currency details.
     * @throws Exception
     */
    public static function updateBaseCurrency()
    {
        $currenciesOperations = new CurrenciesOperations();
        $bodyWrapper = new BaseCurrencyWrapper();
        $currencyClass = "com\zoho\crm\api\currencies\BaseCurrency";
        $currency = new $currencyClass();
        //true: Display ISO code before the currency value.
        //false: Display ISO code after the currency value.
        $currency->setPrefixSymbol(true);
        $currency->setSymbol("Af");
        $currency->setExchangeRate("1.00");
        $currency->setId("3477061608002");
        $format = new Format();
        //It can be a Period or Comma, depending on the base currency.
        $format->setDecimalSeparator(new Choice("Period"));
        //It can be a Period, Comma, or Space, depending on the base currency.
        $format->setThousandSeparator(new Choice("Comma"));
        $format->setDecimalPlaces(new Choice("2"));
        $currency->setFormat($format);
        $bodyWrapper->setBaseCurrency($currency);
        //Call enableMultipleCurrencies method that takes BodyWrapper instance as parameter
        $response = $currenciesOperations->updateBaseCurrency($bodyWrapper);
        if ($response != null) {
            echo ("Status code" . $response->getStatusCode() . "\n");
            $baseCurrencyActionHandler = $response->getObject();
            if ($baseCurrencyActionHandler instanceof BaseCurrencyActionWrapper) {
                $baseCurrencyActionWrapper = $baseCurrencyActionHandler;
                $actionResponse = $baseCurrencyActionWrapper->getBaseCurrency();
                if ($actionResponse instanceof SuccessResponse) {
                    $successResponse = $actionResponse;
                    echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                    echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                    echo ("Details: ");
                    foreach ($successResponse->getDetails() as $key => $value) {
                        echo ($key . ": " . $value . "\n");
                    }
                    echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
                }
                else if ($actionResponse instanceof APIException) {
                    $exception = $actionResponse;
                    echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo ("Code: " . $exception->getCode()->getValue() . "\n");
                    if ($exception->getDetails() != null) {
                        echo ("Details: ");
                        foreach ($exception->getDetails() as $key => $value) {
                            echo ($key . ": " . $value . "\n");
                        }
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                }
            }
            else if ($baseCurrencyActionHandler instanceof APIException) {
                $exception = $baseCurrencyActionHandler;
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                echo ("Code: " . $exception->getCode()->getValue() . "\n");
                if ($exception->getDetails() != null) {
                    echo ("Details: ");
                    foreach ($exception->getDetails() as $key => $value) {
                        echo ($key . ": " . $value . "\n");
                    }
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
            }
        }
    }
}
UpdateBaseCurrency::initialize();
UpdateBaseCurrency::updateBaseCurrency();
