<?php

namespace Tests\Unit;

use App\Models\ForumPost;
use App\Models\Forum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ForumPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_forum_post()
    {
        $forum = Forum::factory()->create();
        $user = User::factory()->create();

        $forumPost = ForumPost::create([
            'forum_id' => $forum->id,
            'title' => 'Test Post Title',
            'content' => 'Test post content',
            'author_id' => $user->id,
            'is_pinned' => false,
            'is_locked' => false,
            'is_approved' => true,
            'likes_count' => 0,
            'dislikes_count' => 0,
            'views_count' => 0,
            'slug' => 'test-post-title',
        ]);

        $this->assertDatabaseHas('forum_posts', [
            'forum_id' => $forum->id,
            'title' => 'Test Post Title',
            'is_approved' => true,
        ]);
    }

    public function test_forum_post_belongs_to_forum()
    {
        $forum = Forum::factory()->create();
        $user = User::factory()->create();
        $forumPost = ForumPost::factory()->create([
            'forum_id' => $forum->id,
            'author_id' => $user->id,
        ]);

        $this->assertInstanceOf(Forum::class, $forumPost->forum);
        $this->assertEquals($forum->id, $forumPost->forum->id);
    }

    public function test_forum_post_belongs_to_author()
    {
        $forum = Forum::factory()->create();
        $user = User::factory()->create();
        $forumPost = ForumPost::factory()->create([
            'forum_id' => $forum->id,
            'author_id' => $user->id,
        ]);

        $this->assertInstanceOf(User::class, $forumPost->author);
        $this->assertEquals($user->id, $forumPost->author->id);
    }

    public function test_forum_post_has_replies()
    {
        $forum = Forum::factory()->create();
        $user = User::factory()->create();
        
        $parentPost = ForumPost::factory()->create([
            'forum_id' => $forum->id,
            'author_id' => $user->id,
        ]);

        $childPost = ForumPost::factory()->create([
            'forum_id' => $forum->id,
            'author_id' => $user->id,
            'parent_id' => $parentPost->id,
        ]);

        $this->assertTrue($parentPost->hasReplies());
        $this->assertEquals(1, $parentPost->repliesCount());
        $this->assertCount(1, $parentPost->replies);
    }

    public function test_approve_scope()
    {
        $forum = Forum::factory()->create();
        $user = User::factory()->create();

        ForumPost::create([
            'forum_id' => $forum->id,
            'title' => 'Approved Post',
            'content' => 'Approved content',
            'author_id' => $user->id,
            'is_approved' => true,
        ]);

        ForumPost::create([
            'forum_id' => $forum->id,
            'title' => 'Pending Post',
            'content' => 'Pending content',
            'author_id' => $user->id,
            'is_approved' => false,
        ]);

        $approvedPosts = ForumPost::approved()->get();
        $this->assertCount(1, $approvedPosts);
        $this->assertEquals('Approved Post', $approvedPosts->first()->title);
    }

    public function test_pinned_scope()
    {
        $forum = Forum::factory()->create();
        $user = User::factory()->create();

        ForumPost::create([
            'forum_id' => $forum->id,
            'title' => 'Pinned Post',
            'content' => 'Pinned content',
            'author_id' => $user->id,
            'is_pinned' => true,
        ]);

        ForumPost::create([
            'forum_id' => $forum->id,
            'title' => 'Normal Post',
            'content' => 'Normal content',
            'author_id' => $user->id,
            'is_pinned' => false,
        ]);

        $pinnedPosts = ForumPost::pinned()->get();
        $this->assertCount(1, $pinnedPosts);
        $this->assertEquals('Pinned Post', $pinnedPosts->first()->title);
    }

    public function test_casts_attributes()
    {
        $forum = Forum::factory()->create();
        $user = User::factory()->create();

        $forumPost = ForumPost::create([
            'forum_id' => $forum->id,
            'title' => 'Test Post',
            'content' => 'Test content',
            'author_id' => $user->id,
            'is_pinned' => '1',
            'is_locked' => '0',
            'is_approved' => '1',
            'likes_count' => '5',
            'dislikes_count' => '2',
            'views_count' => '10',
            'attachments' => ['file1.jpg', 'file2.pdf'],
        ]);

        $this->assertTrue($forumPost->is_pinned);
        $this->assertFalse($forumPost->is_locked);
        $this->assertTrue($forumPost->is_approved);
        $this->assertIsInt($forumPost->likes_count);
        $this->assertIsInt($forumPost->dislikes_count);
        $this->assertIsArray($forumPost->attachments);
        $this->assertEquals(['file1.jpg', 'file2.pdf'], $forumPost->attachments);
    }
}