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
use Illuminate\Contracts\Config\Repository as ConfigContract;

class PetService implements IPetService
{
    private Factory $http;
    private string $header;
    private string $secret;
    private UrlGenerator $url;
    private ResponseFactory $response_factory;

    public function __construct(
        Factory $http,
        ConfigContract $config,
        UrlGenerator $url,
        ResponseFactory $response_factory
    ) {
        $this->header = $config->get('pets.authorization_header');
        $this->secret = $config->get('pets.authorization_secret');
        $this->http = $http;
        $this->url = $url;
        $this->response_factory = $response_factory;
    }

    public function get(IPetStatus $pet_status): Collection
    {
        $statuses = implode(',', $pet_status->getStatus());

        $response = $this->http
            ->withHeader($this->header, $this->secret)
            ->get($this->url->findByStatus(), [
                'status' => $statuses,
        ]);

        return $this->response_factory->proceedPetsResponse($response);
    }

    public function findById(int $id): IPet
    {
        $response = $this->http
            ->withHeader($this->header, $this->secret)
            ->withUrlParameters([
            'id' => $id,
            ])->get($this->url->findById())
        ;


        return $this->response_factory->proceedPetResponse($response);
    }

    public function create(IPetRequest $pet_request): int
    {
        $response = $this->http
            ->withHeader($this->header, $this->secret)
            ->post($this->url->create(), [
            'id' => $pet_request->getId(),
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
        $response = $this->http
            ->withHeader($this->header, $this->secret)
            ->put($this->url->update(), [
            'id' =>  $pet_request->getId(),
            'category' => $pet_request->getCategory(),
            'name' => $pet_request->getName(),
            'tags' => $pet_request->getTags(),
            'status' => $pet_request->getStatus(),
            'photoUrls' => $pet_request->getPhotoUrls(),
        ]);

        return $response->json('id');
    }
}