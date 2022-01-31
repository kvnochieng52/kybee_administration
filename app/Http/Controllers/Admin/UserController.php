<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Franchise;
use App\Models\PermissionGroup;
use App\Models\UserFranchise;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['role:Admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->get([
                'users.email',
                'users.id',
                'users.name as user_full_names',
                'users.created_at',
                'roles.name as role',
                'users.telephone',
                'users.is_active',
            ]);

        return view('admin.user.index')->with([
            'users'  => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create')->with([
            'roles'  => DB::table('roles')->pluck('name', 'id')->all(),
            'perm_groups' => PermissionGroup::getPermissionsWithGroup(),
            'businesses' => Business::pluck('business_name', 'id'),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'full_names' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);
        $user = new User;
        $user->name = $request->input('full_names');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->telephone = $request->input('telephone');
        $user->is_active = $request->input('is_active');
        $user->business_id = $request->input('business');
        $user->created_by = Auth::user()->id;
        $user->updated_by = Auth::user()->id;
        $user->has_reset_password = 0;
        $user->save();


        if (!empty($request->input('role'))) {
            DB::table('model_has_roles')->insert([
                'role_id' => $request->input('role'),
                'model_type' => 'App\User',
                'model_id' => $user->id
            ]);
        }




        // if (!empty($request->input('permissions')) && count($request->input('permissions')) > 0) {
        //     foreach ($request->input('permissions') as $permission) {
        //         DB::table('model_has_permissions')->insert([
        //             'permission_id' => $permission,
        //             'model_type' => 'App\User',
        //             'model_id' => $user->id
        //         ]);
        //     }
        // }
        Artisan::call('permission:cache-reset');
        // Alert::toast('User Successfully Created', 'success');
        return redirect('admin/users/' . $user->id . '/edit')->with('success', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $user = User::leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('users.id', $user->id)
            ->first([
                'users.email',
                'users.id',
                'users.business_id',
                'users.name as user_full_names',
                'users.created_at',
                'roles.id as role',
                'users.telephone',
                'users.is_active',
            ]);

        $user_role_get = DB::table('model_has_roles')->where(['model_id' => $user->id])->first(['role_id']);

        $user_role = !empty($user_role_get) ? $user_role_get->role_id : 0;





        $user_permissions = array_merge(
            DB::table('model_has_permissions')->where(['model_id' => $user->id])->pluck('permission_id')->all(),
            DB::table('role_has_permissions')->where(['role_id' => $user_role])->pluck('permission_id')->all()

        );



        // $roles =  DB::table('model_has_permissions')->where(['model_id' => $user->id])->pluck('permission_id')->all(),
        // echo "<pre>";

        // print_r($roles);
        // exit;

        // print_r($user_permissions);
        // exit;




        return view('admin.user.edit')->with([
            'roles'  => DB::table('roles')->pluck('name', 'id')->all(),
            'user'  => $user,
            'perm_groups' => PermissionGroup::getPermissionsWithGroup(),
            'user_permissions' => $user_permissions,
            'user_role' => $user_role,
            'businesses' => Business::pluck('business_name', 'id'),
            // 'user_permissions' => DB::table('model_has_permissions')->where(['model_id' => $user->id])->pluck('permission_id')->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'full_names' => 'required',
            'email' => 'required|email',
            'password' => 'confirmed'
        ]);

        $user->name = $request->input('full_names');
        $user->email = $request->input('email');
        $user->telephone = $request->input('telephone');
        $user->is_active = $request->input('is_active');
        $user->has_reset_password = 0;
        $user->business_id = $request->input('business');

        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->updated_by = Auth::user()->id;
        $user->save();

        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        if (!empty($request->input('role'))) {

            DB::table('model_has_roles')->insert([
                'role_id' => $request->input('role'),
                'model_type' => 'App\User',
                'model_id' => $user->id
            ]);
        }
        DB::table('model_has_permissions')->where('model_id', $user->id)->delete();

        if ((!empty($request->input('permissions')) && count($request->input('permissions')) > 0) && empty($request->input('role'))) {

            foreach ($request->input('permissions') as $permission) {
                DB::table('model_has_permissions')->insert([
                    'permission_id' => $permission,
                    'model_type' => 'App\User',
                    'model_id' => $user->id
                ]);
            }
        }




        Artisan::call('permission:cache-reset');
        //Alert::toast('User Successfully Updated', 'success');
        return redirect('admin/users/' . $user->id . '/edit')->with('success', 'User Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        Alert::toast('User Deleted', 'success');
        return redirect('admin/users');
    }

    public function role_create()
    {
        return view('admin.role.create')->with([
            'perm_groups' => PermissionGroup::getPermissionsWithGroup(),
        ]);
    }

    public function role_store(Request $request)
    {

        $role_id = DB::table('roles')->insertGetId([
            'name' => $request->input('role'),
            'guard_name' => 'web',
        ]);


        if (!empty($request->input('permissions')) && count($request->input('permissions')) > 0) {

            foreach ($request->input('permissions') as $permission) {
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $permission,
                    'role_id' => $role_id
                ]);
            }
        }

        Artisan::call('permission:cache-reset');

        Alert::toast('Role Successfully Created', 'success');
        return redirect("admin/roles");
    }


    public function role_index()
    {
        return view('admin.role.index')->with([
            'roles' => DB::table('roles')->get(),
        ]);
    }


    public function destroy_role(Request $request)
    {
        DB::table('role_has_permissions')->where('role_id', $request->input('role'))->delete();
        DB::table('roles')->where('id', $request->input('role'))->delete();

        Alert::toast('Role Deleted', 'success');
        return redirect("admin/roles/");
    }

    public function role_edit($role_id)
    {
        return view('admin.role.edit')->with([
            'perm_groups' => PermissionGroup::getPermissionsWithGroup(),
            'role_details' => DB::table('roles')->where('id', $role_id)->first(),
            'role_permissions' => DB::table('role_has_permissions')->where(['role_id' => $role_id])->pluck('permission_id')->all(),
        ]);
    }


    public function update_role(Request $request)
    {
        DB::table('roles')->where('id', $request->input('role_id'))->update([
            'name' => $request->input('role')
        ]);

        DB::table('role_has_permissions')->where('role_id', $request->input('role_id'))->delete();

        if (!empty($request->input('permissions')) && count($request->input('permissions')) > 0) {

            foreach ($request->input('permissions') as $permission) {
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $permission,
                    'role_id' => $request->input('role_id')
                ]);
            }
        }
        Artisan::call('permission:cache-reset');
        Alert::toast('Role Updated Successfully', 'success');
        return redirect("admin/roles/" . $request->input('role_id') . "/edit");
    }
}
