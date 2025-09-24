<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a user and assign a role
        $this->user = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'User']);
        $this->user->roles()->attach($role->id);
    }

    public function test_user_can_view_messages()
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'User']);
        $user->roles()->attach($role->id);
        
        Message::create([
            'sender_name' => 'Test Sender',
            'sender_email' => 'sender@example.com',
            'subject' => 'Test Subject',
            'content' => 'Test content',
            'recipient_id' => $user->id,
            'status' => 'unread',
        ]);

        $response = $this->actingAs($user)
            ->get('/admin/messages');

        $response->assertStatus(200);
        $response->assertViewHas('messages');
    }

    public function test_user_can_view_individual_message()
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'User']);
        $user->roles()->attach($role->id);
        
        $message = Message::create([
            'sender_name' => 'Test Sender',
            'sender_email' => 'sender@example.com',
            'subject' => 'Test Subject',
            'content' => 'Test content',
            'recipient_id' => $user->id,
            'status' => 'unread',
        ]);

        $response = $this->actingAs($user)
            ->get("/admin/messages/{$message->id}");

        $response->assertStatus(200);
        $response->assertViewHas('message');
    }

    public function test_user_can_create_message()
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'User']);
        $user->roles()->attach($role->id);
        
        $recipient = User::factory()->create();
        $recipient->roles()->attach($role->id);

        $response = $this->actingAs($user)
            ->post('/admin/messages', [
                'recipient_id' => $recipient->id,
                'subject' => 'Test Subject',
                'content' => 'Test content',
                '_token' => csrf_token(),
            ]);

        $response->assertRedirect('/admin/messages');
        $this->assertDatabaseHas('messages', [
            'sender_name' => $user->name,
            'sender_email' => $user->email,
            'subject' => 'Test Subject',
            'content' => 'Test content',
            'recipient_id' => $recipient->id,
        ]);
    }

    public function test_user_can_archive_message()
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'User']);
        $user->roles()->attach($role->id);
        
        $message = Message::create([
            'sender_name' => 'Test Sender',
            'sender_email' => 'sender@example.com',
            'subject' => 'Test Subject',
            'content' => 'Test content',
            'recipient_id' => $user->id,
            'status' => 'unread',
        ]);

        $response = $this->actingAs($user)
            ->post("/admin/messages/{$message->id}/archive", [
                '_token' => csrf_token(),
            ]);

        $response->assertRedirect('/admin/messages');
        $this->assertEquals('archived', $message->fresh()->status);
    }

    public function test_user_can_delete_message()
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'User']);
        $user->roles()->attach($role->id);
        
        $message = Message::create([
            'sender_name' => 'Test Sender',
            'sender_email' => 'sender@example.com',
            'subject' => 'Test Subject',
            'content' => 'Test content',
            'recipient_id' => $user->id,
            'status' => 'unread',
        ]);

        $response = $this->actingAs($user)
            ->delete("/admin/messages/{$message->id}", [
                '_token' => csrf_token(),
            ]);

        $response->assertRedirect('/admin/messages');
        $this->assertSoftDeleted('messages', [
            'id' => $message->id,
        ]);
    }
}