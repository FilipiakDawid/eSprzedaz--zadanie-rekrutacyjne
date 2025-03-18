<?php

declare(strict_types=1);

namespace UseCases\Contracts\Pet;

use Illuminate\Support\Collection;
use UseCases\Contracts\Pet\Entities\IPet;
use UseCases\Contracts\Requests\IPetStatus;
use UseCases\Contracts\Requests\IPetRequest;
use UseCases\Contracts\Pet\Entities\IStatus;
use UseCases\Contracts\Requests\IUpdatePetRequest;

interface IPetService
{
    public function get(IPetStatus $pet_status): Collection;

    public function findById(int $id): IPet;

    public function create(IPetRequest $pet_request): int;

    public function update(IUpdatePetRequest $pet_request): int;

    public function delete(int $id): IStatus;
}