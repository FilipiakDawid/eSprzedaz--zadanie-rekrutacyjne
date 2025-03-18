<?php

declare(strict_types=1);

namespace Pet;

use Pet\Entities\Pet;
use Pet\Entities\Status;
use Pet\Entities\Category;
use App\Models\Enums\PetStatus;
use Illuminate\Support\Collection;
use App\Exceptions\Api\ApiException;
use Illuminate\Http\Client\Response;
use Illuminate\Container\Attributes\Log;
use App\Exceptions\Api\NotFoundException;
use App\Exceptions\Api\BadRequestException;
use App\Exceptions\Api\ValidationException;
use Illuminate\Foundation\Application as App;
use UseCases\Contracts\Pet\Entities\IStatus;

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

    public function proceedPetResponse(Response $response): Pet
    {
        switch ($response->status()) {
            case "200":
                return $this->createPet($response);
            case "400":
                throw new BadRequestException('Provided invalid ID');
            case "404":
                throw new NotFoundException('Pet Not Found');
            default:
                throw new ApiException($response->getStatusCode());
        }
    }

    public function proceedIdResponse(Response $response): int
    {
        switch ($response->status()) {
            case "200":
                return $response->json('id');
            case "400":
                throw new BadRequestException('Provided invalid ID');
            case "404":
                throw new NotFoundException('Pet Not Found');
            case "405":
                throw new ValidationException('Provided invalid data');
            default:
                throw new ApiException($response->getStatusCode());
        }
    }

    private function createCollection(Response $response): Collection
    {
        return $response->collect();
    }

    private function createPet(Response $response): Pet
    {
        $category = new Category($response->json('category.id'), $response->json('category.name'));

        $pet = new Pet(
            $response->json('id'),
            $category, $response->json('name'),
            $response->collect('photoUrls'),
            $response->collect('tags'),
            PetStatus::from($response->json('status')),
        );

        return $pet;
    }

    public function proceedRemoveResponse(Response $response): IStatus
    {
        switch ($response->status()) {
            case "200":
                return $this->createStatus();
            case "400":
                throw new BadRequestException('Provided invalid ID');
            case "404":
                throw new NotFoundException('Pet Not Found');
            default:
                throw new ApiException($response->getStatusCode());
        }
    }

    private function createStatus(): IStatus
    {
        return new Status('Pet successfully removed');
    }
}