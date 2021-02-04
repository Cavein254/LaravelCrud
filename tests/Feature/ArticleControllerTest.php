<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     */
    public function it_allows_anyone_to_see_list_of_all_articles()
    {
        $response = $this->get(route('get_all_articles'));
        $response->assertSuccessful();
    }
}
