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
- [1.1.0](/versions/1.1.0/README.md)

    - PHP SDK support Unicode value.

- [1.0.0](/versions/1.0.0/README.md)

    - PHP SDK upgraded to support v4 APIs.

    - Structural changes to aid the process of SDK configuration and initialization user-friendly.

        - Handled Token Persistence

        - Updated UserSignature from Mandatory to Optional(Moved to OAuthToken Class).

        - user_mail key in DBStore and FileStore is updated to user_name.
    
    - PHP SDK improved to support the following new APIs

        - [AssociateEmail](https://www.zoho.com/crm/developer/docs/api/v4/associate-email.html)
        - [Backup](https://www.zoho.com/crm/developer/docs/api/v4/get-backup-info.html)
        - [BusinessHours](https://www.zoho.com/crm/developer/docs/api/v4/get-business-hours.html)
        - [CancelMeetings](https://www.zoho.com/crm/developer/docs/api/v4/meeting-cancel.html)
        - [DealContactRoles](https://www.zoho.com/crm/developer/docs/api/v4/get-contact-roles-of-a-specific-deal.html)
        - [DownloadEmailAttachmnets](https://www.zoho.com/crm/developer/docs/api/v4/download-email-attachments.html)
        - [DownloadInlineImagesofanEmail](https://www.zoho.com/crm/developer/docs/api/v4/download-inline-images.html)
        - [EmailSharing](https://www.zoho.com/crm/developer/docs/api/v4/get-email-shared-details.html)
        - [EmailRelatedrecords](https://www.zoho.com/crm/developer/docs/api/v4/get-email-rel-list.html)
        - [FieldMapDependency](https://www.zoho.com/crm/developer/docs/api/v4/get-map-dependency.html)
        - [fromAddresses](https://www.zoho.com/crm/developer/docs/api/v4/get-from-addresses-list.html)
        - [Holidays](https://www.zoho.com/crm/developer/docs/api/v4/get-holidays.html)
        - [MassChangeOwner](https://www.zoho.com/crm/developer/docs/api/v4/mass-change-owner.html)
        - [MassConvert](https://www.zoho.com/crm/developer/docs/api/v4/mass-convert-lead.html)
        - [MassDeleteCVID](https://www.zoho.com/crm/developer/docs/api/v4/mass-delete.html)
        - [Portals](https://www.zoho.com/crm/developer/docs/api/v4/get-portals.html)
        - [PortalInvite](https://www.zoho.com/crm/developer/docs/api/v4/invite-user.html)
        - [ShiftHours](https://www.zoho.com/crm/developer/docs/api/v4/get-shift-hours.html)
        - [UserGroups](https://www.zoho.com/crm/developer/docs/api/v4/get-user-groups.html)
        - [UserTerritories](https://www.zoho.com/crm/developer/docs/api/v4/get-user-territories.html)
        - [UserType](https://www.zoho.com/crm/developer/docs/api/v4/get-user-types.html)
        - [UserTypeUsers](https://www.zoho.com/crm/developer/docs/api/v4/get-users-user-type.html)


- [1.0.0-beta](/versions/1.0.0-beta/README.md)

    - Beta version of CRM v4 APIs.
  
For older versions, please [refer](https://github.com/zoho/zohocrm-php-sdk-4.0/releases).

## Including the SDK in your project
You can include the SDK to your project using Composer.
For installing the latest [version](https://github.com/zoho/zohocrm-php-sdk-4.0/releases/tag/1.1.0) of PHP SDK, navigate to the workspace of your client app and run the following command.

```sh
composer require zohocrm/php-sdk-4.0
```
With this, the PHP SDK will be installed and a package named vendor will be created in the workspace of your client app.

For more details, kindly refer here. [here](/versions/1.1.0/README.md).
