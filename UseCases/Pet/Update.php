<?php

declare(strict_types=1);

namespace UseCases\Pet;

use UseCases\BaseUseCase;
use UseCases\Contracts\Pet\IPetService;
use UseCases\Contracts\Pet\Entities\IStatus;
use UseCases\Contracts\Requests\IFileRequest;
use UseCases\Contracts\Requests\IUpdatePetRequest;

final class Update extends BaseUseCase
{
    public function update(IUpdatePetRequest $request)
    {
        $pet_service = $this->domain_service_factory->create(IPetService::class);

        return $pet_service->update($request);
    }

    public function uploadImage(IFileRequest $request, int $id): IStatus
    {
        $pet_service = $this->domain_service_factory->create(IPetService::class);

        return $pet_service->uploadImage($request, $id);
    }
}