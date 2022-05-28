<?php 

namespace App\Domain\Flowers\Actions;

use App\Domain\Flowers\Models\Flower;

class GetFlowerById
{
    public function execute(int $id): Flower
    {
        return Flower::findOrFail($id);
    }
}