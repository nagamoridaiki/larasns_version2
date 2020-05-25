<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use App\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function testAriticleindex()
    {
        $response = $this->get(route('articles.index'));

        $response->assertStatus(200)
            ->assertViewIs('articles.index');
    }

    public function testArticlecreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('articles.create'));

        $response->assertStatus(200)
            ->assertViewIs('articles.create');
    }

    public function testArticleshow()
    {
        $article = factory(Article::class)->create();
        $response = $this->get(route('articles.show',['article' => $article]));

        $response->assertStatus(200)
            ->assertViewIs('articles.show');
    }

    public function testArticleedit()
    {
        $article = factory(Article::class)->create();

        $response = $this->get(route('articles.edit',['article' => $article]));

        $response->assertRedirect(route('login'));
    }



    public function testGuestCreate()
    {
        $response = $this->get(route('articles.create'));

        $response->assertRedirect(route('login'));
    }

    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('articles.create'));

        $response->assertStatus(200)
            ->assertViewIs('articles.create');
    }

    public function testCommentCreate()
    {

        $comment = factory(Comment::class)->create()->save();
        $article = Article::find(1);
        $response = $this->get(route('articles.show',['article' => $article]));
        $response->assertStatus(200);
    }

}
