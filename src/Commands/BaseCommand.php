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
    const SUCCESS  = 'Success';
    const BAD_LINK = 'Bad link';

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
            return self::BAD_LINK;
        }

        $workTime = microtime(true)- $start;

        $pages->getResult($workTime);

        return self::SUCCESS;
    }
}
