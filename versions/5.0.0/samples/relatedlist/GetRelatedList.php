<?php
namespace relatedlist;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\relatedlists\APIException;
use com\zoho\crm\api\relatedlists\RelatedListsOperations;
use com\zoho\crm\api\relatedlists\ResponseWrapper;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class GetRelatedList
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
     * <h3> Get RelatedList </h3>
     * This method is used to get the single related list data of a particular module with relatedListId and print the response.
     * @param moduleAPIName - The API Name of the module to get related list
     * @param relatedListId - The ID of the relatedList to be obtained
     * @throws Exception
     */
    public static function getRelatedList(string $moduleAPIName, string $relatedListId)
    {
        //example,
        //moduleAPIName = "module_api_name";
        //relatedListId = "525912";
        $relatedListsOperations = new RelatedListsOperations($moduleAPIName);
        //Call getRelatedLists method which takes relatedListId as parameter
        $response = $relatedListsOperations->getRelatedList($relatedListId);
        if ($response != null) {
            echo ("Status code " . $response->getStatusCode() . "\n");
            if (in_array($response->getStatusCode(), array(204, 304))) {
                echo ($response->getStatusCode() == 204 ? "No Content\n" : "Not Modified\n");
                return;
            }
            $responseHandler = $response->getObject();
            if ($responseHandler instanceof ResponseWrapper) {
                $responseWrapper = $responseHandler;
                $relatedLists = $responseWrapper->getRelatedLists();
                foreach ($relatedLists as $relatedList) {
                    echo ("RelatedList SequenceNumber: " . $relatedList->getSequenceNumber() . "\n");
                    echo ("RelatedList DisplayLabel: " . $relatedList->getDisplayLabel() . "\n");
                    echo ("RelatedList APIName: " . $relatedList->getAPIName() . "\n");
                    $module = $relatedList->getModule();
                    if ($module != null) {
                        echo ("RelatedList Module APIName: " . $module->getAPIName() . "\n");
                        echo ("RelatedList Module Id: " . $module->getId() . "\n");
                    }
                    echo ("RelatedList Name: " . $relatedList->getName() . "\n");
                    echo ("RelatedList Action: " . $relatedList->getAction() . "\n");
                    echo ("RelatedList ID: " . $relatedList->getId() . "\n");
                    echo ("RelatedList Href: " . $relatedList->getHref() . "\n");
                    echo ("RelatedList Type: " . $relatedList->getType() . "\n");
                    echo ("RelatedList Connectedmodule: " . $relatedList->getConnectedmodule() . "\n");
                    echo ("RelatedList Linkingmodule: " . $relatedList->getLinkingmodule() . "\n");
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
}
$moduleAPIName = "module_api_name";
$relatedListId = "525912";
GetRelatedList::initialize();
GetRelatedList::getRelatedList($moduleAPIName,$relatedListId);
