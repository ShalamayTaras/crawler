<?php declare( strict_types = 1 );


namespace Services;


/**
 * Class Url
 * @package Services
 */
class Url
{
    private $scheme;
    private $host;
    private $port;
    private $path;
    private $query;

    /**
     * Url constructor.
     * @param string $scheme
     * @param string $host
     * @param int $port
     * @param string $path
     * @param string $query
     */
    private function __construct (string $scheme, string $host, ?integer $port, ?string $path, ?string $query)
    {
        $this->setScheme($scheme);
        $this->setHost($host);
        $this->setPort($port);
        $this->setPath($path);
        $this->setQuery($query);
    }

    /**
     * @param string $url
     * @return Url
     */
    public static function make (string $url) : self
    {

        $parseUrl = parse_url($url);

        return new self($parseUrl['scheme'], $parseUrl['host'], $parseUrl['port'], $parseUrl['path'], $parseUrl['query']);
    }

    /**
     * @return string
     */
    public function toString () : string
    {
        return $this->getScheme() . '://' . $this->getHost() . $this->getPort() . $this->getPath() . '?' . $this->getQuery();
    }

    /**
     * @param mixed $scheme
     */
    private function setScheme ($scheme) : void
    {
        $this->scheme = $scheme;
    }

    /**
     * @param mixed $host
     */
    private function setHost ($host) : void
    {
        $this->host = $host;
    }

    /**
     * @param mixed $port
     */
    private function setPort ($port) : void
    {
        $this->port = $port;
    }

    /**
     * @param mixed $path
     */
    private function setPath ($path) : void
    {
        $this->path = $path;
    }

    /**
     * @param mixed $query
     */
    private function setQuery ($query) : void
    {
        $this->query = $query;
    }

    /**
     * @return mixed
     */
    private function getScheme ()
    {
        return $this->scheme;
    }

    /**
     * @return mixed
     */
    private function getHost ()
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    private function getPort ()
    {
        return $this->port;
    }

    /**
     * @return mixed
     */
    private function getPath ()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    private function getQuery ()
    {
        return $this->query;
    }
}