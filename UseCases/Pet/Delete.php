<?php

declare(strict_types=1);

namespace UseCases\Pet;

use UseCases\BaseUseCase;
use UseCases\Contracts\Pet\IPetService;
use UseCases\Contracts\Pet\Entities\IStatus;

final class Delete extends BaseUseCase
{
    public function delete(int $id): IStatus
    {
        $pet_service = $this->domain_service_factory->create(IPetService::class);

        return $pet_service->delete($id);
    }
}