<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use DB;
use Log;

class RoleController extends Controller
{
	public function showListRoles()
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
		$listPermission = $this->getRoleDetail();

		return view('roles.create', compact(
			'slug',
			'listPermission'
        ));
	}

	public function createRole(Request $request)
    {
		$data = $request->all();
		$result = Role::saveRole($data);

		if ($result['alert-type'] == 'error') {
			return redirect()->back()->withInput()->with($result);
		}

		return redirect()->route('showListRoles')->with($result);
    }

	public function viewEditRole(Request $request)
	{
		$slug = 'role';
		$roleDetail = Role::find($request->id);

		if (empty($roleDetail)) {
			return redirect()->route('showListRoles')->with([
	            'message'       => 'Role does not exist',
	            'alert-type'    => 'error'
	        ]);
		}

		$roleId = $request->id;
		$listPermission = $this->getRoleDetail();
		$listPermissionAssigned = Role::getListPermissionAssigned($request->id);

		return view('roles.edit', compact(
			'slug',
			'roleId',
			'roleDetail',
			'listPermission',
			'listPermissionAssigned'
        ));
	}

	public function updateRole(Request $request, $id)
    {
		$data = $request->all();
		$result = Role::saveRole($data, $id);

		return redirect()->route('viewEditRole', $id)->with($result);
    }

	public function getRoleDetail()
    {
        $listPermission = config('role.list_permission');
        foreach ($listPermission as $key => &$permission) {
            if ($permission['sub_menu'] == false) {
                $permission['action'] = $this->getAction($permission['slug']);
            } else {
                foreach ($permission['list_sub'] as $key => &$sub) {
                    $sub['action'] = $this->getAction($sub['slug']);
                }
            }
        }

        return $listPermission;
    }

    public function getAction($value)
    {
        $action = Permission::select(['id', 'name'])
                            ->where('name', 'like', '%'.$value)
                            ->get()->toArray();

        return $action;
    }

    public function deleteRole(Request $request, $id)
    {
        $result = Role::deleteRole($id);
        if (isset($response['alert-type']) && $response['alert-type'] == 'error') {
            return redirect()->back()->with($response);
        }

        return redirect()->route('showListRoles')->with($result);
    }
}
