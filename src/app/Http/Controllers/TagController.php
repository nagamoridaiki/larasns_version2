<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Article;
use App\Comment;
use App\User;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request){
        //選んだタグでarticleを絞り込み、ユーザーIDを取り出す。
        dd($request);
        $tag = $request->input('tag');
        $article_user_id = Tag::where('name', $tag)
        ->first()
        ->articles
        ->pluck('user_id')
        ->all();
        //ユーザーごとの件数を取得する
        $count = array_count_values($article_user_id );
        //ユーザー名の取得
        $users = User::select('name')
        ->wherein('id', $article_user_id)
        ->orderby('id')
        ->get();
        //vueのBarChart.jsに渡す
        $tagPostRankingData = [
            //ユーザーごとの指定したタグの投稿の数を格納する
            'tag_post_count' => $count,
            //投稿したユーザー名を格納する
            'name' => $users,
        ];
        return ['tagPostRankingData' => $tagPostRankingData];
    }

    public function show(string $name)
    {
        $tag = Tag::where('name', $name)->first();
        return view('tags.show', ['tag' => $tag]);
    }
}
