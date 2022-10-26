<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EquipmentTypeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example(): void
    {
        $response = $this->get('/api/equipment-type');

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => true,
                        'name' => true,
                        'mask' => true,
                    ]
                ],
                'links' => true
            ]);
    }
}
