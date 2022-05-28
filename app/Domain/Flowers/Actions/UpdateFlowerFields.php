<?php

namespace App\Domain\Flowers\Actions;

use App\Domain\Flowers\Models\Flower;

class UpdateFlowerFields
{
    public function execute(int $id, array $data): Flower
    {
        $flower = Flower::findOrFail($id);
        $flower->name = array_key_exists('name', $data) ? $data['name'] : $flower->name;
        $flower->price = array_key_exists('price', $data) ? $data['price'] : $flower->price;
        $flower->watering_time = array_key_exists('watering_time', $data) ? $data['watering_time'] : $flower->watering_time;
        $flower->watering_interval = array_key_exists('watering_interval', $data) ? $data['watering_interval'] : $flower->watering_interval;
        $flower->room_id = array_key_exists('room_id', $data) ? $data['room_id'] : $flower->room_id;
        $flower->save();
        return $flower;
    }
}