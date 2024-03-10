<?php

namespace App\Currency\Application\Query;

use App\Common\Application\Query\Query;

class GetCurrencyByNameQuery implements Query
{
    public function __construct(
        public readonly string $name,
    ) {}
}