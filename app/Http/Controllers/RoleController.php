<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Role;
use Auth;
use DB;
use Log;

class RoleController extends Controller
{
	public function viewRoleList()
	{
		$slug = 'role';
		$listRoles = Role::get();

		return view('roles.browse', compact(
			'slug',
            'listRoles'
        ));
	}

	public function viewCreateRole()
	{
		$slug = 'role';

		return view('roles.create', compact(
			'slug'
        ));
	}

	public function viewEditRole(Request $request)
	{
		$slug = 'role';
		$roleDetail = Role::find($request->id);

		return view('roles.edit', compact(
			'slug',
			'roleDetail'
        ));
	}
}
