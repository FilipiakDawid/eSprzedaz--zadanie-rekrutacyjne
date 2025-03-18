<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\PetService\UploadImage;

use Tests\TestCase;
use Pet\PetService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class PetServiceTest extends TestCase
{
    use PetServiceTrait;

    #[Test]
    public function uploadImage_provideValidId_returnSuccessResponse(): void
    {
        // GIVEN
        $id = 1;
        $status = $this->mockStatus();
        $this->mockResponseFactory($status);
        $request_file = $this->mockRequestFile();

        Http::fake([
            'https://petstore.swagger.io/v2/pet/1/uploadImage' => Http::response([], 200),
        ]);

        $pet_service = $this->app->make(PetService::class);

        // WHEN
        $result = $pet_service->uploadImage($request_file, $id);

        // THEN
        Http::assertSent(function (Request $request) {
            return $request->hasHeader('api_key', 'test') &&
                $request->method() == 'POST' &&
                $request->hasFile('filename');
        });
        $this->assertSame($status, $result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
    }
}
