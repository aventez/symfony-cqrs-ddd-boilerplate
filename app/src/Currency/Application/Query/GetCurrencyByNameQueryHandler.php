<?php

namespace App\Currency\Application\Query;

use App\Common\Application\Query\QueryHandler;
use App\Currency\Domain\ReadModel\CurrencyReadModel;
use App\Currency\Domain\Repository\CurrencyRepository;

class GetCurrencyByNameQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly CurrencyRepository $currencyRepository,
    ) {}

    public function __invoke(GetCurrencyByNameQuery $query): ?CurrencyReadModel
    {
        return $this->currencyRepository->findByName($query->name);
    }
}