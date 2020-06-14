<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create Roles
         */
        $adminRole = Role::where(['name' => 'admin'])->first();
        $moderatorRole = Role::where(['name' => 'moderator'])->first();

        /**
         * User Permissions
         */
        $userPermissions = [
            'ban' => Permission::create(['name' => 'ban users']),
            'unban' => Permission::create(['name' => 'unban users']),
            'edit' => Permission::create(['name' => 'edit users'])
        ];

        $adminRole->givePermissionTo($userPermissions['ban']);
        $moderatorRole->givePermissionTo($userPermissions['ban']);

        $adminRole->givePermissionTo($userPermissions['unban']);
        $moderatorRole->givePermissionTo($userPermissions['unban']);

        $adminRole->givePermissionTo($userPermissions['edit']);
        $moderatorRole->givePermissionTo($userPermissions['edit']);

        /**
         * Guest Permissions
         */
        $guestPermissions = [
            'ban' => Permission::create(['name' => 'ban guests']),
            'unban' => Permission::create(['name' => 'unban guests'])
        ];

        $adminRole->givePermissionTo($guestPermissions['ban']);
        $moderatorRole->givePermissionTo($guestPermissions['ban']);

        $adminRole->givePermissionTo($guestPermissions['unban']);
        $moderatorRole->givePermissionTo($guestPermissions['unban']);

    }
}
