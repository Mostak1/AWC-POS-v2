<?php

namespace App\Http\Controllers;


use App\Models\UserRole;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }

    public function index()
    {

        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::get();
        $permission_groups = User::getpermissionGroups();
        return view('roles.create', compact('permissions','permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|unique:roles,name',
        //     'permission' => 'required',
        // ]);

        // $role = Role::create(['name' => $request->get('name')]);
        // $role->syncPermissions($request->get('permission'));

        // return redirect()->route('roles.index')
        //     ->with('success', 'Role created successfully');
        $request->validate([
            'name' => 'required|max:100|unique:roles'
        ], [
            'name.requried' => 'Please give a role name'
        ]);

        // Process Data
        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);

        // $role = DB::table('roles')->where('name', $request->name)->first();
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        session()->flash('success', 'Role has been created !!');
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role = $role;
        $rolePermissions = $role->permissions;
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $role = $role;
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permission_groups = User::getpermissionGroups();

        $permissions = Permission::get();

        return view('roles.edit', compact('role', 'rolePermissions', 'permissions','permission_groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Role $role)
    // {
    //     // $this->validate($request, [
    //     //     'name' => 'required',
    //     //     'permission' => 'required',
    //     // ]);

    //     // $role->update($request->only('name'));

    //     // $role->syncPermissions($request->get('permission'));

    //     // return redirect()->route('roles.index')
    //     //     ->with('success', 'Role updated successfully');
        
    // }
    public function update(Request $request, int $id)
    {
        if (is_null($this->user) || !$this->user->can('role.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any role !');
        }


        if ($id === 1) {
            session()->flash('error', 'Sorry !! You are not authorized to edit this role !');
            return back();
        }

        // Validation Data
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id
        ], [
            'name.requried' => 'Please give a role name'
        ]);

        $role = Role::findById($id, 'web');
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissions);
        }

        session()->flash('success', 'Role has been updated !!');
        return back();
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
