<?php

use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
			AddPermissionData::class,
			AddSystemAdminRole::class
        ]);
    }
}
