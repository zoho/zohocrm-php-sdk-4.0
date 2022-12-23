<?php

namespace com\zoho\crm\sample\taxes;

use com\zoho\crm\api\taxes\APIException;
use com\zoho\crm\api\taxes\ActionWrapper;
use com\zoho\crm\api\taxes\BodyWrapper;
use com\zoho\crm\api\taxes\ResponseWrapper;
use com\zoho\crm\api\taxes\UpdateSuccessResponse;
use com\zoho\crm\api\taxes\TaxesOperations;
use com\zoho\crm\api\taxes\OrgTax;
use com\zoho\crm\api\taxes\Preference;

class Tax
{
	/**
	 * <h3> Get Taxes </h3>
	 * This method is used to get all the Organization Taxes and print the response.
	 * @throws Exception
	 */
	public static function getTaxes()
	{
		//Get instance of TaxesOperations Class
		$taxesOperations = new TaxesOperations();

		//Call getTaxes method
		$response = $taxesOperations->getTaxes();

		if ($response != null) {
			//Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			if (in_array($response->getStatusCode(), array(204, 304))) {
				echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

				return;
			}

			//Get object from response
			$responseHandler = $response->getObject();

			if ($responseHandler instanceof ResponseWrapper) {
				//Get the received ResponseWrapper instance
				$responseWrapper = $responseHandler;

				$orgTax = $responseWrapper->getOrgTaxes();

				//Get the list of obtained Tax instances
				$taxes = $orgTax->getTaxes();

				if ($taxes != null) {
					foreach ($taxes as $tax) {
						//Get the DisplayLabel of each Tax
						echo ("Tax DisplayLabel: " . $tax->getDisplayLabel() . "\n");

						//Get the Name of each Tax
						echo ("Tax Name: " . $tax->getName() . "\n");

						//Get the ID of each Tax
						echo ("Tax Id: " . $tax->getId() . "\n");

						//Get the Value of each Tax
						echo ("Tax Value: " . $tax->getValue() . "\n");
					}
				}

				//Get the Preference instance of Tag
				$preference = $orgTax->getPreference();

				//Check if preference is not null
				if ($preference != null) {
					//Get the AutoPopulateTax of each Preference
					echo ("Preference AutoPopulateTax: ");
					print_r($preference->getAutoPopulateTax());
					echo ("\n");

					//Get the ModifyTaxRates of each Preference
					echo ("Preference ModifyTaxRates: ");
					print_r($preference->getModifyTaxRates());
					echo ("\n");
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

				echo ("Details: ");

				//Get the details map
				foreach ($exception->getDetails() as $key => $value) {
					//Get each value in the map
					echo ($key . " : " . $value . "\n");
				}

				//Get the Message
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}

	/**
	 * <h3> Update Taxes </h3>
	 * This method is used to update Organization Taxes and print the response.
	 * @throws Exception
	 */
	public static function updateTaxes()
	{
		//Get instance of TaxesOperations Class
		$taxesOperations = new TaxesOperations();

		//Get instance of BodyWrapper Class that will contain the request body
		$request = new BodyWrapper();

		$orgTax = new OrgTax();

		//List of Tax instances
		$taxList = array();

		$taxClass = 'com\zoho\crm\api\taxes\Tax';

		//Get instance of Tax Class
		$tax1 = new $taxClass();

		$tax1->setId("347706114903099");

		$tax1->setName("MyT213ax1134");

		$tax1->setSequenceNumber(1);

		$tax1->setValue(15.0);

		// $tax1->setDelete(null);

		array_push($taxList, $tax1);

		$orgTax->setTaxes($taxList);

		$preference = new Preference();

		$preference->setAutoPopulateTax(false);

		$preference->setModifyTaxRates(false);

		$orgTax->setPreference($preference);

		$request->setOrgTaxes($orgTax);

		//Call updateTaxes method that takes BodyWrapper instance as parameter
		$response = $taxesOperations->updateTaxes($request);

		if ($response != null) {
			//Get the status code from response
			echo ("Status Code: " . $response->getStatusCode() . "\n");

			//Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				//Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				//Get the list of obtained ActionResponse instances
				$actionResponse = $actionWrapper->getOrgTaxes();

				//Check if the request is successful
				if ($actionResponse instanceof UpdateSuccessResponse) {
					//Get the received SuccessResponse instance
					$successResponse = $actionResponse;

					//Get the Status
					echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");

					//Get the Code
					echo ("Code: " . $successResponse->getCode()->getValue() . "\n");

					if ($successResponse->getDetails() != null) {
						echo ("Details: ");

						//Get the details map
						foreach ($successResponse->getDetails() as $key => $value) {
							//Get each value in the map
							echo ($key . " : ");

							print_r($value);

							echo ("\n");
						}
					}

					//Get the Message
					echo ("Message: " . $successResponse->getMessage()->getValue() . "\n");
				}
				//Check if the request returned an exception
				else if ($actionResponse instanceof APIException) {
					//Get the received APIException instance
					$exception = $actionResponse;

					//Get the Status
					echo ("Status: " . $exception->getStatus()->getValue() . "\n");

					//Get the Code
					echo ("Code: " . $exception->getCode()->getValue() . "\n");

					echo ("Details: ");

					//Get the details map
					foreach ($exception->getDetails() as $key => $value) {
						//Get each value in the map
						echo ($key . " : " . $value . "\n");
					}

					//Get the Message
					echo ("Message: " . $exception->getMessage()->getValue() . "\n");
				}
			}
			//Check if the request returned an exception
			else if ($actionHandler instanceof APIException) {
				//Get the received APIException instance
				$exception = $actionHandler;

				//Get the Status
				echo ("Status: " . $exception->getStatus()->getValue() . "\n");

				//Get the Code
				echo ("Code: " . $exception->getCode()->getValue() . "\n");

				echo ("Details: ");

				//Get the details map
				foreach ($exception->getDetails() as $key => $value) {
					//Get each value in the map
					echo ($key . " : " . $value . "\n");
				}

				//Get the Message
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}

	/**
	 * <h3> Get Tax </h3>
	 * This method is used to get the Organization Tax and print the response.
	 * @param taxId - The ID of the tax to be obtainted
	 * @throws Exception
	 */
	public static function getTax(string $taxId)
	{
		//Get instance of TaxesOperations Class
		$taxesOperations = new TaxesOperations();

		//Call getTax method that takes taxId as parameter
		$response = $taxesOperations->getTax($taxId);

		if ($response != null) {
			//Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			if (in_array($response->getStatusCode(), array(204, 304))) {
				echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

				return;
			}

			//Get object from response
			$responseHandler = $response->getObject();

			if ($responseHandler instanceof ResponseWrapper) {
				//Get the received ResponseWrapper instance
				$responseWrapper = $responseHandler;

				$orgTax = $responseWrapper->getOrgTaxes();

				//Get the list of obtained Tax instances
				$taxes = $orgTax->getTaxes();

				if ($taxes != null) {
					foreach ($taxes as $tax) {
						//Get the DisplayLabel of each Tax
						echo ("Tax DisplayLabel: " . $tax->getDisplayLabel() . "\n");

						//Get the Name of each Tax
						echo ("Tax Name: " . $tax->getName() . "\n");

						//Get the ID of each Tax
						echo ("Tax Id: " . $tax->getId() . "\n");

						//Get the Value of each Tax
						echo ("Tax Value: " . $tax->getValue() . "\n");
					}
				}

				//Get the Preference instance of Tag
				$preference = $orgTax->getPreference();

				//Check if preference is not null
				if ($preference != null) {
					//Get the AutoPopulateTax of each Preference
					echo ("Preference AutoPopulateTax: ");
					print_r($preference->getAutoPopulateTax());
					echo ("\n");

					//Get the ModifyTaxRates of each Preference
					echo ("Preference ModifyTaxRates: ");
					print_r($preference->getModifyTaxRates());
					echo ("\n");
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

				echo ("Details: ");

				//Get the details map
				foreach ($exception->getDetails() as $key => $value) {
					//Get each value in the map
					echo ($key . " : " . $value . "\n");
				}

				//Get the Message
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}
}
