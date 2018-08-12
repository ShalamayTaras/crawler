<?php declare( strict_types = 1 );

namespace Tests;

use PHPUnit\Framework\TestCase;


/**
 * Class ImageTagsTest
 */
class ImageTagsTest extends TestCase
{
    public function testGetImgCount()
    {
        $imgCount = \Services\Page\ImageTags::getImgCount(self::getTextWithImgTags());

        static::assertEquals($imgCount, 2);

        $imgCount = \Services\Page\ImageTags::getImgCount(self::getTextWithOutImgTags());

        static::assertEquals($imgCount, 0);
    }


    /**
     * @return string
     */
    public static function getTextWithImgTags()
    {
        return '<img> <img>';
    }

    /**
     * @return string
     */
    public static function getTextWithOutImgTags()
    {
        return 'html';
    }
}
