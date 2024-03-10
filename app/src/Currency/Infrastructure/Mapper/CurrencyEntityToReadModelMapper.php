<?php

namespace App\Currency\Infrastructure\Mapper;

use App\Currency\Domain\ReadModel\CurrencyReadModel;
use App\Currency\Infrastructure\Entity\CurrencyEntity;
use Symfony\Component\Uid\Uuid;

class CurrencyEntityToReadModelMapper
{
    public static function map(CurrencyEntity $entity): CurrencyReadModel
    {
        return new CurrencyReadModel(
            new Uuid($entity->getId()),
            $entity->getName(),
            $entity->getCurrencyCode(),
            $entity->getExchangeRate(),
        );
    }
}