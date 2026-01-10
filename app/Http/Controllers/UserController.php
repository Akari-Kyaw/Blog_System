<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\category;
use App\Models\favourite;
use App\Models\tag;



class UserController extends Controller
{
    public function index()
    {
        return view('frontend.users.index', [
            'blogs' => blog::paginate(2),
            'categories' => category::all(),

        ]);
    }
    public function searchCategory(Request $request){
        $request->validate([
            'search' => 'required'
        ]);
        
        // dd($categories);
        return view('frontend.users.index', [
            'blogs' => blog::where('title','like',"%".$request->search."%")->get(),
            'categories' => category::all(),
        ]);    
    }
    public function showByCategory(int $cid){
        $blogs = blog::where('category_id','=',$cid)->get();
        return view('frontend.users.index', [
            'blogs' => $blogs,
            'categories' => category::all(),

        ]);
    }
    public function create()
    {
        return view('frontend.users.create', [
            'categories' => category::all(),
            'tags' => tag::all()

        ]);
    }
    public function store(Request $request)
    {   
        $validate = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image'
            ]);
            $validate['image'] = $request->file('image')->store('blogs');
        }
        $validate['user_id']=auth()->user()->id;
        $blog = Blog::create($validate);
        if ($request->has('tag_ids')) {
            $blog->tags()->attach($request->tag_ids);
        }
        return redirect('/users/blogs/index');
    }
    public function show(blog $blog)
    {
        $favourites = auth()->user()->favourites()->pluck('blog_id');
        $isFavourite = $favourites->contains($blog->id);

        $like = auth()->user()->likes()->pluck('blog_id');
        $isLike = $like->contains($blog->id);
        return view('frontend.users.show', [
            'blog' => $blog,
            'isFavourite'=>$isFavourite,
            'isLike'=>$isLike,
            'favourite'=>favourite::all()

        ]);
    }
    public function edit(Blog $blog){
        return view('frontend.users.edit', [
            'blog'=>$blog,
            'categories' => category::all(),
            'tags' => tag::all()

        ]);
    }
    public function update(Blog $blog){
        
        $validate =request()->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);
        if (request()->hasFile('image')) {
            request()->validate([
                'image' => 'image'
            ]);
            unlink(storage_path()."/app/public/$blog->image");
            $validate['image'] = request()->file('image')->store('blogs');
        }
        $blog->update($validate);
        $blog->tags()->sync(request()->tag_ids);
        return  redirect("/users/blogs/".$blog->id);
    }
            public function destroy(Blog $blog){ 
                if($blog->image){
                    unlink(storage_path()."/app/public/$blog->image");

                }
                $blog->delete();
        return  redirect("/users/blogs/index");
}}
