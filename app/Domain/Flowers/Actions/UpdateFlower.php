<?php

namespace App\Domain\Flowers\Actions;

use App\Domain\Flowers\Models\Flower;

class UpdateFlower
{
    public function execute(int $id, array $data): void
    {
        $flower = Flower::findOrFail($id);
        $flower->update($data);
    }
}