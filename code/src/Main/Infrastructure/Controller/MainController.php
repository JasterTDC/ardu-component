<?php


namespace ComAI\ArduComponents\Main\Infrastructure\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class MainController
 *
 * @package ComAI\ArduComponents\Main\Infrastructure\Controller
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
class MainController
{

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
        $response = $response->withAddedHeader(
            'Content-type',
            'application/json'
        );
        $response->getBody()->write((string) json_encode([
            'success'   => true,
            'data'      => [
                'page'  => 'main'
            ]
        ]));

        return $response->withStatus(200);
    }
}
