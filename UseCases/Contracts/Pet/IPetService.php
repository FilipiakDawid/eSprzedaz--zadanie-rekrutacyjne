<?php

declare(strict_types=1);

namespace UseCases\Contracts\Pet;

use Illuminate\Support\Collection;
use UseCases\Contracts\Pet\Entities\IPet;
use UseCases\Contracts\Requests\IPetStatus;

interface IPetService
{
    public function get(IPetStatus $pet_status): Collection;

    public function findById(int $id): IPet;
}