<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_dashboard()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

}
