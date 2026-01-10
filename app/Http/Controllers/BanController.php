<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BanController extends Controller
{
    
    public function index(){
        $is_banned = User::where('is_banned',1)->get();
        return view('backend.banlist.index',[
            'is_banned'=> $is_banned,
            'user'=> User::all()
        ]);
    }
    public function banned(User $user)
    {
       $user->is_banned = !$user->is_banned;
       $user->save();
       return redirect('/users');
    }
 
}
