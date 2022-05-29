<?php

namespace App\Domain\Flowers\Actions;

use App\Domain\Flowers\Models\Flower;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetFlowers
{
    public function execute(array $request): LengthAwarePaginator
    {
        $page = $request['page'] ?? 1;
        $pageSize = $request['page_size'] ?? 10;
        $field = $request['field'] ?? 'id';
        $order = $request['order'] ?? 'asc';
        return Flower::orderBy($field, $order)->paginate($pageSize, ['*'], 'page', $page);
    }
}