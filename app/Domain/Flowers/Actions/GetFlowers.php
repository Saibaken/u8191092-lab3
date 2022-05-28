<?php

namespace App\Domain\Flowers\Actions;

use App\Domain\Flowers\Models\Flower;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetFlowers
{
    public function execute(): LengthAwarePaginator
    {
        return Flower::query()->paginate(10);
    }
}