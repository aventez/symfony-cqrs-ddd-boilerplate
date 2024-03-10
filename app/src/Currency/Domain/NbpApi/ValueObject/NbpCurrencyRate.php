<?php

namespace App\Currency\Domain\NbpApi\ValueObject;

class NbpCurrencyRate
{
    public function __construct(
        public readonly string $name,
        public readonly string $code,
        public readonly int $exchangeRate,
    ) {}
}