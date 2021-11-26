<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::guard('admin')->user();
        return view('back.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'phone' => 'required|string|max:30',
            'address' => 'required|string',
        ]);

        $user = Auth::guard('admin')->user();

        $user->update($data);

        flash('Profile Updated.')->success();

        return redirect()->route('back.profile.edit');
    }
}
