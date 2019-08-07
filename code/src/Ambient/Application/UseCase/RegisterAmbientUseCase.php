<?php


namespace ComAI\ArduComponents\Ambient\Application\UseCase;

use ComAI\ArduComponents\Ambient\Domain\Factory\AmbientFactoryInterface;
use ComAI\ArduComponents\Ambient\Domain\Repository\ComponentWriterInterface;

/**
 * Class RegisterAmbientUseCase
 *
 * @package ComAI\ArduComponents\Ambient\Application\UseCase
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
final class RegisterAmbientUseCase
{

    /**
     * @var ComponentWriterInterface
     */
    protected $componentWriter;

    /**
     * @var AmbientFactoryInterface
     */
    protected $ambientFactory;

    /**
     * RegisterAmbientUseCase constructor.
     *
     * @param ComponentWriterInterface $componentWriter
     * @param AmbientFactoryInterface $ambientFactory
     */
    public function __construct(
        ComponentWriterInterface $componentWriter,
        AmbientFactoryInterface $ambientFactory
    ) {
        $this->componentWriter = $componentWriter;
        $this->ambientFactory = $ambientFactory;
    }

    /**
     * @param RegisterAmbientUseCaseArgument $argument
     *
     * @return RegisterAmbientUseCaseResponse
     */
    public function handle(
        RegisterAmbientUseCaseArgument $argument
    ) : RegisterAmbientUseCaseResponse {
        try {
            $ambient = $this->ambientFactory->create(
                null,
                $argument->temperature(),
                $argument->humidity(),
                null
            );

            $ambient = $this->componentWriter->persist($ambient);

            return new RegisterAmbientUseCaseResponse(
                true,
                null,
                $ambient
            );
        } catch (\Exception $e) {
            return new RegisterAmbientUseCaseResponse(
                false,
                null,
                null
            );
        }
    }
}
