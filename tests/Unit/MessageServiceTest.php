<?php

namespace Tests\Unit;

use App\Enums\MessageStatusEnum;
use App\Models\Message;
use App\Models\User;
use App\Repositories\MessageRepository;
use App\Services\MessageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class MessageServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $messageRepository;
    protected $messageService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->messageRepository = Mockery::mock(MessageRepository::class);
        $this->messageService = new MessageService($this->messageRepository);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_send_message()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $inputData = [
            'subject' => 'Test Subject',
            'content' => 'Test content',
            'recipient_id' => 2,
        ];

        $expectedData = [
            'sender_name' => $user->name,
            'sender_email' => $user->email,
            'subject' => 'Test Subject',
            'content' => 'Test content',
            'recipient_id' => 2,
            'status' => MessageStatusEnum::UNREAD,
        ];

        $this->messageRepository
            ->shouldReceive('create')
            ->with($expectedData)
            ->andReturn(new Message($expectedData));

        $result = $this->messageService->sendMessage($inputData);

        $this->assertInstanceOf(Message::class, $result);
        $this->assertEquals($expectedData['subject'], $result->subject);
        $this->assertEquals($expectedData['status'], $result->status);
    }

    public function test_find_message()
    {
        $message = new Message([
            'id' => 1,
            'subject' => 'Test Subject',
            'content' => 'Test content',
        ]);

        $this->messageRepository
            ->shouldReceive('find')
            ->with(1, [])
            ->andReturn($message);

        $result = $this->messageService->find(1);

        $this->assertInstanceOf(Message::class, $result);
        $this->assertEquals($message->id, $result->id);
    }

    public function test_archive_message()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $message = new Message([
            'id' => 1,
            'recipient_id' => $user->id,
            'subject' => 'Test Subject',
        ]);

        $this->messageRepository
            ->shouldReceive('find')
            ->with(1, [])
            ->andReturn($message);

        $result = $this->messageService->archiveMessage(1);

        $this->assertTrue($result);
    }

    public function test_archive_message_fails_for_wrong_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $otherUser = User::factory()->create();
        $message = new Message([
            'id' => 1,
            'recipient_id' => $otherUser->id,
            'subject' => 'Test Subject',
        ]);

        $this->messageRepository
            ->shouldReceive('find')
            ->with(1, [])
            ->andReturn($message);

        $result = $this->messageService->archiveMessage(1);

        $this->assertFalse($result);
    }
}