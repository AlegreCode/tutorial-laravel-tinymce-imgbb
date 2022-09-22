<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Infotech\ImgBB\ImgBB;

class PostController extends Controller
{
    public function show()
    {
        return view('home');
    }

    public function uploadImage(Request $request)
    {
        $data = ImgBB::image($request->file('file'));
        return response()->json([
            'location' => $data['data']['url'],
        ]);
    }
}
