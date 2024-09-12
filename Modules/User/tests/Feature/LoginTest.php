<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Models\User;

uses(Tests\TestCase::class);
uses(RefreshDatabase::class);

describe('User Login', function () {

    /** @test */
    it('logs in successfully with correct credentials', function () {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson(route('api.user.login'), [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'access_token',
                'token_type',
            ]);

        $this->assertAuthenticatedAs($user);
    });

    /** @test */
    it('fails login with incorrect password', function () {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson(route('api.user.login'), [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email' => trans('The provided credentials do not match our records.')]);
    });

    /** @test */
    it('fails login with missing email field', function () {
        User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson(route('api.user.login'), [
            'password' => 'password123',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    });
});
