<?php

namespace Tests\Feature;

use App\Domain\Flowers\Models\Flower;
use App\Domain\Rooms\Models\Room;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as Faker;

use function PHPSTORM_META\expectedArguments;

uses(DatabaseTransactions::class);

uses()->group('flowers');

test('Create a flower', function () {
    $flower = Flower::factory()->raw();
    $response = $this->postJson('/api/flowers', [
        'id' => 1,
        'name' => $flower['name'],
        'price' => $flower['price'],
        'watering_time' => $flower['watering_time']->format('c'),
        'watering_interval' => $flower['watering_interval'],
        'room_id' => $flower['room_id'],
    ]);
    $response->assertStatus(201)->assertJson([
        'data' => [
            'name' => $flower['name'],
            'price' => $flower['price'],
            'watering_time' => $flower['watering_time']->format('c'),
            'watering_interval' => $flower['watering_interval'],
            'room_id' => $flower['room_id'],
        ],
    ]);
    $this->assertDatabaseHas('flowers', $flower);
});

test('Missing room_id while creating a flower', function () {
    $response = $this->postJson('/api/flowers', [
        'id' => 1,
        'name' => 'A',
        'price' => '1',
        'watering_time' => '2020-07-10 15:00:00.000',
        'watering_interval' => '1',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The room id field is required.',
        ]
    ]);
});

test('Missing name while creating a flower', function() {
    $response = $this->postJson('/api/flowers', [
        'id' => 1,
        'price' => '1',
        'watering_time' => '2020-07-10 15:00:00.000',
        'watering_interval' => '1',
        'room_id' => '1',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The name field is required.',
        ]
    ]);
});

test('Missing price while creating a flower', function() {
    $response = $this->postJson('/api/flowers', [
        'id' => 1,
        'name' => 'A',
        'watering_time' => '2020-07-10 15:00:00.000',
        'watering_interval' => '1',
        'room_id' => '1',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The price field is required.',
        ]
    ]);
});

test('Missing watering_time while creating a flower', function() {
    $response = $this->postJson('/api/flowers', [
        'id' => 1,
        'name' => 'A',
        'price' => '1',
        'watering_interval' => '1',
        'room_id' => '1',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The watering time field is required.',
        ]
    ]);
});

test('Missing watering_interval while creating a flower', function() {
    $response = $this->postJson('/api/flowers', [
        'id' => 1,
        'name' => 'A',
        'price' => '1',
        'watering_time' => '2020-07-10 15:00:00.000',
        'room_id' => '1',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The watering interval field is required.',
        ]
    ]);
});

test('Update a flower', function() {
    $oldFlower = Flower::factory()->create();
    $newFlower = Flower::factory()->raw();
    $response = $this->putJson('/api/flowers/1', [
        'id' => $oldFlower->id,
        'name' => $newFlower['name'],
        'price' => $newFlower['price'],
        'watering_time' => $newFlower['watering_time']->format('c'),
        'watering_interval' => $newFlower['watering_interval'],
        'room_id' => $newFlower['room_id'],
    ]);
    $response->assertStatus(200)->assertJson([
        'data' => [
            'name' => $newFlower['name'],
            'price' => $newFlower['price'],
            'watering_time' => $newFlower['watering_time']->format('c'),
            'watering_interval' => $newFlower['watering_interval'],
            'room_id' => $newFlower['room_id'],
        ],
    ]);
    $this->assertDatabaseHas('flowers', $newFlower);
});

test('Update a flower, but name is missing', function() {
    $response = $this->putJson('/api/flowers/1', [
        'id' => 1,
        'price' => '1',
        'watering_time' => '2020-07-10 15:00:00.000',
        'watering_interval' => '1',
        'room_id' => '1',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The name field is required.',
        ]
    ]);
});

test('Update a flower, but price is missing', function() {
    $response = $this->putJson('/api/flowers/1', [
        'id' => 1,
        'name' => 'A',
        'watering_time' => '2020-07-10 15:00:00.000',
        'watering_interval' => '1',
        'room_id' => '1',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The price field is required.',
        ]
    ]);
});

test('Update a flower, but watering_time is missing', function() {
    $response = $this->putJson('/api/flowers/1', [
        'id' => 1,
        'name' => 'A',
        'price' => '1',
        'watering_interval' => '1',
        'room_id' => '1',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The watering time field is required.',
        ]
    ]);
});

test('Update a flower, but watering_interval is missing', function() {
    $response = $this->putJson('/api/flowers/1', [
        'id' => 1,
        'name' => 'A',
        'price' => '1',
        'watering_time' => '2020-07-10 15:00:00.000',
        'room_id' => '1',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The watering interval field is required.',
        ]
    ]);
});

