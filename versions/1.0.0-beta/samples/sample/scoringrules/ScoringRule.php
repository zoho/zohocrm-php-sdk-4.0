<?php

namespace com\zoho\crm\sample\scoringrules;

use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\scoringrules\GetScoringRulesParam;
use com\zoho\crm\api\scoringrules\ActionWrapper;
use com\zoho\crm\api\scoringrules\APIException;
use com\zoho\crm\api\scoringrules\DeleteScoringRulesParam;
use com\zoho\crm\api\scoringrules\GetEntityScoreRecordsParam;
use com\zoho\crm\api\scoringrules\ScoringRulesOperations;
use com\zoho\crm\api\scoringrules\ResponseWrapper;
use com\zoho\crm\api\scoringrules\BodyWrapper;
use com\zoho\crm\api\modules\Module;
use com\zoho\crm\api\scoringrules\Layout;
use com\zoho\crm\api\scoringrules\FieldRule;
use com\zoho\crm\api\scoringrules\Criteria;
use com\zoho\crm\api\fields\MinifiedFields;
use com\zoho\crm\api\util\Choice;
use com\zoho\crm\api\scoringrules\SuccessResponse;
use com\zoho\crm\api\scoringrules\LayoutRequestWrapper;
use com\zoho\crm\api\scoringrules\EntityResponseWrapper;
use com\zoho\crm\api\scoringrules\RoleRequestWrapper;

