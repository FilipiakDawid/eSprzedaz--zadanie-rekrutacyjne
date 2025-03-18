<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\PetService\Delete;

use Mockery as m;
use Pet\ResponseFactory;
use UseCases\Contracts\Pet\Entities\IStatus;

trait PetServiceTrait
{
    private function mockStatus(): IStatus
    {
        $mock = m::mock(IStatus::class);

        return $mock;
    }

    private function mockResponseFactory(IStatus $status): void
    {
        $m = m::mock(ResponseFactory::class);
        $m->expects('proceedRemoveResponse')->andReturn($status);
        $this->instance(ResponseFactory::class, $m);
    }
}
