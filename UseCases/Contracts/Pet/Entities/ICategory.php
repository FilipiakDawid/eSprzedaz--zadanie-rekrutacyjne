<?php

declare(strict_types=1);

namespace UseCases\Contracts\Pet\Entities;

interface ICategory
{
    public function getId(): int;

    public function getName(): string;
}