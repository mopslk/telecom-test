<?php

namespace Tests\Feature;

use App\Models\Equipment;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class EquipmentControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index(): void
    {
        $response = $this->get('/api/equipment');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'serial_number',
                        'description',
                        'equipment_type',
                    ]
                ],
                'links'
            ]);
    }

    public function test_store()
    {
        $equipment = Equipment::factory(1)->create(['type_id' => 1]);

        $response = $this->post('/api/equipment', $equipment->toArray(), [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'serial_number',
                        'description',
                        'equipment_type',
                    ]
                ]
            ]);
    }

    public function test_show()
    {
        $equipment = Equipment::inRandomOrder()->first();
        $response = $this->get('/api/equipment/' . $equipment->id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'serial_number',
                    'description',
                    'equipment_type',
                ]
            ]);
    }

    public function test_update()
    {
        $equipment = Equipment::inRandomOrder()->first();
        $serial_number = rand(100000000, 999999999);

        $response = $this->put('/api/equipment/' . $equipment->id, [
            'serial_number' => $serial_number,
            'description' => 'test',
            'type_id' => 1,
        ]);
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('data')
                    ->where('data.serial_number', $serial_number)
                    ->etc()
            )
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'serial_number',
                    'description',
                    'equipment_type',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }

    public function test_delete()
    {
        $equipment = Equipment::inRandomOrder()->first();

        $response = $this->delete('/api/equipment/' . $equipment->id);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'serial_number',
                'description',
                'equipment_type',
                'created_at',
                'updated_at',
            ]
        ]);
    }
}
