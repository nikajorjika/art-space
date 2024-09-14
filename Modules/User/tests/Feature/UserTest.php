<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Http\Controllers\UserController;
use Modules\User\Models\User;

covers(UserController::class);

uses(Tests\TestCase::class);
uses(RefreshDatabase::class);

describe('User CRUD me/Update/Destroy', function () {

    /** @test */
    it('can retrieve authenticated user', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson(route('api.user.me'));

        $response->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone_prefix' => $user->phone_prefix,
                'phone' => $user->phone,
            ]);
    });

    /** @test */
    it('updates a user successfully', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->putJson(route('api.user.update', $user->id), [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'name' => 'Updated Name',
                'email' => 'updated@example.com',
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
    });
    it('fails to update non authenticated user', function () {
        $user = User::factory()->create();

        $response = $this->putJson(route('api.user.update', $user->id), [
            'name' => 'Updated Name',
        ]);
        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.',
            ]);
    });

    /** @test */
    it('fails to update a user with invalid data', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->putJson(route('api.user.update', $user->id), [
            'name' => '', // Invalid data
            'email' => 'invalid-email', // Invalid email
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email']);
    });

    /** @test */
    it('returns 404 not found in case non-existing user', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->deleteJson(route('api.user.destroy', 999));

        $response->assertStatus(404);
    });

    /** @test */
    it('deletes a user using soft delete successfully', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->deleteJson(route('api.user.destroy', $user->id));

        $response->assertStatus(204);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'deleted_at' => null,
        ]);
    });

    /** @test */
    it('fails to delete a another user when authenticated', function () {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $response = $this->actingAs($user1)->deleteJson(route('api.user.destroy', $user2->id));

        $response->assertStatus(401)
            ->assertJson([
                'message' => trans('Unauthenticated.'),
            ]);
    });
});
