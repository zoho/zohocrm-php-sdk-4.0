<?php
namespace layouts;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\layouts\APIException;
use com\zoho\crm\api\layouts\LayoutsOperations;
use com\zoho\crm\api\layouts\ResponseWrapper;
use com\zoho\crm\api\layouts\GetLayoutsParam;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class GetLayout
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
     * <h3> Get Layout </h3>
     * This method is used to get metadata about a single layout of a module with layoutID and print the response.
     * @param moduleAPIName The API Name of the layout's module
     * @param layoutId The ID of the field to be obtained
     * @throws Exception
     */
    public static function getLayout(string $moduleAPIName, string $layoutId)
    {
        //example, moduleAPIName = "module_api_name";
        //layoutId = "3477061055"
        $layoutsOperations = new LayoutsOperations();
        $paramInstance = new ParameterMap();
        $paramInstance->add(GetLayoutsParam::module(), $moduleAPIName);
        //Call getLayouts method
        $response = $layoutsOperations->getLayout($layoutId, $paramInstance);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            $responseHandler = $response->getObject();
            if ($responseHandler instanceof ResponseWrapper) {
                $responseWrapper = $responseHandler;
                $layouts = $responseWrapper->getLayouts();
                foreach ($layouts as $layout) {
                    if ($layout->getCreatedTime() != null) {
                        echo ("Layout CreatedTime: ");
                        print_r($layout->getCreatedTime());
                        echo ("\n");
                    }
                    if ($layout->getConvertMapping() != null) {
                        $convertMapping = $layout->getConvertMapping();
                        $accounts = $convertMapping->getAccounts();
                        $contacts = $convertMapping->getContacts();
                        $deals = $convertMapping->getDeals();
                    }
                    echo ("Layout Visible: ");
                    print_r($layout->getVisible());
                    echo ("\n");
                    $createdFor = $layout->getCreatedFor();
                    if ($createdFor != null) {
                        echo ("Layout CreatedFor User-Name: " . $createdFor->getName() . "\n");
                        echo ("Layout CreatedFor User-ID: " . $createdFor->getId() . "\n");
                        echo ("Layout CreatedFor User-Email: " . $createdFor->getEmail() . "\n");
                    }
                    $profiles = $layout->getProfiles();
                    if ($profiles != null) {
                        foreach ($profiles as $profile) {
                            echo ("Layout Profile Default: " . $profile->getDefault() . "\n");
                            echo ("Layout Profile Name: " . $profile->getName() . "\n");
                            echo ("Layout Profile ID: " . $profile->getId() . "\n");
                            $defaultView = $profile->getDefaultview();
                            if ($defaultView != null) {
                                echo ("Layout Profile DefaultView Name: " . $defaultView->getName() . "\n");
                                echo ("Layout Profile DefaultView ID: " . $defaultView->getId() . "\n");
                                echo ("Layout Profile DefaultView Type: " . $defaultView->getType() . "\n");
                            }
                        }
                    }
                    $createdBy = $layout->getCreatedBy();
                    if ($createdBy != null) {
                        echo ("Layout CreatedBy User-Name: " . $createdBy->getName() . "\n");
                        echo ("Layout CreatedBy User-ID: " . $createdBy->getId() . "\n");
                        echo ("Layout CreatedBy User-Email: " . $createdBy->getEmail() . "\n");
                    }
                    $sections = $layout->getSections();
                    if ($sections != null) {
                        foreach ($sections as $section) {
                            echo ("Layout Section DisplayLabel: " . $section->getDisplayLabel() . "\n");
                            echo ("Layout Section SequenceNumber: " . $section->getSequenceNumber() . "\n");
                            echo ("Layout Section Issubformsection: " . $section->getIssubformsection() . "\n");
                            echo ("Layout Section TabTraversal: " . $section->getTabTraversal() . "\n");
                            echo ("Layout Section APIName: " . $section->getAPIName() . "\n");
                            echo ("Layout Section ColumnCount: " . $section->getColumnCount() . "\n");
                            echo ("Layout Section Name: " . $section->getName() . "\n");
                            echo ("Layout Section GeneratedType: " . $section->getGeneratedType() . "\n");
                            echo ("Layout Section Type: " . $section->getType() . "\n");
                            $fields = $section->getFields();
                            if ($fields != null) {
                                foreach ($fields as $field) {
                                    self::printField($field);
                                }
                            }
                            $properties = $section->getProperties();
                            if ($properties != null) {
                                echo ("Layout Section Properties ReorderRows: " . $properties->getReorderRows() . "\n");
                                $tooltip = $properties->getTooltip();
                                if ($tooltip != null) {
                                    echo ("Layout Section Properties ToolTip Name: " . $tooltip->getName() . "\n");
                                    echo ("Layout Section Properties ToolTip Value: " . $tooltip->getValue() . "\n");
                                }
                                echo ("Layout Section Properties MaximumRows: " . $properties->getMaximumRows() . "\n");
                            }
                        }
                    }
                    echo ("Layout ShowBusinessCard: ");
                    print_r($layout->getShowBusinessCard());
                    echo ("\n");
                    echo ("Layout ModifiedTime: ");
                    print_r($layout->getModifiedTime());
                    echo ("\n");
                    echo ("Layout Name: " . $layout->getName() . "\n");
                    $modifiedBy = $layout->getModifiedBy();
                    if ($modifiedBy != null) {
                        echo ("Layout ModifiedBy User-Name: " . $modifiedBy->getName() . "\n");
                        echo ("Layout ModifiedBy User-ID: " . $modifiedBy->getId() . "\n");
                    }
                    echo ("Layout ID: " . $layout->getId() . "\n");
                    echo ("Layout Status: " . $layout->getStatus() . "\n");
                }
            }
            else if ($responseHandler instanceof APIException) {
                $exception = $responseHandler;
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                echo ("Code: " . $exception->getCode()->getValue() . "\n");
                echo ("Details: ");
                foreach ($exception->getDetails() as $key => $value) {
                    echo ($key . ": " . $value . "\n");
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
            }
        }
    }
    private static function printField($field)
    {
        echo ("Field SystemMandatory: ");
        print_r($field->getSystemMandatory());
        echo ("\n");
        $privateInfo = $field->getPrivate();
        if ($privateInfo != null) {
            echo ("Private Details\n");
            echo ("Field Private Type: " . $privateInfo->getType() . "\n");
            echo ("Field Private Export: " . $privateInfo->getExport() . "\n");
            echo ("Field Private Restricted: " . $privateInfo->getRestricted() . "\n");
        }
        echo ("Field Webhook: ");
        print_r($field->getWebhook());
        print_r("\n");
        echo ("Field JsonType: " . $field->getJsonType() . "\n");
        $crypt = $field->getCrypt();
        if ($crypt != null) {
            echo ("Field Crypt Mode: " . $crypt->getMode() . "\n");
            echo ("Field Crypt Column: " . $crypt->getColumn() . "\n");
            $encFldIds = $crypt->getEncfldids();
            if ($encFldIds != null) {
                echo ("EncFldIds : ");
                foreach ($encFldIds as $encFldId) {
                    echo ($encFldId . "\n");
                }
            }
            echo ("Field Crypt Notify: " . $crypt->getNotify() . "\n");
            echo ("Field Crypt Table: " . $crypt->getTable() . "\n");
            echo ("Field Crypt Status: " . $crypt->getStatus() . "\n");
        }
        echo ("Field FieldLabel: " . $field->getFieldLabel() . "\n");
        $tooltip = $field->getTooltip();
        if ($tooltip != null) {
            echo ("Field ToolTip Name: " . $tooltip->getName()->getValue() . "\n");
            echo ("Field ToolTip Value: " . $tooltip->getValue() . "\n");
        }
        echo ("Field CreatedSource: " . $field->getCreatedSource() . "\n");
        echo ("Field Type: " . $field->getType() . "\n");
        echo ("Field FieldReadOnly: ");
        print_r($field->getFieldReadOnly());
        echo ("\n");
        echo ("Field DisplayLabel: " . $field->getDisplayLabel() . "\n");
        echo ("Field DisplayType: " . $field->getDisplayType() . "\n");
        echo ("Field UIType: " . $field->getUiType() . "\n");
        echo ("Field ReadOnly: ");
        print_r($field->getReadOnly());
        echo ("\n");
        $associationDetails = $field->getAssociationDetails();
        if ($associationDetails != null) {
            $lookupField = $associationDetails->getLookupField();
            if ($lookupField != null) {
                echo ("Field AssociationDetails LookupField ID: " . $lookupField->getId() . "\n");
                echo ("Field AssociationDetails LookupField Name: " . $lookupField->getName() . "\n");
            }
            $relatedField = $associationDetails->getRelatedField();
            if ($relatedField != null) {
                echo ("Field AssociationDetails RelatedField ID: " . $relatedField->getId() . "\n");
                echo ("Field AssociationDetails RelatedField Name: " . $relatedField->getName() . "\n");
            }
        }
        echo ("Field BusinesscardSupported: ");
        print_r($field->getBusinesscardSupported());
        echo ("\n");
        if ($field->getMultiModuleLookup() != null) {
            foreach ($field->getMultiModuleLookup() as $key => $value) {
                echo ($key . ": " . $value . "\n");
            }
        }
        $currency = $field->getCurrency();
        if ($currency != null) {
            echo ("Field Currency RoundingOption: " . $currency->getRoundingOption()->getValue() . "\n");
            if ($currency->getPrecision() != null) {
                echo ("Field Currency Precision: " . $currency->getPrecision() . "\n");
            }
        }
        echo ("Field ID: " . $field->getId() . "\n");
        echo ("Field CustomField: ");
        print_r($field->getCustomField());
        echo ("\n");
        $lookup = $field->getLookup();
        if ($lookup != null) {
            echo ("Field Lookup DisplayLabel: " . $lookup->getDisplayLabel() . "\n");
            echo ("Field Lookup APIName: " . $lookup->getAPIName() . "\n");
            $module = $lookup->getModule();
            if ($module != null) {
                echo ("Field Lookup Module ID: " . $module->getId());
                echo ("\n");
                echo ("Field Lookup Module APIName: " . $module->getAPIName());
                echo ("\n");
            }
            if ($lookup->getId() != null) {
                echo ("Field Lookup ID: " . $lookup->getId() . "\n");
            }
        }
        echo ("Field Filterable: " . $field->getFilterable() . "\n");
        if ($field->getConvertMapping() != null) {
            echo ("Field ConvertMapping: \n");
            foreach ($field->getConvertMapping() as $key => $value) {
                echo ($key . " : " . $value . "\n");
            }
        }
        echo ("Field Visible: ");
        print_r($field->getVisible());
        echo ("\n");
        $profiles = $field->getProfiles();
        if ($profiles != null) {
            foreach ($profiles as $profile) {
                echo ("Field Profile PermissionType: " . $profile->getPermissionType() . "\n");
                echo ("Field Profile Name: " . $profile->getName() . "\n");
                echo ("Field Profile Id: " . $profile->getId() . "\n");
            }
        }
        if ($field->getLength() != null) {
            echo ("Field Length: " . $field->getLength()->getValue() . "\n");
        }
        $viewType = $field->getViewType();
        if ($viewType != null) {
            echo ("Field ViewType View: " . $viewType->getView() . "\n");
            echo ("Field ViewType Edit: " . $viewType->getEdit() . "\n");
            echo ("Field ViewType Create: " . $viewType->getCreate() . "\n");
            echo ("Field ViewType QuickCreate: " . $viewType->getQuickCreate() . "\n");
        }
        echo ("Field PickListValuesSortedLexically: " . $field->getPickListValuesSortedLexically() . "\n");
        echo ("Field Sortable: ");
        print_r($field->getSortable());
        echo ("\n");
        $subform = $field->getSubform();
        if ($subform != null) {
            echo ("Field Subform Module: " . $subform->getModule() . "\n");
            if ($subform->getId() != null) {
                echo ("Field Subform ID: " . $subform->getId() . "\n");
            }
        }
        $external = $field->getExternal();
        if ($external != null) {
            echo ("Field External Show: " . $external->getShow() . "\n");
            echo ("Field External Type: " . $external->getType()->getValue() . "\n");
            echo ("Field External AllowMultipleConfig: " . $external->getAllowMultipleConfig() . "\n");
        }
        echo ("Field APIName: " . $field->getAPIName() . "\n");
        $unique = $field->getUnique();
        if ($unique != null) {
            echo ("Field Unique Casesensitive : ");
            print_r($unique);
            echo ("\n");
        }
        if ($field->getHistoryTracking() != null) {
            echo ("Field HistoryTracking: " . print_r($field->getHistoryTracking()) . "\n");
        }
        echo ("Field DataType: " . $field->getDataType() . "\n");
        $formula = $field->getFormula();
        if ($formula != null) {
            echo ("Field Formula ReturnType : " . $formula->getReturnType() . "\n");
            if ($formula->getExpression() != null) {
                echo ("Field Formula Expression : " . $formula->getExpression() . "\n");
            }
        }
        if ($field->getDecimalPlace() != null) {
            echo ("Field DecimalPlace: " . $field->getDecimalPlace() . "\n");
        }
        echo ("Field MassUpdate: " . $field->getMassUpdate() . "\n");
        $multiSelectLookup = $field->getMultiselectlookup();
        if ($multiSelectLookup != null) {
            echo ("Field MultiSelectLookup DisplayLabel: " . $multiSelectLookup->getDisplayLabel() . "\n");
            $module = $multiSelectLookup->getLinkingModule();
            if ($module != null) {
                echo ("Field MultiSelectLookup Module ID: " . $module->getId() . "\n");
                echo ("Field MultiSelectLookup Module Name: " . $module->getAPIName() . "\n");
            }
            echo ("Field MultiSelectLookup LookupApiname: " . $multiSelectLookup->getLookupApiname() . "\n");
            echo ("Field MultiSelectLookup APIName: " . $multiSelectLookup->getAPIName() . "\n");
            $connectedModule = $multiSelectLookup->getConnectedModule();
            if ($connectedModule != null) {
                echo ("Field MultiSelectLookup ConnectedModule ID: " . $connectedModule->getId() . "\n");
                echo ("Field MultiSelectLookup ConnectedModule Name: " . $connectedModule->getAPIName() . "\n");
            }
            echo ("Field MultiSelectLookup ConnectedlookupApiname: " . $multiSelectLookup->getConnectedlookupApiname() . "\n");
            echo ("Field MultiSelectLookup ID: " . $multiSelectLookup->getId() . "\n");
        }
        $pickListValues = $field->getPickListValues();
        if ($pickListValues != null) {
            foreach ($pickListValues as $pickListValue) {
                self::printPickListValue($pickListValue);
            }
        }
        $autoNumber = $field->getAutoNumber();
        if ($autoNumber != null) {
            echo ("Field AutoNumber Prefix: " . $autoNumber->getPrefix() . "\n");
            echo ("Field AutoNumber Suffix: " . $autoNumber->getSuffix() . "\n");
            if ($autoNumber->getStartNumber() != null) {
                echo ("Field AutoNumber StartNumber: " . $autoNumber->getStartNumber() . "\n");
            }
        }
    }
    private static function printPickListValue($pickListValue)
    {
        echo ("Field PickListValue DisplayValue: " . $pickListValue->getDisplayValue() . "\n");
        if ($pickListValue->getSequenceNumber() != null) {
            echo (" Field PickListValue SequenceNumber: " . $pickListValue->getSequenceNumber() . "\n");
        }
        echo ("Field PickListValue ExpectedDataType: " . $pickListValue->getExpectedDataType() . "\n");
        if ($pickListValue->getMaps() != null) {
            foreach ($pickListValue->getMaps() as $map) {
                echo ("Field PickListValue Maps APIName: " . $map->getAPIName() . "\n");
                $pickListValues = $map->getPickListValues();
                if ($pickListValues != null) {
                    foreach ($pickListValues as $pickListValue1) {
                        self::printPickListValue($pickListValue1);
                    }
                }
            }
        }
        echo ("Field PickListValue ActualValue: " . $pickListValue->getActualValue() . "\n");
        echo ("Field PickListValue SysRefName: " . $pickListValue->getSysRefName() . "\n");
        if ($pickListValue->getType() != null) {
            echo ("Field PickListValue Type: " . $pickListValue->getType()->getValue() . "\n");
        }
        echo ("Field PickListValue Id: " . $pickListValue->getId() . "\n");
    }
}
$moduleAPIName = "leads";
$layoutId = "3477061055";
GetLayout::initialize();
GetLayout::getLayout($moduleAPIName,$layoutId);
