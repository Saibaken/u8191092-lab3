<?php

namespace App\Domain\Flowers\Actions;

use App\Domain\Flowers\Models\Flower;

class GetFlowers
{
    public function execute(): array
    {
        return Flower::all()->toArray();
    }
}