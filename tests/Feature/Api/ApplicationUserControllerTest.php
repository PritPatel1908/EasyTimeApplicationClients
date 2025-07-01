<?php

namespace Tests\Feature\Api;

use App\Models\ApplicationUser;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationUserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_url_when_valid_client_code_is_provided()
    {
        // Create a client
        $client = Client::factory()->create();

        // Create an application user with the client
        $applicationUser = ApplicationUser::factory()->create([
            'client_id' => $client->id,
            'client_code' => 'VALID_CODE_123',
            'url' => 'https://example.com/app',
        ]);

        // Send request with valid client code
        $response = $this->postJson('/api/verify-client-code', [
            'client_code' => 'VALID_CODE_123',
        ]);

        // Assert response
        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'url' => 'https://example.com/app',
            ]);
    }

    /** @test */
    public function it_returns_error_when_invalid_client_code_is_provided()
    {
        // Send request with invalid client code
        $response = $this->postJson('/api/verify-client-code', [
            'client_code' => 'INVALID_CODE_123',
        ]);

        // Assert response
        $response->assertStatus(404)
            ->assertJson([
                'status' => 'error',
                'message' => 'Invalid client code or URL not found',
            ]);
    }

    /** @test */
    public function it_validates_client_code_is_required()
    {
        // Send request without client code
        $response = $this->postJson('/api/verify-client-code', []);

        // Assert validation error
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['client_code']);
    }
}
