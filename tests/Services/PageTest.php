<?php declare(strict_types = 1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Services\Page\Page;

/**
 * Class PageTest
 * @package Tests
 */
class PageTest extends TestCase
{
    /**
     * @var string
     */
    const URL = 'test.url.com';

    /**
     * @var array
     */
    const LINKS = ['test.url.com/test', 'other.url.test'];

    /**
     * @var float
     */
    const LOAD_TIME = 0.16;

    /**
     * @var int
     */
    const IMAGE_COUNT = 16;

    /**
     * @var int
     */
    const DEPTH = 2;

    /**
     * @dataProvider  createPageProvider
     * @param string $url
     * @param float $loadTime
     * @param int $imgCount
     * @param int $depth
     * @param array $expected
     */
    public function testCreatePage(string $url, float $loadTime, int $imgCount, int $depth, array $expected) : void
    {

        $page = (new Page())
            ->setUrl($url)
            ->setLoadTime($loadTime)
            ->setImgCount($imgCount)
            ->setDepth($depth);

        self::assertEquals($expected, $page->toArray());
    }

    /**
     * @return array
     */
    public function createPageProvider() : array
    {
        return [
            'all property' => [
                self::URL,
                self::LOAD_TIME,
                self::IMAGE_COUNT,
                self::DEPTH,
                [
                    self::URL,
                    self::IMAGE_COUNT,
                    self::DEPTH,
                    self::LOAD_TIME,
                ],
            ],
        ];
    }

    /**
     * @dataProvider  linkPageProvider
     * @param array $links
     */
    public function testLinkPage(array $links) : void
    {

        $page = (new Page())
            ->setLinks($links);

        self::assertEquals($links, $page->getLinks());
    }

    /**
     * @return array
     */
    public function linkPageProvider() : array
    {
        return [
            'link property' => [
                self::LINKS,
            ],
        ];
    }
}
