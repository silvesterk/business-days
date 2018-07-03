<?php
if (!is_file($autoloadFile = __DIR__ . '/../vendor/autoload.php')) {
    throw new \RuntimeException('Did not find vendor/autoload.php.');
}

date_default_timezone_set('Europe/Belgrade');

$loader = require($autoloadFile);
$loader->add('BusinessDays',__DIR__.'/../src/');