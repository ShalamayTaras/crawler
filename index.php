<?php declare( strict_types = 1 );

require_once __DIR__ . '/vendor/autoload.php';

return var_dump((new \Services\Page\Loader())->load('https://habr.com/post/4195411/'));

