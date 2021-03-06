<?php declare(strict_types = 1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Services\Page\Links;
use Services\Url;

/**
 * Class LinksTest
 */
class LinksTest extends TestCase
{
    /**
     * @var string
     */
    const GOOD_URL = 'https://test.com.ua/test';

    /**
     * @var string
     */
    const OTHER_DOMAIN_URL = 'https://other.com.ua/test';

    /**
     * @var string
     */
    const SAME_DOMAIN_URL = 'https://test.com.ua/test/test';

    /**
     * @var string
     */
    const TEST_DOMAIN = 'test.com.ua';

    /**
     * @var string
     */
    const URL_SCHEME_HTTP = 'http://other-test.com.ua';

    /**
     * @var string
     */
    const OTHER_DOMAIN = 'other-test.com.ua';

    /**
     * @var string
     */
    const MUST_TRANSFORM_URL = 'test/';

    /**
     * @var string
     */
    const RESULT_TRANSFORM_URL = '/test';

    /**
     * @var string
     */
    const BAD_URL = 'mailto://test.com.ua';

    /**
     * @var string
     */
    const SCHEME_HTTP = 'http';

    /**
     * @var string
     */
    const SCHEME_HTTPS = 'https';

    /**
     * @var string
     */
    const HTML = '<html>
                            <a href="' . self::OTHER_DOMAIN_URL . '" />
                            <a href="' . self::SAME_DOMAIN_URL . '"/>
                            <a href="' . self::TEST_DOMAIN . ' "/>
                            <a href="' . self::URL_SCHEME_HTTP . '" />
                            <a href="' . self::BAD_URL . '" />
                          </html>';


    /**
     * Test method getLinks
     */
    public function testGetLinks() : void
    {
        $url = Url::make(self::GOOD_URL);

        $links = Links::getLinks(self::HTML, $url);

        self::assertContains(self::SAME_DOMAIN_URL, $links);
        self::assertContains(self::OTHER_DOMAIN_URL, $links);
        self::assertNotContains(self::BAD_URL, $links);
    }

    /**
     * Test for change path of url
     */
    public function testPreparePathChange() : void
    {
        /** @var URL $url */
        $url = Url::make(self::MUST_TRANSFORM_URL);

        Links::preparePath($url);

        static::assertEquals(self::RESULT_TRANSFORM_URL, $url->getPath());
    }

    /**
     * Test for no change host of url
     */
    public function testPreparePathNoChange() : void
    {
        /** @var Url $goodUrl */
        $goodUrl = Url::make(self::GOOD_URL);

        Links::preparePath($goodUrl);

        static::assertEquals(self::RESULT_TRANSFORM_URL, $goodUrl->getPath());
    }

    /**
     * Test for change host of url
     */
    public function testPrepareHostChange() : void
    {
        $goodUrl          = Url::make(self::MUST_TRANSFORM_URL);
        $urlWithoutScheme = Url::make(self::TEST_DOMAIN);

        Links::prepareHost($urlWithoutScheme, $goodUrl);

        static::assertEquals($urlWithoutScheme->getHost(), $goodUrl->getHost());
    }

    /**
     * Test for no change host of url
     */
    public function testPrepareHostNoChange() : void
    {
        $goodUrl     = Url::make(self::GOOD_URL);
        $otherScheme = Url::make(self::OTHER_DOMAIN_URL);

        Links::prepareScheme($otherScheme, $goodUrl);

        static::assertNotEquals($otherScheme->getHost(), $goodUrl->getHost());
    }

    /**
     * Test for change scheme of url
     */
    public function testPrepareSchemeChange() : void
    {
        $goodUrl          = Url::make(self::GOOD_URL);
        $urlWithoutScheme = Url::make(self::TEST_DOMAIN);

        Links::prepareScheme($urlWithoutScheme, $goodUrl);

        static::assertEquals($urlWithoutScheme->getScheme(), $goodUrl->getScheme());
    }

    /**
     * Test for no change scheme of url
     */
    public function testPrepareSchemeNoChange() : void
    {
        $goodUrl     = Url::make(self::GOOD_URL);
        $otherScheme = Url::make(self::URL_SCHEME_HTTP);

        Links::prepareScheme($otherScheme, $goodUrl);

        static::assertEquals($otherScheme->getScheme(), self::SCHEME_HTTP);
    }

    /**
     * @dataProvider filterLinkProvider
     * @param array $links
     * @param string $domain
     * @param $expected
     */
    public function testFilterLinks(array $links, string $domain, array $expected) : void
    {
        $filteredLink = Links::filterLinks($links, $domain);
        static::assertEquals($expected, $filteredLink);
    }

    /**
     * @return array
     */
    public static function filterLinkProvider() : array
    {
        return [
            'other url domain'   => [
                [self::GOOD_URL, self::OTHER_DOMAIN_URL],
                self::TEST_DOMAIN,
                [self::GOOD_URL],
            ],
            'same url domain'    => [
                [self::GOOD_URL, self::SAME_DOMAIN_URL],
                self::TEST_DOMAIN,
                [self::GOOD_URL, self::SAME_DOMAIN_URL],
            ],
            'empty links result' => [
                [self::GOOD_URL, self::SAME_DOMAIN_URL],
                self::OTHER_DOMAIN,
                [],
            ],
        ];
    }
}
