Dingtalk
================================

A PHP SDK for dingtalk API, providing a simple interface to interact with dingtalk services.

Installation
--------------------------------

```sh
composer require pcb-flow/dingtalk
```

Usage
--------------------------------

```php
$client = new PcbFlow\Dingtalk\Client([
    'app_id' => 'xxxxxxxxxxxxxxxxxxxx',
    'app_secret' => 'xxxxxxx_xxxxxxx-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
]);

$userService = new PcbFlow\Dingtalk\Services\UserService($client);

$data = $userService->getUserByPhone($phone);
```
