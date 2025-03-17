<?php

declare(strict_types=1);

namespace Tests\Integration\Pet\GetById;

use Tests\TestCase;
use UseCases\Pet\GetPet;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use UseCases\Contracts\Pet\Entities\IPet;

class GetPetTests extends TestCase
{
    use GetPetTrait;

    private GetPet $use_case;

    #[Test]
    public function getById(): void
    {
        // GIVEN
        $response = $this->mockResponse();

        Http::fake(['*' => Http::response($response, 200)]);

        // WHEN
        $result = $this->service = $this->use_case->getById(1);

        // THEN
        $this->assertInstanceOf(IPet::class, $result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->use_case = $this->app->make(GetPet::class);
        Http::preventStrayRequests();;
    }
}
