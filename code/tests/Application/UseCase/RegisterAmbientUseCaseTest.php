<?php


namespace ComAI\ArduComponents\Tests\Application\UseCase;

use ComAI\ArduComponents\Ambient\Application\UseCase\RegisterAmbientUseCase;
use ComAI\ArduComponents\Ambient\Application\UseCase\RegisterAmbientUseCaseArgument;
use ComAI\ArduComponents\Ambient\Domain\Entity\Ambient;
use ComAI\ArduComponents\Ambient\Domain\Exception\AmbientPersistenceException;
use ComAI\ArduComponents\Ambient\Domain\Factory\AmbientFactoryInterface;
use ComAI\ArduComponents\Ambient\Domain\Repository\ComponentWriterInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class RegisterAmbientUseCaseTest
 *
 * @package ComAI\ArduComponents\Tests\Application\UseCase
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
class RegisterAmbientUseCaseTest extends TestCase
{

    protected $componentWriter;

    protected $ambientFactory;

    public function setUp(): void
    {
        parent::setUp();

        $this->componentWriter = $this->getMockBuilder(ComponentWriterInterface::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disallowMockingUnknownTypes()
            ->disableArgumentCloning()
            ->getMock();

        $this->ambientFactory = $this->getMockBuilder(AmbientFactoryInterface::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disallowMockingUnknownTypes()
            ->disableArgumentCloning()
            ->getMock();
    }

    public function testIfRegisterAmbientIsOk()
    {
        $ambient = new Ambient(
            1,
            33.10,
            75.20,
            new \DateTime()
        );

        $this->componentWriter->method('persist')
            ->willReturn($ambient);

        $this->ambientFactory->method('create')
            ->willReturn($ambient);

        $useCase = new RegisterAmbientUseCase(
            $this->componentWriter,
            $this->ambientFactory
        );

        $response = $useCase->handle(
            new RegisterAmbientUseCaseArgument(
                33.10,
                75.20
            )
        );

        $this->assertEquals($response->ambient(), $ambient);
    }

    public function testIfRegisterAmbientThrowPersistenceException()
    {
        $ambient = new Ambient(
            1,
            33.10,
            75.20,
            new \DateTime()
        );

        $this->componentWriter->method('persist')
            ->will($this->throwException(new AmbientPersistenceException()));

        $this->ambientFactory->method('create')
            ->willReturn($ambient);

        $useCase = new RegisterAmbientUseCase(
            $this->componentWriter,
            $this->ambientFactory
        );

        $response = $useCase->handle(
            new RegisterAmbientUseCaseArgument(
                33.10,
                75.20
            )
        );

        $this->assertFalse($response->success());
    }
}
