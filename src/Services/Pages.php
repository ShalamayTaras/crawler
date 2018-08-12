<?php

namespace Services;


use Interfaces\UrlInterface;
use Services\Page\Loader;
use Services\Page\Page;
use Services\Report\ReportBuilder;

class Pages
{
    public $pages;
    public $domain;
    private $depth = 0;

    /**
     * Pages constructor.
     * @param UrlInterface $link
     */
    public function __construct(UrlInterface $link)
    {
        $this->pages[$link->toString()] = null;
        $this->domain = $link->getHost();
    }

    public function parsePages()
    {
        foreach ($this->pages as $link => $page) {
            if ($page === false || ! is_null($page)) {
                continue;
            }
            $page = (new Loader)->load($link, $this->depth);

            if ($page === false) {
                $this->pages[$link] = false;
                continue;
            }

            $this->pages[$link] = $page;

            foreach ($page->getLinks() as $link) {
                if (key_exists($link, $this->pages) === false)
                    $this->pages[$link] = null;
            }
        }

        if (count(array_filter($this->pages, function ($page) {
                return !is_null($page);
            })) !== count($this->pages)) {
            $this->depth++;
            $this->parsePages();
        }
    }

    public function sortPages()
    {
        uasort($this->pages, function(Page $firstElement,Page $secondElement){
            return (int)$firstElement->getImgCount() <=> (int)$secondElement->getImgCount();
        });
    }

    public function filterPages()
    {
        $this->pages = array_filter($this->pages, function($element){
            return $element;
        });
    }


    public function getResult(float $time) : string
    {
        $report = new ReportBuilder();
        $report->setPages($this->pages)->setLoadTime($time);

        Files::save($this->domain, $report);
        return $report->build();
    }

    public function isEmpty() : bool
    {
        return empty($this->pages);
    }
}