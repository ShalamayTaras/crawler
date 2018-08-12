#!/usr/bin/env php
<?php declare( strict_types = 1 );

require_once __DIR__ . '/vendor/autoload.php';

if ($argv === null ) {
    $argv = $_SERVER['argv'];
}

/**
 * $argv[0] - executed filename
 * $argv[1] - first argument it is url
 */
$result = ( new \Commands\BaseCommand() )->runCommand($argv[1]);

echo $result . PHP_EOL;