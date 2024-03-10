<?php

namespace App\Currency\Application\Command;

use App\Common\Application\Command\Command;
use App\Currency\Domain\WriteModel\UpsertCurrencyWriteModel;
use Symfony\Component\Uid\Uuid;

class UpsertCurrencyCommand implements Command
{
    public function __construct(
        private readonly Uuid $uuid,
        private readonly UpsertCurrencyWriteModel $writeModel,
    ) {}

    /**
     * @return Uuid
     */
    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    /**
     * @return mixed
     */
    public function getWriteModel(): UpsertCurrencyWriteModel
    {
        return $this->writeModel;
    }
}