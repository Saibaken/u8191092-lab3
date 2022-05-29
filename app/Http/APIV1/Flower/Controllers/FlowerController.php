<?php

namespace App\Http\APIV1\Flower\Controllers;

use App\Http\APIV1\Flower\Resources\FlowerResource;
use App\Http\APIV1\Flower\Resources\FlowerCollection;
use App\Http\APIV1\Room\Resources\RoomResource;
use App\Http\APIV1\Flower\Requests\AddFlowerRequest;
use App\Http\APIV1\Flower\Requests\UpdateFlowerFieldsRequest;
use App\Http\APIV1\Flower\Requests\UpdateFlowerRequest;
use App\Http\APIV1\Flower\Requests\GetFlowersRequest;
use App\Domain\Flowers\Actions;
use App\Domain\Flowers\Actions\GetFlowers;
use App\Http\APIV1\Common\EmptyJsonResource;
use App\Http\APIV1\Common\ErrorJsonResource;
use App\Http\Controllers\Controller;

class FlowerController extends Controller
{
    public function create(AddFlowerRequest $request)
    {
        $result = [];
        $return = null;
        $action = new Actions\AddFlower();
        try {
            $result['data'] = $action->execute($request->validated());
            $return = (new FlowerResource($result['data']))->response()->setStatusCode(201);
        }
        catch (\Exception $e) {
            $return['error'] = new ErrorJsonResource($e);
        }
        return $return;
    }
    
    public function delete(int $id)
    {
        $result = [];
        $return = null;
        $action = new Actions\DeleteFlowerById();
        try {
            $result['data'] = $action->execute($id);
            $return = (new EmptyJsonResource($result))->response()->setStatusCode(200);
        }
        catch (\Exception $e) {
            $return['error'] = new ErrorJsonResource($e);
        }
        return $return;
        
    }

    public function getById(int $id)
    {
        $result = [];
        $return = null;
        $action = new Actions\GetFlowerById();
        try {
            $result['data'] = $action->execute($id);
            $return = (new FlowerResource($result['data']))->response()->setStatusCode(200);
        }
        catch (\Exception $e) {
            $return['error'] = new ErrorJsonResource($e);
        }
        return $return;
    }

    public function getAll(GetFlowersRequest $request)
    {
        $result = [];
        $return = null;
        $action = new Actions\GetFlowers();
        try {
            $result['data'] = $action->execute($request->validated());
            $return = (new FlowerCollection($result['data']))->response()->setStatusCode(200);
        }
        catch (\Exception $e) {
            $return['error'] = new ErrorJsonResource($e);
        }
        return $return;
    }

    public function update(int $id, UpdateFlowerRequest $request)
    {
        $result = [];
        $return = null;
        $action = new Actions\UpdateFlower();
        try {
            $result['data'] = $action->execute($id, $request->validated());
            $return = (new FlowerResource($result['data']))->response()->setStatusCode(200);
        }
        catch (\Exception $e) {
            $return['error'] = new ErrorJsonResource($e);
        }
        return $return;
    }

    public function updateFields(int $id, UpdateFlowerFieldsRequest $request)
    {
        $result = [];
        $return = null;
        $action = new Actions\UpdateFlowerFields();
        try {
            $result['data'] = $action->execute($id, $request->validated());
            $return = (new FlowerResource($result['data']))->response()->setStatusCode(200);
        }
        catch (\Exception $e) {
            $return['error'] = new ErrorJsonResource($e);
        }
        return $return;
    }

    public function water(int $id)
    {
        $result = [];
        $return = null;
        $action = new Actions\WaterFlower();
        try {
            $result['data'] = $action->execute($id);
            $return = (new FlowerResource($result['data']))->response()->setStatusCode(200);
        }
        catch (\Exception $e) {
            $return['error'] = new ErrorJsonResource($e);
        }
        return $return;
    }
}