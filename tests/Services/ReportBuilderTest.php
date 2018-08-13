<?php declare(strict_types = 1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Services\Page\Page;
use Services\Report\ReportBuilder;

/**
 * Class ReportBuilderTest
 * @package Tests
 */
class ReportBuilderTest extends TestCase
{
    /**
     * @var float
     */
    const LOAD_TIME = 2.0;

    /**
     * @var int
     */
    const IMG_COUNT = 2;

    /**
     * @var int
     */
    const DEPTH = 5;

    /**
     * @var string
     */
    const URL = 'https://test.com.ua';

    /**
     * Test Build html
     */
    public function testBuild() : void
    {
        $page = self::createMock(Page::class);
        $page->method('toArray')->willReturn([
            self::URL,
            self::IMG_COUNT,
            self::DEPTH,
            self::LOAD_TIME,
        ]);


        $reportBuilder = new ReportBuilder();
        $reportBuilder->setLoadTime(self::LOAD_TIME);
        $reportBuilder->setPages([$page]);

        $report = $reportBuilder->build();

        self::assertNotEmpty($report);
        self::assertContains(self::URL, $report);
        self::assertContains((string)self::IMG_COUNT, $report);
        self::assertContains((string)self::DEPTH, $report);
        self::assertContains((string)self::LOAD_TIME, $report);
    }
}
