<?php

declare(strict_types=1);

namespace UseCases\Pet;

use UseCases\BaseUseCase;
use UseCases\Contracts\Pet\IPetService;
use UseCases\Contracts\Requests\IUpdatePetRequest;

final class Update extends BaseUseCase
{
    public function update(IUpdatePetRequest $request)
    {
        $pet_service = $this->domain_service_factory->create(IPetService::class);

        return $pet_service->update($request);
    }
}