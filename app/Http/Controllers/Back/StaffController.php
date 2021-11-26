<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Admin::where('type', 'Staff')->latest()->paginate(10);

        return  view('back.staffs.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.staffs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'phone' => 'required|string|max:30',
            'address' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|confirmed',
            'status' => 'required|in:Active,Inactive'
        ]);

        Admin::create($data);

        flash('Staff created.')->success();

        return redirect()->route('back.staffs.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $staff)
    {
        return view('back.staffs.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $staff)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'phone' => 'required|string|max:30',
            'address' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        $staff->update($data);

        flash('Staff updated.')->success();

        return redirect()->route('back.staffs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $staff)
    {
        $staff->delete();
        flash('Staff removed.')->success();

        return redirect()->route('back.staffs.index');
    }
}
