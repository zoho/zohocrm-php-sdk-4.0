<?php
namespace taxes;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\taxes\ActionWrapper;
use com\zoho\crm\api\taxes\APIException;
use com\zoho\crm\api\taxes\BodyWrapper;
use com\zoho\crm\api\taxes\OrgTax;
use com\zoho\crm\api\taxes\Preference;
use com\zoho\crm\api\taxes\TaxesOperations;
use com\zoho\crm\api\taxes\UpdateSuccessResponse;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class UpdateTaxes
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
     * <h3> Update Taxes </h3>
     * This method is used to update Organization Taxes and print the response.
     * @throws Exception
     */
    public static function updateTaxes()
    {
        $taxesOperations = new TaxesOperations();
        $request = new BodyWrapper();
        $orgTax = new OrgTax();
        //List of Tax instances
        $taxList = array();
        $taxClass = 'com\zoho\crm\api\taxes\Tax';
        $tax1 = new $taxClass();
        $tax1->setId("3477061000014903099");
        $tax1->setName("MyT213ax1134");
        $tax1->setSequenceNumber(1);
        $tax1->setValue(15.0);
        // $tax1->setDelete(null);
        array_push($taxList, $tax1);
        $orgTax->setTaxes($taxList);
        $preference = new Preference();
        $preference->setAutoPopulateTax(false);
        $preference->setModifyTaxRates(false);
        $orgTax->setPreference($preference);
        $request->setOrgTaxes($orgTax);
        //Call updateTaxes method that takes BodyWrapper instance as parameter
        $response = $taxesOperations->updateTaxes($request);
        if ($response != null) {
            echo ("Status Code: " . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof ActionWrapper) {
                $actionWrapper = $actionHandler;
                $actionResponse = $actionWrapper->getOrgTaxes();
                if ($actionResponse instanceof UpdateSuccessResponse) {
                    $successResponse = $actionResponse;
                    echo ("Status: " . $successResponse->getStatus()->getValue() . "\n");
                    echo ("Code: " . $successResponse->getCode()->getValue() . "\n");
                    if ($successResponse->getDetails() != null) {
                        echo ("Details: ");
                        foreach ($successResponse->getDetails() as $key => $value) {
                            echo ($key . " : ");
                            print_r($value);
                            echo ("\n");
                        }
                    }
                    echo ("Message: " . ($successResponse->getMessage() instanceof Choice ? $successResponse->getMessage()->getValue() : $successResponse->getMessage()) . "\n");
                }
                else if ($actionResponse instanceof APIException) {
                    $exception = $actionResponse;
                    echo ("Status: " . $exception->getStatus()->getValue() . "\n");
                    echo ("Code: " . $exception->getCode()->getValue() . "\n");
                    echo ("Details: ");
                    foreach ($exception->getDetails() as $key => $value) {
                        echo ($key . " : " . $value . "\n");
                    }
                    echo ("Message : " . ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue() : $exception->getMessage()) . "\n");
                }
            }
            else if ($actionHandler instanceof APIException) {
                $exception = $actionHandler;
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
}
UpdateTaxes::initialize();
UpdateTaxes::updateTaxes();
