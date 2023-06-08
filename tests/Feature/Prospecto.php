<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Prospecto extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     public function ConsultarProspectos()
     {
        $response = $this->get('/seguimiento/index');

        $response->assertStatus(200);
     }

    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
