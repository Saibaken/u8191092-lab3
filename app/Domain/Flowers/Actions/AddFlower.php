<?php

namespace App\Domain\Flowers\Actions;

use App\Domain\Flowers\Models\Flower;

class AddFlower
{
    public function execute(array $data): Flower
    {
        return Flower::create($data);
    }
}