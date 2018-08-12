<?php declare( strict_types = 1 );

use PHPUnit\Framework\TestCase;

/**
 * Class UrlTest
 */
class UrlTest extends TestCase
{
    const URL     = 'https://www.google.com.ua';
    const BAD_URL = 'mailto://www.google.com.ua';

    public function testCreateUrl()
    {
        $url = \Services\Url::make(self::URL);

        static::assertEquals($url->toString(), self::URL);
    }

    public function testValidateUrlTrue()
    {
        $url = \Services\Url::make(self::URL);

        static::assertEquals($url->isValidate(), true);
    }

    public function testValidateUrlFalse ()
    {
        $url = \Services\Url::make(self::BAD_URL);

        static::assertEquals($url->isValidate(), false);
    }
}
