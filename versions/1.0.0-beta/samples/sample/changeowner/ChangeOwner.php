<?php

namespace com\zoho\crm\sample\changeowner;

use com\zoho\crm\api\changeowner\ChangeOwnerOperations;
use com\zoho\crm\api\changeowner\MassWrapper;
use com\zoho\crm\api\changeowner\Owner;
use com\zoho\crm\api\changeowner\RelatedModule;
use com\zoho\crm\api\changeowner\APIException;
use com\zoho\crm\api\changeowner\SuccessResponse;
use com\zoho\crm\api\changeowner\ActionWrapper;
use com\zoho\crm\api\changeowner\BodyWrapper;

class ChangeOwner
{
	public static function updateRecordsOwner($moduleAPIName)
	{
		// Get instance of ChangeOwnerOperations Class
		$changeOwnerOperations = new ChangeOwnerOperations($moduleAPIName);

		// Get instance of BodyWrapper Class that will contain the request body
		$massWrapper = new MassWrapper();

		// List of record id
		$Ids = array();

		array_push($Ids, "347706114612001");

		array_push($Ids, "347706114611002");

		$massWrapper->setIds($Ids);

		$owner = new Owner();

		$owner->setId("34770615791024");

		$massWrapper->setOwner($owner);

		$massWrapper->setNotify(true);

		$relatedModules = array();

		// Get instance of Module Class
		$relatedModule = new RelatedModule();

		// Set ID to the Module instance
		$relatedModule->setId("347706114686005");

		// Set name to the Module instance
		$relatedModule->setAPIName("Tasks");

		// Add Module instance to the list
		array_push($relatedModules, $relatedModule);

		$relatedModule = new RelatedModule();

		// Set ID to the Module instance
		$relatedModule->setId("347706114686005");

		// Set name to the Module instance
		$relatedModule->setAPIName("Tasks");

		// Add Module instance to the list
		array_push($relatedModules, $relatedModule);

		// Set the list to relatedModules in BodyWrapper instance
		$massWrapper->setRelatedModules($relatedModules);

		// Call updateByModule method that takes BodyWrapper instance as parameter
		$response = $changeOwnerOperations->massUpdate($massWrapper);

		if ($response != null) {
			// Get the status code from response
			echo ("Status Code: " . $response->getStatusCode() . "\n");

			// Check if expected response is received
			if ($response->isExpected()) {
				// Get object from response
				$actionHandler = $response->getObject();

				if ($actionHandler instanceof ActionWrapper) {
					// Get the received RecordActionWrapper instance
					$actionWrapper = $actionHandler;

					// Get the list of obtained ActionResponse instances
					$actionResponses = $actionWrapper->getData();

					foreach ($actionResponses as $actionResponse) {
						// Check if the request is successful
						if ($actionResponse instanceof SuccessResponse) {
							// Get the received SuccessResponse instance
							$successResponse = $actionResponse;

							// Get the Status
							echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");

							// Get the Code
							echo ("Code: " . $successResponse->getCode()->getValue() . "\n");

							echo ("Details: ");

							//Get the details map
							foreach ($successResponse->getDetails() as $key => $value) {
								//Get each value in the map
								echo ($key . " : ");

								print_r($value);

								echo ("\n");
							}

							// Get the Message
							echo ("Message: " . $successResponse->getMessage() . "\n");
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

							if ($exception->getDetails() != null) {
								//Get the details map
								foreach ($exception->getDetails() as $key => $value) {
									//Get each value in the map
									echo ($key . ": " . $value . "\n");
								}
							}

							//Get the Message
							echo ("Message: " . $exception->getMessage() . "\n");
						}
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

					if ($exception->getDetails() != null) {
						//Get the details map
						foreach ($exception->getDetails() as $key => $value) {
							//Get each value in the map
							echo ($key . ": " . $value . "\n");
						}
					}

					//Get the Message
					echo ("Message: " . $exception->getMessage() . "\n");
				}
			}
		}
	}

	public static function updateRecordOwner($moduleAPIName, $recordId)
	{
		// ID of the Record to be updated
		// String recordId = "5255085067923";

		// Get instance of ChangeOwnerOperations Class
		$changeOwnerOperations = new ChangeOwnerOperations($moduleAPIName);

		// Get instance of BodyWrapper Class that will contain the request body
		$bodyWrapper = new BodyWrapper();

		$owner = new Owner();

		$owner->setId("34770615791024");

		$bodyWrapper->setOwner($owner);

		$bodyWrapper->setNotify(true);

		$relatedModules = array();

		// Get instance of Module Class
		$relatedModule = new RelatedModule();

		// Set ID to the Module instance
		$relatedModule->setId("347706114686005");

		// Set name to the Module instance
		$relatedModule->setAPIName("Tasks");

		// Add Module instance to the list
		array_push($relatedModules, $relatedModule);

		$relatedModule = new RelatedModule();

		// Set ID to the Module instance
		$relatedModule->setId("347706114686005");

		// Set name to the Module instance
		$relatedModule->setAPIName("Tasks");

		// Add Module instance to the list
		array_push($relatedModules, $relatedModule);

		// Set the list to relatedModules in BodyWrapper instance
		$bodyWrapper->setRelatedModules($relatedModules);

		// Call updateRecordOwner method that takes recordId and BodyWrapper instance as parameters
		$response = $changeOwnerOperations->singleUpdate($recordId, $bodyWrapper);

		if ($response != null) {
			// Get the status code from response
			echo ("Status Code: " . $response->getStatusCode() . "\n");

			// Check if expected response is received
			if ($response->isExpected()) {
				// Get object from response
				$actionHandler = $response->getObject();

				if ($actionHandler instanceof ActionWrapper) {
					// Get the received ActionWrapper instance
					$actionWrapper = $actionHandler;

					// Get the list of obtained ActionResponse instances
					$actionResponses = $actionWrapper->getData();

					foreach ($actionResponses as $actionResponse) {
						// Check if the request is successful
						if ($actionResponse instanceof SuccessResponse) {
							// Get the received SuccessResponse instance
							$successResponse = $actionResponse;

							// Get the Status
							echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");

							// Get the Code
							echo ("Code: " . $successResponse->getCode()->getValue() . "\n");

							echo ("Details: ");

							//Get the details map
							foreach ($successResponse->getDetails() as $key => $value) {
								//Get each value in the map
								echo ($key . " : ");

								print_r($value);

								echo ("\n");
							}

							// Get the Message
							echo ("Message: " . $successResponse->getMessage() . "\n");
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

							if ($exception->getDetails() != null) {
								//Get the details map
								foreach ($exception->getDetails() as $key => $value) {
									//Get each value in the map
									echo ($key . ": " . $value . "\n");
								}
							}

							//Get the Message
							echo ("Message: " . $exception->getMessage() . "\n");
						}
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

					if ($exception->getDetails() != null) {
						//Get the details map
						foreach ($exception->getDetails() as $key => $value) {
							//Get each value in the map
							echo ($key . ": " . $value . "\n");
						}
					}

					//Get the Message
					echo ("Message: " . $exception->getMessage() . "\n");
				}
			}
		}
	}
}
