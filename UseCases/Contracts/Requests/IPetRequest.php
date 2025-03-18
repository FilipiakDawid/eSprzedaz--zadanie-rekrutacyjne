<?php

declare(strict_types=1);

namespace UseCases\Contracts\Requests;

use App\Models\Enums\PetStatus;
use Illuminate\Support\Collection;

interface IPetRequest
{
    public function getId(): int;

    public function getName(): string;

    public function getStatus(): PetStatus;

    public function getTags(): Collection;

    public function getCategory(): array;

    public function getPhotoUrls(): array;
}