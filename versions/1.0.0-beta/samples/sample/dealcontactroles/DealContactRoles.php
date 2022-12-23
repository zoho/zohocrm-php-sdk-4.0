<?php

namespace com\zoho\crm\sample\dealcontactroles;

use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\dealcontactroles\APIException;
use com\zoho\crm\api\dealcontactroles\ActionWrapper;
use com\zoho\crm\api\dealcontactroles\BodyWrapper;
use com\zoho\crm\api\dealcontactroles\ContactRole;
use com\zoho\crm\api\dealcontactroles\Data;
use com\zoho\crm\api\dealcontactroles\DealContactRolesOperations;
use com\zoho\crm\api\dealcontactroles\GetAssociatedContactRolesParam;
use com\zoho\crm\api\dealcontactroles\SuccessResponse;

class DealContactRoles
{
	/**
	 * <h3> Get All ContactRoles Of Deal </h3>
	 * @param dealId ID of the Deals
	 * @throws Exception
	 */
	public static function getAllContactRolesOfDeal($dealId)
	{
		//Get instance of ContactRolesOperations Class
		$contactRolesOperations = new DealContactRolesOperations();

		//Get instance of ParameterMap Class
		$paramInstance = new ParameterMap();

		// $paramInstance->add(GetAssociatedContactRolesParam::ids(),[""]);

		$paramInstance->add(GetAssociatedContactRolesParam::fields(), "Last_Name");

		//Call getAllContactRolesOfDeal method that takes Param instance as parameter 
		$response = $contactRolesOperations->getAssociatedContactRoles($dealId, $paramInstance);

		if ($response != null) {
			//Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			if (in_array($response->getStatusCode(), array(204, 304))) {
				echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

				return;
			}

			//Check if expected response is received
			if ($response->isExpected()) {
				//Get the object from response
				$responseHandler = $response->getObject();

				if ($responseHandler instanceof BodyWrapper) {
					//Get the received ResponseWrapper instance
					$responseWrapper = $responseHandler;

					//Get the obtained Record instances
					$records = $responseWrapper->getData();

					foreach ($records as $record) {
						//Get the ID of each Record
						echo ("Record ID: " . $record->getId() . "\n");

						//Get the createdBy User instance of each Record
						$createdBy = $record->getCreatedBy();

						//Check if createdBy is not null
						if ($createdBy != null) {
							//Get the ID of the createdBy User
							echo ("Record Created By User-ID: " . $createdBy->getId() . "\n");

							//Get the name of the createdBy User
							echo ("Record Created By User-Name: " . $createdBy->getName() . "\n");

							//Get the Email of the createdBy User
							echo ("Record Created By User-Email: " . $createdBy->getEmail() . "\n");
						}

						//Get the CreatedTime of each Record
						echo ("Record CreatedTime: ");
						print_r($record->getCreatedTime());
						echo ("\n");

						//Get the modifiedBy User instance of each Record
						$modifiedBy = $record->getModifiedBy();

						//Check if modifiedBy is not null
						if ($modifiedBy != null) {
							//Get the ID of the modifiedBy User
							echo ("Record Modified By User-ID: " . $modifiedBy->getId() . "\n");

							//Get the name of the modifiedBy User
							echo ("Record Modified By User-Name: " . $modifiedBy->getName() . "\n");

							//Get the Email of the modifiedBy User
							echo ("Record Modified By User-Email: " . $modifiedBy->getEmail() . "\n");
						}

						//To get particular field value 
						echo ("Record Field Value: " . $record->getKeyValue("Last_Name") . "\n"); // FieldApiName

						echo ("Record KeyValues: \n");

						//Get the KeyValue map
						foreach ($record->getKeyValues() as $keyName => $value) {
							if ($value != null) {
								if ((is_array($value) && sizeof($value) > 0) && isset($value[0])) {
									echo ("Record KeyName : " . $keyName . " : \n");

									$dataList = $value;

									foreach ($dataList as $data) {
										if (is_array($data)) {
											echo ("Record KeyName : " . $keyName  . " - Value :  \n");

											foreach ($data as $key => $arrayValue) {
												echo ($key . " : " . $arrayValue . "\n");
											}
										} else {
											print_r($data);
											echo ("\n");
										}
									}
								} else if ($value instanceof ContactRole) {
									echo ("Record ContactRole Name : " . $value->getName() . "\n");

									echo ("Record ContactRole Id : " . $value->getId() . "\n");
								} else {
									echo ("Record KeyName : " . $keyName  . " - Value : ");
									print_r($value);
									echo ("\n");
								}
							}
						}
					}
					//Get the Object obtained Info instance
					$info = $responseWrapper->getInfo();

					//Check if info is not null
					if ($info != null) {
						if ($info->getCount() != null) {
							//Get the Count of the Info
							echo ("Record Info Count: " . $info->getCount() . "\n");
						}

						if ($info->getMoreRecords() != null) {
							//Get the MoreRecords of the Info
							echo ("Record Info MoreRecords: " . $info->getMoreRecords() . "\n");
						}
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
			} else { //If response is not as expected
				print_r($response);
			}
		}
	}

	public static function getContactRoleOfDeal($contactId, $dealId)
	{
		//Get instance of ContactRolesOperations Class
		$contactRolesOperations = new DealContactRolesOperations();

		//Call getContactRoleOfDeal method that takes Param instance as parameter 
		$response = $contactRolesOperations->getAssociatedContactRolesSpecificToContact($contactId, $dealId);

		if ($response != null) {
			//Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			if (in_array($response->getStatusCode(), array(204, 304))) {
				echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

				return;
			}

			//Check if expected response is received
			if ($response->isExpected()) {
				//Get the object from response
				$responseHandler = $response->getObject();

				if ($responseHandler instanceof BodyWrapper) {
					//Get the received ResponseWrapper instance
					$responseWrapper = $responseHandler;

					//Get the obtained Record instances
					$records = $responseWrapper->getData();

					foreach ($records as $record) {
						//Get the ID of each Record
						echo ("Record ID: " . $record->getId() . "\n");

						//Get the createdBy User instance of each Record
						$createdBy = $record->getCreatedBy();

						//Check if createdBy is not null
						if ($createdBy != null) {
							//Get the ID of the createdBy User
							echo ("Record Created By User-ID: " . $createdBy->getId() . "\n");

							//Get the name of the createdBy User
							echo ("Record Created By User-Name: " . $createdBy->getName() . "\n");

							//Get the Email of the createdBy User
							echo ("Record Created By User-Email: " . $createdBy->getEmail() . "\n");
						}

						//Get the CreatedTime of each Record
						echo ("Record CreatedTime: ");
						print_r($record->getCreatedTime());
						echo ("\n");

						//Get the modifiedBy User instance of each Record
						$modifiedBy = $record->getModifiedBy();

						//Check if modifiedBy is not null
						if ($modifiedBy != null) {
							//Get the ID of the modifiedBy User
							echo ("Record Modified By User-ID: " . $modifiedBy->getId() . "\n");

							//Get the name of the modifiedBy User
							echo ("Record Modified By User-Name: " . $modifiedBy->getName() . "\n");

							//Get the Email of the modifiedBy User
							echo ("Record Modified By User-Email: " . $modifiedBy->getEmail() . "\n");
						}

						//Get the ModifiedTime of each Record
						echo ("Record CreatedTime: ");
						print_r($record->getModifiedTime());
						echo ("\n");

						//To get particular field value 
						echo ("Record Field Value: " . $record->getKeyValue("Last_Name") . "\n"); // FieldApiName

						echo ("Record KeyValues: \n");

						//Get the KeyValue map
						foreach ($record->getKeyValues() as $keyName => $value) {
							if ($value != null) {
								if ((is_array($value) && sizeof($value) > 0) && isset($value[0])) {
									echo ("Record KeyName : " . $keyName . "\n");

									$dataList = $value;

									foreach ($dataList as $data) {
										if (is_array($data)) {
											echo ("Record KeyName : " . $keyName  . " - Value :  \n");

											foreach ($data as $key => $arrayValue) {
												echo ($key . " : " . $arrayValue);
											}
										} else if ($value instanceof ContactRole) {
											echo ("Record ContactRole Name : " . $value->getName() . "\n");

											echo ("Record ContactRole Id : " . $value->getId() . "\n");
										} else {
											print_r($data);
											echo ("\n");
										}
									}
								} else {
									echo ("Record KeyName : " . $keyName  . " - Value : ");
									print_r($value);
									echo ("\n");
								}
							}
						}
					}
					//Get the Object obtained Info instance
					$info = $responseWrapper->getInfo();

					//Check if info is not null
					if ($info != null) {
						if ($info->getCount() != null) {
							//Get the Count of the Info
							echo ("Record Info Count: " . $info->getCount() . "\n");
						}

						if ($info->getMoreRecords() != null) {
							//Get the MoreRecords of the Info
							echo ("Record Info MoreRecords: " . $info->getMoreRecords() . "\n");
						}
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
			} else { //If response is not as expected
				print_r($response);
			}
		}
	}

	public static function addContactRoleToDeal($contactId, $dealId)
	{
		//Get instance of ContactRolesOperations Class
		$contactRolesOperations = new DealContactRolesOperations();

		//Get instance of BodyWrapper Class that will contain the request body
		$bodyWrapper = new BodyWrapper();

		$data = array();

		$data1 = new Data();

		// Get instance of ContactRole Class
		$contactRole = new ContactRole();

		$contactRole->setId("34770619185008");

		// Set name of the Contact Role
		$contactRole->setName("contactRole1211");

		$data1->setContactRole($contactRole);

		array_push($data, $data1);

		//Set the list to contactRoles in BodyWrapper instance
		$bodyWrapper->setData($data);

		//Call createContactRoles method that takes BodyWrapper instance as parameter
		$response = $contactRolesOperations->associateContactRoleToDeal($contactId, $dealId, $bodyWrapper);

		if ($response != null) {
			//Get the status code from response
			echo ("Status code" . $response->getStatusCode() . "\n");

			//Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				//Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				//Get the list of obtained action responses
				$actionResponses = $actionWrapper->getData();

				foreach ($actionResponses as $actionResponse) {
					//Check if the request is successful
					if ($actionResponse instanceof SuccessResponse) {
						//Get the received SuccessResponse instance
						$successResponse = $actionResponse;

						//Get the Status
						echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");

						//Get the Code
						echo ("Code: " . $successResponse->getCode()->getValue() . "\n");

						echo ("Details: ");

						if ($successResponse->getDetails() != null) {
							//Get the details map
							foreach ($successResponse->getDetails() as $keyName => $keyValue) {
								//Get each value in the map
								echo ($keyName . ": " . $keyValue . "\n");
							}
						}

						//Get the Message
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
			//Check if the request returned an exception
			else if ($actionHandler instanceof APIException) {
				//Get the received APIException instance
				$exception = $actionHandler;

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

	public static function removeContactRoleFromDeal($contactId, $dealId)
	{
		//Get instance of ContactRolesOperations Class
		$contactRolesOperations = new DealContactRolesOperations();

		//Call createContactRoles method that takes BodyWrapper instance as parameter
		$response = $contactRolesOperations->deleteContactRoleRealation($contactId, $dealId);

		if ($response != null) {
			//Get the status code from response
			echo ("Status code" . $response->getStatusCode() . "\n");

			//Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				//Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				//Get the list of obtained action responses
				$actionResponses = $actionWrapper->getData();

				foreach ($actionResponses as $actionResponse) {
					//Check if the request is successful
					if ($actionResponse instanceof SuccessResponse) {
						//Get the received SuccessResponse instance
						$successResponse = $actionResponse;

						//Get the Status
						echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");

						//Get the Code
						echo ("Code: " . $successResponse->getCode()->getValue() . "\n");

						echo ("Details: ");

						if ($successResponse->getDetails() != null) {
							//Get the details map
							foreach ($successResponse->getDetails() as $keyName => $keyValue) {
								//Get each value in the map
								echo ($keyName . ": " . $keyValue . "\n");
							}
						}

						//Get the Message
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
			//Check if the request returned an exception
			else if ($actionHandler instanceof APIException) {
				//Get the received APIException instance
				$exception = $actionHandler;

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
