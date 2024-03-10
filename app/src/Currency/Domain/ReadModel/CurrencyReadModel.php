<?php

namespace App\Currency\Domain\ReadModel;

use Symfony\Component\Uid\Uuid;

class CurrencyReadModel
{
    public function __construct(
        public readonly Uuid $id,
        public readonly string $name,
        public readonly string $currencyCode, // merge to value object
        public readonly int $exchangeRate,
    ) {}
}