<?php declare( strict_types = 1 );

namespace Interfaces;

/**
 * Interface UrlInterface
 * @package Interfaces
 */
interface UrlInterface
{

    /**
     * @param string $url
     * @return UrlInterface|null
     */
    public static function make(string $url) : ?self;

    /**
     * @return string
     */
    public function toString() : string;

    /**
     * @return null|string
     */
    public function getHost() : ?string;

    /**
     * @return null|string
     */
    public function getScheme() : ?string;

    /**
     * @param string $scheme
     * @return mixed
     */
    public function setScheme(string $scheme) : void;

    /**
     * @param string $host
     * @return mixed
     */
    public function setHost(string $host) : void;

    /**
     * @return bool
     */
    public function isValidate() : bool;
}
