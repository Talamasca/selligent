
# Logging

This library allows you to connect a [PSR3](http://www.php-fig.org/psr/psr-3/) implementation to log an monitor how it's work.

All classes of the `mediapart/selligent` library that could log messages implements [Psr\Log\LoggerAwareInterface](http://www.php-fig.org/psr/psr-3/#4-psr-log-loggerawareinterface).

## Logging example with Monolog

For example, if you want to use [Monolog](https://github.com/Seldaek/monolog) :

```php
<?php # monolog-example.php

require './vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Mediapart\Selligent\Connection;
use Mediapart\Selligent\Transport;
use Mediapart\Selligent\Properties;

$log = new Logger('selligent');
$log->pushHandler(new StreamHandler('monolog-example.log'));

$con = new Connection();
$con->setLogger($log);

$client = $con->open('login', 'password', 'wsdl');

$transport = new Transport($client);
$transport->setLogger($log);
$transport->setList('TESTLIST');

$user = new Properties();
$user['NAME'] = 'foo bar';
$user['MAIL'] = 'foo@bar.tld';
$transport->subscribe($user);

```


