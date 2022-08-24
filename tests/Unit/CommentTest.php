<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test for obtaining the name of a registered user.
     *
     * @return void
     */
    public function testGetUserName()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->for($user)->create();
        $name = $user->name;
        $userName = $comment->user->name;

        $this->assertEquals($name, $userName);
    }

    /**
     * Anonymous User Test.
     *
     * @return void
     */
    public function testGetAnonymous()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->for($user)->create();
        $user->delete();
        $userName = $comment->user->name;

        $this->assertEquals('Anonymous', $userName);
    }
}
