<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Infotech\ImgBB\ImgBB;

class PostController extends Controller
{
    public function show()
    {
        $posts = Post::all();
        return view('home', ['posts' => $posts]);
    }

    public function uploadImage(Request $request)
    {
        $data = ImgBB::image($request->file('file'));
        return response()->json([
            'location' => $data['data']['url'],
        ]);
    }

    public function save(Request $request)
    {
        $post = new Post();
        $post->body = $request->body;
        $post->save();

        return redirect()->route('home');
    }
}
