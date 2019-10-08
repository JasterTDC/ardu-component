<?php


namespace ComAI\ArduComponents\WorkingCheck\Domain;

/**
 * Interface SesameParser
 *
 * @package ComAI\ArduComponents\WorkingCheck\Infrastructure\Parser
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
interface SesameParserInterface
{
    /**
     * @return string
     * @throws CheckButtonEmptyException
     */
    public function getCheckStatus() : string;

    /**
     * @return string
     * @throws WorkedTimeEmptyException
     */
    public function getWorkedTime() : string;
}
