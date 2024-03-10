<?php

namespace App\Currency\Application\NbpApi\Client;

use App\Currency\Domain\NbpApi\Response\NbpCurrencyRatesResponse;

interface NbpApiClientInterface
{
    public function fetchRates(): NbpCurrencyRatesResponse;
}