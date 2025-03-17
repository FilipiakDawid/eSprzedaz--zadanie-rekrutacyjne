<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Enums\PetStatus;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Http\FormRequest;
use UseCases\Contracts\Requests\IUpdatePetRequest;

class UpdatePetRequest extends FormRequest implements IUpdatePetRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'array'],
            'category.name' => ['required', 'string', 'max:255'],
            'category.id' => ['integer'],
            'photo_urls' => ['required', 'array'],
            'photo_urls.*' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::enum(PetStatus::class)],
            'tags' => ['required', 'array'],
            'tags.*' => ['required', 'array'],
            'tags.*.id' => ['nullable', 'integer'],
            'tags.*.name' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function getPetId(): int
    {
        return (int)$this->input('id');
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getStatus(): PetStatus
    {
        return $this->enum('status', PetStatus::class);
    }

    public function getTags(): Collection
    {
        return $this->collect('tags');
    }

    public function getCategory(): array
    {
        return $this->input('category') ?? [];
    }

    public function getPhotoUrls(): array
    {
        return $this->input('photo_urls');
    }
}
