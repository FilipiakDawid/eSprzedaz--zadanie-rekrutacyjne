<?php

declare(strict_types=1);

namespace UseCases\Contracts\Requests;

interface IPetStatus
{
    public function getStatus(): array;
}