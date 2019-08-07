<?php


namespace ComAI\ArduComponents\Ambient\Application\UseCase;

use ComAI\ArduComponents\Ambient\Domain\Entity\Ambient;

/**
 * Class RegisterAmbientUseCaseResponse
 *
 * @package ComAI\ArduComponents\Ambient\Application\UseCase
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
final class RegisterAmbientUseCaseResponse
{
    /**
     * @var bool
     */
    protected $success;

    /**
     * @var string|null
     */
    protected $error;

    /**
     * @var Ambient|null
     */
    protected $ambient;

    /**
     * RegisterAmbientUseCaseResponse constructor.
     *
     * @param bool $success
     * @param string|null $error
     * @param Ambient|null $ambient
     */
    public function __construct(
        bool $success,
        ?string $error,
        ?Ambient $ambient
    ) {
        $this->success = $success;
        $this->error = $error;
        $this->ambient = $ambient;
    }

    /**
     * @return bool
     */
    public function success(): bool
    {
        return $this->success;
    }

    /**
     * @return string|null
     */
    public function error(): ?string
    {
        return $this->error;
    }

    /**
     * @return Ambient|null
     */
    public function ambient(): ?Ambient
    {
        return $this->ambient;
    }
}
