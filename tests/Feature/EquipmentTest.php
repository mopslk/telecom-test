<?php

namespace Tests\Feature;

use Tests\TestCase;

class EquipmentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example(): void
    {
        $response = $this->get('/api/equipment');

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => true,
                        'serial_number' => true,
                        'description' => true,
                        'equipment_type' => true,
                    ]
                ],
                'links' => true
            ]);
    }
}
