<?php


namespace ComAI\ArduComponents\WorkingCheck\Domain;

/**
 * Interface SesameCheckReaderRepositoryInterface
 *
 * @package ComAI\ArduComponents\WorkingCheck\Infrastructure\Repository
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
interface SesameCheckReaderRepositoryInterface
{
    /**
     * @param string $userCookie
     *
     * @return string
     * @throws SesamePanelEmptyException
     */
    public function getSesamePanel(
        string $userCookie
    ) : string;
}
