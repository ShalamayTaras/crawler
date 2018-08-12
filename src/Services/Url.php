<?php declare(strict_types=1);

namespace Services;

use Exceptions\BadUrlException;
use Interfaces\UrlInterface;

/**
 * Class Url
 * @package Services
 */
class Url implements UrlInterface
{
    private $scheme;
    private $host;
    private $port;
    private $path;
    private $query;
    const SEPARATOR = '://';

    /**
     * Url constructor.
     * @param string $scheme
     * @param string $host
     * @param int $port
     * @param string $path
     * @param string $query
     */
    private function __construct(?string $scheme, ?string $host, ?int $port, ?string $path, ?string $query)
    {
        $this->setScheme($scheme);
        $this->setHost($host);
        $this->setPort($port);
        $this->setPath($path);
        $this->setQuery($query);
    }

    /**
     * @return bool
     */
    public function isValidate(): bool
    {
        if (empty($this->getPath()))
            return false;


        switch ($this->getScheme()) {
            case 'http':
            case 'https':
                return true;
            default:
                return false;
        }
    }

    /**
     * @param string $url
     * @return UrlInterface|null
     * @throws BadUrlException
     */
    public static function make(string $url) : ?UrlInterface
    {
        $parseUrl = parse_url($url);

        try {
            return new self($parseUrl['scheme'], $parseUrl['host'], $parseUrl['port'], $parseUrl['path'], $parseUrl['query']);
        } catch (\Throwable $exception) {
            throw new BadUrlException();
        }

    }

    /**
     * @return string
     */
    public function toString(): string
    {
        $string =  $this->getScheme() . self::SEPARATOR . $this->getHost() . $this->getPort() . $this->getPath();

        if ($this->getQuery())
            $string .=  '?' . $this->getQuery();

        return $string;
    }

    /**
     * @param mixed $scheme
     */
    public function setScheme(?string $scheme): void
    {
        $this->scheme = $scheme;
    }

    /**
     * @param mixed $host
     */
    public function setHost(?string $host): void
    {
        $this->host = $host;
    }

    /**
     * @param mixed $port
     */
    private function setPort($port): void
    {
        $this->port = $port;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * @param mixed $query
     */
    private function setQuery($query): void
    {
        $this->query = $query;
    }

    /**
     * @return mixed
     */
    public function getScheme() : ?string
    {
        return $this->scheme;
    }

    /**
     * @return mixed
     */
    public function getHost() : ?string
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    private function getPort() : ?int
    {
        return $this->port;
    }

    /**
     * @return mixed
     */
    public function getPath() : ?string
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    private function getQuery() : ?string
    {
        return $this->query;
    }
}