<?php

declare(strict_types=1);

namespace Tests\Integration\UseCases\Pet\GetPet\GetByStatus;

use Tests\TestCase;
use UseCases\Pet\GetPet;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class GetPetTest extends TestCase
{
    use GetPetTrait;

    private GetPet $use_case;

    #[Test]
    public function getByStatus(): void
    {
        // GIVEN
        $pet_status = $this->mockPetStatus();

        // WHEN
        $result = $this->service = $this->use_case->getByStatus($pet_status);

        // THEN
        $this->assertInstanceOf(Collection::class, $result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->use_case = $this->app->make(GetPet::class);
        Http::preventStrayRequests();
        Http::fake();
    }
}
