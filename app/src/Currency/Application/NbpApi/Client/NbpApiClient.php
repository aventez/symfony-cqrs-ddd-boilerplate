<?php

namespace App\Currency\Application\NbpApi\Client;

use App\Currency\Domain\NbpApi\Response\NbpCurrencyRatesResponse;
use App\Currency\Domain\NbpApi\ValueObject\NbpCurrencyRate;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NbpApiClient implements NbpApiClientInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
    ) {}

    private const CURRENCY_API_URL = 'https://api.nbp.pl/api/exchangerates/tables/a?format=json';

    public function fetchRates(): NbpCurrencyRatesResponse
    {
        $body = $this->httpClient->request('GET', self::CURRENCY_API_URL);
        $content = json_decode($body->getContent(false), true)[0];

        return new NbpCurrencyRatesResponse(
            $content['table'],
            $content['no'],
            $content['effectiveDate'],
            array_map(function (array $row) {
                return new NbpCurrencyRate(
                    $row['currency'],
                    $row['code'],
                    // we should have accuracy up to 4 decimal places
                    $row['mid'] * 10000,
                );
            }, $content['rates']),
        );
    }
}