<?php

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Modules\User\Http\Controllers\RegistrationController;
use Modules\User\Models\User;

covers(RegistrationController::class);

uses(Tests\TestCase::class);
uses(RefreshDatabase::class);

describe('User registration', function () {

    it('can register a user', function () {
        // Fake the mail sending
        Notification::fake();
        $response = $this->postJson(route('api.user.register'), [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone' => '234567890',
            'phone_prefix' => '+1',
        ]);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'name',
            'email',
            'phone',
            'phone_prefix',
            'updated_at',
            'created_at',
            'id'
        ]);

        // Assert that the user is created in the database
        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com'
        ]);
    });

    it('fails to register a user with missing email', function () {
        $response = $this->postJson(route('api.user.register'), [
            'name' => 'John Doe',
            'email' => '',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertStatus(422); // Validation error
        $response->assertJsonValidationErrors(['email']);
    });


    it('fails to register when email is already taken', function () {
        // Create a user with the email that will be used in the registration attempt
        User::factory()->create([
            'email' => 'existinguser@example.com',
        ]);

        // Attempt to register with the same email
        $response = $this->postJson(route('api.user.register'), [
            'name' => 'Jane Doe',
            'email' => 'existinguser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone' => '234567890',
            'phone_prefix' => '+1',
        ]);

        $response->assertStatus(422); // Validation error
        $response->assertJsonValidationErrors(['email']);

        // Optionally, check the error message
        $response->assertJsonFragment([
            'email' => [trans('The email has already been taken.')],
        ]);
    });

    it('fails to register a user with password mismatch', function () {
        $response = $this->postJson(route('api.user.register'), [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'different password',
        ]);

        $response->assertStatus(422); // Validation error
        $response->assertJsonValidationErrors(['password_confirmation']);
    });


    it('can register a user and sends verification email', function () {
        // Fake the mail sending
        Notification::fake();

        $this->postJson(route('api.user.register'), [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone' => '234567890',
            'phone_prefix' => '+1',
        ]);

        $user = User::where('email', 'johndoe@example.com')->first();

        Notification::assertSentTo($user, VerifyEmail::class);
    });
});
