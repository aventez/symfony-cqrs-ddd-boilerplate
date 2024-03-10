<?php

namespace App\Currency\Domain\WriteModel;

class UpsertCurrencyWriteModel
{
    public function __construct(
        public readonly string $name,
        public readonly string $currencyCode,
        public readonly int $exchangeRate,
    ) {}
}