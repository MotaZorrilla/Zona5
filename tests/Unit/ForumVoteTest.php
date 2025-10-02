<?php

namespace Tests\Unit;

use App\Models\ForumVote;
use App\Models\User;
use App\Models\ForumPost;
use App\Models\Forum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ForumVoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_forum_vote()
    {
        $user = User::factory()->create();
        $forum = Forum::factory()->create();
        $forumPost = ForumPost::factory()->create([
            'forum_id' => $forum->id,
            'author_id' => $user->id,
        ]);

        $forumVote = ForumVote::create([
            'user_id' => $user->id,
            'forum_post_id' => $forumPost->id,
            'vote_type' => 'like',
        ]);

        $this->assertDatabaseHas('forum_votes', [
            'user_id' => $user->id,
            'forum_post_id' => $forumPost->id,
            'vote_type' => 'like',
        ]);
    }

    public function test_forum_vote_belongs_to_user()
    {
        $user = User::factory()->create();
        $forum = Forum::factory()->create();
        $forumPost = ForumPost::factory()->create([
            'forum_id' => $forum->id,
            'author_id' => $user->id,
        ]);

        $forumVote = ForumVote::create([
            'user_id' => $user->id,
            'forum_post_id' => $forumPost->id,
            'vote_type' => 'like',
        ]);

        $this->assertInstanceOf(User::class, $forumVote->user);
        $this->assertEquals($user->id, $forumVote->user->id);
    }

    public function test_forum_vote_belongs_to_forum_post()
    {
        $user = User::factory()->create();
        $forum = Forum::factory()->create();
        $forumPost = ForumPost::factory()->create([
            'forum_id' => $forum->id,
            'author_id' => $user->id,
        ]);

        $forumVote = ForumVote::create([
            'user_id' => $user->id,
            'forum_post_id' => $forumPost->id,
            'vote_type' => 'like',
        ]);

        $this->assertInstanceOf(ForumPost::class, $forumVote->forumPost);
        $this->assertEquals($forumPost->id, $forumVote->forumPost->id);
    }

    public function test_likes_scope()
    {
        $user = User::factory()->create();
        $forum = Forum::factory()->create();
        $forumPost = ForumPost::factory()->create([
            'forum_id' => $forum->id,
            'author_id' => $user->id,
        ]);

        ForumVote::create([
            'user_id' => $user->id,
            'forum_post_id' => $forumPost->id,
            'vote_type' => 'like',
        ]);

        ForumVote::create([
            'user_id' => $user->id,
            'forum_post_id' => $forumPost->id,
            'vote_type' => 'dislike',
        ]);

        $likes = ForumVote::likes()->get();
        $this->assertCount(1, $likes);
        $this->assertEquals('like', $likes->first()->vote_type);
    }

    public function test_dislikes_scope()
    {
        $user = User::factory()->create();
        $forum = Forum::factory()->create();
        $forumPost = ForumPost::factory()->create([
            'forum_id' => $forum->id,
            'author_id' => $user->id,
        ]);

        ForumVote::create([
            'user_id' => $user->id,
            'forum_post_id' => $forumPost->id,
            'vote_type' => 'like',
        ]);

        ForumVote::create([
            'user_id' => $user->id,
            'forum_post_id' => $forumPost->id,
            'vote_type' => 'dislike',
        ]);

        $dislikes = ForumVote::dislikes()->get();
        $this->assertCount(1, $dislikes);
        $this->assertEquals('dislike', $dislikes->first()->vote_type);
    }

    public function test_by_user_scope()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $forum = Forum::factory()->create();
        $forumPost = ForumPost::factory()->create([
            'forum_id' => $forum->id,
            'author_id' => $user1->id,
        ]);

        ForumVote::create([
            'user_id' => $user1->id,
            'forum_post_id' => $forumPost->id,
            'vote_type' => 'like',
        ]);

        ForumVote::create([
            'user_id' => $user2->id,
            'forum_post_id' => $forumPost->id,
            'vote_type' => 'dislike',
        ]);

        $user1Votes = ForumVote::byUser($user1->id)->get();
        $this->assertCount(1, $user1Votes);
        $this->assertEquals($user1->id, $user1Votes->first()->user_id);
    }

    public function test_for_post_scope()
    {
        $user = User::factory()->create();
        $forum = Forum::factory()->create();
        $forumPost1 = ForumPost::factory()->create([
            'forum_id' => $forum->id,
            'author_id' => $user->id,
        ]);

        $forumPost2 = ForumPost::factory()->create([
            'forum_id' => $forum->id,
            'author_id' => $user->id,
        ]);

        ForumVote::create([
            'user_id' => $user->id,
            'forum_post_id' => $forumPost1->id,
            'vote_type' => 'like',
        ]);

        ForumVote::create([
            'user_id' => $user->id,
            'forum_post_id' => $forumPost2->id,
            'vote_type' => 'dislike',
        ]);

        $votesForPost1 = ForumVote::forPost($forumPost1->id)->get();
        $this->assertCount(1, $votesForPost1);
        $this->assertEquals($forumPost1->id, $votesForPost1->first()->forum_post_id);
    }

    public function test_vote_type_casting()
    {
        $user = User::factory()->create();
        $forum = Forum::factory()->create();
        $forumPost = ForumPost::factory()->create([
            'forum_id' => $forum->id,
            'author_id' => $user->id,
        ]);

        $forumVote = ForumVote::create([
            'user_id' => $user->id,
            'forum_post_id' => $forumPost->id,
            'vote_type' => 'like',
        ]);

        $this->assertIsString($forumVote->vote_type);
        $this->assertEquals('like', $forumVote->vote_type);
    }
}