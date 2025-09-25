<?php

namespace Tests\Unit;

use App\Models\Message;
use App\Models\User;
use App\Repositories\MessageRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $messageRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->messageRepository = new MessageRepository(new Message());
    }

    public function test_all_returns_all_messages()
    {
        $user = User::factory()->create();
        
        Message::create([
            'sender_name' => 'Test Sender 1',
            'sender_email' => 'sender1@example.com',
            'subject' => 'Test Subject 1',
            'content' => 'Test content 1',
            'recipient_id' => $user->id,
            'status' => 'unread',
        ]);

        Message::create([
            'sender_name' => 'Test Sender 2',
            'sender_email' => 'sender2@example.com',
            'subject' => 'Test Subject 2',
            'content' => 'Test content 2',
            'recipient_id' => $user->id,
            'status' => 'read',
        ]);

        $messages = $this->messageRepository->all();
        $this->assertCount(2, $messages);
    }

    public function test_find_returns_message_by_id()
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

        $foundMessage = $this->messageRepository->find($message->id);
        $this->assertEquals($message->id, $foundMessage->id);
        $this->assertEquals($message->subject, $foundMessage->subject);
    }

    public function test_create_creates_new_message()
    {
        $user = User::factory()->create();
        
        $data = [
            'sender_name' => 'Test Sender',
            'sender_email' => 'sender@example.com',
            'subject' => 'Test Subject',
            'content' => 'Test content',
            'recipient_id' => $user->id,
            'status' => 'unread',
        ];

        $message = $this->messageRepository->create($data);

        $this->assertDatabaseHas('messages', $data);
        $this->assertEquals($data['subject'], $message->subject);
    }

    public function test_update_updates_existing_message()
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

        $updatedData = [
            'subject' => 'Updated Subject',
            'content' => 'Updated content',
        ];

        $updatedMessage = $this->messageRepository->update($message->id, $updatedData);

        $this->assertEquals($updatedData['subject'], $updatedMessage->subject);
        $this->assertEquals($updatedData['content'], $updatedMessage->content);
        $this->assertDatabaseHas('messages', [
            'id' => $message->id,
            'subject' => 'Updated Subject',
            'content' => 'Updated content',
        ]);
    }

    public function test_delete_removes_message()
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

        $result = $this->messageRepository->delete($message->id);

        $this->assertTrue($result);
        $this->assertSoftDeleted('messages', ['id' => $message->id]);
    }

    public function test_count_returns_message_count()
    {
        $user = User::factory()->create();
        
        Message::create([
            'sender_name' => 'Test Sender 1',
            'sender_email' => 'sender1@example.com',
            'subject' => 'Test Subject 1',
            'content' => 'Test content 1',
            'recipient_id' => $user->id,
            'status' => 'unread',
        ]);

        Message::create([
            'sender_name' => 'Test Sender 2',
            'sender_email' => 'sender2@example.com',
            'subject' => 'Test Subject 2',
            'content' => 'Test content 2',
            'recipient_id' => $user->id,
            'status' => 'read',
        ]);

        $count = $this->messageRepository->count();
        $this->assertEquals(2, $count);
    }
}