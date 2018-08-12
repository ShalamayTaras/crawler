<?php declare( strict_types = 1 );

namespace Services\Page;

/**
 * Class ImageTag
 * @package Services\Page
 */
class ImageTags
{
    private const PATTERN = '/<img(?P<img>)/mi';

    /**
     * @param string $pageData
     * @return int
     */
    public static function getImgCount(string $pageData) : int
    {
        preg_match_all(self::PATTERN, $pageData, $result);

        return count($result['img']);
    }
}
