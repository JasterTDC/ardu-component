<?php


namespace ComAI\ArduComponents\Ambient\Infrastructure\Controller;

use ComAI\ArduComponents\Ambient\Application\UseCase\RegisterAmbientUseCase;
use ComAI\ArduComponents\Ambient\Application\UseCase\RegisterAmbientUseCaseArgument;
use ComAI\ArduComponents\Ambient\Infrastructure\DataTransformer\RegisterAmbientDataTransformer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class RegisterAmbientController
 *
 * @package ComAI\ArduComponents\Ambient\Infrastructure\Controller
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
class RegisterAmbientController
{
    /**
     * @var RegisterAmbientUseCase
     */
    protected $registerAmbientUseCase;

    /**
     * RegisterAmbientController constructor.
     *
     * @param RegisterAmbientUseCase $registerAmbientUseCase
     */
    public function __construct(
        RegisterAmbientUseCase $registerAmbientUseCase
    ) {
        $this->registerAmbientUseCase = $registerAmbientUseCase;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) : ResponseInterface {
        $ret = [
            'success'   => false
        ];

        $parameters = json_decode($request->getBody(), true);

        if (empty($parameters['temperature'])) {
            $ret['message'] = 'Temperature is missing';

            $response = $response->withHeader('Content-type', 'application/json');

            $response->getBody()->write((string) json_encode($ret));

            return $response->withStatus(400);
        }

        if (empty($parameters['humidity'])) {
            $ret['message'] = 'Humidity is missing';

            $response = $response->withHeader('Content-type', 'application/json');

            $response->getBody()->write((string) json_encode($ret));

            return $response->withStatus(400);
        }

        $argument = new RegisterAmbientUseCaseArgument(
            $parameters['temperature'],
            $parameters['humidity']
        );

        $useCaseResponse = $this->registerAmbientUseCase->handle(
            $argument
        );

        $dataTransformer = new RegisterAmbientDataTransformer();

        $useCaseResponseArr = $dataTransformer->getResponseAsArray(
            $useCaseResponse
        );

        $response = $response->withHeader('Content-type', 'application/json');

        $response->getBody()->write((string) json_encode($useCaseResponseArr));

        if ($useCaseResponse->success()) {
            return $response->withStatus(200);
        }

        return $response->withStatus(500);
    }
}
