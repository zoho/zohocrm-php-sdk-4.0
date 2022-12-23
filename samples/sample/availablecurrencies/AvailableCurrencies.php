<?php

namespace com\zoho\crm\sample\availablecurrencies;

use com\zoho\crm\api\availablecurrencies\APIException;
use com\zoho\crm\api\availablecurrencies\AvailableCurrenciesOperations;
use com\zoho\crm\api\availablecurrencies\ResponseWrapper;

class AvailableCurrencies
{
	public static function getAvailableCurrencies()
	{
		// Get instance of AvailableCurrenciesOperations Class
		$currenciesOperations = new AvailableCurrenciesOperations();

		// Call getCurrencies method
		$response = $currenciesOperations->getAvailableCurrencies();

		if ($response != null) {
			// Get the status code from response
			echo ("Status Code: " . $response->getStatusCode() . "\n");

			if (in_array($response->getStatusCode(), array(204, 304))) {
				echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

				return;
			}

			// Get object from response
			$responseHandler = $response->getObject();

			if ($responseHandler instanceof ResponseWrapper) {
				// Get the received BodyWrapper instance
				$responseWrapper = $responseHandler;

				// Get the list of obtained Currency instances
				$currenciesList = $responseWrapper->getAvailableCurrencies();

				foreach ($currenciesList as $currency) {
					// Get the DisplayValue of each currency
					echo ("Currency DisplayValue: " . $currency->getDisplayValue() . "\n");

					// Get the currency is DecimalSeparator
					echo ("Currency DecimalSeparator: " . $currency->getDecimalSeparator() . "\n");

					// Get the Symbol of each currency
					echo ("Currency Symbol: " . $currency->getSymbol() . "\n");

					// Get the ThousandSeparator of each currency
					echo ("Currency ThousandSeparator: " . $currency->getThousandSeparator() . "\n");

					// Get the IsoCode of each currency
					echo ("Currency IsoCode: " . $currency->getIsoCode() . "\n");

					// Get the DisplayName of each currency
					echo ("Currency DisplayName: " . $currency->getDisplayName() . "\n");

					// Get the ModifiedTime of each currency
					echo ("Currency DecimalPlaces: " . $currency->getDecimalPlaces() . "\n");
				}
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
