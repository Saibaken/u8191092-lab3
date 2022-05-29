<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domain\Flowers\Models\Flower;
use App\Domain\Rooms\Models\Room;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Room::factory(10)->create()->each(function ($room) {
            $flowers = Flower::factory(rand(1,$room->capacity))->make();
            foreach($flowers as $flower) {
                $room->flowers()->save($flower);
            }
        });

    }
}
