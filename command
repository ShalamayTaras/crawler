#!/usr/bin/env php
<?php declare( strict_types = 1 );

require_once __DIR__ . '/vendor/autoload.php';

if ($argv === null ) {
    $argv = $_SERVER['argv'];
}


/** Remove from array executed filename */
array_shift($argv);

/** $argv[0] - now first argument it is url*/
$result = ( new \Commands\BaseCommand() )->runCommand($argv[0]);

echo $result . PHP_EOL;
//$pages = (new \Services\Pages($argv[0]));
//$start = microtime(true);
//$pages->loadPages();
//$pages->sortPages();
//
//$long = microtime(true)- $start;
//return $pages->getResult($long);
