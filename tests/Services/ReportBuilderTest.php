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
    const LOAD_TIME = 2.0;
    const IMG_COUNT = 2;
    const DEPTH     = 5;
    const URL       = 'https://test.com.ua';

    public function testBuild()
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