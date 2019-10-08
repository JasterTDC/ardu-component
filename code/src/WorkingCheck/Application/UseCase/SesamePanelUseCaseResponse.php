<?php


namespace ComAI\ArduComponents\WorkingCheck\Application\UseCase;

/**
 * Class SesamePanelUseCaseResponse
 *
 * @package ComAI\ArduComponents\WorkingCheck\Application\UseCase
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
final class SesamePanelUseCaseResponse
{
    /**
     * @var bool
     */
    protected $success;

    /**
     * @var string|null
     */
    protected $checkStatus;

    /**
     * @var string|null
     */
    protected $workingTime;

    /**
     * @var string|null
     */
    protected $error;

    /**
     * SesamePanelUseCaseResponse constructor.
     *
     * @param bool $success
     * @param string|null $checkStatus
     * @param string|null $workingTime
     * @param string|null $error
     */
    public function __construct(
        bool $success,
        ?string $checkStatus,
        ?string $workingTime,
        ?string $error
    ) {
        $this->success = $success;
        $this->checkStatus = $checkStatus;
        $this->workingTime = $workingTime;
        $this->error = $error;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return string|null
     */
    public function getCheckStatus(): ?string
    {
        return $this->checkStatus;
    }

    /**
     * @return string|null
     */
    public function getWorkingTime(): ?string
    {
        return $this->workingTime;
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }
}
