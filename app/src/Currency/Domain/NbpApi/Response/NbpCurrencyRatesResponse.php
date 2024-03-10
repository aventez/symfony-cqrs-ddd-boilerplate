<?php

namespace App\Currency\Domain\NbpApi\Response;

use App\Currency\Domain\NbpApi\ValueObject\NbpCurrencyRate;

class NbpCurrencyRatesResponse
{
    /**
     * @param array<NbpCurrencyRate> $rates
     */
    public function __construct(
        public readonly string $table,
        public readonly string $no,
        public readonly string $effectiveDate,
        public readonly array $rates,
    ) {}
}