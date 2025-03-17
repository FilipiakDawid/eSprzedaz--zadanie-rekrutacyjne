<?php

declare(strict_types=1);

namespace UseCases\Contracts\Pet;

interface IPetService
{
    public function get(string $type);
}