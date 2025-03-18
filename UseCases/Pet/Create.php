<?php

declare(strict_types=1);

namespace UseCases\Pet;

use UseCases\BaseUseCase;
use UseCases\Contracts\Pet\IPetService;
use UseCases\Contracts\Requests\IPetRequest;

final class Create extends BaseUseCase
{
    public function create(IPetRequest $request): int
    {
        $pet_service = $this->domain_service_factory->create(IPetService::class);

        return $pet_service->create($request);
    }

}