<?php

namespace App\Currency\Infrastructure\Repository;

use App\Currency\Domain\ReadModel\CurrencyReadModel;
use App\Currency\Domain\Repository\CurrencyRepository;
use App\Currency\Domain\WriteModel\UpsertCurrencyWriteModel;
use App\Currency\Infrastructure\Entity\CurrencyEntity;
use App\Currency\Infrastructure\Mapper\CurrencyEntityToReadModelMapper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

/**
 * @extends ServiceEntityRepository<CurrencyEntity>
 *
 * @method CurrencyEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrencyEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrencyEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyDoctrineRepository extends ServiceEntityRepository implements CurrencyRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrencyEntity::class);
    }

    public function findById(Uuid $uuid): ?CurrencyReadModel
    {
        $entity = $this->find($uuid);
        if (!$entity) return null;

        return CurrencyEntityToReadModelMapper::map($entity);
    }

    public function findByName(string $name): ?CurrencyReadModel
    {
        /** @var CurrencyEntity $entity */
        $entity = $this->findOneBy(['name' => $name]);
        if (!$entity) return null;

        return CurrencyEntityToReadModelMapper::map($entity);
    }

    public function upsert(Uuid $id, UpsertCurrencyWriteModel $writeModel): CurrencyReadModel
    {
        $alreadyExists = $this->findById($id);

        $entity = new CurrencyEntity();
        $entity->setId($id);
        $entity->setName($writeModel->name);
        $entity->setCurrencyCode($writeModel->currencyCode);
        $entity->setExchangeRate($writeModel->exchangeRate);

        if (!$alreadyExists) {
            $this->getEntityManager()->persist($entity);
        }
        $this->getEntityManager()->flush();

        return CurrencyEntityToReadModelMapper::map($entity);
    }

    public function findAll(): array
    {
        return array_map(function (CurrencyEntity $entity) {
            return CurrencyEntityToReadModelMapper::map($entity);
        }, $this->findBy([]));
    }
}
