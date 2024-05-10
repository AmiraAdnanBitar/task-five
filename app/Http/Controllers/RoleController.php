<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        return view('roles.all_roles',compact('roles'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('roles.add_role',compact('permissions'));
    }

    public function updatepage($id)
    {
        $role = Role::find($id);

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        $permissions = Permission::get();
            // dd($permissions);
        return view('roles.update_role',compact('role', 'permissions','rolePermissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {     
        $this->validate($request, [
        'name' => 'required|unique:roles,name',
        'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        // $role->syncPermissions((int)$request->input('permission'));
        $permissionsString = $request->input('permission');
        // dd($permissionsString);
        $permissionsindexes = array_map('intval', $permissionsString);
        $role->syncPermissions($permissionsindexes );
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $permissionsString = $request->input('permission');
        $permissionsindexes = array_map('intval', $permissionsString);
        $role->syncPermissions($permissionsindexes );
        // $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // if($id==1)
        //     return redirect()->route('roles.index');
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('roles.index');
    }
}
