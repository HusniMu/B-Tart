<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::members()->get();
        return view('admin.member.index',compact('members'));
    }
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.member.edit', compact('user', 'roles'));
    }
    public function updateAuthority(Request $request, User $user)
    {
        // return $request;
        $this->validate($request, [
            'role' => 'required',
        ]);

        $user->role_id = $request->role;
        $user->save();

        Toastr::success('Authority Successfully Updated', 'Success');
        return redirect()->route('admin.member.index');
    }

    public function destroy($id)
    {
        $member = User::findOrFail($id)->delete();
        Toastr::success('Member Successfully Deleted','Success');
        return redirect()->back();
    }
}
