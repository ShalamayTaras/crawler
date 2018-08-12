<?php

namespace Controllers;

use Exceptions\BadUrlException;
use Services\Pages;
use Services\Url;

class BaseController
{

    public function runCommand(string $url)
    {
        try{
            $url = Url::make($url);

        }
        catch (BadUrlException $exception)
        {
            return $exception->getMessage();
        }

        $pages = (new Pages($url));

        $start = microtime(true);

        $pages->parsePages();
        $pages->filterPages();
        $pages->sortPages();

        if ($pages->isEmpty())
            return 'Bad link';

        $workTime = microtime(true)- $start;

        $pages->getResult($workTime);

        return 'Success';

    }
   }