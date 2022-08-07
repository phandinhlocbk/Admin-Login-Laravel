<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\Permission;


class RolesController extends Controller
{
    //

    public function index() {
        $roles = Role::all();
       
        return view('admin.roles.index', ['roles'=>$roles]);
    }

    public function store() {
        request() -> validate([
            'name'=>['required']
        ]);

        Role::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::ucfirst(request('name'))
        ]);

        session()->flash('role-created', 'Created-role');

        return back();

    }

    public function destroy(Role $role) {
        $role->delete();

        session()->flash('deleted-role','role has been deleted '.$role['name']);
        return back();
    }

    public function edit(Role $role) {
        return view('admin.roles.edit',[
            'role'=>$role,
            'permissions'=> Permission::all(),
    ]);
    }

    public function update(Role $role) {

        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(request('name'))->slug('-');

        if($role->isDirty('name')){
            session()->flash('role-updated','Role Update '.request('name'));
            $role->save();

        } else {
            session()->flash('role-updated', 'Nothing has been updated');
        }

        return back();
    }

    public function attach_permission(Role $role) {
        $role->permissions()->attach(request('permission'));
        return back();
    }

    public function detach_permission(Role $role) {
        $role->permissions()->detach(request('permission'));
        return back();
    }
}
