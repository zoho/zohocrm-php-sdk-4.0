<?php
namespace territories;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\territories\APIException;
use com\zoho\crm\api\territories\BodyWrapper;
use com\zoho\crm\api\territories\TerritoriesOperations;
use com\zoho\crm\api\territories\GroupCriteria;
use com\zoho\crm\api\territories\SingleCriteria;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class GetTerritories
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
     * <h3> Get Territories </h3>
     * This method is used to get the list of territories enabled for your organization and print the response.
     * @throws Exception
     */
    public static function getTerritories()
    {
        $territoriesOperations = new TerritoriesOperations();
        //Call getTerritories method
        $response = $territoriesOperations->getTerritories();
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            $responseHandler = $response->getObject();
            if ($responseHandler instanceof BodyWrapper) {
                $responseWrapper = $responseHandler;
                $territoryList = $responseWrapper->getTerritories();
                if ($territoryList != null) {
                    foreach ($territoryList as $territory) {
                        echo ("Territory CreatedTime: ");
                        print_r($territory->getCreatedTime());
                        echo ("\n");
                        echo ("Territory PermissionType: " . $territory->getPermissionType()->getValue() . "\n");
                        echo ("Territory ModifiedTime: ");
                        print_r($territory->getModifiedTime());
                        echo ("\n");
                        $manager = $territory->getManager();
                        if ($manager != null) {
                            echo ("Territory Manager User-Name: " . $manager->getName() . "\n");
                            echo ("Territory Manager User-ID: " . $manager->getId() . "\n");
                        }
                        $criteria = $territory->getAccountRuleCriteria();
                        if ($criteria != null) {
                            self::printCriteria($criteria);
                        }
                        echo ("Territory Name: " . $territory->getName() . "\n");
                        $modifiedBy = $territory->getModifiedBy();
                        if ($modifiedBy != null) {
                            echo ("Territory Modified By User-Name: " . $modifiedBy->getName() . "\n");
                            echo ("Territory Modified By User-ID: " . $modifiedBy->getId() . "\n");
                        }
                        echo ("Territory Description: " . $territory->getDescription() . "\n");
                        echo ("Territory ID: " . $territory->getId() . "\n");
                        $reportingTo = $territory->getReportingTo();
                        if ($reportingTo != null) {
                            echo ("Territory ReportingTo User-Name: " . $reportingTo->getName() . "\n");
                            echo ("Territory ReportingTo User-ID: " . $reportingTo->getId() . "\n");
                        }
                        $dealcriteria = $territory->getDealRuleCriteria();
                        if ($dealcriteria != null) {
                            self::printCriteria($dealcriteria);
                        }
                        $createdBy = $territory->getCreatedBy();
                        if ($createdBy != null) {
                            echo ("Territory Created By User-Name: " . $createdBy->getName() . "\n");
                            echo ("Territory Created By User-ID: " . $createdBy->getId() . "\n");
                        }
                    }
                }
                $info = $responseWrapper->getInfo();
                echo ("Territory Info PerPage : " . $info->getPerPage() . "\n");
                echo ("Territory Info Count : " . $info->getCount() . "\n");
                echo ("Territory Info Page : " . $info->getPage() . "\n");
                echo ("Territory Info MoreRecords : ");
                print_r($info->getMoreRecords());
                echo ("\n");
            }
            else if ($responseHandler instanceof APIException) {
                $exception = $responseHandler;
                echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                echo ("Code: " . $exception->getCode()->getValue() . "\n");
                echo ("Details: ");
                foreach ($exception->getDetails() as $key => $value) {
                    echo ($key . " : " . $value . "\n");
                }
                echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()));
            }
        }
    }
    private static function printCriteria($criteria)
    {
        if ($criteria instanceof SingleCriteria) {
            if ($criteria->getComparator() != null) {
                echo ("Territory Criteria Comparator: " . $criteria->getComparator() . "\n");
            }
            $field = $criteria->getField();
            if ($field != null) {
                echo ("Territory Criteria Field: " . $field->getAPIName() . "\n");
                echo ("Territory Criteria Field: " . $field->getId() . "\n");
            }
            echo ("Territory Criteria Value: ");
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
                echo ("Territory Criteria Group Operator: " . $criteria->getGroupOperator() . "\n");
            }
        }
    }
}
GetTerritories::initialize();
GetTerritories::getTerritories();
