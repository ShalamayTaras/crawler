<?php declare(strict_types = 1);


namespace Tests;

use Commands\BaseCommand;
use PHPUnit\Framework\TestCase;

/**
 * Class BaseCommandTest
 * @package Tests
 */
class BaseCommandTest extends TestCase
{
    /**
     * @var string
     */
    const GOOD_URL = 'https://google.com.ua';

    /**
     * @var string
     */
    const BAD_URL = 'google.com.ua';

    /**
     * @var string
     */
    const SUCCESS = 'Success';

    /**
     * @var string
     */
    const BAD_LINK = 'Bad link';

    /**
     *
     */
    public function testRunSuccess() : void
    {
        $command = new BaseCommand();
        $result  = $command->runCommand(self::GOOD_URL);

        self::assertContains(self::SUCCESS, $result);
    }

    /**
     *
     */
    public function testRunFail() : void
    {
        $command = new BaseCommand();
        $result  = $command->runCommand(self::BAD_URL);

        self::assertContains(self::BAD_LINK, $result);
    }
}
