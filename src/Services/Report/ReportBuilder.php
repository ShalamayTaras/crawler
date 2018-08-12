<?php

namespace Services\Report;

use Interfaces\ReportBuilderInterface;
use Services\Page\Page;

class ReportBuilder implements ReportBuilderInterface
{
    private $html;
    private $pages;
    private $loadTime;

    public function build() : string
    {
        $this->buildStartTags();
        $this->buildTableHeader();

        foreach ($this->pages as $page){
            if ($page instanceof Page)
            /** @var PAGE $page */
                $this->buildTr($page->toArray());
        }

        $this->buildTableFooter();

        $this->buildEndTags();

        return $this->html;

    }

    public function buildStartTags()
    {
        $this->html .= Tags::HTML_START . Tags::BODY_START . TAGS::TABLE_START;
    }

    public function buildEndTags()
    {
        $this->html .= TAGS::TABLE_END . Tags::BODY_END . Tags::HTML_END;
    }

    public function buildTableHeader()
    {
        $texts = [
            Words::URL,
            Words::IMAGE_COUNT,
            Words::DEPTH,
            Words::LOAD_TIME
        ];

        $this->buildTr($texts);
    }

    public function buildTableFooter()
    {
        $texts = [
            Words::LINK_COUNT,
            count($this->pages),
            Words::LOAD_TIME,
            sprintf(Words::SECONDS, $this->loadTime)
        ];

        $this->buildTr($texts);
    }

    public function buildTr(array $texts)
    {
        $tr = Tags::TR_START;

        foreach ($texts as $text)
            $tr .= $this->buildTd($text);

        $this->html .= $tr . Tags::TR_END;
    }

    public function buildTd(string $text)
    {
        return Tags::TD_START . $text . Tags::TD_END;
    }

    /**
     * @param mixed $pages
     * @return $this
     */
    public function setPages($pages)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * @param mixed $loadTime
     * @return $this
     */
    public function setLoadTime($loadTime)
    {
        $this->loadTime = $loadTime;

        return $this;
    }


}