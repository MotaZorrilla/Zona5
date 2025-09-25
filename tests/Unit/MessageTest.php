<?php

namespace Tests\Unit;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_message_can_be_created()
    {
        $user = User::factory()->create();
        
        $message = Message::create([
            'sender_name' => 'Test Sender',
            'sender_email' => 'sender@example.com',
            'subject' => 'Test Subject',
            'content' => 'Test content',
            'recipient_id' => $user->id,
            'status' => 'unread',
        ]);

        $this->assertDatabaseHas('messages', [
            'sender_name' => 'Test Sender',
            'sender_email' => 'sender@example.com',
            'subject' => 'Test Subject',
            'content' => 'Test content',
            'recipient_id' => $user->id,
            'status' => 'unread',
        ]);
    }

    public function test_message_belongs_to_recipient()
    {
        $user = User::factory()->create();
        
        $message = Message::create([
            'sender_name' => 'Test Sender',
            'sender_email' => 'sender@example.com',
            'subject' => 'Test Subject',
            'content' => 'Test content',
            'recipient_id' => $user->id,
            'status' => 'unread',
        ]);

        $this->assertEquals($user->id, $message->recipient->id);
    }

    public function test_message_can_be_archived()
    {
        $user = User::factory()->create();
        
        $message = Message::create([
            'sender_name' => 'Test Sender',
            'sender_email' => 'sender@example.com',
            'subject' => 'Test Subject',
            'content' => 'Test content',
            'recipient_id' => $user->id,
            'status' => 'unread',
        ]);

        $message->archive();
        
        $freshMessage = $message->fresh();
        $this->assertEquals('archived', $freshMessage->status);
        $this->assertNotNull($freshMessage->archived_at);
    }

    public function test_message_can_be_marked_as_read()
    {
        $user = User::factory()->create();
        
        $message = Message::create([
            'sender_name' => 'Test Sender',
            'sender_email' => 'sender@example.com',
            'subject' => 'Test Subject',
            'content' => 'Test content',
            'recipient_id' => $user->id,
            'status' => 'unread',
        ]);

        $this->assertTrue($message->isUnread());

        $message->markAsRead();
        
        $freshMessage = $message->fresh();
        $this->assertEquals('read', $freshMessage->status);
        $this->assertNotNull($freshMessage->read_at);
        $this->assertFalse($freshMessage->isUnread());
    }

    public function test_message_can_be_marked_as_unread()
    {
        $user = User::factory()->create();
        
        $message = Message::create([
            'sender_name' => 'Test Sender',
            'sender_email' => 'sender@example.com',
            'subject' => 'Test Subject',
            'content' => 'Test content',
            'recipient_id' => $user->id,
            'status' => 'read',
            'read_at' => now(),
        ]);

        $this->assertFalse($message->isUnread());

        $message->markAsUnread();
        
        $this->assertEquals('unread', $message->fresh()->status);
        $this->assertNull($message->fresh()->read_at);
        $this->assertTrue($message->fresh()->isUnread());
    }
}