<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{

    public function index()
    {
        $items= UserRole::with(['role','user'])->get();
        
    }

    public function create()
    {
        $user = User::pluck('name', 'id');
        $role = Role::pluck('role_name','id');
        return view('user.urolecreate',compact('user','role'));
    }

    public function store(Request $request)
    {
        $data  = [
            'user_id'=>$request->user_id,
            'role_id'=>$request->role_id,

        ];
        $roleu = UserRole::create($data);
        
       return back()->with('success', 'Role created successfully');
    }

    public function show(UserRole $userRole)
    {
        //
    }
    public function edit(UserRole $userrole)
    {
        $user = User::pluck('name', 'id');
        $role = Role::pluck('role_name','id');
        return view('user.uroleedit',compact('userrole','user','role'));
    }

    public function update(Request $request, UserRole $userrole)
    {
        $data  = [
            'user_id'=>$request->user_id,
            'role_id'=>$request->role_id,
        ];
        $roleu = $userrole->update($data);
        return back()->with('success', 'Role Updated successfully');
    }

    public function destroy(UserRole $userrole)
    {
        if (UserRole::destroy($userrole->id)) {
            return back()->with('success', 'Role Delete successfully');
        }
    }
}
