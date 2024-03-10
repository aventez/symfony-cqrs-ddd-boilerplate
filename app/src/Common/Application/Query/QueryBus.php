<?php

namespace App\Common\Application\Query;

interface QueryBus
{
    public function handle(Query $query): mixed;
}