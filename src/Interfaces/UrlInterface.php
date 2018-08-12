<?php

namespace Interfaces;

interface UrlInterface
{
    public static function make(string $url): ?self;
    public function toString(): string;
    public function getHost(): ?string;
    public function getScheme(): ?string;
    public function setScheme(string $scheme);
    public function setHost(string $host);

}