<?php declare( strict_types = 1 );

namespace Exceptions;

/**
 * Class BadUrlException
 * @package Exceptions
 */
class BadUrlException extends \Exception
{

    /**
     * BadUrlException constructor.
     */
    public function __construct()
    {
        parent::__construct('Not validate url');
    }
}