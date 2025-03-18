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

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
    }

    #[Test]
    public function update(): void
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
        $result = $pet_service->update($request);

        // THEN
        Http::assertSentCount(1);
        $this->assertSame(1, $result);
    }
}
