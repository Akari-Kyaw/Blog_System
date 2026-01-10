<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class PasswordController extends Controller
{
    public function edit(User $user)
  {
    return view('frontend.users.changepassword', [
      'user' => $user
    ]);
  }

  public function update(User $user ,Request $request)
  {
    $validated = $request->validate([
      'current_password' => 'required',
      'new_password' => 'required|string|min:8|confirmed',
    ]);

    $user =Auth::user();

    $validated['password']=$request->new_password;

    if(!Hash::check($request->current_password,$user->password)){
     return redirect()->back()->with('error','The Current password is incorrect');
    }

    $user->password = Hash::make($request->new_passsword);
    $user->save();
    

    return redirect('/users/profile/index');
  }

}
