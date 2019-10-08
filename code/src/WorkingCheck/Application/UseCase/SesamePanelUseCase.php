<?php


namespace ComAI\ArduComponents\WorkingCheck\Application\UseCase;

use ComAI\ArduComponents\WorkingCheck\Domain\SesameCheckReaderRepositoryInterface;
use ComAI\ArduComponents\WorkingCheck\Domain\SesameParserInterface;
use ComAI\ArduComponents\WorkingCheck\Infrastructure\Parser\SesameHtmlParser;

/**
 * Class SesamePanelUseCase
 *
 * @package ComAI\ArduComponents\WorkingCheck\Application\UseCase
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
final class SesamePanelUseCase
{
    /**
     * @var SesameCheckReaderRepositoryInterface
     */
    protected $sesameCheckReaderRepository;

    /**
     * @var SesameParserInterface
     */
    protected $sesameParser;

    /**
     * SesamePanelUseCase constructor.
     *
     * @param SesameCheckReaderRepositoryInterface $sesameCheckReaderRepository
     */
    public function __construct(
        SesameCheckReaderRepositoryInterface $sesameCheckReaderRepository
    ) {
        $this->sesameCheckReaderRepository = $sesameCheckReaderRepository;
    }

    /**
     * @param SesamePanelUseCaseArgument $argument
     *
     * @return SesamePanelUseCaseResponse
     */
    public function handle(
        SesamePanelUseCaseArgument $argument
    ) : SesamePanelUseCaseResponse {
        try {
            $panelContent = $this
                ->sesameCheckReaderRepository
                ->getSesamePanel($argument->getUserData());

            $this->sesameParser = new SesameHtmlParser($panelContent);

            $checkStatus = $this
                ->sesameParser
                ->getCheckStatus();

            $workedTime = $this
                ->sesameParser
                ->getWorkedTime();

            return new SesamePanelUseCaseResponse(
                true,
                $checkStatus,
                $workedTime,
                null
            );
        } catch (\Exception $e) {
            return new SesamePanelUseCaseResponse(
                false,
                null,
                null,
                $e->getMessage()
            );
        }
    }
}
