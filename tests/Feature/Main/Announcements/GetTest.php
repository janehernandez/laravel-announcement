<?php

namespace Tests\Feature\Main\Announcements;

use App\Models\Announcement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_user_can_see_list_of_announcements()
    {
        $this->get('/')
            ->assertStatus(200);

        $response = Announcement::factory()->count(5)->create();
        $this->assertCount(5, $response);
    }
}
