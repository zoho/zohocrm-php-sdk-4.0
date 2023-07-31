<?php
namespace initializer;

use com\zoho\api\authenticator\OAuthBuilder;

use com\zoho\api\authenticator\store\DBBuilder;

use com\zoho\api\authenticator\store\FileStore;

use com\zoho\crm\api\InitializeBuilder;

use com\zoho\crm\api\UserSignature;

use com\zoho\crm\api\dc\USDataCenter;

use com\zoho\api\logger\LogBuilder;

use com\zoho\api\logger\Levels;

use com\zoho\crm\api\SDKConfigBuilder;

use com\zoho\crm\api\ProxyBuilder;

class Initialize
{
    public static function initialize()
    {
        /*
		 * Create an instance of Logger Class that takes two parameters
		 * 1 -> Level of the log messages to be logged. Can be configured by typing Levels "." and choose any level from the list displayed.
		 * 2 -> Absolute file path, where messages need to be logged.
		 */
		$logger = (new LogBuilder())
		->level(Levels::INFO)
		->filePath("/Users/php-sdk-sample-application/php_sdk_log.log")
		->build();

        //Create an UserSignature instance that takes user Email as parameter
        $user = new UserSignature("abc@zoho.com");

        /*
		 * Configure the environment
		 * which is of the pattern Domain.Environment
		 * Available Domains: USDataCenter, EUDataCenter, INDataCenter, CNDataCenter, AUDataCenter
		 * Available Environments: PRODUCTION, DEVELOPER, SANDBOX
		 */
        $environment = USDataCenter::PRODUCTION();

        //Create a Token instance
		$token = (new OAuthBuilder())
		->clientId("1000.xxxx")
		// ->id("php_abc_us_prd_ea9e")
		->clientSecret("xxxx")
		->grantToken("1000.xxx.xxxx")
		// ->refreshToken("1000.xxx.xxx")
		// ->redirectURL("RedirectURL")
		// ->accessToken("1000.xxx.xxx")
		->build();

		 $tokenstore = (new DBBuilder())
		 ->host("hostName")
		 ->databaseName("databaseName")
		 ->userName("userName")
		 ->portNumber("portNumber")
		 ->tableName("oauthtoken1")
		 ->password("")
		 ->build();

        $tokenstore = new FileStore("/Users/php-sdk-sample-application/php_sdk_token.txt");

		$resourcePath = "/Users/php-sdk-sample-application/file";

		$autoRefreshFields = false;

		$pickListValidation = false;

		// $enableSSLVerification = true;

		$builderInstance = new SDKConfigBuilder();

		$connectionTimeout = 50; //The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.

    	$timeout = 50; //The maximum number of seconds to allow cURL functions to execute.

		$configInstance = $builderInstance
		->autoRefreshFields($autoRefreshFields)
		->pickListValidation($pickListValidation)
		// ->sslVerification($enableSSLVerification)
		// ->connectionTimeout($connectionTimeout)
		// ->timeout($timeout)
		->build();

		$requestProxy = (new ProxyBuilder())->host("proxyHost")->port(3306)->user("proxyUser")->password("password")->build();

		(new InitializeBuilder())
		
		->environment($environment)
		->token($token)
		->store($tokenstore)
		->SDKConfig($configInstance)
		->resourcePath($resourcePath)
		->logger($logger)
		// ->requestProxy($requestProxy)
		->initialize();

		// print_r($tokenstore->getTokens());
    }
}
?>