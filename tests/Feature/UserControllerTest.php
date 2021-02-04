<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_allows_anyone_to_view_user_profiles()
    {
        $user = User::get()->random();

        $response = $this->get(route('show_user_profile', ['id' => $user->id]));

        $response->assertViewIs('users.show');
        $response->assertViewHas('user');

        $returnedUser = $response->original->user;

        $this->assertEquals($user->id, $returnedUser->id, "The returned user is different from the one we requested");
    }

    /**
     * @test
     */
    public function prevent_guests_from_creating_new_articles()
    {
        $response = $this->get(route('create_new_article'));
        $response->assertRedirect('login');
    }

    /**
     * @test
     */
    public function guests_can_get_login_page()
    {
        $response = $this->get(route('login'));
        $response->assertViewIs('auth.login');
    }

    /**
     * @test
     */
    public function guest_can_get_register_page()
    {
        $response = $this->get(route('register'));
        $response->assertViewIs('auth.register');
    }
}
