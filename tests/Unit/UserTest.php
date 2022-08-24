<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testModeratorMethod()
    {
        $user = User::factory()->moderator()->create();

        $this->assertTrue($user->isModerator());
    }
}
