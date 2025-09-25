<?php

namespace Tests\Unit;

use App\Http\Requests\MessageFormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_message_form_request_validation()
    {
        // Create a user for authentication
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        // Create a different user to send message to
        $recipient = \App\Models\User::factory()->create();

        // Valid data
        $validData = [
            'recipient_id' => $recipient->id,
            'subject' => 'Test Subject',
            'content' => 'Test content',
        ];

        $request = MessageFormRequest::createFrom($this->createRequest('POST', '/test', $validData));
        $request->setContainer($this->app);
        $request->setRedirector($this->app['redirect']);

        // This should not throw any validation errors
        $this->expectNotToPerformAssertions(); // We expect validation to pass

        try {
            $request->validateResolved();
        } catch (HttpResponseException $e) {
            $this->fail('Validation should pass but failed with: ' . $e->getMessage());
        }
    }

    public function test_message_form_request_fails_with_invalid_data()
    {
        // Create a user for authentication
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        // Invalid data - missing required fields
        $invalidData = [
            'recipient_id' => '',  // Required field missing
            'subject' => '',       // Required field missing
            'content' => '',       // Required field missing
        ];

        $request = MessageFormRequest::createFrom($this->createRequest('POST', '/test', $invalidData));
        $request->setContainer($this->app);
        $request->setRedirector($this->app['redirect']);

        // We expect validation to fail
        try {
            $request->validateResolved();
            $this->fail('Validation should fail but passed');
        } catch (HttpResponseException $e) {
            // This is expected - validation failed
            $this->assertTrue(true);
        }
    }

    protected function createRequest($method, $uri, $data = [])
    {
        $request = \Illuminate\Http\Request::create($uri, $method, $data);
        $request->setLaravelSession($this->app['session']->driver());
        return $request;
    }
}