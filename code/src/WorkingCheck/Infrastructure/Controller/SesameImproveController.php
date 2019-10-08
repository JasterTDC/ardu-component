<?php


namespace ComAI\ArduComponents\WorkingCheck\Infrastructure\Controller;

use ComAI\ArduComponents\WorkingCheck\Application\UseCase\SesamePanelUseCase;
use ComAI\ArduComponents\WorkingCheck\Application\UseCase\SesamePanelUseCaseArgument;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class SesameImproveController
 *
 * @package ComAI\ArduComponents\Sesame\Infrastructure\Controller
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
final class SesameImproveController
{

    /**
     * @var SesamePanelUseCase
     */
    protected $sesamePanelUseCase;

    /**
     * SesameImproveController constructor.
     *
     * @param SesamePanelUseCase $sesamePanelUseCase
     */
    public function __construct(
        SesamePanelUseCase $sesamePanelUseCase
    ){
        $this->sesamePanelUseCase = $sesamePanelUseCase;
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
            'success'   => true,
            'status'    => 0
        ];

        $params = $request->getQueryParams();

        $response = $response->withHeader(
            'Content-type',
            'application/json'
        );

        if (empty($params['userCookie'])){
            $ret['success'] = false;
            $ret['error'] = 'User cookie information cannot be empty';

            $response->getBody()->write((string) json_encode($ret));

            return $response->withStatus(400);
        }

        $arguments = new SesamePanelUseCaseArgument(
            (string) $params['userCookie']
        );

        $useCaseResponse = $this
            ->sesamePanelUseCase
            ->handle($arguments);

        if (!$useCaseResponse->isSuccess()){
            $ret['success'] = false;
            $ret['error'] = $useCaseResponse->getError();

            $response->getBody()->write((string) json_encode($ret));

            return $response->withStatus(400);
        }
        $ret['workingTime'] = $useCaseResponse->getWorkingTime();

        if ('Check IN' === $useCaseResponse->getCheckStatus()) {
            $ret['status'] = 1;
        }

        if ('Check OUT' === $useCaseResponse->getCheckStatus()) {
            $ret['status'] = 2;
        }

        $response->getBody()->write((string) json_encode($ret));

        return $response->withStatus(200);
    }
}
