<?php

namespace Tests\Feature\Announcement;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function test_user_can_delete_a_content()
    {
        $announcement = Announcement::factory()->create();
        $response = $this->delete(route('announcements.destroy', [$announcement->id]));
        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertCount(0, Announcement::all());
    }

    /** @test */
    public function test_user_cannot_delete_a_non_existing_content()
    {
        $response = $this->delete(route('announcements.destroy', [1]));
        $response->assertNotFound();
    }
}
