<?php

namespace App\Http\Controllers;

use UseCases\Pet\GetPet;
use UseCases\Pet\Create;
use UseCases\Pet\Update;
use UseCases\Pet\Delete;
use App\Models\Enums\PetStatus;
use App\Http\Requests\CreatePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Http\Requests\UploadImageRequest;
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
            'selected_status' => $request->getStatus(),
        ]);
    }

    public function show(
        GetPet $get_pet,
        int $id
    ) {
        $pet = $get_pet->getById($id);

        return view('pet.show', ['pet' => $pet]);
    }

    public function create()
    {
        return view('pet.create', [
            'statuses' => PetStatus::values(),
        ]);
    }

    public function store(
        CreatePetRequest $request,
        Create $create
    )
    {
        $id = $create->create($request);

        return redirect()->route('pet.show', ['id' => $id]);
    }

    public function edit(
        int $id,
        GetPet $get_pet,
    )
    {
        $pet = $get_pet->getById($id);
        $statuses = PetStatus::values();

        return view('pet.edit', [
            'pet' => $pet,
            'statuses' => $statuses,
        ]);
    }

    public function update(
        UpdatePetRequest $request,
        Update $update,
        int $id
    )
    {
        $update->update($request);

        return redirect()->route('pet.show', ['id' => $request->getId()]);
    }

    public function delete(
        int $id,
        Delete $delete
    ) {
        $status = $delete->delete($id);

        return redirect()->route('index')->with("message", $status->getMessage());
    }

    public function uploadImage(
        UploadImageRequest $request,
        Update $update,
        int $id
    ) {

        $status = $update->uploadImage($request, $id);

        return redirect()->route('pet.show', ['id' => $id])->with("message", $status->getMessage());
    }
}
