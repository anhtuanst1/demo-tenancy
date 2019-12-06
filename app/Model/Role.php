<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as BaseRole;
use DB;
use Auth;
use Log;

class Role extends BaseRole
{
    public static function saveRole($data, $roleId = null)
    {
        $respone = [
            'alert-type' => 'success',
            'message'    => 'Save Successfully',
        ];

        $permissionList = array();
        $role = new Role;

        if (!empty($roleId)) {
            $role = Role::find($roleId);
        } else {
            $count = self::validRoleName($data['name']);
            if ($count > 0) {
                $respone = [
                    'alert-type' => 'error',
                    'message'    => 'Role name is duplicate',
                ];

                return $respone;
            }

            $role->name = $data['name'];
        }

        if (isset($data['permission'])) {
            $permissionList = $data['permission'];
        }
        $role->save();

        $role->syncPermissions($permissionList);

        return $respone;
    }

    public static function validRoleName($roleName, $roleId = null)
    {
        $query = Role::where('name', $roleName);

        if (!empty($roleId)) {
            $query->where('id', '<>', $roleId);
        }

        $count = $query->count();

        return $count;
    }

    public static function getListPermissionAssigned($roleId)
    {
        $listPermissionAssigned = DB::table('role_has_permissions')
                                    ->where('role_id', $roleId)
                                    ->pluck('permission_id')->toArray();

        return $listPermissionAssigned;
    }

    public static function deleteRole($roleId)
    {
        $count = DB::table('model_has_roles')
                ->where('role_id', $roleId)
                ->count();

        if ($count > 0) {
            return $respone = [
                'alert-type' => 'error',
                'message'    => 'Role in use, cannot be deleted',
            ];
        }

        DB::table('role_has_permissions')
                    ->where('role_id', $roleId)->delete();

        $role = Role::find($roleId);
        $role->delete($roleId);

        return $respone = [
            'alert-type' => 'success',
            'message'    => 'Delete Role Successfully',
        ];
    }
}
