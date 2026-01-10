<?php

namespace App\Http\Controllers;
use App\Models\favourite;
use App\Models\blog;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    //
    public function index(){
        return view('frontend.users.favouritelist',[
            'favourites' => auth()->user()->favourites
        ]);
    }

    public function store(Blog $blog)
    {
        $favourite['blog_id'] = $blog->id;
        $favourite['user_id'] = auth()->user()->id;

        favourite::create($favourite);
        return redirect('/users/blogs/'.$blog->id);
    }

    public function destroy(Blog $blog) 
    {
        $favourite = favourite::where(['user_id' => auth()->user()->id, 'blog_id' => $blog->id])->first();
        $favourite->delete();
        return redirect()->back();
    }
}
