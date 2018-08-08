#!/usr/bin/env php
<?php declare( strict_types = 1 );

require_once __DIR__ . '/vendor/autoload.php';

if (null === $argv) {
    $argv = $_SERVER['argv'];
}


array_shift($argv);


return (new \Services\Page\Loader())->load($argv[0]);
