<?php declare( strict_types = 1 );

namespace Tests;

use PHPUnit\Framework\TestCase;
use Services\Page\ImageTags;

/**
 * Class ImageTagsTest
 */
class ImageTagsTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     * @param string $text
     * @param int $expected
     */
    public function testGetImgCount(string $text, int $expected)
    {
        $imgCount = ImageTags::getImgCount($text);

        static::assertEquals($imgCount, $expected);
    }

    /**
     * @return array
     */
    public static function additionProvider() : array
    {
        return [
            ['<img> <img>', 2],
            ['<html>', 0],
        ];
    }
}
