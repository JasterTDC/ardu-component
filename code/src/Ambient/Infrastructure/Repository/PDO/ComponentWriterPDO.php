<?php


namespace ComAI\ArduComponents\Ambient\Infrastructure\Repository\PDO;

use ComAI\ArduComponents\Ambient\Domain\Entity\Ambient;
use ComAI\ArduComponents\Ambient\Domain\Exception\AmbientPersistenceException;
use ComAI\ArduComponents\Ambient\Domain\Repository\ComponentWriterInterface;
use ComAI\ArduComponents\Ambient\Infrastructure\Factory\AmbientFactory;

/**
 * Class ComponentWriterPDO
 *
 * @package ComAI\ArduComponents\Ambient\Infrastructure\PDO
 * @author  Ismael Moral <jastertdc@gmail.com>
 */
class ComponentWriterPDO implements ComponentWriterInterface
{

    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var AmbientFactory
     */
    protected $ambientFactory;

    /**
     * @var string
     */
    protected $dateFormat;

    /**
     * ComponentWriterPDO constructor.
     *
     * @param \PDO $pdo
     * @param AmbientFactory $ambientFactory
     * @param string $dateFormat
     */
    public function __construct(
        \PDO $pdo,
        AmbientFactory $ambientFactory,
        string $dateFormat
    ) {
        $this->pdo = $pdo;
        $this->ambientFactory = $ambientFactory;
        $this->dateFormat = $dateFormat;
    }

    /**
     * @param Ambient $ambient
     *
     * @return Ambient
     * @throws AmbientPersistenceException
     */
    public function persist(
        Ambient $ambient
    ) : Ambient {
        if (empty($ambient->id())) {
            return $this->insertAmbient($ambient);
        }

        return $ambient;
    }

    /**
     * @param Ambient $ambient
     *
     * @return Ambient
     * @throws AmbientPersistenceException
     */
    protected function insertAmbient(
        Ambient $ambient
    ) : Ambient {
        $sql = 'INSERT INTO `components`.`ambient` (
            `temperature`,
            `humidity`,
            `createdAt`
            ) VALUES (
              :temperature,
              :humidity,
              :created
            ) 
        ';

        if (empty($ambient->createdAt())) {
            throw new AmbientPersistenceException();
        }

        $parameters = [
            'temperature'   => $ambient->temperature(),
            'humidity'      => $ambient->humidity(),
            'created'       => $ambient->createdAt()->format($this->dateFormat)
        ];

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);

            $ambient->setId((int) $this->pdo->lastInsertId());

            return $ambient;
        } catch (\PDOException $e) {
            throw new AmbientPersistenceException(
                $e->getMessage()
            );
        }
    }
}
