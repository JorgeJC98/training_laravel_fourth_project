<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('admin.permission.index', compact('permissions'));
    }
    public function store(Request $request){
        request()->validate([
            'name'=>'required'
        ]);
        Permission::create([
            'name'=>\Str::ucfirst(request('name')),
            'slug'=>\Str::of(\Str::lower(request('name')))->slug('-'),
        ]);
        session()->flash('message-success', 'Permission was created');
        return back();
    }
    public function destroy(Permission $permission){
        $permission->delete();
        session()->flash('message-delete', 'Permission was deleted'); 
        return back();
    }
    public function edit(Permission $permission){
        return view('admin.permission.edit', compact('permission'));
    }
    public function update(Permission $permission){
        request()->validate([
            'name'=>'required'
        ]);
        $permission->name = \Str::ucfirst(request('name'));
        $permission->slug = \Str::of(\Str::lower(request('name')))->slug('-'); 
        if ($permission->isDirty('name')) {
            session()->flash('message-success', 'Permission was edited');
            $permission->save();
        }else{
            session()->flash('message-success', 'Permission nothing has been updated');
        }
        return redirect('admin/permissions');
    }
}
