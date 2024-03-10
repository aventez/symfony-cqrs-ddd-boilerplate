<?php

namespace App\Currency\Domain\Repository;

use App\Currency\Domain\ReadModel\CurrencyReadModel;
use App\Currency\Domain\WriteModel\UpsertCurrencyWriteModel;
use Symfony\Component\Uid\Uuid;

interface CurrencyRepository
{
    public function findById(Uuid $uuid): ?CurrencyReadModel;

    public function findByName(string $name): ?CurrencyReadModel;

    public function findAll(): array;

    public function upsert(Uuid $id, UpsertCurrencyWriteModel $writeModel): CurrencyReadModel;
}