<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;



class CarTest extends TestCase
{
    // In a production environment I could add more tests
    public function test_home_page_loads(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

	
    public function test_api_loads(): void
    {
        $response = $this->get('/api/carPrice?price=1100&type=common');

		$response->assertJson(fn (AssertableJson $json) =>
            $json->where('basic', 50)
                ->where('special', 22)
                ->where('association', 15)
                ->where('storage', 100)
                ->where('total', 1287)
        );
    }
}
