<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\blog;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('frontend.users.profile', [
            'users' =>User::all(),
        ]);
    }
    public function edit(User $user)
  {
    return view('frontend.users.profile-edit', [
      'user' => $user
    ]);
  }

  public function update(User $user ,Request $request)
  {
    $validated = $request->validate([
      'name' => 'required',
      'email' => 'required',
    ]);

    $user =Auth::user();
    
    $user->update($validated);

    return redirect('/users/profile/index');
  }

}
