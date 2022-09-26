<?php

namespace Tests\Feature\Announcement;

use App\Models\Announcement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function test_user_cannot_update_a_non_existing_content()
    {
        $response = $this->put(route('announcements.update', [1]), []);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function test_user_can_update_content()
    {
        $response = Announcement::factory()->create();
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now())->addDays(20);

        $payload = [
            'title'     => '::title::',
            'content'   => '::content::',
            'startDate' => Carbon::now(),
            'endDate'   => $endDate
        ];

        $this->put(route('announcements.update', [$response->id]), $payload)
            ->assertRedirect(route('announcements.index'));

        $this->assertEquals($payload['title'], Announcement::first()->title);
    }

    /**
     * @test
     * @dataProvider validationProvider
     */
    public function validation_test($payload, $key, $setUp = null)
    {
        if ($setUp) {
            $announcement = $setUp();
        }

        $this->put(route('announcements.update', [$announcement->id]), $payload)
            ->assertSessionHasErrors($key);
    }

    public function validationProvider()
    {
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now())->addDays(20);

        $defaultPayload = [
            'title'     => '::title::',
            'content'   => '::content::',
            'startDate' => Carbon::now(),
            'endDate'   => $endDate
        ];

        $useCase = [];

        foreach (array_keys($defaultPayload) as $key) {
            $useCase['missing_' . $key] = [
                'payload'   => Arr::except($defaultPayload, $key),
                'key'       => $key,
                'setUp'     => fn () => Announcement::factory()->create($defaultPayload)
            ];
        }

        yield from $useCase;
    }
}
