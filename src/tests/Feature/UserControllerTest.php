<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use App\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_新しいユーザーを作成して返却する()
    {
        $data = [
            'name' => 'vuesplashuser',
            'email' => 'dummy@email.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ];

        $response = $this->json('POST', route('register'), $data);

        $user = User::first();
        $this->assertEquals($data['name'], $user->name);

        $response
            ->assertStatus(201);
    }

    public function test_ログイン機能()
    {
        $data = [
            'name' => 'vuesplashuser',
            'email' => 'dummy@email.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ];
        $this->json('POST', route('register'), $data);
        $user = User::first();
        
        $response = $this->json('POST', route('login'), [
            'email' => $user->email,
            'password' => $user->password,
        ]);

        $response
            ->assertStatus(302);

        $this->assertAuthenticatedAs($user);

    }

    public function test_認証済みのユーザーをログアウトさせる()
    {

        $data = [
            'name' => 'vuesplashuser',
            'email' => 'dummy@email.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ];
        $this->json('POST', route('register'), $data);
        $user = User::first();

        $response = $this->actingAs($user)
                         ->json('POST', route('logout'));

        $response->assertStatus(204);
        $this->assertGuest();
    }

    public function test_経歴・実績の画面遷移()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('background'));
        $response->assertStatus(200)
            ->assertViewIs('users.background');
    }
    


}
