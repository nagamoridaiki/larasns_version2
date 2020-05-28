<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Skill;
use App\Background;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load(['articles.user', 'articles.likes', 'articles.tags']);

        $backgrounds = Background::where('user_id',$user->id)
        ->orderBy('id', 'asc')->get();


        $articles = $user->articles->sortByDesc('created_at');
 
        return view('users.show', [
            'user' => $user,
            'articles' => $articles,
            'backgrounds' => $backgrounds,
        ]);
    }

    public function likes(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load(['likes.user', 'likes.likes', 'likes.tags']);
 
        $articles = $user->likes->sortByDesc('created_at');
        $backgrounds = Background::where('user_id',$user->id)->orderBy('id', 'asc')->get();

 
        return view('users.likes', [
            'user' => $user,
            'articles' => $articles,
            'backgrounds' => $backgrounds,
        ]);
    }

    public function followings(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load('followings.followers');
 
        $followings = $user->followings->sortByDesc('created_at');
        $backgrounds = Background::where('user_id',$user->id)->orderBy('id', 'asc')->get();
 
        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
            'backgrounds' => $backgrounds,
        ]);
    }
    
    public function followers(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load('followers.followers');
 
        $followers = $user->followers->sortByDesc('created_at');
        $backgrounds = Background::where('user_id',$user->id)->orderBy('id', 'asc')->get();

 
        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
            'backgrounds' => $backgrounds,
        ]);
    }

    public function follow(Request $request, string $name)
    {
        //$nameの部分には、フォローされる側のユーザーの名前が入っている
        $user = User::where('name', $name)->first();

        //$request->user()は、フォローのリクエストを行なったユーザー
        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }
 
        //followings()メソッドは、多対多のリレーション(BelongsToManyクラスのインスタンス)が返る
        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);
 
        return ['name' => $name];
    }
    
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();
 
        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }
 
        $request->user()->followings()->detach($user);
 
        return ['name' => $name];
    }

    public function store(Request $request, string $name)
    {
        $validatedData = $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $users = User::where('name', $name)->first();

        $image = $request->file('image');
        $path = Storage::disk('s3')->putFile('', $image, 'public');
        $users->image = Storage::disk('s3')->url($path);
        $users->save();
        
        return redirect('/')->with('flash_message', 'プロフィール画像を変更しました');
    }
}
