<?php

namespace App\Currency\UI\Cli;

use App\Common\Application\Command\CommandBus;
use App\Common\Application\Query\QueryBus;
use App\Currency\Application\Command\UpsertCurrencyCommand;
use App\Currency\Application\NbpApi\Client\NbpApiClientInterface;
use App\Currency\Application\Query\GetCurrencyByNameQuery;
use App\Currency\Domain\ReadModel\CurrencyReadModel;
use App\Currency\Domain\WriteModel\UpsertCurrencyWriteModel;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Uid\Uuid;

class FetchCurrenciesRates extends Command
{
    /**
     * @var string
     */
    protected static string $defaultName = 'app:fetch-currencies-rates';

    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly QueryBus $queryBus,
        private readonly CommandBus $commandBus,
        private readonly NbpApiClientInterface $nbpApiClient,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName(self::$defaultName)
            ->setDescription('Fetch currencies rates from NBP API');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->logger->alert('Fetching currencies process started');

        $response = $this->nbpApiClient->fetchRates();
        foreach ($response->rates as $rate) {
            /** @var CurrencyReadModel $existingRate */
            $existingRate = $this->queryBus->handle(new GetCurrencyByNameQuery($rate->name));

            $this->commandBus->dispatch(
                new UpsertCurrencyCommand(
                    $existingRate?->id ?? Uuid::v4(),
                    new UpsertCurrencyWriteModel(
                        $rate->name,
                        $rate->code,
                        $rate->exchangeRate,
                    ),
                )
            );

            $this->logger->alert(sprintf('Updated currency %s (code: %s), exchange rate: %f',
                $rate->name,
                $rate->code,
                $rate->exchangeRate / 10_000
            ));
        }

        $this->logger->alert(sprintf('Updated all currencies successfully. Updated count: %d', count($response->rates)));

        return Command::SUCCESS;
    }
}