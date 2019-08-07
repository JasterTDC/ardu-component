<?php


namespace ComAI\ArduComponents\Ambient\Domain\Factory;

use ComAI\ArduComponents\Ambient\Domain\Entity\Ambient;

/**
 * Interface AmbientFactoryInterface
 *
 * @package ComAI\ArduComponents\Ambient\Domain\Factory
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
interface AmbientFactoryInterface
{
    /**
     * @param int|null $id
     * @param float $temperature
     * @param float $humidity
     * @param string|null $createdAt
     *
     * @return Ambient
     * @throws \Exception
     */
    public function create(
        ?int $id,
        float $temperature,
        float $humidity,
        ?string $createdAt
    ) : Ambient;
}
