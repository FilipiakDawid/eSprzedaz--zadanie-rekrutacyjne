<?php

declare(strict_types=1);

namespace UseCases\Contracts\Pet\Entities;

use Pet\Entities\Category;
use App\Models\Enums\PetStatus;
use Illuminate\Support\Collection;

interface IPet
{
    public function getId(): int;

    public function getCategory(): Category;

    public function getName(): string;

    public function getPhotoUrls(): Collection;

    public function getTags(): Collection;

    public function getStatus(): PetStatus;
}