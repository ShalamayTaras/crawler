<?php declare( strict_types = 1 );

namespace Tests;

use PHPUnit\Framework\TestCase;
use Services\Url;

/**
 * Class UrlTest
 */
class UrlTest extends TestCase
{
    const GOOD_URL = 'https://www.google.com.ua';
    const BAD_URL  = 'mailto://www.google.com.ua';

    /**
     *
     */
    public function testCreateUrl() : void
    {
        $url = Url::make(self::GOOD_URL);

        static::assertEquals($url->toString(), self::GOOD_URL);
    }

    /**
     * @dataProvider additionProvider
     * @param string $url
     * @param $expected
     */
    public function testValidateUrlTrue(string $url, $expected) : void
    {
        $url = Url::make($url);

        static::assertEquals($expected, $url->isValidate());
    }

    /**
     * @return array
     */
    public static function additionProvider() : array
    {
        return [
            'good url' => [self::GOOD_URL, true],
            'bad url'  => [self::BAD_URL, false],
        ];
    }
}
