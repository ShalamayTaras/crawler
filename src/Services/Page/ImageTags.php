<?php declare( strict_types = 1 );


namespace Services\Page;


/**
 * Class ImageTag
 * @package Services\Page
 */
class ImageTags
{
    private CONST PATTERN = '/<img(?P<img>).*\/?>/mi';

    /**
     * @param string $pageData
     * @return int
     */
    public static function getImgCount (string $pageData) : int
    {
        preg_match_all(self::PATTERN, $pageData, $links);

        return count($links['img']);
    }

}