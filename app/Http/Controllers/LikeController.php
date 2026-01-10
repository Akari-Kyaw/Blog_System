<?php

namespace App\Http\Controllers;
use App\Models\like;
use App\Models\blog;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Blog $blog)
    {
        $like['blog_id'] = $blog->id;
        $like['user_id'] = auth()->user()->id;
        like::create($like);
        return redirect('/users/blogs/'.$blog->id);
    }

    public function destroy(Blog $blog) 
    {
        $like = like::where(['user_id' => auth()->user()->id, 'blog_id' => $blog->id])->first();
        $like->delete();
        return redirect()->back();
    }
}
