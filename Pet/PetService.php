<?php

declare(strict_types=1);

namespace Pet;

use Illuminate\Support\Collection;
use Illuminate\Http\Client\Factory;
use UseCases\Contracts\Pet\IPetService;
use UseCases\Contracts\Requests\IPetStatus;

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
}