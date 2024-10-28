# Revive Ad Server XML RPC API
## Uses
- [phpxmlrpc/phpxmlrpc](https://github.com/gggeek/phpxmlrpc)
- [illuminate/support](https://github.com/illuminate/support)
##### Laravel config/env
```bash
php artisan vendor:publish --provider="Biologed\Revive\ReviveServiceProvider"
```
If you want to edit the config, use the ENV constants in the .env file
```dotenv
REVIVE_HOST=example.com
REVIVE_BASEPATH=/www/api/v2/xmlrpc/
REVIVE_USERNAME=admin
REVIVE_PASSWORD=password
REVIVE_PORT=0
REVIVE_SSL=1
REVIVE_TIMEOUT=15
```
## Examples
```php
use Biologed\Revive\Revive;
use Biologed\Revive\Entities\Advertiser;
use Biologed\Revive\Entities\Agency;

//get agency entity from Revive Ad Server
$agencyEntity = Revive::API()->setAgencyId(1)->getAgency();

//create Advertiser Entity
$advertiserEntity = new Advertiser();
$createdAdvertiser = $advertiserEntity->readDataFromArray([
    'advertiserId' => 0,
    'accountId' => 1,
    'agencyId' => 1,
    'advertiserName' => 'Advertiser',
    'contactName' => 'Contact',
    'emailAddress' => 'password',
    'comments' => 'comment',
]);

//modify Agency to Revive Ad Server
$agencyEntity->setParam('contactName', 'new contact name');
Revive::API()->setAgencyEntity($agencyEntity)->modifyAgency();

//get list of Agencies
$agencyList = Revive::API()->getAgencyList();

//get statistics
$advertiserCampaignStatistics = Revive::API()
    ->setAdvertiserId(5)
    ->setStartDate(CarbonImmutable::yesterday())
    ->setEndDate(CarbonImmutable::today())
    ->advertiserCampaignStatistics()
    ->get();
```
