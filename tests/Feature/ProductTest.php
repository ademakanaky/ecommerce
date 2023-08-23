<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * @test
     **/
    public function testProductsCanBeCreatedAndRetrieved()
    {
        $products = Product::factory(5)->create();

        $this->assertNotEmpty($products);
    }
}
