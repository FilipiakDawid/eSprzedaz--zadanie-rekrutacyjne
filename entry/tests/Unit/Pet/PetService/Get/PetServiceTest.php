<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\PetService\Get;

use Tests\TestCase;
use Pet\PetService;
use Illuminate\Support\Collection;
use Illuminate\Http\Client\Request;
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
    public function get_provideAvailablePetType_statusIsSuccessCollectionReturned(): void
    {
        // GIVEN
        $pet_status = $this->mockPetStatus();
        $response = $this->mockResponse();
        $this->mockResponseFactory($response);

        Http::fake([
            'https://petstore.swagger.io/v2/pet/findByStatus?status=available' => Http::response($response, 200),
        ]);

        $pet_service = $this->app->make(PetService::class);

        // WHEN
        $result = $pet_service->get($pet_status);

        // THEN
        Http::assertSent(function (Request $request) {
            return $request->hasHeader('api_key', 'test') &&
                $request->method() == 'GET';
        });
        $this->assertInstanceOf(Collection::class, $result);
    }
}
