<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\tag;
use App\Models\blog;
use App\Models\User;

class BlogController extends Controller
{
    public function index(User $user)
    {

        return view('backend.blog.index', [
            'blogs' => blog::all(),
            'users'=> $user

        ]);
   $blogs = auth()->user()->blogs()->latest()->paginate(5);

        return view('frontend.users.index', [
            'blogs' => $blogs,

          ]);
    }
    public function show(blog $blog)
    {
        return view('backend.blog.show', [
            'blog' => $blog
        ]);
    }
    public function create()
    {
        return view('backend.blog.create', [
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
        return redirect(route('blogs.index'));
    }
    public function edit(Blog $blog)
    {
        return view('backend.blog.edit', [
            'blog' => $blog,
            'categories' => category::all(),
            'tags' => tag::all()

        ]);
    }
    public function update(Blog $blog)
    {
        

        $validate = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);
        if (request()->hasFile('image')) {
            request()->validate([
                'image' => 'image'
            ]);
            unlink(storage_path() . "/app/public/$blog->image");
            $validate['image'] = request()->file('image')->store('blogs');
        }
        $blog->update($validate);
        $blog->tags()->sync(request()->tag_ids);
        return  redirect(route('blogs.show', $blog->id));
    }
    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            unlink(storage_path() . "/app/public/$blog->image");
        }
        $blog->delete();
        return  redirect(route('blogs.index'));
    }
}
