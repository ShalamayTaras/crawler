<?php declare( strict_types = 1 );

namespace Services\Page;

/**
 * Class Page
 * @package Services\Page
 */
class Page
{
    private $url;
    private $imgCount;
    private $depth;
    private $loadTime;
    private $links;

    /**
     * @return string
     */
    public function getUrl() : string
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return $this
     */
    public function setUrl(string $url) : Page
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            $this->getUrl(),
            $this->getImgCount(),
            $this->getDepth(),
            $this->getLoadTime(),
        ];
    }

    /**
     * @return int|null
     */
    public function getImgCount() :?int
    {
        return $this->imgCount;
    }

    /**
     * @param mixed $imgCount
     * @return Page
     */
    public function setImgCount($imgCount) : Page
    {
        $this->imgCount = $imgCount;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDepth() :?int
    {
        return $this->depth;
    }

    /**
     * @param mixed $depth
     * @return Page
     */
    public function setDepth(int $depth) : Page
    {
        $this->depth = $depth;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLoadTime() : ?float
    {
        return $this->loadTime;
    }

    /**
     * @param mixed $loadTime
     * @return Page
     */
    public function setLoadTime(float $loadTime) : Page
    {
        $this->loadTime = round($loadTime, 2);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLinks() : array
    {
        return $this->links;
    }

    /**
     * @param mixed $links
     * @return $this
     */
    public function setLinks(array $links) : Page
    {
        $this->links = $links;

        return $this;
    }
}
