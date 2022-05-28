<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
