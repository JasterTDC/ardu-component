<?php


namespace ComAI\ArduComponents\Ambient\Application\UseCase;

/**
 * Class RegisterAmbientUseCaseArgument
 *
 * @package ComAI\ArduComponents\Ambient\Application\UseCase
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
final class RegisterAmbientUseCaseArgument
{
    /**
     * @var float
     */
    protected $temperature;

    /**
     * @var float
     */
    protected $humidity;

    /**
     * RegisterAmbientUseCaseArgument constructor.
     *
     * @param float $temperature
     * @param float $humidity
     */
    public function __construct(
        float $temperature,
        float $humidity
    ) {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
    }

    /**
     * @return float
     */
    public function temperature(): float
    {
        return $this->temperature;
    }

    /**
     * @return float
     */
    public function humidity(): float
    {
        return $this->humidity;
    }
}
