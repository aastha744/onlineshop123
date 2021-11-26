<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('back.password.edit');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'old_password' => 'required|current_password:admin',
            'password' => 'required|confirmed'
        ], [
            'old_password.current_password' => 'The old password is incorrect.'
        ]);

        Auth::guard('admin')->user()->update($data);

        flash('Password changed.')->success();

        return redirect()->route('back.password.edit');
    }
}
