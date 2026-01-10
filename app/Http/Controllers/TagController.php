<?php

namespace App\Http\Controllers;

use App\Models\tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        return view('backend.tags.index',[
            'tags'=>tag::all()

        ]);
        
    }
    public function create(){
        return view('backend.tags.create',[
            'tags'=>tag::all()

        ]);
;    }
public function store(){
    $validated=Request()->validate([
        'name'=>'required'
    ]);
    tag::create($validated);
    return redirect('/tags');
}
public function edit(Tag $tag){
    return view('backend.tags.edit',[
        'tag'=>$tag
    ]);}

    public function update(Tag $tag){
        $validate=Request()->validate ([
          'name'=> 'required',
        ]);
      
        $tag->update($validate);
     return redirect('/tags');
      }
      public function delete(Tag $tag){
        $tag->delete();
        return redirect('/tags');
      }
}
