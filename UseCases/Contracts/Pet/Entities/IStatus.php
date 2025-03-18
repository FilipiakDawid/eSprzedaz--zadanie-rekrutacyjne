<?php

declare(strict_types=1);

namespace UseCases\Contracts\Pet\Entities;

interface IStatus
{
    public function getMessage(): string;
}