test('Update a flower, but room_id is missing', function() {
    $response = $this->putJson('/api/flowers/1', [
        'id' => 1,
        'name' => 'A',
        'price' => '1',
        'watering_time' => '2020-07-10 15:00:00.000',
        'watering_interval' => '1',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The room id field is required.',
        ]
    ]);
});

test('Update a flower, but id is missing', function() {
    $response = $this->putJson('/api/flowers/1', [
        'name' => 'A',
        'price' => '1',
        'watering_time' => '2020-07-10 15:00:00.000',
        'watering_interval' => '1',
        'room_id' => '1',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The id field is required.',
        ]
    ]);
});

test('Update a flower, but room_id is not a number', function() {
    $response = $this->putJson('/api/flowers/1', [
        'id' => 1,
        'name' => 'A',
        'price' => '1',
        'watering_time' => '2020-07-10 15:00:00.000',
        'watering_interval' => '1',
        'room_id' => 'A',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The room id must be an integer.',
        ]
    ]);
});

test('Update a flower, but id is not a number', function() {
    $response = $this->putJson('/api/flowers/1', [
        'id' => 'A',
        'name' => 'A',
        'price' => '1',
        'watering_time' => '2020-07-10 15:00:00.000',
        'watering_interval' => '1',
        'room_id' => '1',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The id must be an integer.',
        ]
    ]);
});

test('Update a flower, but price is not a number', function() {
    $response = $this->putJson('/api/flowers/1', [
        'id' => 1,
        'name' => 'A',
        'price' => 'A',
        'watering_time' => '2020-07-10 15:00:00.000',
        'watering_interval' => '1',
        'room_id' => '1',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The price must be an integer.',
        ]
    ]);
});

test('Update a flower, but watering_interval is not a number', function() {
    $response = $this->putJson('/api/flowers/1', [
        'id' => 1,
        'name' => 'A',
        'price' => '1',
        'watering_time' => '2020-07-10 15:00:00.000',
        'watering_interval' => 'A',
        'room_id' => '1',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The watering interval must be an integer.',
        ]
    ]);
});

test('Update a flower, but watering_time is not a date', function() {
    $response = $this->putJson('/api/flowers/1', [
        'id' => 1,
        'name' => 'A',
        'price' => '1',
        'watering_time' => "A",
        'watering_interval' => '1',
        'room_id' => '1',
    ]);
    $response->assertStatus(400)->assertJson([
        'data' => [
            'code' => 400,
            'message' => 'The watering time is not a valid date.',
        ]
    ]);
});

test('Delete a flower', function() {
    $flower = Flower::factory()->create();
    $response = $this->deleteJson("/api/flowers/{$flower->id}");
    $response->assertStatus(200)->assertJson([
        'data' => null
    ]);
    $this->assertDatabaseMissing('flowers', [
        'id' => $flower->id,
    ]);
});

test('Delete a flower that does not exist', function() {
    $flower = Flower::factory()->create();
    $flower->delete();
    $response = $this->deleteJson("/api/flowers/{$flower->id}");
    $response->assertStatus(200)->assertJson([
        'data' => null
    ]);
    $this->assertDatabaseMissing('flowers', $flower->toArray());
});

test('Update flower field name', function() {
    $flower = Flower::factory()->create();
    $faker = Faker::create();
    $name = $faker->word;
    $response = $this->patchJson("/api/flowers/{$flower->id}", [
        'name' => $name,
    ]);
    $response->assertStatus(200)->assertJson([
        'data' => [
            'id' => $flower->id,
            'name' => $name,
            'price' => $flower->price,
            'watering_time' => $flower->watering_time->format('Y-m-d H:i:s'),
            'watering_interval' => $flower->watering_interval,
            'room_id' => $flower->room_id,
        ]
    ]);
    $this->assertDatabaseHas('flowers', [
        'id' => $flower->id,
        'name' => $name,
    ]);
});

test('Update flower field price', function() {
    $flower = Flower::factory()->create();
    $faker = Faker::create();
    $price = $faker->numberBetween(1, 100);
    $response = $this->patchJson("/api/flowers/{$flower->id}", [
        'price' => $price,
    ]);
    $response->assertStatus(200)->assertJson([
        'data' => [
            'id' => $flower->id,
            'name' => $flower->name,
            'price' => $price,
            'watering_time' => $flower->watering_time->format('Y-m-d H:i:s'),
            'watering_interval' => $flower->watering_interval,
            'room_id' => $flower->room_id,
        ]
    ]);
    $this->assertDatabaseHas('flowers', [
        'id' => $flower->id,
        'price' => $price,
    ]);
});

