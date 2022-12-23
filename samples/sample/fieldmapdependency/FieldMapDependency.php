<?php

namespace com\zoho\crm\sample\fieldmapdependency;

use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\fieldmapdependency\APIException;
use com\zoho\crm\api\fieldmapdependency\ActionWrapper;
use com\zoho\crm\api\fieldmapdependency\BodyWrapper;
use com\zoho\crm\api\fieldmapdependency\Child;
use com\zoho\crm\api\fieldmapdependency\FieldMapDependencyOperations;
use com\zoho\crm\api\fieldmapdependency\MapDependency;
use com\zoho\crm\api\fieldmapdependency\Parent1;
use com\zoho\crm\api\fieldmapdependency\PickListMapping;
use com\zoho\crm\api\fieldmapdependency\PicklistMap;
use com\zoho\crm\api\fieldmapdependency\SuccessResponse;

class FieldMapDependency
{
	public static function createMapDependency(string $layoutId, string $module)
	{
		// Get instance of FieldMapDependencyOperations Class
		$fieldMapDependencyOperations = new FieldMapDependencyOperations($layoutId, $module);

		$bodyWrapper = new BodyWrapper();

		$mapDependencies = array();

		$mapdependency = new MapDependency();

		$parent = new Parent1();

		$parent->setAPIName("Lead_Status");

		$parent->setId("34770612611");

		$mapdependency->setParent($parent);

		$child = new Child();

		$child->setAPIName("Pick_List_1");

		$child->setId("347706116628001");

		$mapdependency->setChild($child);

		$pickListValues = array();

		$pickListValue = new PickListMapping();

		$pickListValue->setDisplayValue("-None-");

		$pickListValue->setId("34770613409");

		$pickListValue->setActualValue("-None-");

		$picklistMaps = array();

		$picklistMap = new PicklistMap();

		$picklistMap->setId("347706116628005");

		$picklistMap->setActualValue("Option 1");

		$picklistMap->setDisplayValue("Option 1");

		array_push($picklistMaps, $picklistMap);

		$picklistMap = new PicklistMap();

		$picklistMap->setId("347706116628003");

		$picklistMap->setActualValue("-None-");

		$picklistMap->setDisplayValue("-None-");

		array_push($picklistMaps, $picklistMap);

		$pickListValue->setMaps($picklistMaps);

		array_push($pickListValues, $pickListValue);

		$mapdependency->setPickListValues($pickListValues);

		array_push($mapDependencies, $mapdependency);

		$bodyWrapper->setMapDependency($mapDependencies);

		$response = $fieldMapDependencyOperations->createMapDependency($bodyWrapper);

		if ($response != null) {
			//Get the status code from response
			echo ("Status code : " . $response->getStatusCode() . "\n");

			if (in_array($response->getStatusCode(), array(204, 304))) {
				echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

				return;
			}

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $actionWrapper->getMapDependency();

				if ($actionResponses != null) {
					foreach ($actionResponses as $actionResponse) {
						// Check if the request is successful
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

	public static function getMapDependencies(string $layoutId, string $module)
	{
		$fieldMapDependencyOperations = new FieldMapDependencyOperations($layoutId, $module);

		$paramInstance = new ParameterMap();

		// Call getMapDependencys method
		$response = $fieldMapDependencyOperations->getMapDependencies($paramInstance);

		if ($response != null) {
			//Get the status code from response
			echo ("Status code : " . $response->getStatusCode() . "\n");

			if (in_array($response->getStatusCode(), array(204, 304))) {
				echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

				return;
			}

			// Get object from response
			$responseHandler = $response->getObject();

			if ($responseHandler instanceof BodyWrapper) {
				// Get the received BodyWrapper instance
				$responseWrapper = $responseHandler;

				$mapDependencies = $responseWrapper->getMapDependency();

				if ($mapDependencies != null) {
					foreach ($mapDependencies as $mapDependency) {
						$parent = $mapDependency->getParent();

						if ($parent != null) {
							echo ("MapDependency Parent ID: " . $parent->getId() . "\n");

							echo ("MapDependency Parent APIName: " . $parent->getAPIName() . "\n");
						}

						$child = $mapDependency->getChild();

						if ($child != null) {
							echo ("MapDependency Child ID: " . $child->getId() . "\n");

							echo ("MapDependency Child APIName: " . $child->getAPIName() . "\n");
						}

						$pickListValues = $mapDependency->getPickListValues();

						if ($pickListValues != null) {
							foreach ($pickListValues as $pickListValue) {
								echo ("MapDependency PickListValue ID: " . $pickListValue->getId() . "\n");

								echo ("MapDependency PickListValue ActualValue: " . $pickListValue->getActualValue() . "\n");

								echo ("MapDependency PickListValue DisplayValue: " . $pickListValue->getDisplayValue() . "\n");

								$picklistMaps = $pickListValue->getMaps();

								if ($picklistMaps != null) {
									foreach ($picklistMaps as $$picklistMap) {
										echo ("MapDependency PickListValue Map ID: " . $picklistMap->getId() . "\n");

										echo ("MapDependency PickListValue Map ActualValue: " . $picklistMap->getActualValue() . "\n");

										echo ("MapDependency PickListValue Map DisplayValue: " . $picklistMap->getDisplayValue() . "\n");
									}
								}
							}
						}

						echo ("MapDependency Internal: " . $mapDependency->getInternal() . "\n");

						echo ("MapDependency Active: " . $mapDependency->getActive() . "\n");

						echo ("MapDependency ID: " . $mapDependency->getId() . "\n");

						echo ("MapDependency Active: " . $mapDependency->getSource() . "\n");

						echo ("MapDependency Category: " . $mapDependency->getCategory() . "\n");

						echo ("MapDependency Source: " . $mapDependency->getSource() . "\n");
					}

					$info = $responseWrapper->getInfo();

					// Check if info is not null
					if ($info != null) {
						if ($info->getPerPage() != null) {
							// Get the PerPage of the Info
							echo ("MapDependency Info PerPage: " . $info->getPerPage() . "\n");
						}

						if ($info->getCount() != null) {
							// Get the Count of the Info
							echo ("MapDependency Info Count: " . $info->getCount() . "\n");
						}

						if ($info->getPage() != null) {
							// Get the Page of the Info
							echo ("MapDependency Info Page: " . $info->getPage() . "\n");
						}

						if ($info->getMoreRecords() != null) {
							// Get the MoreRecords of the Info
							echo ("MapDependency Info MoreRecords: " . $info->getMoreRecords() . "\n");
						}
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

	public static function updateMapDependency(string $layoutId, string $module, string $dependencyId)
	{
		// Get instance of MapDependencysOperations Class
		$fieldMapDependencyOperations = new FieldMapDependencyOperations($layoutId, $module);

		// Get instance of BodyWrapper Class that will contain the request body
		$bodyWrapper = new BodyWrapper();

		$mapDependencies = array();

		$mapdependency = new MapDependency();

		$parent = new Parent1();

		$parent->setAPIName("Lead_Status");

		$parent->setId("36523972611");

		$mapdependency->setParent($parent);

		$child = new Child();

		$child->setAPIName("Lead_Status");

		$child->setId("36523972611");

		$mapdependency->setChild($child);

		$pickListValues = array();

		$pickListValue = new PickListMapping();

		$pickListValue->setDisplayValue("-None-");

		$pickListValue->setId("36523973409");

		$pickListValue->setActualValue("-None-");

		$picklistMaps = array();

		$picklistMap = new PicklistMap();

		$picklistMap->setId("36523973389");

		$picklistMap->setActualValue("Cold Call");

		$picklistMap->setDisplayValue("Cold Call");

		array_push($picklistMaps, $picklistMap);

		$picklistMap = new PicklistMap();

		$picklistMap->setId("36523973391");

		$picklistMap->setActualValue("-None-");

		$picklistMap->setDisplayValue("-None-");

		array_push($picklistMaps, $picklistMap);

		$pickListValue->setMaps($picklistMaps);

		array_push($pickListValues, $pickListValue);

		$mapdependency->setPickListValues($pickListValues);

		array_push($mapDependencies, $mapdependency);

		$bodyWrapper->setMapDependency($mapDependencies);

		$response = $fieldMapDependencyOperations->updateMapDependency($dependencyId, $bodyWrapper);
		if ($response != null) {
			//Get the status code from response
			echo ("Status code : " . $response->getStatusCode() . "\n");

			if (in_array($response->getStatusCode(), array(204, 304))) {
				echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

				return;
			}

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $actionWrapper->getMapDependency();

				if ($actionResponses != null) {
					foreach ($actionResponses as $actionResponse) {
						// Check if the request is successful
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

	public static function deleteMapDependency(string $layoutId, string $module, string $dependencyId)
	{
		$fieldMapDependencyOperations = new FieldMapDependencyOperations($layoutId, $module);

		// Call deleteMapDependency method that takes paramInstance as parameter
		$response = $fieldMapDependencyOperations->deleteMapDependency($dependencyId);

		if ($response != null) {
			//Get the status code from response
			echo ("Status code : " . $response->getStatusCode() . "\n");

			if (in_array($response->getStatusCode(), array(204, 304))) {
				echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

				return;
			}

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $actionWrapper->getMapDependency();

				if ($actionResponses != null) {
					foreach ($actionResponses as $actionResponse) {
						// Check if the request is successful
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

	public static function getMapDependency(string $layoutId, string $module, string $dependencyId)
	{
		$fieldMapDependencyOperations = new FieldMapDependencyOperations($layoutId, $module);

		$response = $fieldMapDependencyOperations->getMapDependency($dependencyId);

		if ($response != null) {
			//Get the status code from response
			echo ("Status code : " . $response->getStatusCode() . "\n");

			if (in_array($response->getStatusCode(), array(204, 304))) {
				echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

				return;
			}

			// Get object from response
			$responseHandler = $response->getObject();

			if ($responseHandler instanceof BodyWrapper) {
				// Get the received BodyWrapper instance
				$responseWrapper = $responseHandler;

				$mapDependencies = $responseWrapper->getMapDependency();

				if ($mapDependencies != null) {
					foreach ($mapDependencies as $mapDependency) {
						$parent = $mapDependency->getParent();

						if ($parent != null) {
							echo ("MapDependency Parent ID: " . $parent->getId() . "\n");

							echo ("MapDependency Parent APIName: " . $parent->getAPIName() . "\n");
						}

						$child = $mapDependency->getChild();

						if ($child != null) {
							echo ("MapDependency Child ID: " . $child->getId() . "\n");

							echo ("MapDependency Child APIName: " . $child->getAPIName() . "\n");
						}

						$pickListValues = $mapDependency->getPickListValues();

						if ($pickListValues != null) {
							foreach ($pickListValues as $pickListValue) {
								echo ("MapDependency PickListValue ID: " . $pickListValue->getId() . "\n");

								echo ("MapDependency PickListValue ActualValue: " . $pickListValue->getActualValue() . "\n");

								echo ("MapDependency PickListValue DisplayValue: " . $pickListValue->getDisplayValue() . "\n");

								$picklistMaps = $pickListValue->getMaps();

								if ($picklistMaps != null) {
									foreach ($picklistMaps as $picklistMap) {
										echo ("MapDependency PickListValue Map ID: " . $picklistMap->getId() . "\n");

										echo ("MapDependency PickListValue Map ActualValue: " . $picklistMap->getActualValue() . "\n");

										echo ("MapDependency PickListValue Map DisplayValue: " . $picklistMap->getDisplayValue() . "\n");
									}
								}
							}
						}

						echo ("MapDependency Internal: " . $mapDependency->getInternal() . "\n");

						echo ("MapDependency Active: " . $mapDependency->getActive() . "\n");

						echo ("MapDependency ID: " . $mapDependency->getId() . "\n");

						echo ("MapDependency Active: " . $mapDependency->getSource() . "\n");

						echo ("MapDependency Category: " . $mapDependency->getCategory() . "\n");

						echo ("MapDependency Source: " . $mapDependency->getSource() . "\n");
					}

					$info = $responseWrapper->getInfo();

					// Check if info is not null
					if ($info != null) {
						if ($info->getPerPage() != null) {
							// Get the PerPage of the Info
							echo ("MapDependency Info PerPage: " . $info->getPerPage() . "\n");
						}

						if ($info->getCount() != null) {
							// Get the Count of the Info
							echo ("MapDependency Info Count: " . $info->getCount() . "\n");
						}

						if ($info->getPage() != null) {
							// Get the Page of the Info
							echo ("MapDependency Info Page: " . $info->getPage() . "\n");
						}

						if ($info->getMoreRecords() != null) {
							// Get the MoreRecords of the Info
							echo ("MapDependency Info MoreRecords: " . $info->getMoreRecords() . "\n");
						}
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
}
