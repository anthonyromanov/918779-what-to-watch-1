<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Film;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use RefreshDatabase;

    public function testFilmComments()
    {
        $count = random_int(2, 10);
        $user = User::factory(3)->create();
        $film = Film::factory()->create();
        $comments = Comment::factory()->count($count)->create();


        $comment = $film->comments->first();

        $response = $this->getJson(route('comments.index', $film->id));

        $response->assertStatus(200);
        $response->assertJsonFragment(['count' => random_int(2, 10)]);
        $response->assertJsonCount($count, 'data.comments');
        $response->assertJsonFragment([
            'id' => $comment->id,
            'text' => $comment->text,
            'user_id' => $comment->user_id,
            'film_id' => $comment->film_id,
            'comment_id' => $comment->comment_id,
            'created_at' => $comment->created_at,
        ]);
    }

    public function testAddComment()
    {
        Sanctum::actingAs(User::factory()->create());
        $film = Film::factory()->create();
        $comment = Comment::factory()->create();

        $newComment = Comment::factory()->make();

        $response = $this->postJson(route('comments.store', [
            'film' => $film,
            'comment' => $film->comments()->first()
        ]), ['text' => $newComment->text]);

        $response->assertStatus(201);
    }

    public function testValidationErrorForAddComment()
    {
        Sanctum::actingAs(User::factory()->create());
        $film = Film::factory()->create();
        $comment = Comment::factory()->create();

        $response = $this->postJson(route('comments.store', [
            'film' => $film,
            'comment' => $film->comments()->first()
        ]));

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['text']]);
    }

    public function testAuthErrorForAddComment()
    {
        $user = User::factory()->create();
        $film = Film::factory()->create();
        $comment = Comment::factory()->create();

        $newComment = Comment::factory()->make();

        $response = $this->postJson(route('comments.store', [
            'film' => $film,
            'comment' => $film->comments()->first()
        ]), ['text' => $newComment->text]);

        $response->assertStatus(401);
        $response->assertJsonFragment(['message' => 'Unauthenticated.']);
    }

    public function testDeleteComment()
    {
        Sanctum::actingAs(User::factory()->moderator()->create());
        $film = Film::factory()->create();
        $comment = Comment::factory()->create();

        $response = $this->deleteJson(route('comments.destroy', $comment->id));

        $response->assertStatus(201);
    }

    public function testDeleteCommentByGuest()
    {
        Sanctum::actingAs(User::factory()->create());
        $film = Film::factory()->create();
        $comment = Comment::factory()->create();

        $response = $this->deleteJson(route('comments.destroy', $comment->id));

        $response->assertStatus(403);
    }
}
