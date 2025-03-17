<?php

declare(strict_types=1);

namespace Tests\Integration\Pet\Update\Update;

use Tests\TestCase;
use UseCases\Pet\Update;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class UpdateTest extends TestCase
{
    use UpdateTrait;

    private Update $use_case;

    #[Test]
    public function update(): void
    {
        // GIVEN
        $request = $this->mockRequest();
        $response = $this->mockResponse();

        Http::fake(['*' => Http::response($response, 200)]);

        // WHEN
        $result = $this->service = $this->use_case->update($request);

        // THEN
        $this->assertEquals(1, $result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->use_case = $this->app->make(Update::class);
        Http::preventStrayRequests();;
    }
}
