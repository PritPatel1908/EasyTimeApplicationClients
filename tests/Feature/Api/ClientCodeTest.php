<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Client;
use App\Models\ApplicationUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientCodeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_success_with_url_when_client_code_exists()
    {
        // Create a client
        $client = Client::factory()->create([
            'is_active' => true,
        ]);

        // Create an application user with a client code
        $applicationUser = ApplicationUser::factory()->create([
            'client_id' => $client->id,
            'client_code' => 'TEST123',
            'url' => 'https://example.com/app',
            'allow_login' => true,
        ]);

        // Make API request
        $response = $this->postJson('/api/verify-client-code', [
            'client_code' => 'TEST123',
        ]);

        // Assert response
        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'url' => 'https://example.com/app',
                'message' => 'Client code found',
            ]);
    }

    /** @test */
    public function it_returns_error_when_client_code_does_not_exist()
    {
        // Make API request with non-existent client code
        $response = $this->postJson('/api/verify-client-code', [
            'client_code' => 'NONEXISTENT',
        ]);

        // Assert response
        $response->assertStatus(404)
            ->assertJson([
                'status' => 'error',
                'message' => 'Client code not found',
            ]);
    }

    /** @test */
    public function it_validates_client_code_is_required()
    {
        // Make API request without client code
        $response = $this->postJson('/api/verify-client-code', []);

        // Assert validation error
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['client_code']);
    }
}
