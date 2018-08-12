<?php declare( strict_types = 1 );

namespace Exceptions;

/**
 * Class CanNotGetContentException
 * @package Exceptions
 */
class CanNotGetContentException extends \Exception
{

    /**
     * BadUrlException constructor.
     */
    public function __construct()
    {
        parent::__construct('Can n\'t get content');
    }
}
