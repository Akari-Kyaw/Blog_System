<?php
namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    //
    public function create()
    {
        return view('frontend.comments.create');
    }
    public function store(Request $request, blog $blog)
    {   
        $validate = $request->validate([
            'content' => 'required',

        ]);
        $validate['blog_id'] = $blog->id;
        $validate['user_id'] = auth()->user()->id;
        $comment=Comment::create($validate);
       

        return redirect('/users/blogs/'.$blog->id);
    }
    public function edit(Comment $comment,blog $blog){
        return view('frontend.comments.edit', [
            'comment'=>$comment,
            

        ]);
    }
    public function update(Request $request,Comment $comment){
        
        $validate =request()->validate([
            'content' => 'required',
            
        ]);
        $comment->update($validate);
        
        return redirect()->back();
    }
   

    
    public function destroy(Comment $comment)
    {
            $comment->delete();
            return redirect()->back();
        }
    }

