<?php declare( strict_types = 1 );

namespace Services\Page;

use Exceptions\BadUrlException;
use Interfaces\UrlInterface;
use Services\Url;

/**
 * Class Links
 * @package Services\Page
 */
class Links
{
    const PATTERN = '/<a.*?href="(?P<links>[^"]*)".*?\/?>/                                                                                                   mi';

    /**
     * @param string $pageData
     * @param UrlInterface $pageUrl
     * @return array
     */
    public static function getLinks (string $pageData, UrlInterface $pageUrl) : array
    {
        preg_match_all(self::PATTERN, $pageData, $result);

        $links = $result['links'];

        return self::prepareLinks($links, $pageUrl);
    }

    /**
     * @param array $links
     * @param UrlInterface $pageUrl
     * @return array
     */
    private static function prepareLinks (array $links, UrlInterface $pageUrl) : array
    {
        foreach ($links as $key => $link) {
            /** @var Url $url */
            $url = Url::make($link);

            self::prepareScheme($url, $pageUrl);
            self::prepareHost($url, $pageUrl);
            self::preparePath($url);

            if (! $url->isValidate())
                unset($links[ $key ]);
            else
                $links[ $key ] = $url->toString();
        }

        return $links;
    }

    /**
     * @param Url $url
     */
    public static function preparePath (Url $url) : void
    {
        if (! is_null($url->getPath())) {
            if (strpos($url->getPath(), '/') !== 0)
                $url->setPath('/' . $url->getPath());

            if (strripos($url->getPath(), '/') === strlen($url->getPath()) - 1)
                $url->setPath(substr($url->getPath(), 0, strlen($url->getPath()) - 1));
        }
    }

    /**
     * @param UrlInterface $url
     * @param UrlInterface $pageUrl
     */
    public static function prepareHost (UrlInterface $url, UrlInterface $pageUrl) : void
    {
        if (is_null($url->getHost()))
            $url->setHost($pageUrl->getHost());
    }

    /**
     * @param UrlInterface $url
     * @param UrlInterface $pageUrl
     */
    public static function prepareScheme (UrlInterface $url, UrlInterface $pageUrl) : void
    {
        if (is_null($url->getScheme()))
            $url->setScheme($pageUrl->getScheme());
    }

    /**
     * @param array $links
     * @param string $siteDomain
     * @return array
     */
    public static function filterLinks (array $links, string $siteDomain) : array
    {
        return array_filter($links, function($link) use ($siteDomain) {
            try {
                /** @var URL $url */
                $url = Url::make($link);
            } catch (BadUrlException $exception) {
                return false;
            }
            return ( $url->getHost() === $siteDomain ) ? $link : false;
        });
    }
}