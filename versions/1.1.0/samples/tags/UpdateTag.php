<?php
namespace tags;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\UserSignature;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\tags\APIException;
use com\zoho\crm\api\tags\ActionWrapper;
use com\zoho\crm\api\tags\BodyWrapper;
use com\zoho\crm\api\tags\SuccessResponseTag;
use com\zoho\crm\api\tags\TagsOperations;
use com\zoho\crm\api\tags\UpdateTagParam;
use com\zoho\crm\api\util\Choice;

require_once "vendor/autoload.php";
class UpdateTag
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
     * <h3> Update Tag </h3>
     * This method is used to update single tag and print the response.
     * @param moduleAPIName - The API Name of the module to update tag.
     * @param tagId - The ID of the tag to be obtained.
     * @throws Exception
     */
    public static function updateTag(string $moduleAPIName, string $tagId)
    {
        $tagsOperations = new TagsOperations();
        $request = new BodyWrapper();
        $paramInstance = new ParameterMap();
        $paramInstance->add(UpdateTagParam::module(), $moduleAPIName);
        //List of Tag instances
        $tagList = array();
        $tagClass = 'com\zoho\crm\api\tags\Tag';
        $tag1 = new $tagClass();
        $tag1->setName("tagName13");
        array_push($tagList, $tag1);
        $request->setTags($tagList);
        //Call updateTags method that takes BodyWrapper instance, paramInstance and tagId as parameter
        $response = $tagsOperations->updateTag($tagId, $request, $paramInstance);
        if ($response != null) {
            echo ("Status Code: " . $response->getStatusCode() . "\n");
            $actionHandler = $response->getObject();
            if ($actionHandler instanceof ActionWrapper) {
                $actionWrapper = $actionHandler;
                $actionResponses = $actionWrapper->getTags();
                foreach ($actionResponses as $actionResponse) {
                    if ($actionResponse instanceof SuccessResponseTag) {
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
$moduleAPIName="leads";
$tagId="300083";
UpdateTag::initialize();
UpdateTag::updateTag($moduleAPIName,$tagId);
