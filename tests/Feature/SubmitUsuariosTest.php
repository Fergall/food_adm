<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmitUsuariosTest extends TestCase
{
  /** @test */
    function user_can_submit_a_new_link()
    {
        $response = $this->post('/submit', [
            'usuario' => 'UserTest',
            'nombre' => 'Prueba',
            'pass' => 'prueba prueba',
        ]);

        $this->assertDatabaseHas('usuario', [
            'usuario' => 'UserTest'
        ]);

        $response
            ->assertStatus(302)
            ->assertHeader('Location', url('/'));

        $this
            ->get('/')
            ->assertSee('Example Title');
    }


    /** @test */
    function user_is_not_created_if_validation_fails()
    {
        $response = $this->post('/submit');

        $response->assertSessionHasErrors(['usuario', 'nombre', 'pass']);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
      /** @test */
      function guest_can_submit_a_new_user() {}

      /** @test */
      function user_is_not_created_if_validation_fails() {}

      /** @test */
      function user_is_not_created_with_an_invalid_url() {}

      /** @test */
      function max_length_fails_when_too_long() {}

      /** @test */
      function max_length_succeeds_when_under_max() {}
    }
}
