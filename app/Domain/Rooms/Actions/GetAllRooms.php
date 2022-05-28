<?php

namespace App\Domain\Rooms\Actions;

use App\Domain\Rooms\Models\Room;

class GetAllRooms
{
    public function execute(): array
    {
        return Room::all()->toArray();
    }
}