<?php

namespace Tests\Unit;

use App\Models\Forum;
use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ForumTest extends TestCase
{
    use RefreshDatabase;

    public function test_forum_has_fillable_attributes()
    {
        $forum = new Forum();
        $fillable = [
            'title',
            'description',
            'category',
            'is_active',
            'is_pinned',
            'order',
            'created_by',
            'posts_count',
            'last_activity_at',
            'color',
            'icon',
            'views_count',
            'is_featured',
            'excerpt',
        ];

        $this->assertEquals($fillable, $forum->getFillable());
    }

    public function test_forum_has_many_posts()
    {
        $forum = Forum::factory()->create();
        ForumPost::factory()->count(3)->create(['forum_id' => $forum->id]);

        $this->assertInstanceOf("\Illuminate\Database\Eloquent\Collection::class", $forum->posts);
        $this->assertCount(3, $forum->posts);
    }

    public function test_forum_belongs_to_a_creator()
    {
        $user = User::factory()->create();
        $forum = Forum::factory()->create(['created_by' => $user->id]);

        $this->assertInstanceOf(User::class, $forum->creator);
        $this->assertEquals($user->id, $forum->creator->id);
    }

    public function test_forum_has_one_latest_post()
    {
        $forum = Forum::factory()->create();
        ForumPost::factory()->create(['forum_id' => $forum->id, 'created_at' => now()->subDay()]);
        $latestPost = ForumPost::factory()->create(['forum_id' => $forum->id, 'created_at' => now()]);

        $this->assertInstanceOf(ForumPost::class, $forum->latestPost);
        $this->assertEquals($latestPost->id, $forum->latestPost->id);
    }

    public function test_active_scope()
    {
        Forum::factory()->create(['is_active' => true]);
        Forum::factory()->create(['is_active' => false]);

        $this->assertCount(1, Forum::active()->get());
    }

    public function test_pinned_scope()
    {
        Forum::factory()->create(['is_pinned' => true]);
        Forum::factory()->create(['is_pinned' => false]);

        $this->assertCount(1, Forum::pinned()->get());
    }

    public function test_ordered_scope()
    {
        $forum1 = Forum::factory()->create(['is_pinned' => false, 'order' => 2]);
        $forum2 = Forum::factory()->create(['is_pinned' => true, 'order' => 1]);

        $forums = Forum::ordered()->get();

        $this->assertEquals($forum2->id, $forums->first()->id);
    }

    public function test_update_posts_count()
    {
        $forum = Forum::factory()->create();
        ForumPost::factory()->count(5)->create(['forum_id' => $forum->id]);

        $forum->updatePostsCount();

        $this->assertEquals(5, $forum->posts_count);
    }

    public function test_update_last_activity()
    {
        $forum = Forum::factory()->create(['last_activity_at' => now()->subDay()]);

        $forum->updateLastActivity();

        $this->assertNotEquals(now()->subDay(), $forum->last_activity_at);
    }

    public function test_increment_views()
    {
        $forum = Forum::factory()->create(['views_count' => 0]);

        $forum->incrementViews();

        $this->assertEquals(1, $forum->views_count);
    }
}
