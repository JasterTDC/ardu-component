<?php


namespace ComAI\ArduComponents\Sesame\Infrastructure\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class SesameController
 *
 * @package ComAI\ArduComponents\Sesame\Infrastructure\Controller
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
class SesameController
{

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * SesameController constructor.
     */
    public function __construct()
    {
        $this->httpClient = new Client([
            'cookies' => false
        ]);
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
            'status' => 0
        ];

        try {
            $params = $request->getQueryParams();

            if (empty($params['userCookie'])) {
                $response = $response->withHeader('Content-type', 'application/json');
                $response->getBody()->write((string) json_encode($ret));

                return $response->withStatus(200);
            }

            $cookieJar = CookieJar::fromArray([
                'CakeCookie[User]' => $params['userCookie']
            ], '.sesametime.com');

            $result = $this->httpClient->get('https://panel.sesametime.com',[
                'cookies' => $cookieJar
            ]);

            $html = (string) $result->getBody();

            if (preg_match('/(Check IN)/', $html)) {
                $ret['status'] = 1;
            }

            if (preg_match('/(Check OUT)/', $html)) {
                $ret['status'] = 2;
            }

            $response = $response->withHeader('Content-type', 'application/json');
            $response->getBody()->write((string) json_encode($ret));

            return $response->withStatus(200);
        } catch (\Exception $e) {
            $response = $response->withHeader('Content-type', 'application/json');
            $response->getBody()->write((string) json_encode($ret));

            return $response->withStatus(200);
        }
    }
}
