<?php

namespace App\Currency\Application\Command;

use App\Common\Application\Command\CommandHandler;
use App\Currency\Domain\Repository\CurrencyRepository;

class UpsertCurrencyCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly CurrencyRepository $currencyRepository
    ) {}

    public function __invoke(UpsertCurrencyCommand $command): void
    {
        $this->currencyRepository->upsert(
            $command->getUuid(),
            $command->getWriteModel(),
        );
    }
}