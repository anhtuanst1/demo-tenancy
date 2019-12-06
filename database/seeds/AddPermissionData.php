<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddPermissionData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listData = array(
        	// user
        	['guard_name' => 'web', 'name' => 'browse_user'],
        	['guard_name' => 'web', 'name' => 'add_user'],
        	['guard_name' => 'web', 'name' => 'edit_user'],
        	['guard_name' => 'web', 'name' => 'delete_user'],

        	// role
        	['guard_name' => 'web', 'name' => 'browse_role'],
        	['guard_name' => 'web', 'name' => 'add_role'],
        	['guard_name' => 'web', 'name' => 'edit_role'],
        	['guard_name' => 'web', 'name' => 'delete_role'],
        );

        foreach ($listData as $data) {
	        $permission = Permission::create($data);
        }
    }
}
