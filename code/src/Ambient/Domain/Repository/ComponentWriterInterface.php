<?php


namespace ComAI\ArduComponents\Ambient\Domain\Repository;

use ComAI\ArduComponents\Ambient\Domain\Entity\Ambient;
use ComAI\ArduComponents\Ambient\Domain\Exception\AmbientPersistenceException;

/**
 * Interface ComponentWriterInterface
 *
 * @package ComAI\ArduComponents\Ambient\Domain\Repository
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
interface ComponentWriterInterface
{

    /**
     * @param Ambient $ambient
     *
     * @return Ambient
     * @throws AmbientPersistenceException
     */
    public function persist(
        Ambient $ambient
    ) : Ambient;
}
