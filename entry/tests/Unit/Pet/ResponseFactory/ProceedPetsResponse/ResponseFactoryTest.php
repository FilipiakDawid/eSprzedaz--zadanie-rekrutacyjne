<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\ResponseFactory\ProceedPetsResponse;

use Tests\TestCase;
use Pet\ResponseFactory;
use App\Exceptions\Api\ApiException;
use PHPUnit\Framework\Attributes\Test;
use App\Exceptions\Api\BadRequestException;

class ResponseFactoryTest extends TestCase
{
    use ResponseFactoryTrait;

    private ResponseFactory $factory;

    #[Test]
    public function proceedPetsResponse_badRequestError_exceptionThrown(): void
    {
        // GIVEN
        $this->expectException(BadRequestException::class);

        $response = $this->mockResponse(status: 400);

        // WHEN
        $this->factory->proceedPetsResponse($response);

        // THEN
    }

    #[Test]
    public function proceedPetsResponse_serverError_exceptionThrown(): void
    {
        // GIVEN
        $this->expectException(ApiException::class);

        $response = $this->mockServerErrorResponse();

        // WHEN
        $this->factory->proceedPetsResponse($response);

        // THEN
    }

    #[Test]
    public function proceedPetsResponse_success_petsReturned(): void
    {
        // GIVEN
        $response = $this->mockSuccessResponse(status: 200);

        // WHEN
        $result = $this->factory->proceedPetsResponse($response);

        // THEN
        $this->assertCount(2, $result);

    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = $this->app->make(ResponseFactory::class);
    }

}
