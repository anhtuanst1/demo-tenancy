<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddSystemAdminRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create role system admin
        $roleSystemAdmin = Role::create(['name' => 'system admin']);

        $permissionList = array(
            'browse_user', 'add_user', 'edit_user', 'delete_user',
            'browse_role', 'add_role', 'edit_role', 'delete_role'
        );

        $roleSystemAdmin->syncPermissions($permissionList);
    }
}
