<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testProductsCanBeRetrieved()
    {
        $response = $this->actingAs(
            $user  = User::factory()->state([
                'name' => 'Segun Ibidokun',
                'email' => 'segunibidokun@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Password@123'), // password
                'remember_token' => Str::random(10),
            ])->create())->get('/products');

        $response->assertStatus(200);
    }
}
