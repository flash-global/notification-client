# Service Notification - Client

[![GitHub release](https://img.shields.io/github/release/flash-global/notification-client.svg?style=for-the-badge)](README.md) 


## Table of contents
- [Purpose](#purpose)
- [Requirements](#requirements)
    - [Runtime](#runtime)
- [Step by step installation](#step-by-step-installation)
    - [Initialization](#initialization)
    - [Settings](#settings)
    - [Known issues](#known-issues)
- [Contribution](#contribution)
- [Link to documentation](#link-to-documentation)
    - [Examples](#examples)
- [Credits](#credits)

## Purpose
This client permit to use the `Notification Api`. Thanks to it, you could request the API to :
* Fetch data
* Create data
* Update data
* Delete data

easily

## Requirements 

### Runtime
- PHP 5.5

## Step by step Installation
> for all purposes (devlopment, contribution and production)

### Initialization
- Cloning repository 
```git clone https://github.com/flash-global/notification-client.git```
- Run Composer depedencies installation
```composer install```

### Settings

Don't forget to set the right `baseUrl` !

```php
<?php 
$notifier = new Notifier([AbstractApiClient::OPTION_BASEURL => 'http://127.0.0.1:8800']);
$notifier->setTransport(new BasicTransport());
```

### Known issues
No known issue at this time.

## Contribution
As FEI Service, designed and made by OpCoding. The contribution workflow will involve both technical teams. Feel free to contribute, to improve features and apply patches, but keep in mind to carefully deal with pull request. Merging must be the product of complete discussions between Flash and OpCoding teams :) 

## Link to documentation 

### Examples
You can test this client easily thanks to the folder [examples](examples)

Here, an example on how to use example : `php /my/notification-client/folder/examples/notify.php` 


## Credits 
- Product Owner : Nicolas Devaux (FEI)
- Lead developer : Boris Cerati (OpCoding)
- Main developer : Ludovic Sanctorum (OpCoding)