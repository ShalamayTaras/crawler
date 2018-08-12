<?php declare( strict_types = 1 );

namespace Interfaces;

/**
 * Interface ReportBuilderInterface
 * @package Interfaces
 */
interface ReportBuilderInterface
{
    /**
     * @return string
     */
    public function build() : string;
}
