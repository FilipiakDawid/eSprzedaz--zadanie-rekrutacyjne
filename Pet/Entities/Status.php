<?php

declare(strict_types=1);

namespace Pet\Entities;

use UseCases\Contracts\Pet\Entities\IStatus;

class Status implements IStatus
{
    public function __construct(
        private string $message,
    ) {
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}