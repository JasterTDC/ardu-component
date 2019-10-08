<?php


namespace ComAI\ArduComponents\WorkingCheck\Infrastructure\Repository;

use ComAI\ArduComponents\WorkingCheck\Domain\SesameCheckReaderRepositoryInterface;
use ComAI\ArduComponents\WorkingCheck\Domain\SesamePanelEmptyException;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

/**
 * Class GuzzleSesameCheckReaderRepository
 *
 * @package ComAI\ArduComponents\Sesame\Infrastructure\Repository
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
final class GuzzleSesameCheckReaderRepository
    implements SesameCheckReaderRepositoryInterface
{
    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $sesameUrl;

    /**
     * GuzzleSesameCheckReaderRepository constructor.
     *
     * @param string $sesameUrl
     */
    public function __construct(
        string $sesameUrl
    ) {
        $this->httpClient = new Client();

        $this->sesameUrl = $sesameUrl;
    }

    /**
     * @param string $userCookie
     *
     * @return string
     * @throws SesamePanelEmptyException
     */
    public function getSesamePanel(
        string $userCookie
    ) : string {
        try {
            $cookieJar = CookieJar::fromArray([
                'CakeCookie[User]' => $userCookie
            ], '.sesametime.com');

            $result = $this->httpClient->get($this->sesameUrl,[
                'cookies' => $cookieJar
            ]);

            return (string) $result->getBody();
        } catch (\Exception $e) {
            throw new SesamePanelEmptyException(
                'We could not retrieve sesame panel information',
                1
            );
        }
    }
}
