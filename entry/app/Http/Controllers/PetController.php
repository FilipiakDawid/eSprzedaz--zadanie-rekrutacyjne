<?php

namespace App\Http\Controllers;

use UseCases\Pet\GetPet;
use App\Models\Enums\PetStatus;
use App\Http\Requests\GetPetByStatusRequest;

class PetController extends Controller
{
    public function getByStatus(
        GetPetByStatusRequest $request,
        GetPet $get_pet
    )
    {
        $statuses = PetStatus::values();
        $collection = $get_pet->getByStatus($request);
        return view('pet.index', [
            'pets' => $collection,
            'statuses' => $statuses,
            'status' => $request->getStatus(),
        ]);
    }

    public function show(
        GetPet $get_pet,
        int $id
    ) {
        $pet = $get_pet->getById($id);

        return view('pet.show', ['pet' => $pet]);
    }
}
