<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthUserControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_allows_logged_in_users_to_create_new_articles()
    {
        $user = User::get()->random();

        $response = $this->actingAs($user)->get(route('create_new_article'));

        $response->assertViewIs('articles.create');
    }

    /**
     * @test
     */
    public function it_allows_logged_in_users_to_save_new_articles()
    {
        $user = User::get()->random();

        $data = [
            "title" => "This is a simple test",
            "body" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis voluptates quasi rem commodi facilis quia natus, illum, expedita obcaecati nisi repellat temporibus? Corrupti fuga in animi reiciendis illo repellat voluptatum."
        ];

        $this->actingAs($user)->post(route('save_new_article'), $data);

        $lastDBInsert = Article::orderBy('id', 'desc')->first();
        $this->assertEquals($lastDBInsert->title, $data['title'], 'The data retrieved fromthe database "title" is diffrent from the supplied one');
        $this->assertEquals($lastDBInsert->body, $data['body'], 'The data retrieved from the database "body" is diffrent from the supplied one');
    }
}
