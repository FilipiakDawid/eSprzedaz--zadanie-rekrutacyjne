<?php

declare(strict_types=1);

namespace Pet\Entities;

use App\Models\Enums\PetStatus;
use Illuminate\Support\Collection;
use UseCases\Contracts\Pet\Entities\IPet;

class Pet implements IPet
{
    public function __construct(
        private int $id,
        private Category $category,
        private string $name,
        private Collection $photo_urls,
        private Collection $tags,
        private PetStatus $status,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhotoUrls(): Collection
    {
        return $this->photo_urls;
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function getStatus(): PetStatus
    {
        return $this->status;
    }

}