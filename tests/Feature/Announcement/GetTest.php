<?php

namespace Tests\Feature\Announcement;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_user_cannot_see_list_of_announcements()
    {
        $this->get(route('announcements.index'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }

    /** @test */
    public function test_user_can_see_list_of_announcements()
    {
        $this->actingAs(User::factory()->create());
        $this->get(route('announcements.index'))
            ->assertSuccessful();
    }
}
