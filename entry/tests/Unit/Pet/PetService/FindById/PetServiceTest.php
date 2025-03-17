<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\PetService\FindById;

use Tests\TestCase;
use Pet\PetService;
use App\Models\Enums\PetStatus;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class PetServiceTest extends TestCase
{
    use PetServiceTrait;

    private PetService $pet_service;

    #[Test]
    public function findById(): void
    {
        // GIVEN
        $response = $this->mockResponse();

        Http::fake([
            'https://petstore.swagger.io/v2/pet/1' => Http::response($response, 200),
        ]);

        // WHEN
        $result = $this->pet_service->findById(1);

        // THEN
        $this->assertSame(1, $result->getId());
        $this->assertSame('cat', $result->getName());
        $this->assertEmpty($result->getPhotoUrls());
        $this->assertEmpty($result->getTags());
        $this->assertSame(PetStatus::Sold, $result->getStatus());

        $category = $result->getCategory();
        $this->assertSame(1, $category->getId());
        $this->assertSame('cate', $category->getName());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->pet_service = $this->app->make(PetService::class);
        Http::preventStrayRequests();
    }
}
