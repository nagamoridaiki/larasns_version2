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
    
    public function testBackground()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('background'));
        $response->assertStatus(200)
            ->assertViewIs('users.background');
    }

    public function testMessage()
    {
        $data = [
            'send_user_id'=>1,
            'receive_user_id'=>2,
            'message_text'=>'abcde',
        ];

        factory(Message::class)->create();
        $ms = Message::find(1);
        $ms->fill($data)->save();
        $this->assertDatabaseHas('messages',$data);
        
    }



    



}
