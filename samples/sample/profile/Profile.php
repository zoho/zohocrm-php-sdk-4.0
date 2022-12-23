<?php

namespace com\zoho\crm\sample\profile;

use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\profiles\APIException;
use com\zoho\crm\api\profiles\ActionWrapper;
use com\zoho\crm\api\profiles\CategoryModule;
use com\zoho\crm\api\profiles\CategoryOthers;
use com\zoho\crm\api\profiles\ProfileWrapper;
use com\zoho\crm\api\profiles\ProfilesOperations;
use com\zoho\crm\api\profiles\DeleteProfileParam;
use com\zoho\crm\api\profiles\SuccessResponse;

class Profile
{
	/**
	 * <h3> Get Profiles </h3>
	 * This method is used to retrieve the data of profiles through an API request and print the response.
	 * @throws Exception
	 */
	public static function getProfiles()
	{
		//Get instance of ProfilesOperations Class
		$profilesOperations = new ProfilesOperations();

		$paramInstance = new ParameterMap();

		//Call getProfiles method
		$response = $profilesOperations->getProfiles($paramInstance);

		if ($response != null) {
			//Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			if (in_array($response->getStatusCode(), array(204, 304))) {
				echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

				return;
			}

			//Get object from response
			$responseHandler = $response->getObject();

			if ($responseHandler instanceof ProfileWrapper) {
				//Get the received ResponseWrapper instance
				$responseWrapper = $responseHandler;

				//Get the list of obtained Profile instances
				$profiles = $responseWrapper->getProfiles();

				foreach ($profiles as $profile) {
					//Get the DisplayLabel of the each Profile
					echo ("Profile DisplayLabel: " . $profile->getDisplayLabel() . "\n");

					//Get the CreatedTime of each Profile
					echo ("Profile CreatedTime: ");
					print_r($profile->getCreatedTime());
					echo ("\n");

					//Get the ModifiedTime of each Profile
					echo ("Profile ModifiedTime: ");
					print_r($profile->getModifiedTime());
					echo ("\n");

					//Get the Custom of each Profile
					echo ("Profile Custom: ");
					print_r($profile->getCustom());
					echo ("\n");

					//Get the Name of the each Profile
					echo ("Profile Name: " . $profile->getName() . "\n");

					//Get the modifiedBy User instance of each Profile
					$modifiedBy = $profile->getModifiedBy();

					//Check if modifiedBy is not null
					if ($modifiedBy != null) {
						//Get the ID of the modifiedBy User
						echo ("Profile Modified By User-ID: " . $modifiedBy->getId() . "\n");

						//Get the name of the modifiedBy User
						echo ("Profile Modified By User-Name: " . $modifiedBy->getName() . "\n");

						//Get the Email of the modifiedBy User
						echo ("Profile Modified By User-Email: " . $modifiedBy->getEmail() . "\n");
					}

					//Get the Description of the each Profile
					echo ("Profile Description: " . $profile->getDescription() . "\n");

					//Get the ID of the each Profile
					echo ("Profile ID: " . $profile->getId() . "\n");

					//Get the createdBy User instance of each Profile
					$createdBy = $profile->getCreatedBy();

					//Check if createdBy is not null
					if ($createdBy != null) {
						//Get the ID of the createdBy User
						echo ("Profile Created By User-ID: " . $createdBy->getId() . "\n");

						//Get the name of the createdBy User
						echo ("Profile Created By User-Name: " . $createdBy->getName() . "\n");

						//Get the Email of the createdBy User
						echo ("Profile Created By User-Email: " . $createdBy->getEmail() . "\n");
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

	/**
	 * <h3> Get Profile </h3>
	 * This method is used to get the details of any specific profile.
	 * Specify the unique id of the profile in your API request to get the data for that particular profile.
	 * @param profileId - The ID of the Profile to be obtained
	 * @throws Exception
	 */
	public static function getProfile(string $profileId)
	{
		//Get instance of ProfilesOperations Class
		$profilesOperations = new ProfilesOperations();

		//Call getProfile method that takes profileId as parameter
		$response = $profilesOperations->getProfile($profileId);

		if ($response != null) {
			//Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			if (in_array($response->getStatusCode(), array(204, 304))) {
				echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

				return;
			}

			//Get object from response
			$responseHandler = $response->getObject();

			if ($responseHandler instanceof ProfileWrapper) {
				//Get the received ProfileWrapper instance
				$responseWrapper = $responseHandler;

				//Get the list of obtained Profile instances
				$profiles = $responseWrapper->getProfiles();

				foreach ($profiles as $profile) {
					//Get the DisplayLabel of the each Profile
					echo ("Profile DisplayLabel: " . $profile->getDisplayLabel() . "\n");

					//Get the CreatedTime of each Profile
					echo ("Profile CreatedTime: ");
					print_r($profile->getCreatedTime());
					echo ("\n");

					//Get the ModifiedTime of each Profile
					echo ("Profile ModifiedTime: ");
					print_r($profile->getModifiedTime());
					echo ("\n");

					//Get the Custom of each Profile
					echo ("Profile Custom: ");
					print_r($profile->getCustom());
					echo ("\n");

					//Get the permissionsDetails of each Profile
					$permissionsDetails = $profile->getPermissionsDetails();

					//Check if permissionsDetails is not null
					if ($permissionsDetails != null) {
						foreach ($permissionsDetails as $permissionsDetail) {
							//Get the DisplayLabel of the each PermissionDetail
							echo ("Profile PermissionDetail DisplayLabel: " . $permissionsDetail->getDisplayLabel() . "\n");

							//Get the Module of the each PermissionDetail
							echo ("Profile PermissionDetail Module: " . $permissionsDetail->getModule() . "\n");

							//Get the Name of the each PermissionDetail
							echo ("Profile PermissionDetail Name: " . $permissionsDetail->getName() . "\n");

							//Get the ID of the each PermissionDetail
							echo ("Profile PermissionDetail ID: " . $permissionsDetail->getId() . "\n");

							//Get the Enabled of the each PermissionDetail
							echo ("Profile PermissionDetail Enabled: ");
							print_r($permissionsDetail->getEnabled());
							echo ("\n");
						}
					}

					//Get the Name of the each Profile
					echo ("Profile Name: " . $profile->getName() . "\n");

					//Get the modifiedBy User instance of each Profile
					$modifiedBy = $profile->getModifiedBy();

					//Check if modifiedBy is not null
					if ($modifiedBy != null) {
						//Get the ID of the modifiedBy User
						echo ("Profile Modified By User-ID: " . $modifiedBy->getId() . "\n");

						//Get the name of the modifiedBy User
						echo ("Profile Modified By User-Name: " . $modifiedBy->getName() . "\n");

						//Get the Email of the modifiedBy User
						echo ("Profile Modified By User-Email: " . $modifiedBy->getEmail() . "\n");
					}

					//Get the Description of the each Profile
					echo ("Profile Description: " . $profile->getDescription() . "\n");

					//Get the ID of the each Profile
					echo ("Profile ID: " . $profile->getId() . "\n");

					//Get the createdBy User instance of each Profile
					$createdBy = $profile->getCreatedBy();

					//Check if createdBy is not null
					if ($createdBy != null) {
						//Get the ID of the createdBy User
						echo ("Profile Created By User-ID: " . $createdBy->getId() . "\n");

						//Get the name of the createdBy User
						echo ("Profile Created By User-Name: " . $createdBy->getName() . "\n");

						//Get the Email of the createdBy User
						echo ("Profile Created By User-Email: " . $createdBy->getEmail() . "\n");
					}

					//Get the sections of each Profile
					$sections = $profile->getSections();

					//Check if sections is not null
					if ($sections != null) {
						foreach ($sections as $section) {
							//Get the Name of the each Section
							echo ("Profile Section Name: " . $section->getName() . "\n");

							//Get the categories of each Section
							$categories = $section->getCategories();

							foreach ($categories as $category) {
								if ($category instanceof CategoryOthers) {
									//Get the DisplayLabel of the each Category
									echo ("Profile Section Category DisplayLabel: " . $category->getDisplayLabel() . "\n");

									//Get the permissionsDetails List of each Category
									$categoryPermissionsDetails = $category->getPermissionsDetails();

									//Check if categoryPermissionsDetails is not null
									if ($categoryPermissionsDetails != null) {
										foreach ($categoryPermissionsDetails as $permissionsDetailID) {
											//Get the permissionsDetailID of the Category
											echo ("Profile Section Category permissionsDetailID: " . $permissionsDetailID . "\n");
										}
									}

									//Get the Name of the each Category
									echo ("Profile Section Category Name: " . $category->getName() . "\n");
								} else if ($category instanceof CategoryModule) {
									// Get the DisplayLabel of the each Category
									echo ("Profile Section Category DisplayLabel: " . $category->getDisplayLabel() . "\n");

									//Get the permissionsDetails List of each Category
									$categoryPermissionsDetails = $category->getPermissionsDetails();

									//Check if categoryPermissionsDetails is not null
									if ($categoryPermissionsDetails != null) {
										foreach ($categoryPermissionsDetails as $permissionsDetailID) {
											//Get the permissionsDetailID of the Category
											echo ("Profile Section Category permissionsDetailID: " . $permissionsDetailID . "\n");
										}
									}

									// Get the Module of the each Category
									echo ("Profile Section Category Module: " . $category->getModule());

									// Get the Name of the each Category
									echo ("Profile Section Category Name: " . $category->getName());
								}
							}
						}
					}

					if ($profile->getDelete() != null) {
						//Get the Delete of the each Profile
						echo ("Profile Delete: " . $profile->getDelete() . "\n");
					}

					if ($profile->getDefault() != null) {
						//Get the Default of the each Profile
						echo ("Profile Default: " . $profile->getDefault() . "\n");
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

	public static function cloneProfiles(string $profileId)
	{
		$profilesOperations = new ProfilesOperations();

		$bodyWrapper = new ProfileWrapper();

		$profiles = array();

		$profileClass = "com\zoho\crm\api\profiles\Profile";

		$profile = new $profileClass();

		$profile->setName("Java Beta SDK");

		$profile->setDescription("V4 SDK");

		array_push($profiles, $profile);

		$bodyWrapper->setProfiles($profiles);

		$response = $profilesOperations->cloneProfiles($profileId, $bodyWrapper);

		if ($response != null) {
			// Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $actionWrapper->getProfiles();

				if ($actionResponses != null) {
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

							foreach ($successResponse->getDetails() as $key => $value) {
								//Get each value in the map
								echo ($key . ": " . $value . "\n");
							}

							// Get the Message
							echo ("Message: " . $successResponse->getMessage() . "\n");
						}
						// Check if the request returned an exception
						else if ($actionResponse instanceof APIException) {
							// Get the received APIException instance
							$exception = $actionResponse;

							// Get the Status
							echo ("Status: " . $exception->getStatus()->getValue() . "\n");

							// Get the Code
							echo ("Code: " . $exception->getCode()->getValue() . "\n");

							echo ("Details: ");

							foreach ($exception->getDetails() as $key => $value) {
								//Get each value in the map
								echo ($key . ": " . $value . "\n");
							}

							// Get the Message
							echo ("Message: " . $exception->getMessage() . "\n");
						}
					}
				}
				// Check if the request returned an exception
				else if ($actionHandler instanceof APIException) {
					// Get the received APIException instance
					$exception = $actionHandler;

					// Get the Status
					echo ("Status: " . $exception->getStatus()->getValue());

					// Get the Code
					echo ("Code: " . $exception->getCode()->getValue());

					echo ("Details: ");

					foreach ($exception->getDetails() as $key => $value) {
						//Get each value in the map
						echo ($key . ": " . $value . "\n");
					}

					// Get the Message
					echo ("Message: " . $exception->getMessage());
				}
			}
		}
	}

	public static function updateProfile(string $profileId)
	{
		$profilesOperations = new ProfilesOperations();

		$bodyWrapper = new ProfileWrapper();

		$profiles = array();

		$profileClass = "com\zoho\crm\api\profiles\Profile";

		$profile = new $profileClass();

		$profile->setName("Java SDK");

		$profile->setDescription("V4 API SDK");

		array_push($profiles, $profile);

		$bodyWrapper->setProfiles($profiles);

		$response = $profilesOperations->updateProfile($profileId, $bodyWrapper);

		if ($response != null) {
			// Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof ActionWrapper) {
				// Get the received ActionWrapper instance
				$actionWrapper = $actionHandler;

				// Get the list of obtained ActionResponse instances
				$actionResponses = $actionWrapper->getProfiles();

				if ($actionResponses != null) {
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

							foreach ($successResponse->getDetails() as $key => $value) {
								//Get each value in the map
								echo ($key . ": " . $value . "\n");
							}

							// Get the Message
							echo ("Message: " . $successResponse->getMessage() . "\n");
						}
						// Check if the request returned an exception
						else if ($actionResponse instanceof APIException) {
							// Get the received APIException instance
							$exception = $actionResponse;

							// Get the Status
							echo ("Status: " . $exception->getStatus()->getValue() . "\n");

							// Get the Code
							echo ("Code: " . $exception->getCode()->getValue() . "\n");

							echo ("Details: ");

							foreach ($exception->getDetails() as $key => $value) {
								//Get each value in the map
								echo ($key . ": " . $value . "\n");
							}

							// Get the Message
							echo ("Message: " . $exception->getMessage() . "\n");
						}
					}
				}
				// Check if the request returned an exception
				else if ($actionHandler instanceof APIException) {
					// Get the received APIException instance
					$exception = $actionHandler;

					// Get the Status
					echo ("Status: " . $exception->getStatus()->getValue());

					// Get the Code
					echo ("Code: " . $exception->getCode()->getValue());

					echo ("Details: ");

					foreach ($exception->getDetails() as $key => $value) {
						//Get each value in the map
						echo ($key . ": " . $value . "\n");
					}

					// Get the Message
					echo ("Message: " . $exception->getMessage());
				}
			}
		}
	}

	public static function deleteProfile(string $profileId, string $existingprofileid)
	{
		$profilesOperations = new ProfilesOperations();

		$paramInstance = new ParameterMap();

		$paramInstance->add(DeleteProfileParam::transferTo(), $existingprofileid);

		$response = $profilesOperations->deleteProfile($profileId, $paramInstance);

		if ($response != null) {
			// Get the status code from response
			echo ("Status code " . $response->getStatusCode() . "\n");

			// Get object from response
			$actionHandler = $response->getObject();

			if ($actionHandler instanceof SuccessResponse) {
				// Get the received SuccessResponse instance
				$successResponse = $actionHandler;

				// Get the Status
				echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");

				// Get the Code
				echo ("Code: " . $successResponse->getCode()->getValue() . "\n");

				echo ("Details: ");

				foreach ($successResponse->getDetails() as $key => $value) {
					//Get each value in the map
					echo ($key . ": " . $value . "\n");
				}

				// Get the Message
				echo ("Message: " . $successResponse->getMessage() . "\n");
			}
			// Check if the request returned an exception
			else if ($actionHandler instanceof APIException) {
				// Get the received APIException instance
				$exception = $actionHandler;

				// Get the Status
				echo ("Status: " . $exception->getStatus()->getValue() . "\n");

				// Get the Code
				echo ("Code: " . $exception->getCode()->getValue() . "\n");

				echo ("Details: ");

				foreach ($exception->getDetails() as $key => $value) {
					//Get each value in the map
					echo ($key . ": " . $value . "\n");
				}

				// Get the Message
				echo ("Message: " . $exception->getMessage() . "\n");
			}
		}
	}
}
