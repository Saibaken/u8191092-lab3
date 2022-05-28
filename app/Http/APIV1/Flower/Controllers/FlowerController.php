<?php

namespace App\Http\APIV1\Flower\Controllers;

use App\Http\APIV1\Flower\Resources\FlowerResource;
use App\Http\APIV1\Flower\Resources\FlowerCollection;
use App\Http\APIV1\Room\Resources\RoomResource;
use App\Http\APIV1\Flower\Requests\AddFlowerRequest;
use App\Http\APIV1\Flower\Requests\UpdateFlowerFieldsRequest;
use App\Http\APIV1\Flower\Requests\UpdateFlowerRequest;
use App\Domain\Flowers\Actions;
use App\Http\APIV1\Common\EmptyJsonResource;
use App\Http\Controllers\Controller;

class FlowerController extends Controller
{
    public function create(AddFlowerRequest $request)
    {
        $action = new Actions\AddFlower();
        return new FlowerResource($action->execute($request->validated()));
    }
    
    public function delete(int $id)
    {
        $action = new Actions\DeleteFlowerById();
        return new EmptyJsonResource($action->execute($id));
    }

    public function getById(int $id)
    {
        $action = new Actions\GetFlowerById();
        return new FlowerResource($action->execute($id));
    }

    public function getAll()
    {
        $action = new Actions\GetFlowers();
        return new FlowerCollection($action->execute());
    }

    public function update(int $id, UpdateFlowerRequest $request)
    {
        $action = new Actions\UpdateFlower();
        return new FlowerResource($action->execute($id, $request->validated()));
    }

    public function updateFields(int $id, UpdateFlowerFieldsRequest $request)
    {
        $action = new Actions\UpdateFlowerFields();
        return new FlowerResource($action->execute($id, $request->validated()));
    }

    public function water(int $id)
    {
        $action = new Actions\WaterFlower();
        return new FlowerResource($action->execute($id));
    }
}