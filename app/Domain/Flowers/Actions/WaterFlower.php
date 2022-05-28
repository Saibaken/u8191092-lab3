<?php

namespace App\Domain\Flowers\Actions;

use App\Domain\Flowers\Models\Flower;

class WaterFlower
{
    public function execute(int $id): Flower
    {
        $flower = Flower::findOrFail($id);
        $flower->watering_time = now();
        $flower->save();
        return $flower;
    }
}