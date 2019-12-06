<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Auth\RegisterController;
use App\User;
use App\Model\Role;
use Auth;
use DB;
use Log;

class HomeController extends RegisterController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slug = 'user';
        $listUsers = User::get();
        $listRoles = Role::get();

        return view('home', compact(
            'slug',
            'listUsers',
            'listRoles'
        ));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $user->assignRole('super admin');

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath())->with([
            'message'       => 'Create Successfully!',
            'alert-type'    => 'success'
        ]);
    }

    public function deleteUser(Request $request)
    {
        //delete all permissions
        DB::table('model_has_permissions')->where('model_id', $request->id)->delete();

        //delete all roles
        DB::table('model_has_roles')->where('model_id', $request->id)->delete();

        User::find($request->id)->delete();
        $response = [
            'message'       => 'Delete Successfully!',
            'alert-type'    => 'success'
        ];

        return redirect()->route('home')->with($response);
    }

    public static function getRoleIdByUserId($userId)
    {
        $roleId = DB::table('users')
                ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->where('users.id', $userId)->pluck('roles.id');

        $roleId = (!$roleId->isEmpty()) ? $roleId[0] : '';

        return $roleId;
    }

    public function assignRoleForUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->syncRoles($request->role);

        $response = [
            'message'       => 'Assigned the role successfully!',
            'alert-type'    => 'success'
        ];

        return redirect()->route('home')->with($response);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
