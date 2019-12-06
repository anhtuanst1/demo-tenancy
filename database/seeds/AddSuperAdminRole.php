<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddSuperAdminRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create role super admin
        $roleSuperAdmin = Role::create(['name' => 'super admin']);

        $permissionList = array(
            'browse_user', 'add_user', 'edit_user', 'delete_user',
            'browse_role', 'add_role', 'edit_role', 'delete_role'
        );

        $roleSuperAdmin->syncPermissions($permissionList);
    }
}
