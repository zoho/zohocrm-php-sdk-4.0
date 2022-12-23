# Zoho CRM PHP SDK

The PHP SDK for Zoho CRM allows developers to easily create client PHP applications that can be integrated with Zoho CRM. This SDK serves as a wrapper for the REST APIs, making it easier to access and utilize the services of Zoho CRM. 
Authentication to access the CRM APIs is done through OAuth2.0, and the authentication process is streamlined through the use of the PHP SDK. The grant and access/refresh tokens are generated and managed within the SDK code, eliminating the need for manual handling during data synchronization between Zoho CRM and the client application.

This repository includes the PHP SDK for API v4 of Zoho CRM. Check [Versions](https://github.com/zoho/zohocrm-php-sdk-4.0/releases) for more details on the versions of SDK released for this API version.

License
=======

    Copyright (c) 2021, ZOHO CORPORATION PRIVATE LIMITED 
    All rights reserved. 

    Licensed under the Apache License, Version 2.0 (the "License"); 
    you may not use this file except in compliance with the License. 
    You may obtain a copy of the License at 
    
        http://www.apache.org/licenses/LICENSE-2.0 
    
    Unless required by applicable law or agreed to in writing, software 
    distributed under the License is distributed on an "AS IS" BASIS, 
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. 
    See the License for the specific language governing permissions and 
    limitations under the License.


## Latest Version
- [1.0.0-beta](/versions/1.0.0-beta/README.md)

    - Beta version of CRM v4 APIs.
  
For older versions, please [refer](https://github.com/zoho/zohocrm-java-php-4.0/releases).

## Including the SDK in your project
You can include the SDK to your project using Composer.
For installing the latest [version](https://github.com/zoho/zohocrm-php-sdk-4.0/releases) of PHP SDK, navigate to the workspace of your client app and run the following command.

```sh
composer require zohocrm/php-sdk-4.0:1.0.0-beta
```
With this, the PHP SDK will be installed and a package named vendor will be created in the workspace of your client app.

For more details, kindly refer here. [here](/versions/1.0.0-beta/README.md).

