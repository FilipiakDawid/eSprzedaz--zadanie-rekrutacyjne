<?php

declare(strict_types=1);

namespace Pet;

use Pet\Entities\Pet;
use Pet\Entities\Category;
use App\Models\Enums\PetStatus;
use Illuminate\Support\Collection;
use Illuminate\Http\Client\Factory;
use UseCases\Contracts\Pet\IPetService;
use UseCases\Contracts\Pet\Entities\IPet;
use UseCases\Contracts\Requests\IPetStatus;
use UseCases\Contracts\Requests\IPetRequest;
use UseCases\Contracts\Requests\IUpdatePetRequest;

class PetService implements IPetService
{

    public function __construct(
        private Factory $http
    ) {
    }

    public function get(IPetStatus $pet_status): Collection
    {
        $response = $this->http->get("https://petstore.swagger.io/v2/pet/findByStatus", [
            'status' => $pet_status->getStatus(),
        ]);

        return $response->collect()->mapInto(Collection::class);
    }

    public function findById(int $id): IPet
    {
        $response = $this->http->withUrlParameters([
            'id' => $id,
        ])->get("https://petstore.swagger.io/v2/pet/{id}");

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

    public function create(IPetRequest $pet_request): int
    {
        $response = $this->http->post("https://petstore.swagger.io/v2/pet", [
            'category' => $pet_request->getCategory(),
            'name' => $pet_request->getName(),
            'tags' => $pet_request->getTags(),
            'status' => $pet_request->getStatus(),
            'photoUrls' => $pet_request->getPhotoUrls(),
        ]);

        return $response->json('id');
    }

    public function update(IUpdatePetRequest $pet_request): int
    {
        $response = $this->http->put("https://petstore.swagger.io/v2/pet", [
            'id' =>  $pet_request->getPetId(),
            'category' => $pet_request->getCategory(),
            'name' => $pet_request->getName(),
            'tags' => $pet_request->getTags(),
            'status' => $pet_request->getStatus(),
            'photoUrls' => $pet_request->getPhotoUrls(),
        ]);

        return $response->json('id');
    }
}