<?php

namespace App\Currency\Application\Query;

use App\Common\Application\Query\QueryHandler;
use App\Currency\Domain\Repository\CurrencyRepository;

class GetAllCurrenciesQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly CurrencyRepository $currencyRepository,
    ) {}

    public function __invoke(GetAllCurrenciesQuery $query): array
    {
        return $this->currencyRepository->findAll();
    }
}