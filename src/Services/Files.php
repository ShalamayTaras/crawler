<?php declare( strict_types = 1 );

namespace Services;


use Interfaces\ReportBuilderInterface;

/**
 * Class Files
 * @package Services
 */
class Files
{
    const STORAGE        = './storage';
    const FILE_EXTENSION = '.html';

    /**
     * @param string $domain
     * @param ReportBuilderInterface $report
     */
    public static function save (string $domain, ReportBuilderInterface $report) : void
    {
        file_put_contents(self::STORAGE . '/' . $domain . '_' . date('d.m.y') . self::FILE_EXTENSION , $report->build());
    }
}