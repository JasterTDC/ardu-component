<?php


namespace ComAI\ArduComponents\Ambient\Infrastructure\Factory;

use ComAI\ArduComponents\Ambient\Domain\Entity\Ambient;
use ComAI\ArduComponents\Ambient\Domain\Factory\AmbientFactoryInterface;

/**
 * Class AmbientFactory
 *
 * @package ComAI\ArduComponents\Ambient\Infrastructure\Factory
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
class AmbientFactory implements AmbientFactoryInterface
{

    /**
     * @var string
     */
    protected $dateFormat;

    /**
     * AmbientFactory constructor.
     *
     * @param string $dateFormat
     */
    public function __construct(
        string $dateFormat
    ) {
        $this->dateFormat = $dateFormat;
    }

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
    ) : Ambient {
        $created = new \DateTime();

        if (!empty($createdAt)) {
            $created = \DateTime::createFromFormat(
                $this->dateFormat,
                $createdAt
            );
        }

        return new Ambient(
            $id,
            $temperature,
            $humidity,
            $created
        );
    }
}
