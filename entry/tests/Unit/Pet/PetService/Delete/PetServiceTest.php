<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\PetService\Delete;

use Tests\TestCase;
use Pet\PetService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class PetServiceTest extends TestCase
{
    use PetServiceTrait;

    #[Test]
    public function delete_provideValidId_returnSuccessResponse(): void
    {
        // GIVEN
        $id = 1;
        $status = $this->mockStatus();
        $this->mockResponseFactory($status);

        Http::fake([
            'https://petstore.swagger.io/v2/pet/1' => Http::response([], 200),
        ]);

        $pet_service = $this->app->make(PetService::class);

        // WHEN
        $result = $pet_service->delete($id);

        // THEN
        Http::assertSent(function (Request $request) {
            return $request->hasHeader('api_key', 'test') &&
                $request->method() == 'DELETE';
        });
        $this->assertSame($status, $result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
    }
}
