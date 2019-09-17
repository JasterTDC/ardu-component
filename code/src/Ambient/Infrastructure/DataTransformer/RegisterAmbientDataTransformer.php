<?php


namespace ComAI\ArduComponents\Ambient\Infrastructure\DataTransformer;

use ComAI\ArduComponents\Ambient\Application\UseCase\RegisterAmbientUseCaseResponse;

/**
 * Class RegisterAmbientDataTransformer
 *
 * @package ComAI\ArduComponents\Ambient\Infrastructure\DataTransformer
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
class RegisterAmbientDataTransformer
{

    public function getResponseAsArray(
        RegisterAmbientUseCaseResponse $response
    ) : array {
        $ret['success'] = $response->success();

        if (!empty($response->error())) {
            $ret['error'] = $response->error();
        }

        return $ret;
    }
}
