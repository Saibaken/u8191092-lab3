<?php

namespace App\Http\APIV1\Room\Controllers;

use App\Domain\Rooms\Actions\GetAllRooms;
use App\Http\APIV1\Room\Resources\RoomCollection;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function getAll()
    {
        $action = new GetAllRooms();
        return new RoomCollection($action->execute());
    }
}