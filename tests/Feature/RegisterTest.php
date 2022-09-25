<?php

namespace Tests\Feature\Customer\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $payload;

    public function setUp(): void
    {
        parent::setUp();
        $this->payload = [
            'name'      => $this->faker->name,
            'email'     => $this->faker->safeEmail,
            'password'  => 'password'
        ];
    }

    public function test_user_can_see_user_create_form()
    {
        $this->get(route('register'))
            ->assertOk();
    }

    /** @test */
    public function test_user_can_register_using_email()
    {
        $response = $this->post(route('register.store'), $this->payload);
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /**
     * @test
     * @dataProvider validationProvider
     */
    public function verify_validation($payload, $key)
    {
        $this->postJson(route('register.store'), $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function validationProvider()
    {
        $defaultPayload = [
            'name'      => '::name::',
            'email'     => '::email::',
            'password'  => 'password',
        ];

        $testCase = [];

        foreach (array_keys($defaultPayload) as $key) {
            $testCase['missing_' . $key] = [
                'payload' => Arr::except($defaultPayload, $key),
                'key' => $key
            ];

            if ($key === 'email') {
                $testCase['unique_email'] = [
                    'payload' => $defaultPayload,
                    'key' => 'email'
                ];
            }
        }

        yield from $testCase;
    }
}
