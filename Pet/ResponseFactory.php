<?php

declare(strict_types=1);

namespace Pet;

use Illuminate\Support\Collection;
use App\Exceptions\Api\ApiException;
use Illuminate\Http\Client\Response;
use Illuminate\Container\Attributes\Log;
use App\Exceptions\Api\BadRequestException;
use Illuminate\Foundation\Application as App;

class ResponseFactory
{
    public function __construct(
        private App $app,
        private Log $log)
    {
    }

    public function proceedPetsResponse(Response $response): Collection
    {
        switch ($response->status()) {
            case "200":
               return $this->createCollection($response);
            case "400":
                throw new BadRequestException('Provided invalid status value');
            default:
                throw new ApiException($response->getStatusCode());
        }
    }

    private function createCollection(Response $response): Collection
    {
        return $response->collect();
    }
}