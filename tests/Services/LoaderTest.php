<?php declare(strict_types = 1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Services\Page\Loader;
use Services\Page\Page;

/**
 * Class LoaderTest
 * @package Tests
 */
class LoaderTest extends TestCase
{
    /**
     * @var string
     */
    const GOOD_URL = 'https://google.com.ua';

    /**
     * @var string
     */
    const BAD_URL = 'google.com.ua';

    /**
     * Test load return Page object
     */
    public function testLoad() : void
    {
        $loader = new Loader();
        $result = $loader->load(self::GOOD_URL, 0);
        self::assertNotEmpty($result);
        self::assertInstanceOf(Page::class, $result);
    }

    /**
     * Test Load return null
     */
    public function testLoadFalse() : void
    {
        $loader = new Loader();
        $result = $loader->load(self::BAD_URL, 0);
        self::assertNull($result);
    }
}
