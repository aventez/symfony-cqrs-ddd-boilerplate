<?php

namespace App\Common\Application\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;
}