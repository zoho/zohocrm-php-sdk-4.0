<?php

namespace com\zoho\crm\sample\usersunavailability;

use com\zoho\crm\api\usersunavailability\APIException;
use com\zoho\crm\api\usersunavailability\ActionWrapper;
use com\zoho\crm\api\usersunavailability\BodyWrapper;
use com\zoho\crm\api\usersunavailability\SuccessResponse;
use com\zoho\crm\api\usersunavailability\UsersUnavailabilityOperations;
use com\zoho\crm\api\usersunavailability\GetUsersUnavailabilitesParam;
use com\zoho\crm\api\usersunavailability\User;
use com\zoho\crm\api\ParameterMap;

class UsersUnavailability
{
	public static function getUsersUnavailabilites()
	{
		// Get instance of UsersUnavailabilityOperations Class
		$usersUnavailabilityOperations = new UsersUnavailabilityOperations();

		// Get instance of ParameterMap Class
		$paramInstance = new ParameterMap();

		// $paramInstance->add(GetUsersUnavailabilityHoursParam::groupIds(), "347706109,34770610912");

		// $paramInstance->add(GetUsersUnavailabilityHoursParam::includeInnerDetails(), "56xxx8");

		// $paramInstance->add(GetUsersUnavailabilityHoursParam::roleIds(), "3433706109,34037061091");

		// $paramInstance->add(GetUsersUnavailabilityHoursParam::territoryIds(), "3433706109,34037061091");

		$filters = [];

		$filters["group_operator"] = "or";

		$group = [];

		$criteria1 = [];

		$criteria1["comparator"] = "between";

		$criteria1Field = [];

		$criteria1Field["api_name"] = "from";

		$criteria1["field"] = $criteria1Field;

		$criteria1Value = ["2021-02-18T19:00:00+05:30", "2021-02-19T19:00:00+05:30"];

		$criteria1["value"] = $criteria1Value;

		array_push($group, $criteria1);

		$criteria2 = [];

		$criteria2["comparator"] = "between";

		$criteria2Field = [];

		$criteria2Field["api_name"] = "to";

		$criteria2["field"] = $criteria2Field;

		$criteria2Value = ["2021-02-18T20:00:00+05:30", "2021-02-19T20:00:00+05:30"];

		$criteria2["value"] = $criteria2Value;

		array_push($group, $criteria2);

		$filters["group"] = $group;

		$paramInstance->add(GetUsersUnavailabilitesParam::filters(), json_encode($filters, JSON_UNESCAPED_UNICODE));

		// Call getUsersUnavailabilityHours method that takes ParameterMap instance as parameters
		$response = $usersUnavailabilityOperations->getUsersUnavailabilites($paramInstance);

		if ($response != null) {
			// Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			if (in_array($response->getStatusCode(), array(204, 304))) {
				echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

				return;
			}

			// Get object from response
			$responseHandler = $response->getObject();

			if ($responseHandler instanceof BodyWrapper) {
				// Get the received ResponseWrapper instance
				$responseWrapper = $responseHandler;

				// Get the list of obtained UsersUnavailability instances
				$users = $responseWrapper->getUsersUnavailability();

				foreach ($users as $usersUnavailability) {
					echo ("UsersUnavailability Comments: " . $usersUnavailability->getComments() . "\n");

					echo ("UsersUnavailability From: ");
					print_r($usersUnavailability->getFrom());
					echo ("\n");

					echo ("UsersUnavailability Id: " . $usersUnavailability->getId() . "\n");

					echo ("UsersUnavailability to: ");
					print_r($usersUnavailability->getTo());
					echo ("\n");

					$user = $usersUnavailability->getUser();

					if ($user != null) {
						echo ("UsersUnavailability User-Name: " . $user->getName() . "\n");

						echo ("UsersUnavailability User-Id: " . $user->getId() . "\n");

						echo ("UsersUnavailability User-ZuId: " . $user->getZuid() . "\n");
					}
				}

				// Get the Object obtained Info instance
				$info = $responseWrapper->getInfo();

				// Check if info is not null
				if ($info != null) {
					if ($info->getPerPage() != null) {
						// Get the PerPage of the Info
						echo ("User Info PerPage: " . $info->getPerPage() . "\n");
					}

					if ($info->getCount() != null) {
						// Get the Count of the Info
						echo ("User Info Count: " . $info->getCount() . "\n");
					}

					if ($info->getPage() != null) {
						// Get the Page of the Info
						echo ("User Info Page: " . $info->getPage() . "\n");
					}

					if ($info->getMoreRecords() != null) {
						// Get the MoreRecords of the Info
						echo ("User Info MoreRecords: " . $info->getMoreRecords() . "\n");
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

				//Get the details map4
				foreach ($exception->getDetails() as $key => $value) {
					//Get each value in the map
					echo ($key . ": " . $value . "\n");
				}

				//Get the Message
				echo ("Message: " . $exception->getMessage() . "\n");
			}
		}
	}

	public static function getUsersUnavailability($id)
	{
		// Get instance of UsersUnavailabilityOperations Class
		$usersUnavailabilityOperations = new UsersUnavailabilityOperations();

		// Get instance of ParameterMap Class
		$paramInstance = new ParameterMap();

		// Call getUserUnavailabilityHours method that takes id and ParameterMap instance as parameters
		$response = $usersUnavailabilityOperations->getUsersUnavailability($id, $paramInstance);

		if ($response != null) {
			// Get the status code from response
			echo ("Status Code: " . $response->getStatusCode() . "\n");

			if (in_array($response->getStatusCode(), array(204, 304))) {
				echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

				return;
			}

			// Get object from response
			$responseHandler = $response->getObject();

			if ($responseHandler instanceof BodyWrapper) {
				// Get the received ResponseWrapper instance
				$responseWrapper = $responseHandler;

				// Get the list of obtained UsersUnavailability instances
				$users = $responseWrapper->getUsersUnavailability();

				foreach ($users as $usersUnavailability) {
					echo ("UsersUnavailability Comments: " . $usersUnavailability->getComments() . "\n");

					echo ("UsersUnavailability From: ");
					print_r($usersUnavailability->getFrom());
					echo ("\n");

					echo ("UsersUnavailability Id: " . $usersUnavailability->getId() . "\n");

					echo ("UsersUnavailability to: ");
					print_r($usersUnavailability->getTo());
					echo ("\n");

					$user = $usersUnavailability->getUser();

					if ($user != null) {
						echo ("UsersUnavailability User-Name: " . $user->getName() . "\n");

						echo ("UsersUnavailability User-Id: " . $user->getId() . "\n");

						echo ("UsersUnavailability User-ZuId: " . $user->getZuid() . "\n");
					}
				}

				// Get the Object obtained Info instance
				$info = $responseWrapper->getInfo();

				// Check if info is not null
				if ($info != null) {
					if ($info->getPerPage() != null) {
						// Get the PerPage of the Info
						echo ("User Info PerPage: " . $info->getPerPage() . "\n");
					}

					if ($info->getCount() != null) {
						// Get the Count of the Info
						echo ("User Info Count: " . $info->getCount() . "\n");
					}

					if ($info->getPage() != null) {
						// Get the Page of the Info
						echo ("User Info Page: " . $info->getPage() . "\n");
					}

					if ($info->getMoreRecords() != null) {
						// Get the MoreRecords of the Info
						echo ("User Info MoreRecords: " . $info->getMoreRecords() . "\n");
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

				//Get the details map4
				foreach ($exception->getDetails() as $key => $value) {
					//Get each value in the map
					echo ($key . ": " . $value . "\n");
				}

				//Get the Message
				echo ("Message: " . $exception->getMessage() . "\n");
			}
		}
	}

	public static function createUsersUnavailability()
	{
		// Get instance of UsersUnavailabilityOperations Class
		$usersOperations = new UsersUnavailabilityOperations();

		// Get instance of BodyWrapper Class that will contain the request body
		$bodyWrapper = new BodyWrapper();

		// List of User instances
		$userList = [];

		$usersUnavailabilityClass = 'com\zoho\crm\api\usersunavailability\UsersUnavailability';

		// Get instance of User Class
		$user1 = new $usersUnavailabilityClass();

		$user1->setComments("Unavailable");

		$from = date_create("2022-05-29T15:10:00");

		$user1->setFrom($from);

		$to = date_create("2022-06-29T15:10:00");

		$user1->setTo($to);

		$user = new User();

		$user->setId('347706113767065');

		$user1->setUser($user);

		array_push($userList, $user1);

		$bodyWrapper->setUsersUnavailability($userList);

		// Call createUsersUnavailability method that takes BodyWrapper class instance as parameter
		$response = $usersOperations->createUsersUnavailability($bodyWrapper);

		if ($response != null) {
			// Get the status code from response
			echo ("Status Code: " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$responseWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $responseWrapper->getUsersUnavailability();

				foreach ($actionResponses as $actionResponse) {
					// Check if the request is successful
					if ($actionResponse instanceof SuccessResponse) {
						// Get the received SuccessResponse instance
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

	public static function updateUsersUnavailabilites()
	{
		// Get instance of UsersUnavailabilityOperations Class
		$usersOperations = new UsersUnavailabilityOperations();

		// Get instance of BodyWrapper Class that will contain the request body
		$request = new BodyWrapper();

		// List of User instances
		$userList = [];

		$usersUnavailabilityClass = 'com\zoho\crm\api\usersunavailability\UsersUnavailability';

		// Get instance of User Class
		$user1 = new $usersUnavailabilityClass();

		$user1->setComments("Unavailable");

		$user1->setId('347706115179001');

		$from = date_create("2022-04-29T15:10:00");

		$user1->setFrom($from);

		$to = date_create("2022-05-29T15:10:00");

		$user1->setTo($to);

		$user = new User();

		$user->setId('347706113767065');

		$user1->setUser($user);

		array_push($userList, $user1);

		$request->setUsersUnavailability($userList);

		// Call updateUsersUnavailabilites method that takes BodyWrapper class instance as parameter
		$response = $usersOperations->updateUsersUnavailabilites($request);

		if ($response != null) {
			// Get the status code from response
			echo ("Status Code: " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$responseWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $responseWrapper->getUsersUnavailability();

				foreach ($actionResponses as $actionResponse) {
					// Check if the request is successful
					if ($actionResponse instanceof SuccessResponse) {
						// Get the received SuccessResponse instance
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

	public static function updateUsersUnavailability($id)
	{
		// Get instance of UsersUnavailabilityOperations Class
		$usersOperations = new UsersUnavailabilityOperations();

		// Get instance of BodyWrapper Class that will contain the request body
		$request = new BodyWrapper();

		// List of User instances
		$userList = [];

		$usersUnavailabilityClass = 'com\zoho\crm\api\usersunavailability\UsersUnavailability';

		// Get instance of User Class
		$user1 = new $usersUnavailabilityClass();

		$user1->setComments("Unavailable");

		$user1->setId('347706115179001');

		$from = date_create("2022-04-29T15:10:00");

		$user1->setFrom($from);

		$to = date_create("2022-05-29T15:10:00");

		$user1->setTo($to);

		array_push($userList, $user1);

		$request->setUsersUnavailability($userList);

		// Call updateUsersUnavailability method that takes id and BodyWrapper class instance as parameter
		$response = $usersOperations->updateUsersUnavailability($id, $request);

		if ($response != null) {
			// Get the status code from response
			echo ("Status Code: " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$responseWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $responseWrapper->getUsersUnavailability();

				foreach ($actionResponses as $actionResponse) {
					// Check if the request is successful
					if ($actionResponse instanceof SuccessResponse) {
						// Get the received SuccessResponse instance
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

	public static function deleteUsersUnavailabilityHour($id)
	{
		// Get instance of UsersUnavailabilityOperations Class
		$usersOperations = new UsersUnavailabilityOperations();

		// Call deleteUsersUnavailabilityHour method that takes id as parameter
		$response = $usersOperations->deleteUsersUnavailabilityHour($id);

		if ($response != null) {
			// Get the status code from response
			echo ("Status Code: " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$responseWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $responseWrapper->getUsersUnavailability();

				foreach ($actionResponses as $actionResponse) {
					// Check if the request is successful
					if ($actionResponse instanceof SuccessResponse) {
						// Get the received SuccessResponse instance
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