class ScoringRule
{
	public static function getScoringRules()
	{
		// Get instance of ScoringRulesOperations Class
		$scoringRulesOperations = new ScoringRulesOperations();

		$paramInstance = new ParameterMap();

		$paramInstance->add(GetScoringRulesParam::module(), "Leads");

		// Call getContactRoles method
		$response = $scoringRulesOperations->getScoringRules($paramInstance);

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
				// Get the received ResponseWrapper instance
				$responseWrapper = $responseHandler;

				// Get the list of obtained ScoringRule instances
				$scoringRules = $responseWrapper->getScoringRules();

				foreach ($scoringRules as $scoringRule) {
					$layout = $scoringRule->getLayout();

					if ($layout != null) {
						echo ("ScoringRule Layout ID: " . $layout->getId() . "\n");

						echo ("ScoringRule Layout APIName: " . $layout->getAPIName() . "\n");
					}

					// Get the CreatedTime of each ScoringRule
					echo ("ScoringRule CreatedTime: ");

					print_r($scoringRule->getCreatedTime());
					echo ("\n");

					// Get the ModifiedTime of each ScoringRule
					echo ("ScoringRule ModifiedTime: ");

					print_r($scoringRule->getModifiedTime());
					echo ("\n");

					$fieldRules = $scoringRule->getFieldRules();

					foreach ($fieldRules as $fieldRule) {
						echo ("ScoringRule FieldRule Score: " . $fieldRule->getScore() . "\n");

						// Get the Criteria instance of each CustomView
						$criteria = $fieldRule->getCriteria();

						// Check if criteria is not null
						if ($criteria != null) {
							self::printCriteria($criteria);
						}

						echo ("ScoringRule FieldRule Id: " . $fieldRule->getId() . "\n");
					}

					$module = $scoringRule->getModule();

					if ($module != null) {
						echo ("ScoringRule Module ID: " . $module->getId() . "\n");

						echo ("ScoringRule Module APIName: " . $module->getAPIName() . "\n");
					}

					// Get the Name each ScoringRule
					echo ("ScoringRule Name: " . $scoringRule->getName() . "\n");

					$modifiedBy = $scoringRule->getModifiedBy();

					if ($modifiedBy != null) {
						echo ("ScoringRule Modified By Name : " . $modifiedBy->getName() . "\n");

						echo ("ScoringRule Modified By id : " . $modifiedBy->getId() . "\n");
					}

					echo ("ScoringRule Active: " . $scoringRule->getActive() . "\n");

					echo ("ScoringRule Description: " . $scoringRule->getDescription() . "\n");

					echo ("ScoringRule Id: " . $scoringRule->getId() . "\n");

					$signalRules = $scoringRule->getSignalRules();

					if ($signalRules != null) {
						foreach ($signalRules as $signalRule) {
							echo ("ScoringRule SignalRule Score: " . $signalRule->getScore() . "\n");

							echo ("ScoringRule SignalRule Id: " . $signalRule->getId() . "\n");

							$signal = $signalRule->getSignal();

							if ($signal != null) {
								echo ("ScoringRule SignalRule Signal Namespace: " . $signal->getNamespace() . "\n");

								echo ("ScoringRule SignalRule Signal Id: " . $signal->getId() . "\n");
							}
						}
					}

					$createdBy = $scoringRule->getCreatedBy();

					if ($createdBy != null) {
						echo ("ScoringRule Created By Name : " . $createdBy->getName() . "\n");

						echo ("ScoringRule Created By id : " . $createdBy->getId() . "\n");
					}
				}

				// Get the Object obtained Info instance
				$info = $responseWrapper->getInfo();

				if ($info != null) {
					if ($info->getPerPage() != null) {
						// Get the PerPage of the Info
						echo ("Info PerPage: " . $info->getPerPage() . "\n");
					}

					if ($info->getCount() != null) {
						// Get the Count of the Info
						echo ("Info Count: " . $info->getCount() . "\n");
					}

					if ($info->getPage() != null) {
						// Get the Default of the Info
						echo ("Info Page: " . $info->getPage() . "\n");
					}

					if ($info->getMoreRecords() != null) {
						// Get the Default of the Info
						echo ("Info MoreRecords: " . $info->getMoreRecords() . "\n");
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
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}

	public static function getScoringRule($id)
	{
		// Get instance of ScoringRulesOperations Class
		$scoringRulesOperations = new ScoringRulesOperations();

		$paramInstance = new ParameterMap();

		// Call getContactRoles method
		$response = $scoringRulesOperations->getScoringRule($id, $paramInstance);

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
				// Get the received ResponseWrapper instance
				$responseWrapper = $responseHandler;

				// Get the list of obtained ScoringRule instances
				$scoringRules = $responseWrapper->getScoringRules();

				foreach ($scoringRules as $scoringRule) {
					$layout = $scoringRule->getLayout();

					if ($layout != null) {
						echo ("ScoringRule Layout ID: " . $layout->getId() . "\n");

						echo ("ScoringRule Layout APIName: " . $layout->getAPIName() . "\n");
					}

					// Get the CreatedTime of each ScoringRule
					echo ("ScoringRule CreatedTime: ");

					print_r($scoringRule->getCreatedTime());
					echo ("\n");

					// Get the ModifiedTime of each ScoringRule
					echo ("ScoringRule ModifiedTime: ");

					print_r($scoringRule->getModifiedTime());
					echo ("\n");

					$fieldRules = $scoringRule->getFieldRules();

					foreach ($fieldRules as $fieldRule) {
						echo ("ScoringRule FieldRule Score: " . $fieldRule->getScore() . "\n");

						// Get the Criteria instance of each CustomView
						$criteria = $fieldRule->getCriteria();

						// Check if criteria is not null
						if ($criteria != null) {
							self::printCriteria($criteria);
						}

						echo ("ScoringRule FieldRule Id: " . $fieldRule->getId() . "\n");
					}

					$module = $scoringRule->getModule();

					if ($module != null) {
						echo ("ScoringRule Module ID: " . $module->getId() . "\n");

						echo ("ScoringRule Module APIName: " . $module->getAPIName() . "\n");
					}

					// Get the Name each ScoringRule
					echo ("ScoringRule Name: " . $scoringRule->getName() . "\n");

					$modifiedBy = $scoringRule->getModifiedBy();

					if ($modifiedBy != null) {
						echo ("ScoringRule Modified By Name : " . $modifiedBy->getName() . "\n");

						echo ("ScoringRule Modified By id : " . $modifiedBy->getId() . "\n");
					}

					echo ("ScoringRule Active: " . $scoringRule->getActive() . "\n");

					echo ("ScoringRule Description: " . $scoringRule->getDescription() . "\n");

					echo ("ScoringRule Id: " . $scoringRule->getId() . "\n");

					$signalRules = $scoringRule->getSignalRules();

					if ($signalRules != null) {
						foreach ($signalRules as $signalRule) {
							echo ("ScoringRule SignalRule Score: " . $signalRule->getScore() . "\n");

							echo ("ScoringRule SignalRule Id: " . $signalRule->getId() . "\n");

							$signal = $signalRule->getSignal();

							if ($signal != null) {
								echo ("ScoringRule SignalRule Signal Namespace: " . $signal->getNamespace() . "\n");

								echo ("ScoringRule SignalRule Signal Id: " . $signal->getId() . "\n");
							}
						}
					}

					$createdBy = $scoringRule->getCreatedBy();

					if ($createdBy != null) {
						echo ("ScoringRule Created By Name : " . $createdBy->getName() . "\n");

						echo ("ScoringRule Created By id : " . $createdBy->getId() . "\n");
					}
				}

				// Get the Object obtained Info instance
				$info = $responseWrapper->getInfo();

				if ($info != null) {
					if ($info->getPerPage() != null) {
						// Get the PerPage of the Info
						echo ("Info PerPage: " . $info->getPerPage() . "\n");
					}

					if ($info->getCount() != null) {
						// Get the Count of the Info
						echo ("Info Count: " . $info->getCount() . "\n");
					}

					if ($info->getPage() != null) {
						// Get the Default of the Info
						echo ("Info Page: " . $info->getPage() . "\n");
					}

					if ($info->getMoreRecords() != null) {
						// Get the Default of the Info
						echo ("Info MoreRecords: " . $info->getMoreRecords() . "\n");
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
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}

	private static function printCriteria($criteria)
	{
		if ($criteria->getComparator() != null) {
			// Get the Comparator of the Criteria
			echo ("CustomView Criteria Comparator: " . $criteria->getComparator()->getValue() . "\n");
		}

		if ($criteria->getField() != null) {
			// Get the name of the field
			echo ("CustomView Criteria field name: " . $criteria->getField()->getAPIName() . "\n");
		}

		if ($criteria->getValue() != null) {
			// Get the Value of the Criteria
			echo ("CustomView Criteria Value: " . $criteria->getValue() . "\n");
		}

		// Get the List of Criteria instance of each Criteria
		$criteriaGroup = $criteria->getGroup();

		if ($criteriaGroup != null) {
			foreach ($criteriaGroup as $criteria1) {
				self::printCriteria($criteria1);
			}
		}

		if ($criteria->getGroupOperator() != null) {
			// Get the Group Operator of the Criteria
			echo ("CustomView Criteria Group Operator: " . $criteria->getGroupOperator()->getValue() . "\n");
		}
	}

	public static function createScoringRules()
	{
		// Get instance of ScoringRulesOperations Class
		$scoringRulesOperations = new ScoringRulesOperations();

		// Get instance of BodyWrapper Class that will contain the request body
		$bodyWrapper = new BodyWrapper();

		// List of ScoringRule instances
		$scoringRules = [];

		$scoringRuleClass = 'com\zoho\crm\api\scoringrules\ScoringRule';

		// Get instance of ScoringRule Class
		$scoringRule = new $scoringRuleClass();

		$scoringRule->setName("Rule 13");

		$scoringRule->setDescription("Rule for Module Leads");

		$module = new Module();

		$module->setAPIName("Leads");

		$module->setId("34770612175");

		$scoringRule->setModule($module);

		$layout = new Layout();

		$layout->setAPIName("Standard");

		$layout->setId("34770610091055");

		$scoringRule->setLayout($layout);

		$scoringRule->setActive(false);

		$fieldRules = [];

		$fieldRule = new FieldRule();

		$fieldRule->setScore(10);

		$criteria = new Criteria();

		$criteria->setGroupOperator(new Choice("or"));

		$group = [];

		$criteria1 = new Criteria();

		$field1 = new MinifiedFields();

		$field1->setAPIName("Company");

		$criteria1->setField($field1);

		$criteria1->setComparator(new Choice("equal"));

		$criteria1->setValue("zoho");

		array_push($group, $criteria1);

		$criteria2 = new Criteria();

		$field1 = new MinifiedFields();

		$field1->setAPIName("Designation");

		$criteria2->setField($field1);

		$criteria2->setComparator(new Choice("equal"));

		$criteria2->setValue("review");

		array_push($group, $criteria2);

		$criteria->setGroup($group);

		$fieldRule->setCriteria($criteria);

		array_push($fieldRules, $fieldRule);

		$scoringRule->setFieldRules($fieldRules);

		array_push($scoringRules, $scoringRule);

		$bodyWrapper->setScoringRules($scoringRules);

		// Call createScoringRules method that takes BodyWrapper instance as parameter
		$response = $scoringRulesOperations->createScoringRules($bodyWrapper);

		if ($response != null) {
			// Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $actionWrapper->getScoringRules();

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

						if ($exception->getDetails() != null) {
							//Get the details map
							foreach ($exception->getDetails() as $keyName => $keyValue) {
								//Get each value in the map
								echo ($keyName . ": " . $keyValue . "\n");
							}
						}

						//Get the Message
						echo ("Message: " . $exception->getMessage()->getValue() . "\n");
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
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}

	public static function updateScoringRules($id)
	{
		// Get instance of ScoringRulesOperations Class
		$scoringRulesOperations = new ScoringRulesOperations();

		// Get instance of BodyWrapper Class that will contain the request body
		$bodyWrapper = new BodyWrapper();

		// List of ScoringRule instances
		$scoringRules = [];

		$scoringRuleClass = 'com\zoho\crm\api\scoringrules\ScoringRule';

		// Get instance of ScoringRule Class
		$scoringRule = new $scoringRuleClass();

		$scoringRule->setId($id);

		$scoringRule->setName("Rule 14");

		$scoringRule->setDescription("Rule for Module Leads");

		$module = new Module();

		$module->setAPIName("Leads");

		$module->setId("34770612175");

		$scoringRule->setModule($module);

		$layout = new Layout();

		$layout->setAPIName("Standard");

		$layout->setId("34770610091055");

		$scoringRule->setLayout($layout);

		$scoringRule->setActive(false);

		$fieldRules = [];

		$fieldRule = new FieldRule();

		$fieldRule->setScore(10);

		// $fieldRule->setId("347706114954005");

		// $fieldRule->setDelete(null);

		$criteria = new Criteria();

		$criteria->setGroupOperator(new Choice("or"));

		$group = [];

		$criteria1 = new Criteria();

		$field1 = new MinifiedFields();

		$field1->setAPIName("Company");

		$criteria1->setField($field1);

		$criteria1->setComparator(new Choice("equal"));

		$criteria1->setValue("zoho");

		array_push($group, $criteria1);

		$criteria2 = new Criteria();

		$field1 = new MinifiedFields();

		$field1->setAPIName("Designation");

		$criteria2->setField($field1);

		$criteria2->setComparator(new Choice("equal"));

		$criteria2->setValue("review");

		array_push($group, $criteria2);

		$criteria3 = new Criteria();

		$field1 = new MinifiedFields();

		$field1->setAPIName("Last_Name");

		$criteria3->setField($field1);

		$criteria3->setComparator(new Choice("equal"));

		$criteria3->setValue("SDK");

		array_push($group, $criteria3);

		$criteria->setGroup($group);

		$fieldRule->setCriteria($criteria);

		array_push($fieldRules, $fieldRule);

		$scoringRule->setFieldRules($fieldRules);

		array_push($scoringRules, $scoringRule);

		$bodyWrapper->setScoringRules($scoringRules);

		// Call createScoringRules method that takes BodyWrapper instance as parameter
		$response = $scoringRulesOperations->updateScoringRules($bodyWrapper);

		if ($response != null) {
			// Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $actionWrapper->getScoringRules();

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

						if ($exception->getDetails() != null) {
							//Get the details map
							foreach ($exception->getDetails() as $keyName => $keyValue) {
								//Get each value in the map
								echo ($keyName . ": " . $keyValue . "\n");
							}
						}

						//Get the Message
						echo ("Message: " . $exception->getMessage()->getValue() . "\n");
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
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}

	public static function updateScoringRule($id)
	{
		// Get instance of ScoringRulesOperations Class
		$scoringRulesOperations = new ScoringRulesOperations();

		// Get instance of BodyWrapper Class that will contain the request body
		$bodyWrapper = new BodyWrapper();

		// List of ScoringRule instances
		$scoringRules = [];

		$scoringRuleClass = 'com\zoho\crm\api\scoringrules\ScoringRule';

		// Get instance of ScoringRule Class
		$scoringRule = new $scoringRuleClass();

		$scoringRule->setName("Rule 15");

		$scoringRule->setDescription("Rule for Module Leads");

		$module = new Module();

		$module->setAPIName("Leads");

		$module->setId("34770612175");

		$scoringRule->setModule($module);

		$layout = new Layout();

		$layout->setAPIName("Standard");

		$layout->setId("34770610091055");

		$scoringRule->setLayout($layout);

		$scoringRule->setActive(false);

		$fieldRules = [];

		$fieldRule = new FieldRule();

		$fieldRule->setScore(10);

		// $fieldRule->setId("347706114954005");

		// $fieldRule->setDelete(null);

		$criteria = new Criteria();

		$criteria->setGroupOperator(new Choice("and"));

		$group = [];

		$criteria1 = new Criteria();

		$field1 = new MinifiedFields();

		$field1->setAPIName("Company");

		$criteria1->setField($field1);

		$criteria1->setComparator(new Choice("equal"));

		$criteria1->setValue("zoho");

		array_push($group, $criteria1);

		$criteria2 = new Criteria();

		$field1 = new MinifiedFields();

		$field1->setAPIName("Designation");

		$criteria2->setField($field1);

		$criteria2->setComparator(new Choice("equal"));

		$criteria2->setValue("review");

		array_push($group, $criteria2);

		$criteria3 = new Criteria();

		$field1 = new MinifiedFields();

		$field1->setAPIName("Last_Name");

		$criteria3->setField($field1);

		$criteria3->setComparator(new Choice("equal"));

		$criteria3->setValue("SDK");

		array_push($group, $criteria3);

		$criteria->setGroup($group);

		$fieldRule->setCriteria($criteria);

		array_push($fieldRules, $fieldRule);

		$scoringRule->setFieldRules($fieldRules);

		array_push($scoringRules, $scoringRule);

		$bodyWrapper->setScoringRules($scoringRules);

		// Call updateScoringRule method that takes id and BodyWrapper instance as parameter
		$response = $scoringRulesOperations->updateScoringRule($id, $bodyWrapper);

		if ($response != null) {
			// Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $actionWrapper->getScoringRules();

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

						if ($exception->getDetails() != null) {
							//Get the details map
							foreach ($exception->getDetails() as $keyName => $keyValue) {
								//Get each value in the map
								echo ($keyName . ": " . $keyValue . "\n");
							}
						}

						//Get the Message
						echo ("Message: " . $exception->getMessage()->getValue() . "\n");
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
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}

	public static function deleteScoringRules()
	{
		// Get instance of ScoringRulesOperations Class
		$scoringRulesOperations = new ScoringRulesOperations();

		$paramInstance = new ParameterMap();

		$paramInstance->add(DeleteScoringRulesParam::ids(), "347706115136003,34770611513600");

		// Call deleteScoringRules method that takes paramInstance as parameter
		$response = $scoringRulesOperations->deleteScoringRules($paramInstance);

		if ($response != null) {
			// Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $actionWrapper->getScoringRules();

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

						if ($exception->getDetails() != null) {
							//Get the details map
							foreach ($exception->getDetails() as $keyName => $keyValue) {
								//Get each value in the map
								echo ($keyName . ": " . $keyValue . "\n");
							}
						}

						//Get the Message
						echo ("Message: " . $exception->getMessage()->getValue() . "\n");
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
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}

	public static function deleteScoringRule($id)
	{
		// Get instance of ScoringRulesOperations Class
		$scoringRulesOperations = new ScoringRulesOperations();

		// Call deleteScoringRules method that takes paramInstance as parameter
		$response = $scoringRulesOperations->deleteScoringRule($id);

		if ($response != null) {
			// Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $actionWrapper->getScoringRules();

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

						if ($exception->getDetails() != null) {
							//Get the details map
							foreach ($exception->getDetails() as $keyName => $keyValue) {
								//Get each value in the map
								echo ($keyName . ": " . $keyValue . "\n");
							}
						}

						//Get the Message
						echo ("Message: " . $exception->getMessage()->getValue() . "\n");
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
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}

	public static function scoringRuleExecutionUsingLayoutId($moduleAPIName)
	{
		// Get instance of ScoringRulesOperations Class
		$scoringRulesOperations = new ScoringRulesOperations();

		// Get instance of LayoutRequestWrapper Class that will contain the request body
		$bodyWrapper = new LayoutRequestWrapper();

		$layout = new Layout();

		$layout->setId("34770610091055");

		$bodyWrapper->setLayout($layout);

		// Call scoringRuleExecutionUsingLayoutId method that takes moduleAPIName and LayoutRequestWrapper instance as parameter
		$response = $scoringRulesOperations->scoringRuleExecutionUsingLayoutId($moduleAPIName, $bodyWrapper);

		if ($response != null) {
			// Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionResponse = $response->getObject();

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

				if ($exception->getDetails() != null) {
					//Get the details map
					foreach ($exception->getDetails() as $keyName => $keyValue) {
						//Get each value in the map
						echo ($keyName . ": " . $keyValue . "\n");
					}
				}

				//Get the Message
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}

	public static function scoringRuleExecutionUsingRuleIds($moduleAPIName)
	{
		// Get instance of ScoringRulesOperations Class
		$scoringRulesOperations = new ScoringRulesOperations();

		// Get instance of RoleRequestWrapper Class that will contain the request body
		$bodyWrapper = new RoleRequestWrapper();

		$scoringRules = ["347706114954046", "347706114913001"];

		$bodyWrapper->setScoringRules($scoringRules);

		// Call scoringRuleExecutionUsingRuleIds method that takes moduleAPIName and RoleRequestWrapper instance as parameter
		$response = $scoringRulesOperations->scoringRuleExecutionUsingRuleIds($moduleAPIName, $bodyWrapper);

		if ($response != null) {
			// Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $actionWrapper->getScoringRules();

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

						if ($exception->getDetails() != null) {
							//Get the details map
							foreach ($exception->getDetails() as $keyName => $keyValue) {
								//Get each value in the map
								echo ($keyName . ": " . $keyValue . "\n");
							}
						}

						//Get the Message
						echo ("Message: " . $exception->getMessage()->getValue() . "\n");
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
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}

	public static function activateScoringRule($id)
	{
		// Get instance of ScoringRulesOperations Class
		$scoringRulesOperations = new ScoringRulesOperations();

		// Call activateScoringRule method that takes paramInstance as parameter
		$response = $scoringRulesOperations->activateScoringRule($id);

		if ($response != null) {
			// Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $actionWrapper->getScoringRules();

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

						if ($exception->getDetails() != null) {
							//Get the details map
							foreach ($exception->getDetails() as $keyName => $keyValue) {
								//Get each value in the map
								echo ($keyName . ": " . $keyValue . "\n");
							}
						}

						//Get the Message
						echo ("Message: " . $exception->getMessage()->getValue() . "\n");
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
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}

	public static function deactivateScoringRule($id)
	{
		// Get instance of ScoringRulesOperations Class
		$scoringRulesOperations = new ScoringRulesOperations();

		// Call deactivateScoringRule method that takes paramInstance as parameter
		$response = $scoringRulesOperations->deactivateScoringRule($id);

		if ($response != null) {
			// Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $actionWrapper->getScoringRules();

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

						if ($exception->getDetails() != null) {
							//Get the details map
							foreach ($exception->getDetails() as $keyName => $keyValue) {
								//Get each value in the map
								echo ($keyName . ": " . $keyValue . "\n");
							}
						}

						//Get the Message
						echo ("Message: " . $exception->getMessage()->getValue() . "\n");
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
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}

	public static function cloneScoringRule($id)
	{
		// Get instance of ScoringRulesOperations Class
		$scoringRulesOperations = new ScoringRulesOperations();

		// Call cloneScoringRule method that takes id as parameter
		$response = $scoringRulesOperations->cloneScoringRule($id);

		if ($response != null) {
			// Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $actionWrapper->getScoringRules();

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

						if ($exception->getDetails() != null) {
							//Get the details map
							foreach ($exception->getDetails() as $keyName => $keyValue) {
								//Get each value in the map
								echo ($keyName . ": " . $keyValue . "\n");
							}
						}

						//Get the Message
						echo ("Message: " . $exception->getMessage()->getValue() . "\n");
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
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}

	public static function getEntityScoreRecords()
	{
		// Get instance of ScoringRulesOperations Class
		$scoringRulesOperations = new ScoringRulesOperations();

		$paramInstance = new ParameterMap();

		$paramInstance->add(GetEntityScoreRecordsParam::fields(), "Positive_Score");

		// Call getContactRoles method
		$response = $scoringRulesOperations->getEntityScoreRecords($paramInstance);

		if ($response != null) {
			// Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			if (in_array($response->getStatusCode(), array(204, 304))) {
				echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

				return;
			}

			// Get object from response
			$responseHandler = $response->getObject();

			if ($responseHandler instanceof EntityResponseWrapper) {
				// Get the received EntityResponseWrapper instance
				$responseWrapper = $responseHandler;

				// Get the list of obtained ScoringRule instances
				$entityScores = $responseWrapper->getData();

				foreach ($entityScores as $entityScore) {
					echo ("EntityScore Id: " . $entityScore->getId() . "\n");

					echo ("EntityScore Positive_Score: " . $entityScore->getPositiveScore() . "\n");
				}

				// Get the Object obtained Info instance
				$info = $responseWrapper->getInfo();

				if ($info != null) {
					if ($info->getPerPage() != null) {
						// Get the PerPage of the Info
						echo ("Info PerPage: " . $info->getPerPage() . "\n");
					}

					if ($info->getCount() != null) {
						// Get the Count of the Info
						echo ("Info Count: " . $info->getCount() . "\n");
					}

					if ($info->getPage() != null) {
						// Get the Default of the Info
						echo ("Info Page: " . $info->getPage() . "\n");
					}

					if ($info->getMoreRecords() != null) {
						// Get the Default of the Info
						echo ("Info MoreRecords: " . $info->getMoreRecords() . "\n");
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
					//Get the details map
					foreach ($exception->getDetails() as $keyName => $keyValue) {
						//Get each value in the map
						echo ($keyName . ": " . $keyValue . "\n");
					}
				}

				//Get the Message
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}

	public static function getEntityScoreRecord($recordId, $moduleAPIName)
	{
		// Get instance of ScoringRulesOperations Class
		$scoringRulesOperations = new ScoringRulesOperations();

		$paramInstance = new ParameterMap();

		$paramInstance->add(GetEntityScoreRecordsParam::fields(), "Positive_Score");

		// Call getContactRoles method
		$response = $scoringRulesOperations->getEntityScoreRecord($recordId, $moduleAPIName, $paramInstance);

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
				// Get the received ResponseWrapper instance
				$responseWrapper = $responseHandler;

				// Get the list of obtained ScoringRule instances
				$scoringRules = $responseWrapper->getScoringRules();

				foreach ($scoringRules as $scoringRule) {
					$layout = $scoringRule->getLayout();

					if ($layout != null) {
						echo ("ScoringRule Layout ID: " . $layout->getId() . "\n");

						echo ("ScoringRule Layout APIName: " . $layout->getAPIName() . "\n");
					}

					// Get the CreatedTime of each ScoringRule
					echo ("ScoringRule CreatedTime: " . $scoringRule->getCreatedTime() . "\n");

					// Get the ModifiedTime of each ScoringRule
					echo ("ScoringRule ModifiedTime: " . $scoringRule->getModifiedTime() . "\n");

					$fieldRules = $scoringRule->getFieldRules();

					foreach ($fieldRules as $fieldRule) {
						echo ("ScoringRule FieldRule Score: " . $fieldRule->getScore() . "\n");

						// Get the Criteria instance of each CustomView
						$criteria = $fieldRule->getCriteria();

						// Check if criteria is not null
						if ($criteria != null) {
							self::printCriteria($criteria);
						}

						echo ("ScoringRule FieldRule Id: " . $fieldRule->getId() . "\n");
					}

					$module = $scoringRule->getModule();

					if ($module != null) {
						echo ("ScoringRule Module ID: " . $module->getId() . "\n");

						echo ("ScoringRule Module APIName: " . $module->getAPIName() . "\n");
					}

					// Get the Name each ScoringRule
					echo ("ScoringRule Name: " . $scoringRule->getName() . "\n");

					$modifiedBy = $scoringRule->getModifiedBy();

					if ($modifiedBy != null) {
						echo ("ScoringRule Modified By Name : " . $modifiedBy->getName() . "\n");

						echo ("ScoringRule Modified By id : " . $modifiedBy->getId() . "\n");
					}

					echo ("ScoringRule Active: " . $scoringRule->getActive() . "\n");

					echo ("ScoringRule Description: " . $scoringRule->getDescription() . "\n");

					echo ("ScoringRule Id: " . $scoringRule->getId() . "\n");

					$signalRules = $scoringRule->getSignalRules();

					if ($signalRules != null) {
						foreach ($signalRules as $signalRule) {
							echo ("ScoringRule SignalRule Score: " . $signalRule->getScore() . "\n");

							echo ("ScoringRule SignalRule Id: " . $signalRule->getId() . "\n");

							$signal = $signalRule->getSignal();

							if ($signal != null) {
								echo ("ScoringRule SignalRule Signal Namespace: " . $signal->getNamespace() . "\n");

								echo ("ScoringRule SignalRule Signal Id: " . $signal->getId() . "\n");
							}
						}
					}

					$createdBy = $scoringRule->getCreatedBy();

					if ($createdBy != null) {
						echo ("ScoringRule Created By Name : " . $createdBy->getName() . "\n");

						echo ("ScoringRule Created By id : " . $createdBy->getId() . "\n");
					}
				}

				// Get the Object obtained Info instance
				$info = $responseWrapper->getInfo();

				if ($info != null) {
					if ($info->getPerPage() != null) {
						// Get the PerPage of the Info
						echo ("Info PerPage: " . $info->getPerPage() . "\n");
					}

					if ($info->getCount() != null) {
						// Get the Count of the Info
						echo ("Info Count: " . $info->getCount() . "\n");
					}

					if ($info->getPage() != null) {
						// Get the Default of the Info
						echo ("Info Page: " . $info->getPage() . "\n");
					}

					if ($info->getMoreRecords() != null) {
						// Get the Default of the Info
						echo ("Info MoreRecords: " . $info->getMoreRecords() . "\n");
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
				echo ("Message: " . $exception->getMessage()->getValue() . "\n");
			}
		}
	}
}