test('Update flower field watering_time', function() {
    $flower = Flower::factory()->create();
    $faker = Faker::create();
    $watering_time = $faker->dateTimeBetween('-1 week', '+1 week');
    $response = $this->patchJson("/api/flowers/{$flower->id}", [
        'watering_time' => $watering_time->format('Y-m-d H:i:s'),
    ]);
    $response->assertStatus(200)->assertJson([
        'data' => [
            'id' => $flower->id,
            'name' => $flower->name,
            'price' => $flower->price,
            'watering_time' => $watering_time->format('Y-m-d H:i:s'),
            'watering_interval' => $flower->watering_interval,
            'room_id' => $flower->room_id,
        ]
    ]);
    $this->assertDatabaseHas('flowers', [
        'id' => $flower->id,
        'watering_time' => $watering_time->format('Y-m-d H:i:s'),
    ]);
});

test('Update flower field watering_interval', function() {
    $flower = Flower::factory()->create();
    $faker = Faker::create();
    $watering_interval = $faker->numberBetween(1, 10);
    $response = $this->patchJson("/api/flowers/{$flower->id}", [
        'watering_interval' => $watering_interval,
    ]);
    $response->assertStatus(200)->assertJson([
        'data' => [
            'id' => $flower->id,
            'name' => $flower->name,
            'price' => $flower->price,
            'watering_time' => $flower->watering_time->format('Y-m-d H:i:s'),
            'watering_interval' => $watering_interval,
            'room_id' => $flower->room_id,
        ]
    ]);
    $this->assertDatabaseHas('flowers', [
        'id' => $flower->id,
        'watering_interval' => $watering_interval,
    ]);
});

test('Update flower field room_id', function() {
    $flower = Flower::factory()->create();
    $faker = Faker::create();
    $room_id = $faker->numberBetween(1, 10);
    $response = $this->patchJson("/api/flowers/{$flower->id}", [
        'room_id' => $room_id,
    ]);
    $response->assertStatus(200)->assertJson([
        'data' => [
            'id' => $flower->id,
            'name' => $flower->name,
            'price' => $flower->price,
            'watering_time' => $flower->watering_time->format('Y-m-d H:i:s'),
            'watering_interval' => $flower->watering_interval,
            'room_id' => $room_id,
        ]
    ]);
    $this->assertDatabaseHas('flowers', [
        'id' => $flower->id,
        'room_id' => $room_id,
    ]);
});

test('Water flower', function() {
    $flower = Flower::factory()->create();
    $start = (new DateTime())->getTimestamp();
    $response = $this->postJson("/api/flowers/{$flower->id}/water");
    $end = (new DateTime())->modify('+1 minute')->getTimestamp();
    $response->assertStatus(200)->assertJson([
        'data' => [
            'id' => $flower->id,
            'name' => $flower->name,
            'price' => $flower->price,
            'watering_interval' => $flower->watering_interval,
            'room_id' => $flower->room_id,
        ]
    ]);
    $responseTimeStamp = (new DateTime($response['data']['watering_time']))->getTimestamp();
    expect($responseTimeStamp)->toEqualWithDelta($start, $end-$start);
    $this->assertDatabaseHas('flowers', [
        'id' => $flower->id,
        'watering_time' => (new DateTime($response['data']['watering_time']))->format('c'),
    ]);
});

test('Get flower by id', function() {
    $flower = Flower::factory()->create();
    $response = $this->getJson("/api/flowers/{$flower->id}");
    $response->assertStatus(200)->assertJson([
        'data' => [
            'id' => $flower->id,
            'name' => $flower->name,
            'price' => $flower->price,
            'watering_time' => $flower->watering_time->format('Y-m-d H:i:s'),
            'watering_interval' => $flower->watering_interval,
            'room_id' => $flower->room_id,
        ]
    ]);
    $this->assertDatabaseHas('flowers', [
        'id' => $flower->id,
    ]);
});

test('Get flower that does not exist by id', function() {
    $flower = Flower::factory()->create();
    $flower->delete();
    $response = $this->getJson("/api/flowers/{$flower->id}");
    $response->assertStatus(404)->assertJson([
        'data' => [
            'code' => 404,
            'message' => "No query results for model [App\\Domain\\Flowers\\Models\\Flower] $flower->id",
        ]
    ]);
});
