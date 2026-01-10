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

  public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ]);

    $user->update($validated);

    return redirect('/users/profile/index');
  }

}
