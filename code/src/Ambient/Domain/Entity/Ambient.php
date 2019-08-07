<?php


namespace ComAI\ArduComponents\Ambient\Domain\Entity;

/**
 * Class Ambient
 *
 * @package ComAI\ArduComponents\Ambient\Domain\Entity
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
class Ambient
{

    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var float
     */
    protected $temperature;

    /**
     * @var float
     */
    protected $humidity;

    /**
     * @var \DateTime|null
     */
    protected $createdAt;

    /**
     * Ambient constructor.
     *
     * @param int|null $id
     * @param float $temperature
     * @param float $humidity
     * @param \DateTime|null $createdAt
     */
    public function __construct(
        ?int $id,
        float $temperature,
        float $humidity,
        ?\DateTime $createdAt
    ) {
        $this->id = $id;
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->createdAt = $createdAt;
    }

    /**
     * @return int|null
     */
    public function id(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return float
     */
    public function temperature(): float
    {
        return $this->temperature;
    }

    /**
     * @param float $temperature
     */
    public function setTemperature(float $temperature): void
    {
        $this->temperature = $temperature;
    }

    /**
     * @return float
     */
    public function humidity(): float
    {
        return $this->humidity;
    }

    /**
     * @param float $humidity
     */
    public function setHumidity(float $humidity): void
    {
        $this->humidity = $humidity;
    }

    /**
     * @return \DateTime|null
     */
    public function createdAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     */
    public function setCreatedAt(?\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
