<?php

namespace Tests\Feature;

use App\Article;
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

        $response->assertViewIs('articles.index');
        $response->assertViewHas('articles');
    }

    /**
     * @test
     */
    public function it_allows_everone_to_view_individual_articles()
    {
        $article = Article::get()->random();
        $response = $this->get(route('view_article', ['id' => $article->id]));

        $response->assertViewIs('articles.view');
        $response->assertViewHas('article');
        $returnedArticle = $response->original->article;
        $this->assertEquals($article->id, $returnedArticle->id, "The returned article is different from the one we requested");
    }
}
