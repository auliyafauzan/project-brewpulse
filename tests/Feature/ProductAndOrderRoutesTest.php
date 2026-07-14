<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductAndOrderRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_index_page_loads(): void
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
    }

    public function test_products_create_page_loads(): void
    {
        $response = $this->get('/products/create');

        $response->assertStatus(200);
    }

    public function test_orders_page_loads(): void
    {
        $response = $this->get('/orders');

        $response->assertStatus(200);
    }
}
