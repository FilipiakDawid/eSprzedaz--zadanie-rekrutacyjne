<?php

declare(strict_types=1);

namespace Pet\Entities;

use UseCases\Contracts\Pet\Entities\id;
use UseCases\Contracts\Pet\Entities\ICategory;

class Category implements ICategory
{
    public function __construct(
        private int $id,
        private string $name,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}