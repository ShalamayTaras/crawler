<?php declare( strict_types = 1 );

namespace Services\Report;

use Interfaces\ReportBuilderInterface;
use Services\Page\Page;

/**
 * Class ReportBuilder
 * @package Services\Report
 */
class ReportBuilder implements ReportBuilderInterface
{
    private $html;
    private $pages;
    private $loadTime;

    /**
     * @return string
     */
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

    /**
     * Start document tags
     */
    public function buildStartTags()
    {
        $this->html .= Tags::HTML_START . Tags::BODY_START . TAGS::TABLE_START;
    }

    /**
     * End document tags
     */
    public function buildEndTags()
    {
        $this->html .= TAGS::TABLE_END . Tags::BODY_END . Tags::HTML_END;
    }

    /**
     * Build first line for table where headers
     */
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

    /**
     * Build last line for table where additional information
     */
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

    /**
     * @param array $texts
     */
    public function buildTr(array $texts)
    {
        $trTag = Tags::TR_START;

        foreach ($texts as $text)
            $trTag .= $this->buildTd($text);

        $this->html .= $trTag . Tags::TR_END;
    }

    /**
     * @param string $text
     * @return string
     */
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