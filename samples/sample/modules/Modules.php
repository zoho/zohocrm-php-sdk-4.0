<?php

namespace com\zoho\crm\sample\modules;

use com\zoho\crm\api\HeaderMap;
use com\zoho\crm\api\modules\APIException;
use com\zoho\crm\api\modules\ActionWrapper;
use com\zoho\crm\api\modules\BodyWrapper;
use com\zoho\crm\api\modules\ModulesOperations;
use com\zoho\crm\api\modules\ResponseWrapper;
use com\zoho\crm\api\modules\SuccessResponse;
use com\zoho\crm\api\modules\GetModulesHeader;
use com\zoho\crm\api\modules\SingleCriteria;
use com\zoho\crm\api\modules\GroupCriteria;
use com\zoho\crm\api\profiles\Profile;
use com\zoho\crm\api\modules\ModuleMeta;
use com\zoho\crm\api\modules\SingleResponseWrapper;

class Modules
{
    /**
     * <h3> Get Modules </h3>
     * This method is used to get metadata about all the modules and print the response.
     * @throws Exception
     */
    public static function getModules()
    {
        //Get instance of ModulesOperations Class
        $moduleOperations = new ModulesOperations();

        $headerInstance = new HeaderMap();

        $datetime = date_create("2022-12-15T17:58:47+05:30")->setTimezone(new \DateTimeZone(date_default_timezone_get()));

        $headerInstance->add(GetModulesHeader::IfModifiedSince(), $datetime);

        //Call getModules method that takes headerInstance as parameters
        $response = $moduleOperations->getModules($headerInstance);

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

                //Get the list of obtained Module instances
                $modules = $responseWrapper->getModules();

                foreach ($modules as $module) {
                    //Get the GlobalSearchSupported of each Module
                    echo ("Module GlobalSearchSupported: ");
                    print_r($module->getGlobalSearchSupported());
                    echo ("\n");

                    //Get the Deletable of each Module
                    echo ("Module Deletable: ");
                    print_r($module->getDeletable());
                    echo ("\n");

                    //Get the Description of each Module
                    echo ("Module Description: " . $module->getDescription() . "\n");

                    //Get the Creatable of each Module
                    echo ("Module Creatable: ");
                    print_r($module->getCreatable());
                    echo ("\n");

                    //Get the InventoryTemplateSupported of each Module
                    echo ("Module InventoryTemplateSupported: ");
                    print_r($module->getInventoryTemplateSupported());
                    echo ("\n");

                    //Get the ModifiedTime of each Module
                    echo ("Module ModifiedTime: ");
                    print_r($module->getModifiedTime());
                    echo ("\n");

                    //Get the PluralLabel of each Module
                    echo ("Module PluralLabel: " . $module->getPluralLabel() . "\n");

                    //Get the PresenceSubMenu of each Module
                    echo ("Module PresenceSubMenu: ");
                    print_r($module->getPresenceSubMenu());
                    echo ("\n");

                    //Get the TriggersSupported of each Module
                    echo ("Module TriggersSupported: ");
                    print_r($module->getTriggersSupported());
                    echo ("\n");

                    //Get the Id of each Module
                    echo ("Module Id: " . $module->getId() . "\n");

                    //Get the IsBlueprintSupported of each Module
                    echo ("Module IsBlueprintSupported: ");
                    print_r($module->getIsblueprintsupported());
                    echo ("\n");

                    //Get the Visible of each Module
                    echo ("Module Visible: ");
                    print_r($module->getVisible());
                    echo ("\n");

                    //Get the Visibility of each Module
                    echo ("Module Visibility: " . $module->getVisibility() . "\n");

                    //Get the Convertable of each Module
                    echo ("Module Convertable: ");
                    print_r($module->getConvertable());
                    echo ("\n");

                    //Get the Editable of each Module
                    echo ("Module Editable: ");
                    print_r($module->getEditable());
                    echo ("\n");

                    //Get the EmailtemplateSupport of each Module
                    echo ("Module EmailtemplateSupport: ");
                    print_r($module->getEmailtemplateSupport());
                    echo ("\n");

                    //Get the list of Profile instance each Module
                    $profiles = $module->getProfiles();

                    //Check if profiles is not null
                    if ($profiles != null) {
                        foreach ($profiles as $profile) {
                            //Get the Name of each Profile
                            echo ("Module Profile Name: " . $profile->getName() . "\n");

                            //Get the Id of each Profile
                            echo ("Module Profile Id: " . $profile->getId() . "\n");
                        }
                    }

                    //Get the FilterSupported of each Module
                    echo ("Module FilterSupported: ");
                    print_r($module->getFilterSupported());
                    echo ("\n");

                    //Get the ShowAsTab of each Module
                    echo ("Module ShowAsTab: ");
                    print_r($module->getShowAsTab());
                    echo ("\n");

                    //Get the WebLink of each Module
                    echo ("Module WebLink: " . $module->getWebLink() . "\n");

                    //Get the SequenceNumber of each Module
                    echo ("Module SequenceNumber: " . $module->getSequenceNumber() . "\n");

                    //Get the SingularLabel of each Module
                    echo ("Module SingularLabel: " . $module->getSingularLabel() . "\n");

                    //Get the Viewable of each Module
                    echo ("Module Viewable: ");
                    print_r($module->getViewable());
                    echo ("\n");

                    //Get the APISupported of each Module
                    echo ("Module APISupported: ");
                    print_r($module->getAPISupported());
                    echo ("\n");

                    //Get the APIName of each Module
                    echo ("Module APIName: " . $module->getAPIName() . "\n");

                    //Get the QuickCreate of each Module
                    echo ("Module QuickCreate: ");
                    print_r($module->getQuickCreate());
                    echo ("\n");

                    //Get the modifiedBy User instance of each Module
                    $modifiedBy = $module->getModifiedBy();

                    //Check if modifiedBy is not null
                    if ($modifiedBy != null) {
                        //Get the name of the modifiedBy User
                        echo ("Module Modified By User-Name: " . $modifiedBy->getName() . "\n");

                        //Get the ID of the modifiedBy User
                        echo ("Module Modified By User-ID: " . $modifiedBy->getId() . "\n");
                    }

                    //Get the GeneratedType of each Module
                    echo ("Module GeneratedType: " . $module->getGeneratedType()->getValue() . "\n");

                    //Get the FeedsRequired of each Module
                    echo ("Module FeedsRequired: ");
                    print_r($module->getFeedsRequired());
                    echo ("\n");

                    //Get the ScoringSupported of each Module
                    echo ("Module ScoringSupported: ");
                    print_r($module->getScoringSupported());
                    echo ("\n");

                    //Get the WebformSupported of each Module
                    echo ("Module WebformSupported: ");
                    print_r($module->getWebformSupported());
                    echo ("\n");

                    //Get the list of Argument instance each Module
                    $arguments = $module->getArguments();

                    //Check if arguments is not null
                    if ($arguments != null) {
                        foreach ($arguments as $argument) {
                            //Get the Name of each Argument
                            echo ("Module Argument Name: " . $argument->getName() . "\n");

                            //Get the Value of each Argument
                            echo ("Module Argument Value: " . $argument->getValue() . "\n");
                        }
                    }

                    //Get the ModuleName of each Module
                    echo ("Module ModuleName: " . $module->getModuleName() . "\n");

                    //Get the BusinessCardFieldLimit of each Module
                    echo ("Module BusinessCardFieldLimit: " . $module->getBusinessCardFieldLimit() . "\n");

                    //Get the parentModule Module instance of each Module
                    $parentModule = $module->getParentModule();

                    //Check if arguments is not null
                    if ($parentModule != null && $parentModule->getAPIName() != null) {
                        //Get the Name of Parent Module
                        echo ("Module Parent Module Name: " . $parentModule->getAPIName() . "\n");

                        //Get the Value of Parent Module
                        echo ("Module Parent Module Id: " . $parentModule->getId() . "\n");
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
     * <h3> Get Module </h3>
     * This method is used to get metadata about single module with it's API Name and print the response.
     * @param apiName The API Name of the module to obtain metadata
     * @throws Exception
     */
    public static function getModuleByAPIName(string $moduleAPIName)
    {
        //example, moduleAPIName = "module_api_name";

        //Get instance of ModulesOperations Class
        $moduleOperations = new ModulesOperations();

        //Call getModule method that takes moduleAPIName as parameter
        $response = $moduleOperations->getModule($moduleAPIName);

        if ($response != null) {
            //Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

                return;
            }

            //Get object from response
            $responseHandler = $response->getObject();

            if ($responseHandler instanceof SingleResponseWrapper) {
                //Get the received ResponseWrapper instance
                $responseWrapper = $responseHandler;

                //Get the list of obtained Module instances
                $modules = $responseWrapper->getModules();

                foreach ($modules as $module) {
                    //Get the GlobalSearchSupported of each Module
                    echo ("Module GlobalSearchSupported: " . $module->getGlobalSearchSupported() . "\n");

                    //Get the KanbanView of each Module
                    echo ("Module KanbanView: " . $module->getKanbanView() . "\n");

                    //Get the Deletable of each Module
                    echo ("Module Deletable: " . $module->getDeletable() . "\n");

                    //Get the Description of each Module
                    echo ("Module Description: " . $module->getDescription() . "\n");

                    //Get the Creatable of each Module
                    echo ("Module Creatable: " . $module->getCreatable() . "\n");

                    //Get the FilterStatus of each Module
                    echo ("Module FilterStatus: " . $module->getFilterStatus() . "\n");

                    //Get the InventoryTemplateSupported of each Module
                    echo ("Module InventoryTemplateSupported: " . $module->getInventoryTemplateSupported() . "\n");

                    if ($module->getModifiedTime() != null) {
                        //Get the ModifiedTime of each Module
                        echo ("Module ModifiedTime: ");

                        print_r($module->getModifiedTime());

                        echo ("\n");
                    }

                    //Get the PluralLabel of each Module
                    echo ("Module PluralLabel: " . $module->getPluralLabel() . "\n");

                    //Get the PresenceSubMenu of each Module
                    echo ("Module PresenceSubMenu: " . $module->getPresenceSubMenu() . "\n");

                    //Get the TriggersSupported of each Module
                    echo ("Module TriggersSupported: " . $module->getTriggersSupported() . "\n");

                    //Get the Id of each Module
                    echo ("Module Id: " . $module->getId() . "\n");

                    echo ("Module IsBlueprintSupported: " . $module->getIsblueprintsupported() . "\n");

                    //Get the RelatedListProperties instance of each Module
                    $relatedListProperties = $module->getRelatedListProperties();

                    //Check if relatedListProperties is not null
                    if ($relatedListProperties != null) {
                        //Get the SortBy of each RelatedListProperties
                        echo ("Module RelatedListProperties SortBy: " . $relatedListProperties->getSortBy() . "\n");

                        //Get List of fields APIName
                        $fields = $relatedListProperties->getFields();

                        //Check if fields is not null
                        if ($fields != null) {
                            foreach ($fields as $fieldName) {
                                //Get the Field Name
                                echo ("Module RelatedListProperties Fields: " . $fieldName . "\n");
                            }
                        }

                        //Get the Name of RelatedListProperties
                        echo ("Module RelatedListProperties SortOrder: " . $relatedListProperties->getSortOrder() . "\n");
                    }

                    echo ("Module PerPage: " . $module->getPerPage() . "\n");

                    //Get List of properties field APIName
                    $properties = $module->getProperties();

                    //Check if properties is not null
                    if ($properties != null) {
                        foreach ($properties  as $fieldName) {
                            //Get the Field Name
                            echo ("Module Properties Fields: " . $fieldName . "\n");
                        }
                    }

                    echo ("Module Visible: " . $module->getVisible() . "\n");

                    //Get the Visibility of each Module
                    echo ("Module Visibility: " . $module->getVisibility() . "\n");

                    //Get the Convertable of each Module
                    echo ("Module Convertable: " . $module->getConvertable() . "\n");

                    //Get the Editable of each Module
                    echo ("Module Editable: " . $module->getEditable() . "\n");

                    //Get the EmailtemplateSupport of each Module
                    echo ("Module EmailtemplateSupport: " . $module->getEmailtemplateSupport() . "\n");

                    //Get the list of Profile instance each Module
                    $profiles = $module->getProfiles();

                    //Check if profiles is not null
                    if ($profiles != null) {
                        foreach ($profiles as $profile) {
                            //Get the Name of each Profile
                            echo ("Module Profile Name: " . $profile->getName() . "\n");

                            //Get the Id of each Profile
                            echo ("Module Profile Id: " . $profile->getId() . "\n");
                        }
                    }

                    //Get the FilterSupported of each Module
                    echo ("Module FilterSupported: " . $module->getFilterSupported() . "\n");

                    //Get List of properties field APIName
                    $onDemandProperties = $module->getOnDemandProperties();

                    if ($onDemandProperties != null) {
                        foreach ($onDemandProperties as $fieldName) {
                            //Get the Field Name
                            echo ("Module onDemandProperties Fields: " . $fieldName);
                        }
                    }

                    //Get the DisplayField of each Module
                    echo ("Module DisplayField: " . $module->getDisplayField() . "\n");

                    //Get List of SearchLayoutFields APIName
                    $searchLayoutFields = $module->getSearchLayoutFields();

                    //Check if searchLayoutFields is not null
                    if ($searchLayoutFields != null) {
                        foreach ($searchLayoutFields as $fieldName) {
                            //Get the Field Name
                            echo ("Module SearchLayoutFields Fields: " . $fieldName . "\n");
                        }
                    }

                    //Get the KanbanViewSupported of each Module
                    echo ("Module KanbanViewSupported: " . $module->getKanbanViewSupported() . "\n");

                    //Get the ShowAsTab of each Module
                    echo ("Module ShowAsTab: " . $module->getShowAsTab() . "\n");

                    //Get the WebLink of each Module
                    echo ("Module WebLink: " . $module->getWebLink() . "\n");

                    //Get the SequenceNumber of each Module
                    echo ("Module SequenceNumber: " . $module->getSequenceNumber() . "\n");

                    //Get the SingularLabel of each Module
                    echo ("Module SingularLabel: " . $module->getSingularLabel() . "\n");

                    //Get the Viewable of each Module
                    echo ("Module Viewable: " . $module->getViewable() . "\n");

                    //Get the APISupported of each Module
                    echo ("Module APISupported: " . $module->getAPISupported() . "\n");

                    //Get the APIName of each Module
                    echo ("Module APIName: " . $module->getAPIName() . "\n");

                    //Get the QuickCreate of each Module
                    echo ("Module QuickCreate: " . $module->getQuickCreate() . "\n");

                    //Get the modifiedBy User instance of each Module
                    $modifiedBy = $module->getModifiedBy();

                    //Check if modifiedBy is not null
                    if ($modifiedBy != null) {
                        //Get the name of the modifiedBy User
                        echo ("Module Modified By User-Name: " . $modifiedBy->getName() . "\n");

                        //Get the ID of the modifiedBy User
                        echo ("Module Modified By User-ID: " . $modifiedBy->getId() . "\n");
                    }

                    //Get the GeneratedType of each Module
                    echo ("Module GeneratedType: " . $module->getGeneratedType()->getValue() . "\n");

                    //Get the FeedsRequired of each Module
                    echo ("Module FeedsRequired: " . $module->getFeedsRequired() . "\n");

                    //Get the ScoringSupported of each Module
                    echo ("Module ScoringSupported: " . $module->getScoringSupported() . "\n");

                    //Get the WebformSupported of each Module
                    echo ("Module WebformSupported: " . $module->getWebformSupported() . "\n");

                    //Get the list of Argument instance each Module
                    $arguments = $module->getArguments();

                    //Check if arguments is not null
                    if ($arguments != null) {
                        foreach ($arguments as $argument) {
                            //Get the Name of each Argument
                            echo ("Module Argument Name: " . $argument->getName() . "\n");

                            //Get the Value of each Argument
                            echo ("Module Argument Value: " . $argument->getValue() . "\n");
                        }
                    }

                    //Get the ModuleName of each Module
                    echo ("Module ModuleName: " . $module->getModuleName() . "\n");

                    //Get the BusinessCardFieldLimit of each Module
                    echo ("Module BusinessCardFieldLimit: " . $module->getBusinessCardFieldLimit() . "\n");

                    //Get the CustomView instance of each Module
                    $customView = $module->getCustomView();

                    //Check if customView is not null
                    if ($customView != null) {
                        self::printCustomView($customView);
                    }

                    //Get the parentModule Module instance of each Module
                    $parentModule = $module->getParentModule();

                    //Check if arguments is not null
                    if ($parentModule != null && $parentModule->getAPIName() != null) {
                        //Get the Name of Parent Module
                        echo ("Module Parent Module Name: " . $parentModule->getAPIName() . "\n");

                        //Get the Value of Parent Module
                        echo ("Module Parent Module Id: " . $parentModule->getId() . "\n");
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

                if ($exception->getDetails() != null) {
                    echo ("Details: ");

                    //Get the details map4
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

    private static function printCustomView($customView)
    {
        //Get the DisplayValue of the CustomView
        echo ("Module CustomView DisplayValue: " . $customView->getDisplayValue() . "\n");

        echo ("Module CustomView CreatedTime: ");
        print_r($customView->getCreatedTime());
        echo ("\n");

        if ($customView->getAccessType() != null) {
            //Get the AccessType of the CustomView
            echo ("Module CustomView AccessType: " . $customView->getAccessType()->getValue() . "\n");
        }

        // Get the Criteria instance of the CustomView
        $criteria = $customView->getCriteria();

        //Check if criteria is not null
        if ($criteria != null) {
            self::printCriteria($criteria);
        }

        //Get the SystemName of the CustomView
        echo ("Module CustomView SystemName: " . $customView->getSystemName() . "\n");

        //Get the SortBy of the CustomView
        echo ("Module CustomView SortBy: " . $customView->getSortBy() . "\n");

        //Get the CreatedBy User instance of each Module
        $createdBy = $customView->getCreatedBy();

        //Check if createdBy is not null
        if ($createdBy != null) {
            //Get the name of the createdBy User
            echo ("Module Created By User-Name: " . $createdBy->getName());

            //Get the ID of the createdBy User
            echo ("Module Created By User-ID: " . $createdBy->getId());
        }

        $sharedToDetails = $customView->getSharedTo();

        if ($sharedToDetails != null) {
            foreach ($sharedToDetails as $sharedTo) {
                //Get the Name of the each sharedTo
                echo ("SharedDetails Name: " . $sharedTo->getName());

                //Get the ID of the each sharedTo
                echo ("SharedDetails ID: " . $sharedTo->getId());

                //Get the Type of the each sharedTo
                echo ("SharedDetails Type: " . $sharedTo->getType());

                //Get the Subordinates of the each sharedTo
                echo ("SharedDetails Subordinates: " . $sharedTo->getSubordinates());
            }
        }

        //Get the Default of the CustomView
        echo ("Module CustomView Default: " . $customView->getDefault() . "\n");

        echo ("Module CustomView ModifiedTime: ");
        print_r($customView->getModifiedTime());
        echo ("\n");

        //Get the Name of the CustomView
        echo ("Module CustomView Name: " . $customView->getName() . "\n");

        //Get the SystemDefined of the CustomView
        echo ("Module CustomView SystemDefined: " . $customView->getSystemDefined() . "\n");

        //Get the modifiedBy User instance of each Module
        $modifiedBy = $customView->getModifiedBy();

        //Check if modifiedBy is not null
        if ($modifiedBy != null) {
            //Get the name of the modifiedBy User
            echo ("Module CustomView Modified By User-Name: " . $modifiedBy->getName() . "\n");

            //Get the ID of the modifiedBy User
            echo ("Module CustomView Modified By User-ID: " . $modifiedBy->getId() . "\n");
        }

        //Get the ID of the CustomView
        echo ("Module CustomView ID: " . $customView->getId() . "\n");

        //Get the list of string
        $fields = $customView->getFields();

        if ($fields != null) {
            foreach ($fields as $field) {
                //Get the APIName of the CustomView Field
                echo ("Module CustomView Field APIName: " . $field->getAPIName() . "\n");

                //Get the ID of the CustomView Field
                echo ("Module CustomView Field ID: " . $field->getId() . "\n");
            }
        }

        //Get the Category of the CustomView
        echo ("Module CustomView Category: " . $customView->getCategory() . "\n");

        echo ("Module CustomView LastAccessedTime: ");
        print_r($customView->getLastAccessedTime());
        echo ("\n");

        if ($customView->getFavorite() != null) {
            //Get the Favorite of the CustomView
            echo ("Module CustomView Favorite: " . $customView->getFavorite() . "\n");
        }

        if ($customView->getSortOrder() != null) {
            //Get the SortOrder of the CustomView
            echo ("Module CustomView SortOrder: " . $customView->getSortOrder() . "\n");
        }
    }

    private static function printCriteria($criteria)
    {
        if ($criteria instanceof SingleCriteria) {
            if ($criteria->getComparator() != null) {
                //Get the Comparator of the Criteria
                echo ("CustomView Criteria Comparator: " . $criteria->getComparator() . "\n");
            }

            //Get the Field of the Criteria
            $field = $criteria->getField();

            if ($field != null) {
                echo ("CustomView Criteria Field: " . $field->getAPIName() . "\n");

                echo ("CustomView Criteria Field: " . $field->getId() . "\n");
            }

            //Get the Value of the Criteria
            echo ("CustomView Criteria Value: ");
            print_r($criteria->getValue());
            echo ("\n");
        } else if ($criteria instanceof GroupCriteria) {
            // Get the List of Criteria instance of each Criteria
            $criteriaGroup = $criteria->getGroup();

            if ($criteriaGroup != null) {
                foreach ($criteriaGroup as $criteria1) {
                    self::printCriteria($criteria1);
                }
            }

            if ($criteria->getGroupOperator() != null) {
                // Get the Group Operator of the Criteria
                echo ("CustomView Criteria Group Operator: " . $criteria->getGroupOperator() . "\n");
            }
        }
    }

    /**
     * <h3> Update Module By APIName </h3>
     * This method is used to update module details using module APIName and print the response.
     * @param moduleAPIName The API Name of the module to obtain metadata
     * @throws Exception
     */
    public static function updateModuleByAPIName(string $moduleAPIName)
    {
        //example, apiName = "module_api_name";

        //Get instance of ModulesOperations Class
        $moduleOperations = new ModulesOperations();

        $modules = array();

        $profiles = array();

        //Get instance of Profile Class
        $profile = new Profile();

        //To set the Profile Id
        $profile->setId("34770610026014");

        $profile->setDelete(true);

        array_push($profiles, $profile);

        $module = new ModuleMeta();

        $module->setProfiles($profiles);

        array_push($modules, $module);

        $request = new BodyWrapper();

        $request->setModules($modules);

        //Call updateModuleByAPIName method that takes BodyWrapper instance and moduleAPIName as parameter
        $response = $moduleOperations->updateModuleByAPIName($moduleAPIName, $request);

        if ($response != null) {
            //Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            //Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                //Get the received ActionWrapper instance
                $actionWrapper = $actionHandler;

                //Get the list of obtained ActionResponse instances
                $actionResponses = $actionWrapper->getModules();

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

    public static function getModuleById(string $moduleId)
    {
        //example, $moduleId = "0";

        //Get instance of ModulesOperations Class
        $moduleOperations = new ModulesOperations();

        $response = $moduleOperations->getModule($moduleId);

        if ($response != null) {
            //Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");

                return;
            }

            //Get object from response
            $responseHandler = $response->getObject();

            if ($responseHandler instanceof SingleResponseWrapper) {
                //Get the received ResponseWrapper instance
                $responseWrapper = $responseHandler;

                //Get the list of obtained Module instances
                $modules = $responseWrapper->getModules();

                foreach ($modules as $module) {
                    //Get the GlobalSearchSupported of each Module
                    echo ("Module GlobalSearchSupported: " . $module->getGlobalSearchSupported() . "\n");

                    //Get the KanbanView of each Module
                    echo ("Module KanbanView: " . $module->getKanbanView() . "\n");

                    //Get the Deletable of each Module
                    echo ("Module Deletable: " . $module->getDeletable() . "\n");

                    //Get the Description of each Module
                    echo ("Module Description: " . $module->getDescription() . "\n");

                    //Get the Creatable of each Module
                    echo ("Module Creatable: " . $module->getCreatable() . "\n");

                    //Get the FilterStatus of each Module
                    echo ("Module FilterStatus: " . $module->getFilterStatus() . "\n");

                    //Get the InventoryTemplateSupported of each Module
                    echo ("Module InventoryTemplateSupported: " . $module->getInventoryTemplateSupported() . "\n");

                    if ($module->getModifiedTime() != null) {
                        //Get the ModifiedTime of each Module
                        echo ("Module ModifiedTime: ");

                        print_r($module->getModifiedTime());

                        echo ("\n");
                    }

                    //Get the PluralLabel of each Module
                    echo ("Module PluralLabel: " . $module->getPluralLabel() . "\n");

                    //Get the PresenceSubMenu of each Module
                    echo ("Module PresenceSubMenu: " . $module->getPresenceSubMenu() . "\n");

                    //Get the TriggersSupported of each Module
                    echo ("Module TriggersSupported: " . $module->getTriggersSupported() . "\n");

                    //Get the Id of each Module
                    echo ("Module Id: " . $module->getId() . "\n");

                    echo ("Module IsBlueprintSupported: " . $module->getIsblueprintsupported() . "\n");

                    //Get the RelatedListProperties instance of each Module
                    $relatedListProperties = $module->getRelatedListProperties();

                    //Check if relatedListProperties is not null
                    if ($relatedListProperties != null) {
                        //Get the SortBy of each RelatedListProperties
                        echo ("Module RelatedListProperties SortBy: " . $relatedListProperties->getSortBy() . "\n");

                        //Get List of fields APIName
                        $fields = $relatedListProperties->getFields();

                        //Check if fields is not null
                        if ($fields != null) {
                            foreach ($fields as $fieldName) {
                                //Get the Field Name
                                echo ("Module RelatedListProperties Fields: " . $fieldName . "\n");
                            }
                        }

                        //Get the Name of RelatedListProperties
                        echo ("Module RelatedListProperties SortOrder: " . $relatedListProperties->getSortOrder() . "\n");
                    }

                    echo ("Module PerPage: " . $module->getPerPage() . "\n");

                    //Get List of properties field APIName
                    $properties = $module->getProperties();

                    //Check if properties is not null
                    if ($properties != null) {
                        foreach ($properties  as $fieldName) {
                            //Get the Field Name
                            echo ("Module Properties Fields: " . $fieldName . "\n");
                        }
                    }

                    echo ("Module Visible: " . $module->getVisible() . "\n");

                    //Get the Visibility of each Module
                    echo ("Module Visibility: " . $module->getVisibility() . "\n");

                    //Get the Convertable of each Module
                    echo ("Module Convertable: " . $module->getConvertable() . "\n");

                    //Get the Editable of each Module
                    echo ("Module Editable: " . $module->getEditable() . "\n");

                    //Get the EmailtemplateSupport of each Module
                    echo ("Module EmailtemplateSupport: " . $module->getEmailtemplateSupport() . "\n");

                    //Get the list of Profile instance each Module
                    $profiles = $module->getProfiles();

                    //Check if profiles is not null
                    if ($profiles != null) {
                        foreach ($profiles as $profile) {
                            //Get the Name of each Profile
                            echo ("Module Profile Name: " . $profile->getName() . "\n");

                            //Get the Id of each Profile
                            echo ("Module Profile Id: " . $profile->getId() . "\n");
                        }
                    }

                    //Get the FilterSupported of each Module
                    echo ("Module FilterSupported: " . $module->getFilterSupported() . "\n");

                    //Get List of properties field APIName
                    $onDemandProperties = $module->getOnDemandProperties();

                    if ($onDemandProperties != null) {
                        foreach ($onDemandProperties as $fieldName) {
                            //Get the Field Name
                            echo ("Module onDemandProperties Fields: " . $fieldName);
                        }
                    }

                    //Get the DisplayField of each Module
                    echo ("Module DisplayField: " . $module->getDisplayField() . "\n");

                    //Get List of SearchLayoutFields APIName
                    $searchLayoutFields = $module->getSearchLayoutFields();

                    //Check if searchLayoutFields is not null
                    if ($searchLayoutFields != null) {
                        foreach ($searchLayoutFields as $fieldName) {
                            //Get the Field Name
                            echo ("Module SearchLayoutFields Fields: " . $fieldName . "\n");
                        }
                    }

                    //Get the KanbanViewSupported of each Module
                    echo ("Module KanbanViewSupported: " . $module->getKanbanViewSupported() . "\n");

                    //Get the ShowAsTab of each Module
                    echo ("Module ShowAsTab: " . $module->getShowAsTab() . "\n");

                    //Get the WebLink of each Module
                    echo ("Module WebLink: " . $module->getWebLink() . "\n");

                    //Get the SequenceNumber of each Module
                    echo ("Module SequenceNumber: " . $module->getSequenceNumber() . "\n");

                    //Get the SingularLabel of each Module
                    echo ("Module SingularLabel: " . $module->getSingularLabel() . "\n");

                    //Get the Viewable of each Module
                    echo ("Module Viewable: " . $module->getViewable() . "\n");

                    //Get the APISupported of each Module
                    echo ("Module APISupported: " . $module->getAPISupported() . "\n");

                    //Get the APIName of each Module
                    echo ("Module APIName: " . $module->getAPIName() . "\n");

                    //Get the QuickCreate of each Module
                    echo ("Module QuickCreate: " . $module->getQuickCreate() . "\n");

                    //Get the modifiedBy User instance of each Module
                    $modifiedBy = $module->getModifiedBy();

                    //Check if modifiedBy is not null
                    if ($modifiedBy != null) {
                        //Get the name of the modifiedBy User
                        echo ("Module Modified By User-Name: " . $modifiedBy->getName() . "\n");

                        //Get the ID of the modifiedBy User
                        echo ("Module Modified By User-ID: " . $modifiedBy->getId() . "\n");
                    }

                    //Get the GeneratedType of each Module
                    echo ("Module GeneratedType: " . $module->getGeneratedType()->getValue() . "\n");

                    //Get the FeedsRequired of each Module
                    echo ("Module FeedsRequired: " . $module->getFeedsRequired() . "\n");

                    //Get the ScoringSupported of each Module
                    echo ("Module ScoringSupported: " . $module->getScoringSupported() . "\n");

                    //Get the WebformSupported of each Module
                    echo ("Module WebformSupported: " . $module->getWebformSupported() . "\n");

                    //Get the list of Argument instance each Module
                    $arguments = $module->getArguments();

                    //Check if arguments is not null
                    if ($arguments != null) {
                        foreach ($arguments as $argument) {
                            //Get the Name of each Argument
                            echo ("Module Argument Name: " . $argument->getName() . "\n");

                            //Get the Value of each Argument
                            echo ("Module Argument Value: " . $argument->getValue() . "\n");
                        }
                    }

                    //Get the ModuleName of each Module
                    echo ("Module ModuleName: " . $module->getModuleName() . "\n");

                    //Get the BusinessCardFieldLimit of each Module
                    echo ("Module BusinessCardFieldLimit: " . $module->getBusinessCardFieldLimit() . "\n");

                    //Get the CustomView instance of each Module
                    $customView = $module->getCustomView();

                    //Check if customView is not null
                    if ($customView != null) {
                        self::printCustomView($customView);
                    }

                    //Get the parentModule Module instance of each Module
                    $parentModule = $module->getParentModule();

                    //Check if arguments is not null
                    if ($parentModule != null && $parentModule->getAPIName() != null) {
                        //Get the Name of Parent Module
                        echo ("Module Parent Module Name: " . $parentModule->getAPIName() . "\n");

                        //Get the Value of Parent Module
                        echo ("Module Parent Module Id: " . $parentModule->getId() . "\n");
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

                if ($exception->getDetails() != null) {
                    echo ("Details: ");

                    //Get the details map4
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

    /**
     * <h3> Update Module By Id </h3>
     * This method is used to update module details using module Id and print the response.
     * @param moduleID - The Id of the module to obtain metadata
     * @throws Exception
     */
    public static function updateModuleById(string $moduleId)
    {
        //example, moduleAPIName = "module_api_name";

        //Get instance of ModulesOperations Class
        $moduleOperations = new ModulesOperations();

        $modules = array();

        $profiles = array();

        //Get instance of Profile Class
        $profile = new Profile();

        $profile->setId("34770610026014");

        // $profile->setDelete(true);

        array_push($profiles, $profile);

        $module = new ModuleMeta();

        $module->setProfiles($profiles);

        $module->setAPIName("apiName2");

        array_push($modules, $module);

        $request = new BodyWrapper();

        $request->setModules($modules);

        //Call getModule method that takes BodyWrapper instance and moduleAPIName as parameter
        $response = $moduleOperations->updateModule($moduleId, $request);

        if ($response != null) {
            //Get the status code from response
            echo ("Status code " . $response->getStatusCode() . "\n");

            //Get object from response
            $actionHandler = $response->getObject();

            if ($actionHandler instanceof ActionWrapper) {
                //Get the received ActionWrapper instance
                $actionWrapper = $actionHandler;

                //Get the list of obtained action responses
                $actionResponses = $actionWrapper->getModules();

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
