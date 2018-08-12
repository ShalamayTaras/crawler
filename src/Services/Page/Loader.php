<?php declare( strict_types = 1 );

namespace Services\Page;

use Exceptions\BadUrlException;
use Services\Url;

/**
 * Class PageLoader
 */
class Loader
{

    /**
     * @param string $url
     * @param int $depth
     * @return null|Page
     */
    public function load (string $url, int $depth) : ?Page
    {
        try {
            $pageUrl = Url::make($url);
        } catch (BadUrlException $exception) {
            return null;
        }
        $startTime = microtime(true);
        $pageData  = $this->loadPage($pageUrl->toString());

        if ($pageData === false)
            return null;

        $loadTime = microtime(true) - $startTime;
        $imgCount = ImageTags::getImgCount($pageData);
        $links    = Links::getLinks($pageData, $pageUrl);

        $page = ( new Page() )
            ->setUrl($url)
            ->setLoadTime($loadTime)
            ->setImgCount($imgCount)
            ->setDepth($depth)
            ->setLinks(Links::filterLinks($links, $pageUrl->getHost()));

        return $page;
    }

    /**
     * @param string $url
     * @return null|string
     */
    public function loadPage (string $url) :?string
    {
        return file_get_contents($url);
    }
}