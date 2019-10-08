<?php


namespace ComAI\ArduComponents\WorkingCheck\Application\UseCase;

/**
 * Class SesamePanelUseCaseArgument
 *
 * @package ComAI\ArduComponents\WorkingCheck\Application\UseCase
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
final class SesamePanelUseCaseArgument
{

    /**
     * @var string
     */
    protected $userData;

    /**
     * SesamePanelUseCaseArgument constructor.
     *
     * @param string $userData
     */
    public function __construct(string $userData)
    {
        $this->userData = $userData;
    }

    /**
     * @return string
     */
    public function getUserData(): string
    {
        return $this->userData;
    }
}
