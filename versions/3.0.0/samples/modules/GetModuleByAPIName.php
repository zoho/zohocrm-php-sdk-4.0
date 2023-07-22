<?php
namespace modules;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\modules\APIException;
use com\zoho\crm\api\modules\ModulesOperations;
use com\zoho\crm\api\modules\SingleCriteria;
use com\zoho\crm\api\modules\GroupCriteria;
use com\zoho\crm\api\modules\SingleResponseWrapper;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class GetModuleByAPIName
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
     * <h3> Get Module </h3>
     * This method is used to get metadata about single module with it's API Name and print the response.
     * @param apiName The API Name of the module to obtain metadata
     * @throws Exception
     */
    public static function getModuleByAPIName(string $moduleAPIName)
    {
        //example, moduleAPIName = "module_api_name";
        $moduleOperations = new ModulesOperations();
        //Call getModule method that takes moduleAPIName as parameter
        $response = $moduleOperations->getModule($moduleAPIName);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            $responseHandler = $response->getObject();
            if ($responseHandler instanceof SingleResponseWrapper) {
                $responseWrapper = $responseHandler;
                $modules = $responseWrapper->getModules();
                foreach ($modules as $module) {
                    echo ("Module GlobalSearchSupported: " . $module->getGlobalSearchSupported() . "\n");
                    echo ("Module KanbanView: " . $module->getKanbanView() . "\n");
                    echo ("Module Deletable: " . $module->getDeletable() . "\n");
                    echo ("Module Description: " . $module->getDescription() . "\n");
                    echo ("Module Creatable: " . $module->getCreatable() . "\n");
                    echo ("Module FilterStatus: " . $module->getFilterStatus() . "\n");
                    echo ("Module InventoryTemplateSupported: " . $module->getInventoryTemplateSupported() . "\n");
                    if ($module->getModifiedTime() != null) {
                        echo ("Module ModifiedTime: ");
                        print_r($module->getModifiedTime());
                        echo ("\n");
                    }
                    echo ("Module PluralLabel: " . $module->getPluralLabel() . "\n");
                    echo ("Module PresenceSubMenu: " . $module->getPresenceSubMenu() . "\n");
                    echo ("Module TriggersSupported: " . $module->getTriggersSupported() . "\n");
                    echo ("Module Id: " . $module->getId() . "\n");
                    echo ("Module IsBlueprintSupported: " . $module->getIsblueprintsupported() . "\n");
                    $relatedListProperties = $module->getRelatedListProperties();
                    if ($relatedListProperties != null) {
                        echo ("Module RelatedListProperties SortBy: " . $relatedListProperties->getSortBy() . "\n");
                        $fields = $relatedListProperties->getFields();
                        if ($fields != null) {
                            foreach ($fields as $fieldName) {
                                echo ("Module RelatedListProperties Fields: " . $fieldName . "\n");
                            }
                        }
                        echo ("Module RelatedListProperties SortOrder: " . $relatedListProperties->getSortOrder() . "\n");
                    }
                    echo ("Module PerPage: " . $module->getPerPage() . "\n");
                    $properties = $module->getProperties();
                    if ($properties != null) {
                        foreach ($properties  as $fieldName) {
                            echo ("Module Properties Fields: " . $fieldName . "\n");
                        }
                    }
                    echo ("Module Visible: " . $module->getVisible() . "\n");
                    echo ("Module Visibility: " . $module->getVisibility() . "\n");
                    echo ("Module Convertable: " . $module->getConvertable() . "\n");
                    echo ("Module Editable: " . $module->getEditable() . "\n");
                    echo ("Module EmailtemplateSupport: " . $module->getEmailtemplateSupport() . "\n");
                    $profiles = $module->getProfiles();
                    if ($profiles != null) {
                        foreach ($profiles as $profile) {
                            echo ("Module Profile Name: " . $profile->getName() . "\n");
                            echo ("Module Profile Id: " . $profile->getId() . "\n");
                        }
                    }
                    echo ("Module FilterSupported: " . $module->getFilterSupported() . "\n");
                    $onDemandProperties = $module->getOnDemandProperties();
                    if ($onDemandProperties != null) {
                        foreach ($onDemandProperties as $fieldName) {
                            echo ("Module onDemandProperties Fields: " . $fieldName);
                        }
                    }
                    echo ("Module DisplayField: " . $module->getDisplayField() . "\n");
                    $searchLayoutFields = $module->getSearchLayoutFields();
                    if ($searchLayoutFields != null) {
                        foreach ($searchLayoutFields as $fieldName) {
                            echo ("Module SearchLayoutFields Fields: " . $fieldName . "\n");
                        }
                    }
                    echo ("Module KanbanViewSupported: " . $module->getKanbanViewSupported() . "\n");
                    echo ("Module ShowAsTab: " . $module->getShowAsTab() . "\n");
                    echo ("Module WebLink: " . $module->getWebLink() . "\n");
                    echo ("Module SequenceNumber: " . $module->getSequenceNumber() . "\n");
                    echo ("Module SingularLabel: " . $module->getSingularLabel() . "\n");
                    echo ("Module Viewable: " . $module->getViewable() . "\n");
                    echo ("Module APISupported: " . $module->getAPISupported() . "\n");
                    echo ("Module APIName: " . $module->getAPIName() . "\n");
                    echo ("Module QuickCreate: " . $module->getQuickCreate() . "\n");
                    $modifiedBy = $module->getModifiedBy();
                    if ($modifiedBy != null) {
                        echo ("Module Modified By User-Name: " . $modifiedBy->getName() . "\n");
                        echo ("Module Modified By User-ID: " . $modifiedBy->getId() . "\n");
                    }
                    echo ("Module GeneratedType: " . $module->getGeneratedType()->getValue() . "\n");
                    echo ("Module FeedsRequired: " . $module->getFeedsRequired() . "\n");
                    echo ("Module ScoringSupported: " . $module->getScoringSupported() . "\n");
                    echo ("Module WebformSupported: " . $module->getWebformSupported() . "\n");
                    $arguments = $module->getArguments();
                    if ($arguments != null) {
                        foreach ($arguments as $argument) {
                            echo ("Module Argument Name: " . $argument->getName() . "\n");
                            echo ("Module Argument Value: " . $argument->getValue() . "\n");
                        }
                    }
                    echo ("Module ModuleName: " . $module->getModuleName() . "\n");
                    echo ("Module BusinessCardFieldLimit: " . $module->getBusinessCardFieldLimit() . "\n");
                    $customView = $module->getCustomView();
                    if ($customView != null) {
                        self::printCustomView($customView);
                    }
                    $parentModule = $module->getParentModule();
                    if ($parentModule != null && $parentModule->getAPIName() != null) {
                        echo ("Module Parent Module Name: " . $parentModule->getAPIName() . "\n");
                        echo ("Module Parent Module Id: " . $parentModule->getId() . "\n");
                    }
                }
            }
            else if ($responseHandler instanceof APIException) {
                $exception = $responseHandler;
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
    private static function printCustomView($customView)
    {
        echo ("Module CustomView DisplayValue: " . $customView->getDisplayValue() . "\n");
        echo ("Module CustomView CreatedTime: ");
        print_r($customView->getCreatedTime());
        echo ("\n");
        if ($customView->getAccessType() != null) {
            echo ("Module CustomView AccessType: " . $customView->getAccessType()->getValue() . "\n");
        }
        $criteria = $customView->getCriteria();
        if ($criteria != null) {
            self::printCriteria($criteria);
        }
        echo ("Module CustomView SystemName: " . $customView->getSystemName() . "\n");
        echo ("Module CustomView SortBy: " . $customView->getSortBy() . "\n");
        $createdBy = $customView->getCreatedBy();
        if ($createdBy != null) {
            echo ("Module Created By User-Name: " . $createdBy->getName());
            echo ("Module Created By User-ID: " . $createdBy->getId());
        }
        $sharedToDetails = $customView->getSharedTo();
        if ($sharedToDetails != null) {
            foreach ($sharedToDetails as $sharedTo) {
                echo ("SharedDetails Name: " . $sharedTo->getName());
                echo ("SharedDetails ID: " . $sharedTo->getId());
                echo ("SharedDetails Type: " . $sharedTo->getType());
                echo ("SharedDetails Subordinates: " . $sharedTo->getSubordinates());
            }
        }
        echo ("Module CustomView Default: " . $customView->getDefault() . "\n");
        echo ("Module CustomView ModifiedTime: ");
        print_r($customView->getModifiedTime());
        echo ("\n");
        echo ("Module CustomView Name: " . $customView->getName() . "\n");
        echo ("Module CustomView SystemDefined: " . $customView->getSystemDefined() . "\n");
        $modifiedBy = $customView->getModifiedBy();
        if ($modifiedBy != null) {
            echo ("Module CustomView Modified By User-Name: " . $modifiedBy->getName() . "\n");
            echo ("Module CustomView Modified By User-ID: " . $modifiedBy->getId() . "\n");
        }
        echo ("Module CustomView ID: " . $customView->getId() . "\n");
        $fields = $customView->getFields();
        if ($fields != null) {
            foreach ($fields as $field) {
                echo ("Module CustomView Field APIName: " . $field->getAPIName() . "\n");
                echo ("Module CustomView Field ID: " . $field->getId() . "\n");
            }
        }
        echo ("Module CustomView Category: " . $customView->getCategory() . "\n");
        echo ("Module CustomView LastAccessedTime: ");
        print_r($customView->getLastAccessedTime());
        echo ("\n");
        if ($customView->getFavorite() != null) {
            echo ("Module CustomView Favorite: " . $customView->getFavorite() . "\n");
        }
        if ($customView->getSortOrder() != null) {
            echo ("Module CustomView SortOrder: " . $customView->getSortOrder() . "\n");
        }
    }
    private static function printCriteria($criteria)
    {
        if ($criteria instanceof SingleCriteria) {
            if ($criteria->getComparator() != null) {
                echo ("CustomView Criteria Comparator: " . $criteria->getComparator() . "\n");
            }
            $field = $criteria->getField();
            if ($field != null) {
                echo ("CustomView Criteria Field: " . $field->getAPIName() . "\n");
                echo ("CustomView Criteria Field: " . $field->getId() . "\n");
            }
            echo ("CustomView Criteria Value: ");
            print_r($criteria->getValue());
            echo ("\n");
        } else if ($criteria instanceof GroupCriteria) {
            $criteriaGroup = $criteria->getGroup();
            if ($criteriaGroup != null) {
                foreach ($criteriaGroup as $criteria1) {
                    self::printCriteria($criteria1);
                }
            }
            if ($criteria->getGroupOperator() != null) {
                echo ("CustomView Criteria Group Operator: " . $criteria->getGroupOperator() . "\n");
            }
        }
    }
}
$moduleAPIName="leads";
GetModuleByAPIName::initialize();
GetModuleByAPIName::getModuleByAPIName($moduleAPIName);
