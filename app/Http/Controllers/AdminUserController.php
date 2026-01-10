<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    //
    public function index()
    {
        return view('backend.users.index', [
            'users' =>User::all()
        ]);
    }

    public function show(User $user)
    {
        return view('backend.users.show', [
            'user' => $user
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/admin/users');
    }
}
