<?php

namespace App\Domain\Rooms\Models;

use App\Domain\Flowers\Models\Flower;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
    ];

    public function flowers()
    {
        return $this->hasMany(Flower::class);
    }
}
