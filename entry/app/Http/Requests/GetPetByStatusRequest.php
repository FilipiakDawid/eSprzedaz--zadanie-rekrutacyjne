<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Enums\PetStatus;
use Illuminate\Foundation\Http\FormRequest;
use UseCases\Contracts\Requests\IPetStatus;

class GetPetByStatusRequest extends FormRequest implements IPetStatus
{
    public function rules(): array
    {
        return [
            'status' => ['string', Rule::enum(PetStatus::class)],
        ];
    }

    public function getStatus(): PetStatus
    {
        return $this->input('status') ?? PetStatus::Available;
    }
}
