<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\PetService\Get;

use Tests\TestCase;
use Pet\PetService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class PetServiceTest extends TestCase
{
    use PetServiceTrait;

    private PetService $pet_service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pet_service = $this->app->make(PetService::class);
        Http::preventStrayRequests();
    }

    #[Test]
    public function get_provideAvailablePetType_statusIsSuccessCollectionReturned(): void
    {
        // GIVEN
        $pet_status = $this->mockPetStatus();
        $response = $this->mockResponse();
        Http::fake([
            'https://petstore.swagger.io/v2/pet/findByStatus?status=available' => Http::response($response, 200),
        ]);

        // WHEN
        $result = $this->pet_service->get($pet_status);

        // THEN
        Http::assertSentCount(1);
        $this->assertInstanceOf(Collection::class, $result);

    }
}
