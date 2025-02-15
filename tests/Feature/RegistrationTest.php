<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can register with valid data.
     */
    public function test_user_can_register_with_valid_data()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        // Adjust the redirect route if your app uses a different one.
        $response->assertRedirect('/dashboard');

        // Check that the user was created in the database.
        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
        ]);
    }

    /**
     * Test that registration fails when using an invalid email.
     */
    public function test_registration_fails_with_invalid_email()
    {
        $response = $this->post('/register', [
            'name' => 'Jane Doe',
            'email' => 'not-a-valid-email',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        // Expect an error for the 'email' field.
        $response->assertSessionHasErrors('email');
    }
}
