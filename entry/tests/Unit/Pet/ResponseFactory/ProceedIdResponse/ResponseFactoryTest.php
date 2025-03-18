<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\ResponseFactory\ProceedIdResponse;

use Tests\TestCase;
use Pet\ResponseFactory;
use App\Exceptions\Api\ApiException;
use PHPUnit\Framework\Attributes\Test;
use App\Exceptions\Api\NotFoundException;
use App\Exceptions\Api\BadRequestException;
use App\Exceptions\Api\ValidationException;

class ResponseFactoryTest extends TestCase
{
    use ResponseFactoryTrait;

    private ResponseFactory $factory;

    #[Test]
    public function proceedIdResponse_badRequestError_exceptionThrown(): void
    {
        // GIVEN
        $this->expectException(BadRequestException::class);

        $response = $this->mockResponse(status: 400);

        // WHEN
        $this->factory->proceedIdResponse($response);

        // THEN
    }

    #[Test]
    public function proceedIdResponse_notFoundError_exceptionThrown(): void
    {
        // GIVEN
        $this->expectException(NotFoundException::class);

        $response = $this->mockResponse(status: 404);

        // WHEN
        $this->factory->proceedIdResponse($response);

        // THEN
    }

    #[Test]
    public function proceedIdResponse_validationError_exceptionThrown(): void
    {
        // GIVEN
        $this->expectException(ValidationException::class);

        $response = $this->mockResponse(status: 405);

        // WHEN
        $this->factory->proceedIdResponse($response);

        // THEN
    }

    #[Test]
    public function proceedIdResponse_serverError_exceptionThrown(): void
    {
        // GIVEN
        $this->expectException(ApiException::class);

        $response = $this->mockServerErrorResponse();

        // WHEN
        $this->factory->proceedIdResponse($response);

        // THEN
    }

    #[Test]
    public function proceedIdResponse_success_idReturned(): void
    {
        // GIVEN
        $id = 1;
        $response = $this->mockSuccessResponse(status: 200, id: $id);

        // WHEN
        $response = $this->factory->proceedIdResponse($response);

        // THEN
        $this->assertSame($id, $response);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = $this->app->make(ResponseFactory::class);
    }
}
