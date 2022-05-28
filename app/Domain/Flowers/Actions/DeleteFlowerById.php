<?php

namespace App\Domain\Flowers\Actions;

use App\Domain\Flowers\Models\Flower;

class DeleteFlowerById
{
    public function execute(int $id): void
    {
        $flower = Flower::findOrFail($id);
        $flower->delete();
    }
}