<?php declare( strict_types = 1 );

use PHPUnit\Framework\TestCase;


/**
 * Class UrlTest
 */
class UrlTest extends TestCase
{

    public function testCreateUrl ()
    {
        $link = 'https://www.google.com.ua';
        $url  = \Services\Url::make($link);

        static::assertEquals($url->toString(), $link);
    }

    public function testValidateUrlTrue ()
    {
        $link = 'https://www.google.com.ua';
        $url  = \Services\Url::make($link);

        static::assertEquals($url->isValidate(), true);
    }

    public function testValidateUrlFalse ()
    {
        $link = 'mailto://www.google.com.ua';
        $url  = \Services\Url::make($link);

        static::assertEquals($url->isValidate(), false);
    }
}