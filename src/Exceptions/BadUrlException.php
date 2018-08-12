<?php

namespace Exceptions;

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