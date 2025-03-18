<?php

declare(strict_types=1);

namespace Tests\Integration\UseCases\Pet\Create\Create;

use Tests\TestCase;
use UseCases\Pet\Create;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class CreateTest extends TestCase
{
    use CreateTrait;

    private Create $use_case;

    #[Test]
    public function create(): void
    {
        // GIVEN
        $request = $this->mockRequest();
        $response = $this->mockResponse();

        Http::fake(['*' => Http::response($response, 200)]);

        // WHEN
        $result = $this->service = $this->use_case->create($request);

        // THEN
        $this->assertEquals(1, $result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->use_case = $this->app->make(Create::class);
        Http::preventStrayRequests();;
    }
}
