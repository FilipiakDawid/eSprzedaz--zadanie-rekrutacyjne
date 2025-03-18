<?php

declare(strict_types=1);

namespace Tests\Integration\UseCases\Pet\GetPet\GetByStatus;

use Mockery as m;
use App\Models\Enums\PetStatus;
use UseCases\Contracts\Requests\IPetStatus;

trait GetPetTrait
{
    private function mockPetStatus(): IPetStatus
    {
        $m = m::mock(IPetStatus::class);
        $m->expects('getStatus')->andReturn([PetStatus::Available->value]);

        return $m;
    }
}
