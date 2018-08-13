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
     * @var string
     */
    const IMG = '<img> <img>';

    /**
     * @var string
     */
    const HTML = '<html>';

    /**
     * @dataProvider additionProvider
     * @param string $text
     * @param int $expected
     */
    public function testGetImgCount(string $text, int $expected) : void
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
            [self::IMG, 2],
            [self::HTML, 0],
        ];
    }
}
