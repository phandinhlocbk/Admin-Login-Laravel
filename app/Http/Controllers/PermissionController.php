<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    //
    
    public function index() {
        $permissions = Permission::all();
        return view('admin.permissions.index', ['permissions'=>$permissions]);
    }

    public function destroy(Permission $permission) {
        $permission->delete();
        session()->flash('permission-deleted','permission has been deleted');
        return back();
    }

    public function store() {
        request()->validate([
            'name'=>['required']
        ]);

        Permission::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::lower(request('name'))
        ]);

        return back();
    }

    public function edit(Permission $permission) {
        return view('admin.permissions.edit', ['permission'=>$permission]);
    }

    public function update(Permission $permission) {
        $permission -> name = Str::ucfirst(request('name'));
        $permission -> slug = Str::of(request('name'))->slug('-');

        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(request('name'))->slug('-');

        if($permission->isDirty('name')){
            session()->flash('role-updated','Role Update'.request('name'));
            $permission->save();

        } else {
            session()->flash('role-updated', 'Nothing has been updated');
        }

        return back();
    }



}
