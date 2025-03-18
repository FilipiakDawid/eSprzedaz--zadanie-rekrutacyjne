<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\PetService\Create;

use Tests\TestCase;
use Pet\PetService;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class PetServiceTest extends TestCase
{
    use PetServiceTrait;

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
    }

    #[Test]
    public function create(): void
    {
        // GIVEN
        $request = $this->mockRequest();
        $response = $this->mockResponse();
        $this->mockResponseFactory(id: 1);

        Http::fake([
            'https://petstore.swagger.io/v2/pet' => Http::response($response, 200),
        ]);

        $pet_service = $this->app->make(PetService::class);

        // WHEN
        $result = $pet_service->create($request);

        // THEN
        $this->assertSame(1, $result);
        Http::assertSentCount(1);

    }
}
