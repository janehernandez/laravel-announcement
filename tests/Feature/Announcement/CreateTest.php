<?php

namespace Tests\Feature\Announcement;

use App\Models\Announcement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function test_user_can_see_the_create_announcement_form()
    {
        $this->get(route('announcements.create'))
            ->assertSuccessful();
    }


    /** @test */
    public function test_user_can_create_a_new_announcement()
    {
        $payload =  Announcement::factory()->create()->toArray();

        $this->post(route('announcements.store'), $payload);

        $this->assertCount(1, Announcement::all());
    }

    /**
     * @test
     * @dataProvider validationProvider
     */
    public function validation_test($payload, $key, $setUp = null)
    {
        if ($setUp) {
            $setUp();
        }

        $this->post(route('announcements.store'), $payload)
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

        $testCase = [];

        foreach (array_keys($defaultPayload) as $key) {
            $testCase['missing_' . $key] = [
                'payload' => Arr::except($defaultPayload, $key),
                'key' => $key
            ];

            if ($key === 'title') {
                $testCase['unique_title'] = [
                    'payload' => $defaultPayload,
                    'key' => 'title',
                    'setUp' => fn () => Announcement::create($defaultPayload)
                ];
            }
        }

        yield from $testCase;
    }
}
