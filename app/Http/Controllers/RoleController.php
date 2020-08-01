<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }
    public function store(Request $request){
        request()->validate([
            'name'=>'required'
        ]);
        Role::create([
            'name'=>\Str::ucfirst(request('name')),
            'slug'=>\Str::of(\Str::lower(request('name')))->slug('-'),
        ]);
        session()->flash('message-success', 'Role was created');
        return back();
    }
    public function destroy(Role $role){
        $role->delete();
        session()->flash('message-delete', 'Role was deleted'); 
        return back();
    }
    public function edit(Role $role){ 
        $permissions = Permission::all();
        return view('admin.role.edit', compact('role', 'permissions'));
    }
    public function update(Role $role){
        request()->validate([
            'name'=>'required'
        ]);
        $role->name = \Str::ucfirst(request('name'));
        $role->slug = \Str::of(\Str::lower(request('name')))->slug('-'); 
        if ($role->isDirty('name')) {
            session()->flash('message-success', 'Role was edited');
            $role->save();
        }else{
            session()->flash('message-success', 'Permission nothing has been updated');
        }
        return back();
    }
    public function attach_permission(Role $role){   
        $role->permission()->attach(request('permission'));
        return back();
    }
    public function detach_permission(Role $role){ 
        $role->permission()->detach(request('permission'));
        return back();
    }
}
