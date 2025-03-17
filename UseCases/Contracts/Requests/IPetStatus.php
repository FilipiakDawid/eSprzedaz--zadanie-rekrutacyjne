<?php

declare(strict_types=1);

namespace UseCases\Contracts\Requests;

use App\Models\Enums\PetStatus;

interface IPetStatus
{
    public function getStatus(): PetStatus;
}