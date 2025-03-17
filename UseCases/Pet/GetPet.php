<?php

declare(strict_types=1);

namespace UseCases\Pet;

use UseCases\BaseUseCase;
use Illuminate\Support\Collection;
use UseCases\Contracts\Pet\IPetService;
use UseCases\Contracts\Requests\IPetStatus;

class GetPet extends BaseUseCase
{
    public function getByStatus(IPetStatus $pet_status): Collection
    {
        $pet_service = $this->domain_service_factory->create(IPetService::class);

        return $pet_service->get($pet_status);
    }
}