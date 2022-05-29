<?php

namespace App\Domain\Flowers\Models;

use App\Domain\Rooms\Models\Room;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\FlowerFactory;

class Flower extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'watering_time',
        'watering_interval',
        'room_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    protected static function newFactory()
    {
        return new FlowerFactory();
    }
}
