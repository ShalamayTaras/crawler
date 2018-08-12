<?php

namespace Services;


use Interfaces\ReportBuilderInterface;

class Files
{
    const STORAGE        = './storage';
    const FILE_EXTENSION = '.html';

    public static function save(string $domain, ReportBuilderInterface $report)
    {
        file_put_contents(self::STORAGE . '/' . $domain . '_' . date('d.m.y') . self::FILE_EXTENSION , $report->build());
    }
}