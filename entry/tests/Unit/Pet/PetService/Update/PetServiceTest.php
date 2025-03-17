<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\PetService\Update;

use Tests\TestCase;
use Pet\PetService;
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
    public function create(): void
    {
        // GIVEN
        $request = $this->mockRequest();
        $response = $this->mockResponse();

        Http::fake([
            'https://petstore.swagger.io/v2/pet' => Http::response($response, 200),
        ]);

        // WHEN
        $result = $this->pet_service->update($request);

        // THEN
        Http::assertSentCount(1);
        $this->assertSame(1, $result);
    }
}
