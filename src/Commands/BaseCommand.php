<?php declare( strict_types = 1 );

namespace Commands;

use Exceptions\BadUrlException;
use Services\Pages;
use Services\Url;

/**
 * Class BaseController
 * @package Controllers
 */
class BaseCommand
{

    /**
     * @param string $url
     * @return string
     */
    public function runCommand(string $url) : string
    {
        try {
            $url = Url::make($url);
        } catch (BadUrlException $exception) {
            return $exception->getMessage();
        }
        $pages = (new Pages($url));

        $start = microtime(true);

        $pages->parsePages();
        $pages->filterPages();
        $pages->sortPages();

        if ($pages->isEmpty()) {
            return 'Bad link';
        }

        $workTime = microtime(true)- $start;

        $pages->getResult($workTime);

        return 'Success';
    }
}
